<h1>Reference: <?php echo $lang ?></h1>

<table border=1>
  <tr>
    <th>Id</th>
    <th>Source</th>
    <th>Target</th>
    <th>Matches</th>
    <th>Warnings</th>
  </tr>

<?php $wc=0 ?>
<?php foreach($units as $unit): ?>
  <tr <?php if($unit['target']!=$unit['machine']) echo ' style="background-color: #BEF6AB"' ?>>
    <td><?php echo $unit['id'] ?></td>
    <td><?php echo $unit['source'] ?></td>
    <td><?php echo $unit['target'] ?></td>
    <td><?php echo $unit['matches'] ?></td>
    <td <?php if($unit['warnings']) { echo ' style="background-color: red"'; $wc++; } ?>><?php echo $unit['warnings'] ?></td>
  </tr>
<?php endforeach ?>
</table>

<p><?php echo sprintf('Number of items with warnings: %d.', $wc) ?></p>
<hr />

<?php echo link_to('Clean template', url_for('translations/show?lang='.$lang . '&template=clean')) ?><br />
<?php echo link_to('Index', url_for('translations/index')) ?><br />
