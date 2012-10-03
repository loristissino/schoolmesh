<?php

/**
 * sfTCPDFLabel class.
 *
 * @package    sfTCPDFLabelPlugin
 * @author     Loris Tissino <loris.tissino@gmail.com>
 */

class sfTCPDFLabel extends sfTCPDF
{

    private $_Avery_Name     = '';                // Name of format
    private $_Margin_Left    = 0;                // Left margin of labels
    private $_Margin_Top     = 0;                // Top margin of labels
    private $_X_Space        = 0;                // Horizontal space between 2 labels
    private $_Y_Space        = 0;                // Vertical space between 2 labels
    private $_X_Number       = 4;                 // Number of labels horizontally
    private $_Y_Number       = 8;                 // Number of labels vertically
    private $_Width          = 50;                // Width of label
    private $_Height         = 30;                // Height of label
    private $_Char_Size      = 8;                // Character size
    private $_Line_Height    = 10;                // Default line height
    private $_Metric         = 'mm';              // Type of metric for labels.. Will help to calculate good values
    private $_Metric_Doc     = 'mm';              // Type of metric for the document
    private $_Font_Name      = 'Arial';           // Name of the font

    private $_COUNTX = 0;
    private $_COUNTY = 0;


  function __construct($XNumber=4, $YNumber=8, $Width=50, $Height=30, $orientation='P', $format='A4')
  {
    $this->_X_Number = $XNumber;
    $this->_Y_Number = $YNumber;
    
    $this->_Width=$Width;
    $this->_Height=$Height;
        
    parent::__construct($orientation = 'P', $unit = 'mm', $format = 'A4', $unicode = true, $encoding = "UTF-8");

  }
  function addLabel($text) {
    // We are in a new page, then we must add a page
    if (($this->_COUNTX ==0) and ($this->_COUNTY==0))
    {
        $this->AddPage();
    }

    $_PosX = $this->_Margin_Left+($this->_COUNTX*($this->_Width+$this->_X_Space));
    $_PosY = $this->_Margin_Top+($this->_COUNTY*($this->_Height+$this->_Y_Space));
    $this->SetXY($_PosX+3, $_PosY+3);
    $this->MultiCell($this->_Width, $this->_Line_Height, $text, 0, 'L');
    $this->_COUNTY++;

    if ($this->_COUNTY == $this->_Y_Number)
    {
        // End of column reached, we start a new one
        $this->_COUNTX++;
        $this->_COUNTY=0;
    }

    if ($this->_COUNTX == $this->_X_Number)
    {
        // Page full, we start a new one
        $this->_COUNTX=0;
        $this->_COUNTY=0;
    }
  }
}