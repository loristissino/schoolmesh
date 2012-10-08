<?php $items=$sf_user->getAttribute($name)->getRawValue() ?>
<?php if(sizeof(array_filter(array_keys($items)))): ?>
<div id="<?php echo $div_id ?>">
<p><?php echo __($title) ?></p>
<ul>
<?php $count=0; foreach($sf_user->getAttribute($name) as $key=>$value): ?>
<?php if($key): $count++?>
<li>
<?php echo link_to(
  $key,
  url_for($value.$key)
  )
?>
</li>
<?php endif ?>
<?php endforeach ?>
</ul>
<?php if($count>0): ?>
<hr />
<?php echo link_to(
  __('Clear history'),
  url_for('profile/clearhistory?name=' . $name),
  array(
    'method'=>'POST'
    )
  )
?>
<?php endif ?>
</div>
<?php endif ?>