<h1><?php echo $lang ?></h1>

<table border=1>
  <tr>
    <th>Id</th>
    <th>Source</th>
    <th>Target</th>
    <th>Machine</th>
    <th>Matches</th>
    <th>Warnings</th>
  </tr>
  
<?php foreach($units as $unit): ?>
  <tr <?php if($unit['target']!=$unit['machine']) echo ' style="background-color: yellow"' ?>>
    <td><?php echo $unit['id'] ?></td>
    <td><?php echo $unit['source'] ?></td>
    <td><?php echo $unit['target'] ?></td>
    <td><?php echo $unit['machine'] ?></td>
    <td><?php echo $unit['matches'] ?></td>
    <td><?php echo $unit['warnings'] ?></td>
  </tr>
<?php endforeach ?>
</table>

<hr />

<?php echo link_to('Clean template', url_for('translations/show?lang='.$lang . '&template=clean')) ?><br />
<?php echo link_to('Xliff template', url_for('translations/show?lang='.$lang . '&template=xliff')) ?>
