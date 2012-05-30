<?php use_stylesheet('ui-lightness/jquery-ui-1.8.custom.css') ?>
<?php use_stylesheet('jquery.treeview.css') ?>
<?php use_javascript('jquery-ui-1.8.custom.min.js') ?>
<?php use_javascript('jquery.treeview.min.js') ?>
<?php use_javascript('jquery.cookie.js') ?>

<div id="syllabus_tree">
<?php $current_level=0 ?>
<?php foreach($syllabus->getSyllabusItems() as $syllabus_item): ?>
  <?php include_partial('syllabi/link_tree', array('syllabus'=>$syllabus, 'syllabus_item'=>$syllabus_item, 'syllabus_contributions'=>$syllabus_contributions, 'wpmodule'=>$wpmodule, 'current_level'=>$current_level)) ?>
<?php $current_level=$syllabus_item->getLevel() ?>
<?php endforeach ?>
</div>

<?php use_javascript('syllabustreeview.js') ?>