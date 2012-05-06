<?php $u=$unit->getRawValue() ?>
<td style="background-color: red">
<?php $ws=$u['warnings'] ?>
  <?php foreach($ws as $w): ?>
    <?php echo link_to_if(substr($w,0,5)=='link:', $w, url_for('translations/show?lang='.$lang).'#unit_'.substr($w,5)) ?><br />
  <?php endforeach ?>
</td>
