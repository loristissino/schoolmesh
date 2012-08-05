<?php 

require_once('library/odf.php');

class OdfDoc
{
	
	private $_file2serve;
	private $_type;
  private $_mimetype;
	private $_filename;
	private $_template;
	
	private $_config;
	
	private $_odf;

	public function __construct($template, $filename='Untitled Document', $type='odt')
		{
      
      if(sfConfig::get('app_opendocument_changedir', false)==true)
      {
        chdir(sys_get_temp_dir());
      }
			$name=tempnam('/tmp', 'oo_');
			unlink($name);
			$this->_file2serve=$name.'.odt';
			if (!in_array($type, array('odt', 'doc', 'pdf', 'rtf')))
			{
				throw new OdfDocFiletypeException('Not a valid file type specified: '. $type);
			}
			$this->_type=$type;
			$this->_filename=$filename;
			
			$this->_template=sfConfig::get('app_opendocument_template_directory').'/'.$template;
			if (!is_readable($this->_template))
			{
				throw new OdfDocTemplateException('Template not correct for Opendocument: ' . $this->_template);
			}
			
			$this->_config=Array(
//				'DELIMITER_LEFT' => '{', // Yan can also change delimiters
//				'DELIMITER_RIGHT' => '}'
			);

			$this->_odf = new Odf($this->_template, $this->_config);
      
		}
		
		
	public function getOdfDocument()
	{
		return $this->_odf;
	}
	
	public function saveFile()
		{
		// We export the file
		$this->_odf->saveToDisk($this->_file2serve);
		$this->_convert();
		return $this;
		
		}
		
	public function getFilename()
	{
		return $this->_file2serve;
	}
  
  public function getAttributedFilename()
  {
    return $this->_filename;
  }
	
	private function _convertTo($filetype)
	{
		
		if (!OdfDocPeer::getIsUnoconvActive())
		{
			throw new OdfDocConverterNotActiveException('OpenOffice converter is not active at the moment');
		}
		
		try
		{
			$converted = substr($this->_file2serve, 0, -4). '.'. $filetype;
      OdfDocPeer::convertDocument(
        $filetype,
        $this->_file2serve,
        $converted
        );
		}
		catch (Exception $e)
		{
			throw new OdfDocConversionException('Conversion error '. $this->_file2serve);
		}
		
		
//		rename($this->_file2serve, $this->_file2serve.'.source');
		unlink($this->_file2serve);

		$this->_file2serve = $converted;
    
	}
	
  private function _convert()
  {

    switch($this->_type)
    {
      case('doc'):
        $this->_convertTo('doc');
        $this->_mimetype='application/msword';
        break;
      case('pdf'):
        $this->_convertTo('pdf');
        $this->_mimetype='application/pdf';
        break;
      case('rtf'):
        $this->_convertTo('rtf');
        $this->_mimetype='text/rtf';
        break;
      default:
        $this->_mimetype='application/vnd.oasis.opendocument.text';
    }
    
  }
  
	public function setResponse($response)
		{
      
			$filesize=filesize($this->_file2serve);
			
			if ($filesize==0)
			{
				throw new OdfDocConversionException('Conversion error '. $this->_file2serve);
			}
			
			$response->setHttpHeader('Pragma', '');
			$response->setHttpHeader('Cache-Control', '');
			$response->setHttpHeader('Content-Length', $filesize);
			$response->setHttpHeader('Content-Type', $this->_mimetype);
			$response->setHttpHeader('Content-Disposition', 'attachment; filename="' . $this->_filename . '"');
			$response->setContent(fread(fopen($this->_file2serve, 'r'), $filesize));
			unlink($this->_file2serve);
		}

		
}
	
	

