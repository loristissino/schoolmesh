<?php

/**
 * teaching actions.
 *
 * @package    schoolmesh
 * @subpackage teaching
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class plansandreportsActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
//    $this->workplans = AppointmentPeer::doSelect(new Criteria());
    $this->workplans = $this->getUser()->getProfile()->getWorkplans();
	$this->user = $this->getUser();
	$this->steps = Workflow::getWpfrSteps();

  }

	public function executeImport(sfWebRequest $request)
	{
	
	$this->content=sfYaml::load('uploads/test.yaml');

	
		
	}

	public function executeWpsubmit(sfWebRequest $request)
	{
    $this->forward404Unless($request->isMethod('post')||$request->isMethod('put'));
		
    $this->workplan = AppointmentPeer::retrieveByPk($request->getParameter('id'));
	
	$result=$this->workplan->teacherSubmit($this->getUser()->getProfile()->getSfGuardUser()->getId());
	
	$this->getUser()->setFlash($result['result'], $this->getContext()->getI18N()->__($result['message']));
	
	$this->checks = $result['checks'];
	
//	return $this->redirect('@plansandreports');

	}

	public function executeRemovetool(sfWebRequest $request)
	{
    $this->forward404Unless($request->isMethod('post')||$request->isMethod('put'));
		
    $workplan = AppointmentPeer::retrieveByPk($request->getParameter('id'));
	
	$result=$workplan->removeTool($this->getUser()->getProfile()->getSfGuardUser()->getId(), $request->getParameter('tool'));
	
	$this->getUser()->setFlash($result['result'], $result['message']);
	
	$tools=$workplan->getTools();


	return $this->renderPartial('aux', array('tools'=>$tools, 'workplan'=>$workplan));

	}

	public function executeAddtool(sfWebRequest $request)
	{
    $this->forward404Unless($request->isMethod('post')||$request->isMethod('put'));
		
    $workplan = AppointmentPeer::retrieveByPk($request->getParameter('id'));
	
	$result=$workplan->addTool($this->getUser()->getProfile()->getSfGuardUser()->getId(), $request->getParameter('tool'));
	
	$this->getUser()->setFlash($result['result'], $result['message']);
	
	$tools=$workplan->getTools();


	return $this->renderPartial('aux', array('tools'=>$tools, 'workplan'=>$workplan));

	}



  public function executeEditInLine(sfWebRequest $request)
{
		$newtext=$request->getParameter('value');
		return $this->renderText($newtext."!");
}  


  public function executeFill(sfWebRequest $request)
  {
    $this->workplan = AppointmentPeer::retrieveByPk($request->getParameter('id'));
	$this->user=$this->getUser();
    $this->forward404Unless($this->workplan);
    $this->forward404Unless($this->workplan->isOwnedBy($this->user->getProfile()->getSfGuardUser()->getId()));


	$this->steps = Workflow::getWpfrSteps();
	
	if ($this->steps[$this->workplan->getState()]['owner']['viewAction']!='fill')
		{
		$this->redirect('plansandreports/view?id='.$this->workplan->getId());
		}

	$this->getResponse()->addCacheControlHttpHeader('max_age=1');
    $this->getResponse()->setHttpHeader('Expires',  $this->getResponse()->getDate(time()));


//$this->getResponse()->setHttpHeader('Last-Modified', $this->getResponse()->getDate(time()));

	$this->wpinfos = $this->workplan->getWpinfos();
	
	$this->tools = $this->workplan->getTools();
	
	$this->workflow_logs = $this->workplan->getWorkflowLogs();

  }


  public function executeXml(sfWebRequest $request)
	{
		$this->setLayout('odt_content');

		$this->workplan = AppointmentPeer::retrieveByPk($request->getParameter('id'));
		$this->forward404Unless($this->workplan);
		
		$whoIsViewing = $this->getUser()->getProfile()->getSfGuardUser()->getId();
		
		$this->forward404Unless($this->workplan->isViewableBy($whoIsViewing));

	}

  public function executeOdt(sfWebRequest $request)
	{
	
		$document = new Opendocument('mattiussirq', sprintf($this->getContext()->getI18N()->__('workplan di %s'), "Loris Tissino"));
		$document->setHeader($this->getController()->getPresentationFor('headers', 'workplan'));
		$document->setContent($this->getController()->getPresentationFor('plansandreports', 'xml'));
		$document->setResponse($this->getContext()->getResponse());
		return sfView::NONE;
		
	}

  public function executeDoc(sfWebRequest $request)
	{
	
		$document = new Opendocument('mattiussirq', sprintf($this->getContext()->getI18N()->__('workplan di %s'), "Loris Tissino"), 'doc');
		$document->setHeader($this->getController()->getPresentationFor('headers', 'workplan'));
		$document->setContent($this->getController()->getPresentationFor('plansandreports', 'xml'));
		$document->setResponse($this->getContext()->getResponse());
		return sfView::NONE;
		
	}

  public function executeView(sfWebRequest $request)
  {
    $this->workplan = AppointmentPeer::retrieveByPk($request->getParameter('id'));
    $this->forward404Unless($this->workplan);
	
	$whoIsViewing = $this->getUser()->getProfile()->getSfGuardUser()->getId();
	
    $this->forward404Unless($this->workplan->isViewableBy($whoIsViewing));

	switch($request->getRequestFormat())
		{
				case 'yaml': 
					$this->setLayout(false);
					$this->getResponse()->setContentType('text/plain');
					return $this->renderText(sfYaml::dump($this->workplan->getCompleteContentAsArray(), 10));
					
				case 'rtf':
					$pandoc = new Pandoc($this->workplan->getContentAsMarkdown());
					if (!$pandoc->generateFile('--to=rtf -s'))
						return $this->renderText("File could not be generated");
					$response = $this->getContext()->getResponse();
					$response->setHttpHeader('Pragma', '');
					$response->setHttpHeader('Cache-Control', '');
					$response->setHttpHeader('Content-Length', $pandoc->getFileSize());
					$response->setHttpHeader('Content-Type', 'text/rtf');
					$response->setHttpHeader('Content-Disposition', 'attachment; filename="pianodilavoro.rtf"');
					$response->setContent($pandoc->getGeneratedFile());
					return sfView::NONE; 

					
				case 'pdf':
						$config = sfTCPDFPluginConfigHandler::loadConfig();
  sfTCPDFPluginConfigHandler::includeLangFile($this->getUser()->getCulture());
 
  $doc_title    = "Workplan" .  $this->workplan->getFullname();
  $doc_subject  = "Descrizione del piano di lavoro";
  $doc_keywords = "parole chiave";
  $htmlcontent  = "&lt; € &euro; &#8364; &amp; è &egrave; &copy; &gt;<br /><h1>heading 1</h1><h2>heading 2</h2><h3>heading 3</h3><h4>heading 4</h4><h5>heading 5</h5><h6>heading 6</h6>ordered list:<br /><ol><li><b>bold text</b></li><li><i>italic text</i></li><li><u>underlined text</u></li><li><a href=\"http://www.tecnick.com\">link to http://www.tecnick.com</a></li><li>test break<br />second line<br />third line</li><li><font size=\"+3\">font + 3</font></li><li><small>small text</small></li><li>normal <sub>subscript</sub> <sup>superscript</sup></li></ul><hr />table:<br /><table border=\"1\" cellspacing=\"1\" cellpadding=\"1\"><tr><th>#</th><th>A</th><th>B</th></tr><tr><th>1</th><td bgcolor=\"#cccccc\">A1</td><td>B1</td></tr><tr><th>2</th><td>A2 € &euro; &#8364; &amp; è &egrave; </td><td>B2</td></tr><tr><th>3</th><td>A3</td><td><font color=\"#FF0000\">B3</font></td></tr></table><hr />image:<br /><img src=\"sfTCPDFPlugin/images/logo_example.png\" alt=\"test alt attribute\" width=\"100\" height=\"100\" border=\"0\" />";
 
  //create new PDF document (document units are set by default to millimeters)
  $pdf = new sfTCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true);
 
  // set document information
  $pdf->SetCreator(PDF_CREATOR);
  $pdf->SetAuthor(PDF_AUTHOR);
  $pdf->SetTitle($doc_title);
  $pdf->SetSubject($doc_subject);
  $pdf->SetKeywords($doc_keywords);
 
  $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);
 
  //set margins
  $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
 
  //set auto page breaks
  $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
  $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
  $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
  $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO); //set image scale factor
 
  $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
  $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
 
  $l=0; 
  $pdf->setLanguageArray($l); //set language items
 
  //initialize document
  $pdf->AliasNbPages();
  $pdf->AddPage();
 
  // set barcode
  $pdf->SetBarcode(date("Y-m-d H:i:s", time()));
 
  // output some HTML code
  $pdf->writeHTML($htmlcontent, true, 0);
 
  // output two html columns
  $first_column_width = 80;
  $current_y_position = $pdf->getY();
  $pdf->writeHTMLCell($first_column_width, 0, 0, $current_y_position, "<b>hello</b>", 0, 0, 0);
  $pdf->writeHTMLCell(0, 0, $first_column_width, $current_y_position, "<i>world</i>", 0, 1, 0);
 
  // output some content
  $pdf->Cell(0,10,"TEST Bold-Italic Cell",1,1,'C');
 
  // output some UTF-8 test content
  $pdf->AddPage();
  $pdf->SetFont("FreeSerif", "", 12);
 
  $utf8text = file_get_contents(K_PATH_CACHE. "utf8test.txt", false); // get utf-8 text form file
  $pdf->SetFillColor(230, 240, 255, true);
  $pdf->Write(5,$utf8text, '', 1);
 
  // remove page header/footer
  $pdf->setPrintHeader(false);
  $pdf->setPrintFooter(false);
 
  // Two HTML columns test
  $pdf->AddPage();
  $right_column = "<b>right column</b> right column right column right column right column
  right column right column right column right column right column right column
  right column right column right column right column right column right column";
  $left_column = "<b>left column</b> left column left column left column left column left
  column left column left column left column left column left column left column
  left column left column left column left column left column left column left
  column";
  $first_column_width = 80;
  $second_column_width = 80;
  $column_space = 20;
  $current_y_position = $pdf->getY();
  $pdf->writeHTMLCell($first_column_width, 0, 0, 0, $left_column, 1, 0, 0);
  $pdf->Cell(0);
  $pdf->writeHTMLCell($second_column_width, 0, $first_column_width+$column_space, $current_y_position, $right_column, 0, 0, 0);
 
  // add page header/footer
  $pdf->setPrintHeader(true);
  $pdf->setPrintFooter(true);
 
  $pdf->AddPage();
 
  // Multicell test
  $pdf->MultiCell(40, 5, "A test multicell line 1\ntest multicell line 2\ntest multicell line 3", 1, 'J', 0, 0);
  $pdf->MultiCell(40, 5, "B test multicell line 1\ntest multicell line 2\ntest multicell line 3", 1, 'J', 0);
  $pdf->MultiCell(40, 5, "C test multicell line 1\ntest multicell line 2\ntest multicell line 3", 1, 'J', 0, 0);
  $pdf->MultiCell(40, 5, "D test multicell line 1\ntest multicell line 2\ntest multicell line 3", 1, 'J', 0, 2);
  $pdf->MultiCell(40, 5, "F test multicell line 1\ntest multicell line 2\ntest multicell line 3", 1, 'J', 0);
 
  //Close and output PDF document
  $pdf->Output();
 
  return sfView::NONE;

					
		}


	$this->workflow_logs = $this->workplan->getWorkflowLogs();
	$this->wpinfos = $this->workplan->getWpinfos();
	$this->wpitemTypes=WpitemTypePeer::getAllByRank();
	$this->tools = $this->workplan->getTools(true);
	$this->is_owner = $this->workplan->getUserId() == $whoIsViewing;



  }

  public function executeExport(sfWebRequest $request)
  {
    $this->workplan = AppointmentPeer::retrieveByPk($request->getParameter('id'));
    $this->forward404Unless($this->workplan);
	
	$whoIsViewing = $this->getUser()->getProfile()->getSfGuardUser()->getId();
	
    $this->forward404Unless($this->workplan->isViewableBy($whoIsViewing));


  }



  public function executeNew(sfWebRequest $request)
  {
//    $this->form = new AppointmentForm();


  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod('post'));

    $this->form = new AppointmentForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($workplan = AppointmentPeer::retrieveByPk($request->getParameter('id')), sprintf('Object workplan does not exist (%s).', $request->getParameter('id')));
    $this->form = new AppointmentForm($workplan);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod('post') || $request->isMethod('put'));
    $this->forward404Unless($workplan = AppointmentPeer::retrieveByPk($request->getParameter('id')), sprintf('Object workplan does not exist (%s).', $request->getParameter('id')));
    $this->form = new AppointmentForm($workplan);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($workplan = AppointmentPeer::retrieveByPk($request->getParameter('id')), sprintf('Object workplan does not exist (%s).', $request->getParameter('id')));
    $workplan->delete();

    $this->redirect('plansandreports/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $workplan = $form->save();

      $this->redirect('plansandreports/edit?id='.$workplan->getId());
    }
  }
}
