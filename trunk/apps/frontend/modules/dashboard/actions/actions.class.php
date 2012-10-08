<?php

/**
 * dashboard actions.
 *
 * @package    schoolmesh
 * @subpackage dashboard
 * @author     Loris Tissino <loris.tissino@gmail.com>
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class dashboardActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    $this->year=$this->getUser()->getAttribute('year', sfConfig::get('app_config_current_year'));
    $this->years = YearPeer::retrieveAll();
  }
  
  
  public function executeProjects(sfWebRequest $request)
  {
    $this->year=$this->getUser()->getAttribute('year', sfConfig::get('app_config_current_year'));
    $this->years = YearPeer::retrieveAll();
    $ids=SchoolprojectPeer::retrieveIdsForYear($this->year, false);
    $this->projects = SchoolprojectPeer::getSynthesisBudgetData($ids);
  }
  
  public function executeProjectsgraph(sfWebRequest $request)
  {
    $this->type = $request->getParameter('type');
    $this->year=$this->getUser()->getAttribute('year', sfConfig::get('app_config_current_year'));
    $this->years = YearPeer::retrieveAll();
  }
  
  public function executeProjectschart(sfWebRequest $request)
  {
    $this->year=$this->getUser()->getAttribute('year', sfConfig::get('app_config_current_year'));
    $this->years = YearPeer::retrieveAll();
    
    switch($request->getParameter('type'))
    {
      case 'bystate':
        $data=SchoolprojectPeer::getStatsForYear($this->year, $this->getContext());

        $labels=array();
        $values=array();
        
        foreach($data as $d)
        {
          $labels[]=$d->STATEDESCRIPTION;
          $values[]=$d->NUMBER;
        }
        
        $g = new stGraph();
       
        //set background color
        $g->bg_colour = '#E4F5FC';
       
        //Set the transparency, line colour to separate each slice etc.
        $g->pie(80,'#78B9EC','{font-size: 12px; color: #78B9EC;');
       
        //array two arrray one containing data while other contaning labels 
        $g->pie_values($values, $labels);
       
        //Set the colour for each slice. Here we are defining three colours 
        //while we need 7 colours. So, the same colours will be 
        //repeated for the all remaining slices in the same order  
        $g->pie_slice_colours( array('#d01f3c','#356aa0','#c79810', '#351f3c', '#ff5f3c', '#d06a3c', '#d0983c', '#d01fa0') );
       
        //To display value as tool tip
        $g->set_tool_tip( '#val#' );
       
        $g->title($this->getContext()->getI18N()->__('Projects by state'), '{font-size:18px; color: #18A6FF}' );
        echo $g->render();
       
        return sfView::NONE;
        
      case 'internalbudget':
        $this->renderProjectsBudget('internal');
        return sfView::NONE;
      case 'externalbudget':
        $this->renderProjectsBudget('external');
        return sfView::NONE;
      case 'totalbudget':
        $this->renderProjectsBudget('total');
        return sfView::NONE;
      case 'declaredactivities':
        $this->renderProjectsBudget('activities');
        return sfView::NONE;
        
      default:
        throw new Exception('invalid type specified');
      
    }
    

    
  }

  private function renderProjectsBudget($type)
  {
    switch($type)
    {
      case 'internal':
        $key = 'internal funding';
        $property='INTERNAL_FUNDING';
        break;
      case 'external':
        $key = 'external funding';
        $property='EXTERNAL_FUNDING';
        break;
      case 'total':
        $key = 'total amount';
        $property='TOTAL_AMOUNT';
        break;
      case 'activities':
        $key = 'acknowledged activities';
        $property='ACKNOWLEDGED_ACTIVITIES';
        break;
      default:
        throw new Exception('Not a valid type');
    }
    
    $ids=SchoolprojectPeer::retrieveIdsForYear($this->year, false);
    
    $Bar = new bar_sketch(55, 4, '#d070ac', '#000000');
    $Bar->key($this->getContext()->getI18N()->__($key), 10);

    $max_amount=0;
    $x_labels=array();
    $data=array();
    
    foreach(SchoolprojectPeer::getSynthesisBudgetData($ids) as $project)
    {
      if (strlen($project->TITLE)>30)
      {
        $project->LABEL=substr($project->TITLE, 0, 28). '...';
      }
      else
      {
        $project->LABEL=$project->TITLE;
      }
      $x_labels[]=$project->LABEL;
      $amount=$project->$property;
      if(!$amount)
      {
        $amount=0;
      }
      $Bar->add_data_link_tip(
        $amount, 
        $this->getContext()->getRouting()->generate('project_data', array('id'=>$project->ID)), 
        sprintf('%s<br>%s',
          $project->TITLE,
          Generic::currencyvalue($amount, false)
          )
        );
      if($project->TOTAL_AMOUNT > $max_amount)  // we always use total amount in order to have comparable graphs
      {
        $max_amount=$project->TOTAL_AMOUNT;
      }
    }
    
    $g = new stGraph();
    $g->bg_colour = '#E4F5FC';
    $g->title(
      sprintf('%s (%s)',
        $this->getContext()->getI18N()->__('Projects\' budget'),
        $this->getContext()->getI18N()->__($key)
        ),
      '{font-size:20px; color: #18A6FF;}'
      );
       
    $g->data_sets[] = $Bar;

    //to create 3d x-axis
    //$g->set_x_axis_3d( 10 );
    $g->x_axis_colour( '#8499A4', '#E4F5FC' );
    $g->y_axis_colour( '#8499A4', '#E4F5FC' );
   
    $g->set_x_labels($x_labels);
    $g->set_x_label_style(10, '#9933CC', 1, 0);
    $g->set_y_max( floor($max_amount/10000+1)*10000 );
    $g->y_label_steps( 5 );
    $g->set_y_legend(
      sprintf(
        '%s (%s)',
        $this->getContext()->getI18N()->__('Amount'),
        sfConfig::get('app_config_currency_symbol', '€')
        ),
      12, '#18A6FF' );
    $g->set_tool_tip( '#tip#' );
    
    echo $g->render();

    return sfView::NONE;
    
  }
  
  
  public function executeSample(sfWebRequest $request)
  {
    
  }
  
  public function executeData(sfWebRequest $request)
  {
    switch($request->getParameter('example'))
    {
      case 1:
        $redBar = new stBar3D( 75, '#d01f3c' );
        $redBar->key( '2007', 10 );
       
        //random data
        for( $i = 0; $i < 12; $i++ )
        {
          $redBar->data[] = rand(200,500);
        }
       
        //2nd Bar
        $blueBar = new stBar3D( 75, '#356aa0' );
        $blueBar->key( '2008', 10 );
       
        //random data for 2nd bar
        for( $i = 0; $i < 12; $i++ )
        {
          $blueBar->data[] = rand(200,500);
        }
       
        $g = new stGraph();
        $g->bg_colour = '#E4F5FC';
        $g->title( 'Number of downloads in 2008 and 2009', '{font-size:20px; color: #18A6FF;}' );
       
        $g->data_sets[] = $redBar;
        $g->data_sets[] = $blueBar;
       
        //to create 3d x-axis
        $g->set_x_axis_3d( 10 );
        $g->x_axis_colour( '#8499A4', '#E4F5FC' );
        $g->y_axis_colour( '#8499A4', '#E4F5FC' );
       
        $g->set_x_labels( array( 'Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct', 'Nov', 'Dec' ) );
        $g->set_y_max( 500 );
        $g->y_label_steps( 5 );
        $g->set_y_legend( 'stOfcPlugin', 12, '#18A6FF' );
        echo $g->render();
        return sfView::NONE;
      
      case 2:
        $chatData = array();
        for( $i = 0; $i < 7; $i++ )
        {
          $data[] = rand(5,20);
        }
       
        //Creating a stGraph object       
        $g = new stGraph();
       
        //set background color
        $g->bg_colour = '#E4F5FC';
       
        //Set the transparency, line colour to separate each slice etc.
        $g->pie(80,'#78B9EC','{font-size: 12px; color: #78B9EC;');
       
        //array two arrray one containing data while other contaning labels 
        $g->pie_values($data, array('Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday'));
       
        //Set the colour for each slice. Here we are defining three colours 
        //while we need 7 colours. So, the same colours will be 
        //repeated for the all remaining slices in the same order  
        $g->pie_slice_colours( array('#d01f3c','#356aa0','#c79810') );
       
        //To display value as tool tip
        $g->set_tool_tip( '#val#%' );
       
        $g->title( 'stOfcPlugin example', '{font-size:18px; color: #18A6FF}' );
        echo $g->render();
       
        return sfView::NONE;
      case 3:
        $chartData = array();
        for( $i = 0; $i < 7; $i++ )
        {
          $chartData[] = rand(0, 50);
        }
       
        //Create new stGraph object
        $g = new stGraph();
       
        // Chart Title
        $g->title( 'stOfcPlugin example', '{font-size: 20px;}' );
        $g->bg_colour = '#E4F5FC';
        $g->set_inner_background( '#E3F0FD', '#CBD7E6', 90 );
        $g->x_axis_colour( '#8499A4', '#E4F5FC' );
        $g->y_axis_colour( '#8499A4', '#E4F5FC' );
       
        //Use line_dot to set line dots diameter, text, color etc.
        $g->line_dot(2, 3, '#3495FE', 'Number of downloads per day', 10);
       
        //In case of line chart data should be passed to stGraph object
        //unsing set_data
        $g->set_data( $chartData );
       
        //Setting labels for X-Axis
        $g->set_x_labels( array( 'Mon','Tue','Wed','Thu','Fri','Sat','Sun' ) );
       
        //to set the format of labels on x-axis e.g. font, color, step
        $g->set_x_label_style( 10, '#18A6FF', 0, 1 );
       
        //set maximum value for y-axis
        //we can fix the value as 20, 10 etc.
        //but its better to use max of data
        $g->set_y_max( max($chartData) );
       
        $g->y_label_steps( 5 );
       
        // display the data
        echo $g->render();
       
        echo $g->render();
       
        return sfView::NONE;
      case 4:
        $chartData = array();
 
        //Array with sample random data
        for( $i = 0; $i < 7; $i++ )
        {
          $chartData[] = rand(1,20);
        }
       
        //To create a bar chart we need to create a stBarOutline Object
        $bar = new stBarOutline( 80, '#78B9EC', '#3495FE' );
        $bar->key( 'Number of downloads per day', 10 );
       
        //Passing the random data to bar chart
        $bar->data = $chartData;
       
        //Creating a stGraph object
        $g = new stGraph();
        $g->title( 'stOfcPlugin example', '{font-size: 15px;}' );
        $g->bg_colour = '#E4F5FC';
        $g->set_inner_background( '#E3F0FD', '#CBD7E6', 400 );
        $g->x_axis_colour( '#8499A4', '#E4F5FC' );
        $g->y_axis_colour( '#8499A4', '#E4F5FC' );
       
        //Pass stBarOutline object i.e. $bar to graph
        $g->data_sets[] = $bar;
       
        //Setting labels for X-Axis
        $g->set_x_labels(array( 'Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday' ));
       
        // to set the format of labels on x-axis e.g. font, color, step
        $g->set_x_label_style( 10, '#18A6FF', 0, 1 );
       
        // To tick the values on x-axis
        // 2 means tick every 2nd value
        $g->set_x_axis_steps( 2 );
       
        //set maximum value for y-axis
        //we can fix the value as 20, 10 etc.
        //but its better to use max of data
        $g->set_y_max( max($chartData) );
        $g->y_label_steps( 4 );
        $g->set_y_legend( 'stOfcPlugin', 12, '#18A6FF' );
        echo $g->render();
       
        return sfView::NONE;
      default:
        throw new Exception('not a valid example id');
    }
  }

}
