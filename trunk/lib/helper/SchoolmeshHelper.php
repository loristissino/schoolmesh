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
    if ($key==$selected)
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

  return javascripttag("$(document).ready(function() {
     $('" . $name . "').editable('" . $url . "', {\n" .
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
  return $text . $current;
}



