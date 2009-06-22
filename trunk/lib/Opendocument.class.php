<?php 
class Opendocument{
	
	private $template;
	private $filename;
	private $file2serve;
	private $type;
	
	function __construct($template, $filename='document', $type='odt')
		{
			$template=sfConfig::get('app_opendocument_template_directory').'/'.$template;

			if (!(is_dir($template)&&is_readable($template)&&is_writeable($template)))
				throw new Exception('Template not correct for Opendocument: ' . $template);
				
			$this->template=$template;
			$filename.= '.' . $type;
			$this->filename=$filename;
		}
	
	function setContent($content)
		{
			$file=fopen($this->template. '/content.xml', 'w');
			fwrite($file, $content);
			fclose($file);
		}

	function setHeader($content)
		{
			$file=fopen($this->template. '/styles.xml', 'w');
			fwrite($file, $content);
			fclose($file);
		}
	
	function setResponse($response)
		{
			$this->generateContent();
			if ($this->type=='doc')
				{
					$this->convertToDoc();
					$mimetype="application/msword";
				}
			else
				{
					$mimetype='application/vnd.oasis.opendocument.text';
				}
			$filesize=filesize($this->file2serve);
			$response->setHttpHeader('Pragma', '');
			$response->setHttpHeader('Cache-Control', '');
			$response->setHttpHeader('Content-Length', $filesize);
			$response->setHttpHeader('Content-Type', $mimetype);
			$response->setHttpHeader('Content-Disposition', 'attachment; filename="' . $this->filename . '"');
			$response->setContent(fread(fopen($this->file2serve, 'r'), $filesize));
			//unlink($this->file2serve);
		}

	private function generateContent()
		{
			$tempname=tempnam('/tmp', 'oo_');
			//unlink($tempname);
			$this->file2serve=$tempname . '.odt';
			$cmd='cd ' . $this->template . '; zip - -r * > ' . $this->file2serve;
			exec($cmd);
			
		}

	private function convertToDoc()
		{
			$docfile = str_replace('.odt', '.doc', $this->file2serve);
			$cmd='unoconv --server localhost --port 2090 --stdout -f doc ' . $this->file2serve . ' > ' . $docfile;
			exec($cmd);
			$this->file2serve = $docfile;
		}

	};