<?php

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
  return 
    sfConfig::get('app_config_currency_symbol', '€') . '&nbsp;' .
    number_format($value, 
      sfConfig::get('app_config_currency_decimals', 2), 
      sfConfig::get('app_config_currency_decpoint', ','),
      sfConfig::get('app_config_currency_thousandssep', '.')
      );
}

function quantityvalue($value, $mu='')
{
  if($mu)
  {
    $mu=$mu . '&nbsp;';
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
