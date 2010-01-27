<?php

class Folder{
	
	private $_username;
	private $_path;
	
	public function __construct($username, $path)
		{
			$this->setUsername($username);
			$this->setPath($path);
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
			
			$folderItems=Array();
			
			foreach ($info as $file)
			{
				list($filetype,$size,$timestamp,$filename,$quotedfilename)=explode(':', $file);
				$folderItems[]=new FolderItem($filetype, $timestamp, $filename, $quotedfilename, $size, $description='');
			}
			
			usort($folderItems, array('FolderItem', 'compare_items'));
			return $folderItems;
		}
		
		
	};


class FolderItem {
	
	private $_name;
	private $_quotedfilename;
	private $_filetype;
	private $_timestamp;
	private $_size;
	private $_description;

	public function __construct($filetype, $timestamp, $name, $quotedfilename, $size=0, $description='')
	{
		$this
		->setFiletype($filetype)
		->setTimestamp($timestamp)
		->setName($name)
		->setQuotedfilename($quotedfilename)
		->setSize($size)
		->setDescription($description);
	}
	
	public function setName($value)
	{
		$this->_name=$value;
		return $this;
	}
	
	public function setQuotedfilename($value)
	{
		$this->_quotedfilename=$value;
		return $this;
	}
	
	public function getName()
	{
		return $this->_name;
	}
	
	public function getQuotedfilename()
	{
		return $this->_quotedfilename;
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
		if ($a->getFileType()==$b->getFiletype())
		{
			if($a->getName()<$b->getName())
			{
				return $a->getName()<$b->getName() ? -1: +1;
			}
		}
		else
		{
			return $a->getFiletype()<$b->getFiletype() ? -1: +1;
		}
	}


}

