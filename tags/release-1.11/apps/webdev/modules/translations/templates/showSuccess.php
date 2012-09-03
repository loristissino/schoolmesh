<h1><?php echo $lang ?></h1>

<table border=1>
  <tr>
    <th>Id</th>
    <th>RSource</th>
    <th>LSource</th>
    <th>Target</th>
    <th>Machine</th>
    <th>Matches</th>
    <th>Warnings</th>
  </tr>

<?php $wc=0 ?>
<?php foreach($units as $id => $unit): ?>
  <tr <?php if($unit['target']!=$unit['machine']) echo ' style="background-color: #F1F7B0"' ?>>
    <td><a name="unit_<?php echo $id ?>"><?php echo $id ?></a></td>
    <td><?php echo $unit['rsource'] ?></td>
    <td <?php if($unit['lsource']!=$unit['rsource']) { echo ' style="background-color: red"'; $wc++; } ?>><?php echo $unit['lsource'] ?></td>
    <td <?php if($unit['target']!=$unit['rsource']) { echo ' style="background-color: green"'; $wc++; } ?>><?php echo $unit['target'] ?></td>
    <td><?php echo $unit['machine'] ?></td>
    <td><?php echo $unit['matches'] ?></td>
    <?php if(sizeof($unit['warnings'])>0): ?>
      <?php include_partial('td_warnings', array('unit'=>$unit, 'lang'=>$lang)) ?>
    <?php else: ?>
      <td></td>
    <?php endif ?>
  </tr>
<?php endforeach ?>
</table>

<hr />

<?php echo link_to('Clean template', url_for('translations/show?lang='.$lang . '&template=clean')) ?><br />
<?php echo link_to('Xliff template', url_for('translations/show?lang='.$lang . '&template=xliff')) ?>

<hr />
<pre>
<?php foreach($units as $id => $unit): ?>
<?php if($unit['lsource']!=$unit['rsource']): ?>
      &lt;trans-unit id="<?php echo $id ?>"&gt;
        &lt;source&gt;<?php echo htmlspecialchars($unit['rsource']) ?>&lt;/source&gt;
        &lt;target&gt;<?php echo htmlspecialchars($unit['rsource']) ?>&lt;/target&gt;
      &lt;/trans-unit&gt;
<?php endif ?>
<?php endforeach ?>

</pre>
