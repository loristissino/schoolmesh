<h1><?php echo $lang ?></h1>

<pre>
<?php foreach($units as $id=>$unit): ?>
<?php echo $id ?> <?php if(isset($unit['newsource'])): ?><?php echo $unit['newsource'] ?><?php else: ?><?php echo $unit['rsource'] ?><?php endif ?><?php echo PHP_EOL  ?>
<?php endforeach ?>
</pre>

<?php echo link_to('Show', url_for('translations/show?lang='.$lang)) ?>
