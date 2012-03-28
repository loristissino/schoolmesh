<h1><?php echo __('Choose a template!') ?></h1>

<?php foreach($templates as $template): ?>
<?php echo link_to(
  $template,
  'users/getlist?template=' . $template
  )
  ?><br />
<?php endforeach ?>
