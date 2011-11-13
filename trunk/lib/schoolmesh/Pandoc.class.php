<?php 
class Pandoc{
	
	private $text;
	private $tempfile_input;
	private $tempfile_output;
	
	function __construct($text='')
		{
			$this->text=$text;
		}
	
	function generateFile($parameters='')
		{
			$this->tempfile_input= tempnam('/tmp', 'schoolmesh_i_');
			$temp=fopen($this->tempfile_input, 'w');
			fwrite($temp, $this->text);
			fclose($temp);
			$this->tempfile_output= tempnam('/tmp', 'schoolmesh_o_');

			$cmd = '/usr/bin/pandoc ' . $parameters . ' ' . $this->tempfile_input . '  -o ' . $this->tempfile_output;
			exec($cmd, $output, $return_var);
			
			unlink($this->tempfile_input);
			return ($return_var==0);
			
			
		}

	function getFileSize()
		{
			return filesize($this->tempfile_output);
		}

	function getGeneratedFile()
		{
			$data= fread(fopen($this->tempfile_output, 'r'), filesize($this->tempfile_output));
			unlink($this->tempfile_output);
			return $data;
		}

	};
