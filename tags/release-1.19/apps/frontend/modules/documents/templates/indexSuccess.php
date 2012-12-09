<?php include_partial('content/breadcrumps', array(
  'current'=>__('Documents')
  ))
?>

<?php include_partial('content/flashes'); ?>

<?php if(sizeof($Doctypes)>0): ?>
<?php foreach($Doctypes as $Doctype): ?>
  <?php include_component('documents', 'doctype', array('Doctype'=>$Doctype)) ?>
<?php endforeach ?>

<hr />

<?php else: ?>
<p><?php echo __('No documents available.') ?></p>
<?php endif ?>

<h2><?php echo __('Actions') ?></h2>
<ul class="sf_admin_actions">
<?php echo li_link_to_if('action_documents', true, __('View other static documents'), url_for('content/documents'), array('title'=>__('View other documents that are not managed by Schoolmesh\'s documents module'))) ?>
</ul>
