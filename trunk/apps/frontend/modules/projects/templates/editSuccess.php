<?php use_stylesheet('ui-lightness/jquery-ui-1.8.custom.css') ?>
<?php use_javascripts_for_form($form) ?>
<?php use_javascript('jquery-ui-1.8.custom.min.js') ?>
<?php use_javascript('datepicker') ?>
<?php //use_javascript('jquery.ui.datepicker-' . sfConfig::get('sf_default_culture') . '.js') ?>

<?php include_partial('content/breadcrumps', array(
  'breadcrumps'=>array(
    'projects/index' => __("Projects"),
    ),
  'current'=>$project->getTitle()
  ))
?>

<?php include_partial('content/flashes'); ?>

<form action="<?php echo url_for('projects/edit?id='. $project->getId()) ?>" method="POST">

<h2><?php echo __('Basic information') ?></h2>

  <table>
  <?php if(!isset($form['title'])): ?>
  <tr>
    <th><label for="schoolproject_title"><?php echo __('Title') ?></label></th>
    <td><?php echo $project->getTitle() ?></td>
  </tr>
  <?php endif ?>
  <?php if(!isset($form['description'])): ?>
  <tr>
    <th><label for="schoolproject_description"><?php echo __('Description') ?></label></th>
    <td><?php echo $project->getDescription() ?></td>
  </tr>
  <?php endif ?>
  <tr>
    <th><label for="schoolproject_state"><?php echo __('State') ?></label></th>
    <td><?php echo $project->getState() ?></td>
  </tr>
  <?php if(!isset($form['proj_category_id'])): ?>
  <tr>
    <th><label for="schoolproject_category"><?php echo __('Category') ?></label></th>
    <td><?php echo $project->getProjCategory() ?></td>
  </tr>
  <?php endif ?>
  <?php if(!isset($form['proj_financing_id'])): ?>
  <tr>
    <th><label for="schoolproject_financing"><?php echo __('Financing') ?></label></th>
    <td><?php echo $project->getProjFinancing() ?></td>
  </tr>
  <?php endif ?>

    <?php echo $form ?>
  <?php if($project->getState()==Workflow::PROJ_DRAFT): ?>
    <tr>
      <td colspan="2">
         <input type="submit" name="save" value="<?php echo __('Save') ?>">
      </td>
    </tr>
  <?php endif ?>
  </table>
</form>  

<h2><?php echo __('Deadlines') ?></h2>

<?php if(sizeof($deadlines)>0): ?>

<table cellspacing="0">
  <thead>
    <tr>
      <th class="sf_admin_text"><?php echo $project->getState()==Workflow::PROJ_DRAFT ? __('Deadline') : __('Original deadline') ?></th>
      <?php if($project->getState()>Workflow::PROJ_DRAFT): ?>
      <th class="sf_admin_text"><?php echo __('Current deadline') ?></th>
      <?php endif ?>
      <th class="sf_admin_text"><?php echo __('Description') ?></th>
      <?php if($project->getState()>Workflow::PROJ_DRAFT): ?>
      <th class="sf_admin_text"><?php echo __('State') ?></th>
      <?php endif ?>
      <th class="sf_admin_text"><?php echo __('Notes') ?></th>
      <th class="sf_admin_text"><?php echo __('Actions') ?></th>
    </tr>
  </thead>
  <tbody>
	<?php $i=0 ?>
    <?php foreach ($deadlines as $deadline): ?>
    <tr class="sf_admin_row <?php echo (++$i & 1)? 'odd':'even' ?>">
      <td><?php echo Generic::datetime($deadline->getOriginalDeadlineDate('U'), $sf_context) ?></td>
      <?php if($project->getState()>Workflow::PROJ_DRAFT): ?>
      <td><?php echo Generic::datetime($deadline->getCurrentDeadlineDate('U'), $sf_context) ?></td>
      <?php endif ?>
      <td><?php echo $deadline->getDescription() ?></td>
      <?php if($project->getState()>Workflow::PROJ_DRAFT): ?>
      <td><?php include_partial('deadlinestate', array('deadline'=>$deadline, 'with_description'=>false)) ?></td>
      <?php endif ?>
      <td><?php include_partial('content/notes', array('notes'=>$deadline->getNotes())) ?></td>
      <td>
      <ul class="sf_admin_td_actions">
        <?php if($project->getState()==Workflow::PROJ_DRAFT): ?>
        <li class="sf_admin_action_edit">
        <?php echo link_to(
            __('Edit'),
            url_for('projects/editdeadline?id='. $deadline->getId())
            )
             ?></li>
        <li class="sf_admin_action_delete">
        <?php echo link_to(
            __('Delete'),
            url_for('projects/deletedeadline?id='. $deadline->getId()),
            array('method'=>'post', 'confirm' => format_number_choice(__('[0]Are you sure?|[1]Are you sure?'), null, $sf_user->getProfile()->getIsMale()))
            )
             ?></li>
        <?php endif ?>
          
      </ul>
      </td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>
<?php else: ?>
<p><?php echo __('No deadlines defined.') ?></p>
<?php endif ?>

<?php if ($project->getState()==Workflow::PROJ_DRAFT): ?>
<ul class="sf_admin_actions">
	<li class="sf_admin_action_new">
	<?php echo link_to(
				__('Add deadline'),
				'projects/adddeadline?id='. $project->getId(),
				array('method' => 'post', 'title'=>__('Add a new deadline to this project')) 
				)?>
</li>
</ul>


<?php endif ?>

<h2><?php echo __('Resources') ?></h2>

<?php if(sizeof($resources)>0): ?>

<table cellspacing="0">
  <thead>
    <tr>
      <th class="sf_admin_text"><?php echo __('Type') ?></th>
      <th class="sf_admin_text"><?php echo __('Description') ?></th>
      <th class="sf_admin_text"><?php echo __('M.U.') ?></th>
      <th class="sf_admin_text">
      <?php if($project->getState()<Workflow::PROJ_APPROVED): ?>
        <?php echo __('Estimation') ?>
      <?php else: ?>
        <?php echo __('Financing') ?>
      <?php endif ?>
      </th>
      <th class="sf_admin_text"><?php echo __('Actions') ?></th>
    </tr>
  </thead>
  <tbody>
	<?php $i=0 ?>
    <?php foreach ($resources as $resource): ?>
    <tr class="sf_admin_row <?php echo (++$i & 1)? 'odd':'even' ?>">
      <td>
        <?php if ($resource->getProjResourceType()): ?>
          <?php echo $resource->getProjResourceType()->getDescription() ?>
        <?php endif ?>
      </td>
      <td><?php echo $resource->getDescription() ?></td>
      <td>
        <?php if ($resource->getProjResourceType()): ?>
          <?php echo $resource->getProjResourceType()->getMeasurementUnit() ?>
        <?php endif ?>
      </td>
      <td style="text-align: right">
      <?php if($project->getState()<Workflow::PROJ_APPROVED): ?>
        <?php echo $resource->getQuantityEstimated() ?>
      <?php else: ?>
        <?php echo $resource->getQuantityApproved() ?>
      <?php endif ?>
      </td>
      <td>
      <ul class="sf_admin_td_actions">
        <?php if($project->getState()==Workflow::PROJ_DRAFT): ?>
        <li class="sf_admin_action_edit">
        <?php echo link_to(
            __('Edit'),
            url_for('projects/editresource?id='. $resource->getId())
            )
             ?></li>
        <li class="sf_admin_action_delete">
        <?php echo link_to(
            __('Delete'),
            url_for('projects/deleteresource?id='. $resource->getId()),
            array('method'=>'post', 'confirm' => format_number_choice(__('[0]Are you sure?|[1]Are you sure?'), null, $sf_user->getProfile()->getIsMale()))
            )
             ?></li>
        <?php endif ?>
          
      </ul>
      </td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>
<?php else: ?>
<p><?php echo __('No resources defined.') ?></p>
<?php endif ?>
<?php if ($project->getState()==Workflow::PROJ_DRAFT): ?>

<ul class="sf_admin_actions">
	<li class="sf_admin_action_new">
	<?php echo link_to(
				__('Add resource'),
				'projects/addresource?id='. $project->getId(),
				array('method' => 'post', 'title'=>__('Add a new resource to this project')) 
				)?>
</li>
</ul>

<?php endif ?>

<h2><?php echo __('Actions') ?></h2>
<ul class="sf_admin_actions">
  <?php if($project->getState()==Workflow::PROJ_DRAFT): ?>
	<li class="sf_admin_action_submit">
	<?php echo link_to(
				__('Submit project'),
				'projects/submit?id='. $project->getId(),
				array(
          'method' => 'post', 
          'title'=>__('Submit the project for approval'),
          'confirm' => format_number_choice(__('[0]Are you sure?|[1]Are you sure?'), null, $sf_user->getProfile()->getIsMale()) . ' ' . __('Documents submitted cannot be modified anymore.')
          ) 
				) ?>
  </li>
  <?php endif ?>
</ul>


