<h1><?php echo $lang ?></h1>

<pre>
<?php foreach($units as $unit): ?>
<?php echo $unit['id'] ?> <?php echo $unit['newsource'] . PHP_EOL  ?>
<?php endforeach ?>
</pre>

<?php echo link_to('Show', url_for('translations/show?lang='.$lang)) ?>
