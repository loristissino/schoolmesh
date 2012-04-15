<?php include_partial('content/breadcrumps', array(
  'breadcrumps'=>array(
    'users/index' =>__('User management'),
    'users/list'=>__('List/Search'),
    'users/list?query='. $sf_user->getAttribute('currently_selected')=>__('Selected users'),
    ),
    'current'=>__("Choose a custom template")
  ))
?>

<?php if(sizeof($templates)): ?>
<p><?php echo __('Please choose a custom template for your list:') ?></p>
<ul>
<?php foreach($templates as $template): ?>
<li><?php echo link_to(
  $template,
  'users/getlist?template=' . $template
  )
  ?></li>
<?php endforeach ?>
</ul>
<?php else: ?>
<?php echo __('Looks like there are no custom templates available.') ?>
<?php endif ?>
