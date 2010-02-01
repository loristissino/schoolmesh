<?php

class Folder
{
	
	private $_username;
	private $_path;
	private $_folderItems;
	
	public function __construct($username, $path)
		{
			$this->setUsername($username);
			$this->setPath($path);
			$this->_folderItems=Array();
		}

	public function getPath()
		{
			return $this->_path;
		}

	public function setPath($value)
		{
			$this->_path=$value;
			return $this;
		}
				
	private function getUsername()
		{
			return $this->_username;
		}
		
	private function setUsername($value)
		{
			$this->_username=$value;
			return $this;
		}
		
	public function getPathExists()
		{
			try
			{
				$info=Generic::executeCommand(sprintf('posixfolder_getinfo %s path "%s"', $this->getUsername(), $this->getPath()), false);
				return $info['found']==1;
			}
			catch (Exception $e)
			{
				return false;
			}
		}
		
	public function getFolderItems()
		{
			try
			{
				$info=Generic::executeCommand(sprintf('posixfolder_getinfo %s list "%s"', $this->getUsername(), $this->getPath()), false);
			}
			catch (Exception $e)
			{
				return false;
			}
						
			foreach ($info as $file)
			{
				list($filetype,$size,$timestamp,$filename,$mimetype)=explode(':', $file);
				$this->_folderItems[]=new FolderItem($filetype, $timestamp, $filename, $mimetype, $size, $description='');
			}
			
			usort($this->_folderItems, array('FolderItem', 'compare_items'));
			return $this->_folderItems;
		}
		
		
	private function _getFullPathOfFile($name)
	{
		$separator=$this->getPath()=='/' ? '': '/';
//		return str_replace(array('(', ')'), array('\(', '\)'), $this->getPath() . $separator . $name);
		return html_entity_decode($this->getPath() . $separator . $name, ENT_QUOTES, 'UTF-8');

	}
	
	public function serveFile($name, sfWebResponse $response)
	{
		
		if (!$folderItem=$this->_getFileInfo($name))
		{
			throw new Exception('file could not be served');
		}
		
		try
		{
			$info=Generic::executeCommand(sprintf('posixfolder_copyfile %s "%s"', 
				$this->getUsername(),
				$this->_getFullPathOfFile($name)
				), 
				false);
		}
		catch (Exception $e)
		{
				throw $e;
		}
		
		$response->setHttpHeader('Pragma', '');
		$response->setHttpHeader('Cache-Control', '');
		$response->setHttpHeader('Content-Length', $folderItem->getSize());
		$response->setHttpHeader('Content-Type', $folderItem->getMimeType());
		$response->setHttpHeader('Content-Disposition', 'attachment; filename="' . html_entity_decode($name, ENT_QUOTES, 'UTF-8') . '"');
		
		$tmpfile=fopen($info['TMPNAME'], 'r');
		$response->setContent(fread($tmpfile, $folderItem->getSize()));
		fclose($tmpfile);
		$tmpfile=fopen($info['TMPNAME'], 'w');
		fwrite($tmpfile, '');
		// we rewrite the file with no data, because we cannot remove it
				
	}


	public function acceptFile(sfValidatedFile $file)
	{
		try
		{
			$info=Generic::executeCommand(sprintf('posixfolder_putfile %s %s "%s"', 
				$this->getUsername(), 
				$file->getTempName(),
				$this->_getFullPathOfFile($file->getOriginalName())
				));
		}
		catch (Exception $e)
		{
			throw $e;
		}
	}

	private function _getFileInfo($name)
	{
			try
			{
				$info=Generic::executeCommand(sprintf('posixfolder_getinfo %s file "%s"', $this->getUsername(), $this->_getFullPathOfFile($name)), false);
			}
			catch (Exception $e)
			{
				return false;
			}
			
			if (sizeof($info)==0)
			{
				return false;
			}
			
			foreach($info as $file)
			{
				// we have only one file, but we don't know the index of the array... thus the loop!
				list($filetype,$size,$timestamp,$filename,$mimetype)=explode(':', $file);
			}
			$item=new FolderItem($filetype, $timestamp, $filename, $mimetype, $size, $description='');
			
			return $item;
		
	}	
		
};


class FolderItem {
	
	private $_name;
	private $_mimetype;
	private $_filetype;
	private $_timestamp;
	private $_size;
	private $_description;

	public function __construct($filetype, $timestamp, $name, $mimetype, $size=0, $description='')
	{
		$this
		->setFiletype($filetype)
		->setTimestamp($timestamp)
		->setName($name)
		->setMimeType($mimetype)
		->setSize($size)
		->setDescription($description);
	}
	
	public function setName($value)
	{
		$this->_name=$value;
		return $this;
	}
	
	public function setMimeType($value)
	{
		
		/* we add some helpful guessing to what "file" gives to us */
		
		$value=chop($value);
		
		switch($value)
		{
			case 'application/vnd.ms-office':
				switch(strtolower(substr($this->getName(), -4)))
				{
					case '.doc':
						$value='application/msword';
						break;
					case '.xls':
						$value='application/msexcel';
						break;
				}
		}
		
		$this->_mimetype=$value;
		
		return $this;
	}
	
	public function getName()
	{
		return $this->_name;
	}
	
	public function getMimeType()
	{
		return $this->_mimetype;
	}
	
	public function getIsReadable()
	{
		return strpos($this->getMimeType(), 'no read permission')==0;
	}
	
	public function getIsDownloadable()
	{
		return $this->getIsReadable() && $this->getFileType()=='regular file';
	}
	
	public function getIsRemovable()
	{
		return $this->getFileType()=='regular file' || $this->getSize()==0;
	}

	public function setFiletype($value)
	{
		$this->_filetype=$value;
		return $this;
	}
	
	public function getFiletype()
	{
		return $this->_filetype;
	}
	
	public function setTimestamp($value)
	{
		$this->_timestamp=$value;
		return $this;
	}
	
	public function getTimestamp()
	{
		return $this->_timestamp;
	}
	
	public function setSize($value)
	{
		$this->_size=$value;
		return $this;
	}
	
	public function getSize()
	{
		return $this->_size;
	}

	public function setDescription($value)
	{
		$this->_description=$value;
		return $this;
	}
	
	public function getDescription()
	{
		return $this->_description;
	}

	static function compare_items($a, $b)
	{
		
		$aname=Generic::strtolower_utf8($a->getName());
		$bname=Generic::strtolower_utf8($b->getName());
		
		if ($a->getFileType()==$b->getFileType())
		{
			if ($aname==$bname)
			{
				return 0;
			}
			else
			{
				if ($aname < $bname)
				{
					return -1;
				}
				else
				{
					return +1;
				}
			}
			
		}
		else
		{
			if ($a->getFileType()<$b->getFileType())
			{
				return -1;
			}
			else
			{
				return +1;
			}
			
		}
		
	}


}

