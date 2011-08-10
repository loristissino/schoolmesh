<p>Error</p>

<p>These appointments do not share the same Syllabus: </p>

<ul>
<?php foreach($appointments as $appointment): ?>
<li><?php echo $appointment ?> (<?php echo $appointment->getId() ?>) -- syllabus <?php echo $appointment->getSyllabusId() ?></li>
<?php endforeach ?>
</ul>


<?php $ids=array() ?>
<?php foreach($appointments as $appointment): ?>
<?php $ids[] = $appointment->getId() ?> 
<?php endforeach ?>

UPDATE appointment SET syllabus_id=2 WHERE id IN (<?php echo implode(', ', $ids) ?>);



