<?php

/**
 * helper functions.
 *
 * @package    schoolmesh
 * @subpackage lib.helper
 * @author     Loris Tissino
 * @license    GNU GPLv3 -- see license/gpl.txt for details
 */


function human_readable_size($size)
{
  return Generic::getHumanReadableSize($size);
}

function url_for_backend($name, $parameters)
{
  return sfProjectConfiguration::getActive()->generateBackendUrl($name, $parameters);
}

function url_for_frontend($name, $parameters)
{
  return sfProjectConfiguration::getActive()->generateFrontendUrl($name, $parameters);
}

// a quick and dirty replacement for the old select_tag function, now deprecated.
function selecttag($name, $optionstext)
{
  return '<select name="' . $name . '">' . $optionstext . '</select>';
}

function optionsforselect($options = array(), $selected = '')
{
  $html='';
  foreach($options as $key=>$value)
  {
    $html .= '<option value="' . $key .'"';
    if ($key===$selected)
    {
      $html .= ' selected="selected"';
    }
    $html .= '>' . $value . '</option>';
  }
  return $html;
}

function submittag($value, $name='commit')
{
  return '<input type="submit" name="' . $name . '" value="' . $value . '" />';   
}

function checkboxtag($name, $value, $checked=false)
{
  $id=str_replace('[]', '', $name) . '_'. str_replace(' ', '_', $value);
  $cht=$checked ? ' checked="checked"': '';
  return '<input type="checkbox" name="' . $name . '" id="' . $id . '" value="' . $value . '"' . $cht . ' />';

}

// a quick and dirty replacement for the old input_in_place_editor_tag function, now deprecated.
/*function inputinplaceeditortag($name, $url, $editor_options = array())
{
  $cols=array_key_exists('cols', $editor_options) ? $editor_options['cols']: 50;
  $rows=array_key_exists('rows', $editor_options) ? $editor_options['rows']: 1;

  return '<script type="text/javascript">
//<![CDATA[
new Ajax.InPlaceEditor(\'' . $name . '\', \'' . $url . '\', {cols:' . $cols . ', rows:' . $rows . '});
//]]>
</script>';
}
*/

function inputinplaceeditortag($name, $url, $options=array())
{

  foreach(array(
    'indicator'=>'Saving...',
    'tooltip'  =>'Click to edit...',
    'cancel'   =>'Cancel',
    'submit'   =>'OK',
    'onblur'   =>'ignore',  /*possible values: cancel, submit, ignore */
    'bgcolor'  =>'white',
    'hover'    =>'yellow',
    'width'    => 400,
    ) as $key=>$defaultvalue)
  {
    if (!array_key_exists($key, $options))
    {
      $options[$key]=$defaultvalue;
    }
  }
  
  $loadurltext = array_key_exists('loadurl', $options) ? "'loadurl' : '" . $options['loadurl'] . "',\n" : '';

  return javascripttag("$(document).ready(function() {
     $('" . $name . "').editable('" . $url . "', {\n" .
         $loadurltext . 
         "'indicator' : '" . $options['indicator'] . "',\n" .
         "'tooltip' : '" . $options['tooltip'] . "',\n" .
         "'cancel' : '" . $options['cancel'] . "',\n" .
         "'submit' : '" . $options['submit'] . "',\n" .
         "'onblur' : '" . $options['onblur'] . "',\n" .
         "'width' : '" . $options['width'] . "',\n" .
         "'id' : 'itemid'\n" .
         
     "});
     $('" . $name . "').hover(
      function() {\$(this).css({'background-color' : '" . $options['hover'] . "'})},
      function() {\$(this).css({'background-color' : '" . $options['bgcolor'] . "'})}
      );

 });");

}

function javascripttag($jscode)
{
  return "<script type=\"text/javascript\">
//<![CDATA[
" . $jscode . 
"//]]>
</script>";
}

function breadcrumps_to_html($crumps=array(), $current='')
{
  $text='';
  foreach($crumps as $key=>$value)
  {
    if (substr($key, 0, 1) != '_')
    {
      $text .= link_to(__($value), $key) . ' »&nbsp;';
    }
    else
    { 
      $text .= __($value) . ' »&nbsp;';
    }
  }
  return $text . html_entity_decode($current);
}

function currencyvalue($value)
{
  if ($value)
  {
    return 
      sfConfig::get('app_config_currency_symbol', '€') . '&nbsp;' .
      number_format($value, 
        sfConfig::get('app_config_currency_decimals', 2), 
        sfConfig::get('app_config_currency_decpoint', ','),
        sfConfig::get('app_config_currency_thousandssep', '.')
        );
    }
  else
  {
    return '';
  }
}

function quantityvalue($value, $mu='')
{
  if($mu)
  {
    $mu=$mu . '&nbsp;';
  }
  
  if($mu=='h&nbsp;' and $value)
  {
      $hours=floor($value);
      $minutes=round(($value-$hours)*60);
      
      return sprintf('%s%d%s%02d',
        $mu,
        $hours,
        sfConfig::get('app_config_hoursminutessep', ':'),
        $minutes
      );
  }
  
  if ($value)
  {
  return 
    $mu . number_format($value, 
      sfConfig::get('app_config_currency_decimals', 2), 
      sfConfig::get('app_config_currency_decpoint', ','),
      sfConfig::get('app_config_currency_thousandssep', '.')
      );
  }
  else
  {
    return '';
  }
}

function check_count($checkList, $groupname)
{
  $rows=array();
  foreach(array(
    Check::PASSED=>'green',
    Check::WARNING=>'orange',
    Check::FAILED=>'red'
    ) as $key=>$value)
    {
      if($checkList->getResultsByGroupName($groupname, $key)>0)
      {
        $rows[]='<span style="color: ' . $value . '">' .
          format_number_choice($checkList->getShortMessage($key), array('%1'=>$checkList->getResultsByGroupName($groupname, $key)), $checkList->getResultsByGroupName($groupname, $key)) . 
          '</span>';
      }
    }
  return implode(', ', $rows);
}


function br2nl($text)
{
  return str_replace(array('&lt;br /&gt;', '<br />'), "\n", $text);
}

function export_action_links($sf_user, $action, $sf_context)
{
  $text='';
  foreach(sfConfig::get('app_opendocument_formats') as $key=>$value)
  {
    $text.='<li class="sf_admin_action_' . $key . '">' . 
      link_to(
        $sf_context->getI18N()->__('Export to %format%', array('%format%'=>$value)),
        $action . '&doctype='.$key,
        array(
          'title'=>$sf_context->getI18N()->__('Export this document in the specified format')
          )
        ) .
      '</li><br />';
  }
  
  return $text;
}

function minutes_missing_to_restore()
{
  $info=stat(sfConfig::get('app_demo_last_restore_file'));
  $datelastrestore=$info['mtime'];
  return max(0, sfConfig::get('app_demo_time_after') - floor((time()-$datelastrestore)/60));
}


function li_link_to_if($class_suffix, $condition, $name, $internal_uri, $options=array())
{
  if($condition)
  {
    if(substr($class_suffix, 0, 3)=='td_')
    {
      $class_suffix=substr($class_suffix, 3);
      $td=true;
    }
    else
    {
      $td=false;
    }
    
    return '<li class="sf_admin_' . $class_suffix. '">' . 
    link_to($name, $internal_uri, $options).(!$td ? '<br />': '').'</li>';
  }
  else
  {
    return '<li></li>'; // this is needed to avoid <ul> element to be empty
  }
  
}

function customdir()
{
  $customdir=dirname($_SERVER['SCRIPT_NAME']);
  if($customdir=='/')
  {
    $customdir='';
  }
  return $customdir . '/custom';
}


function budgetcolor($amount, $budget)
{
  if($amount==$budget)
  {
    return 'blue';
  }
  if($amount>$budget)
  {
    return 'red';
  }
  return 'green';
}
