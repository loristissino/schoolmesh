<?php use_helper('Javascript') ?>
<h1>Module View: <?php echo $wpmodule ?></h1>

<div id="sf_admin_container">

<h2>The module</h2>
<ul>
<li>Owner: <strong><?php echo $owner->getFullName() ?></strong></li>
<li>Workplan / Report: <strong><?php echo link_to($workplan, 'plansandreports/show?id='.$workplan->getId()) ?></strong></li>
<li>Title: 
<strong><span id="moduletitle" class="editText"><?php echo $wpmodule->getTitle() ?></span></strong>
<?php echo input_in_place_editor_tag('moduletitle', 'wpmodule/editInLine?property=Title&id='.$wpmodule->getId(), array('cols'=>'50', 'rows'=>1)) ?>
</li>
<li>
Period: 
<strong><span id="moduleperiod" class="editText"><?php echo $wpmodule->getPeriod() ?></span></strong></li>
<?php echo input_in_place_editor_tag('moduleperiod', 'wpmodule/editInLine?property=Period&id='.$wpmodule->getId(), array('cols'=>'50', 'rows'=>1)) ?>
</ul>


<?php foreach($item_groups as $item_group): ?>
	<?php include_partial('group', array('item_group' => $item_group)) ?>
<?php endforeach ?>

</div>