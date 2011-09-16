<div id="help">
<?php echo link_to(
  image_tag('help', array(
    'title'=>__('Help on action «%module%/%action%»', array('%module%'=>$module, '%action%'=>$action)),
    'size='=>'16x16'
    )) . '&nbsp;',
  $helplink
) ?>
<?php echo link_to(
  __('Help'),
  $helplink 
  )
?>
</div>
