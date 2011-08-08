<?php use_stylesheet('ui-lightness/jquery-ui-1.8.custom.css') ?>
<?php use_javascripts_for_form($form) ?>
<?php use_javascript('jquery-ui-1.8.custom.min.js') ?>
<?php use_javascript('datepicker') ?>
<?php //use_javascript('jquery.ui.datepicker-' . sfConfig::get('sf_default_culture') . '.js') ?>

<?php include_partial('content/breadcrumps', array(
  'breadcrumps'=>array(
    'projects/index' => __("Projects"),
    ),
  'current'=>$deadline->getProject()
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
  <?php if(!isset($form['hours_approved'])): ?>
  <tr>
    <th><label for="schoolproject_hours_approved"><?php echo __('Hours approved') ?></label></th>
    <td><?php echo $project->getHoursApproved() ?></td>
  </tr>
  <?php endif ?>

    <?php echo $form ?>
	<tr>
      <td colspan="2">
         <input type="submit" name="save" value="<?php echo __('Save') ?>">
      </td>
    </tr>
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
        <li class="sf_admin_action_edit">
        <?php echo link_to(
            __('Edit'),
            url_for('projects/editdeadline?id='. $deadline->getId())
            )
             ?></li>
        <?php if($project->getState()==Workflow::PROJ_DRAFT): ?>
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
</div>
<?php if ($project->getState()==Workflow::PROJ_DRAFT): ?>
<form action="<?php echo url_for('projects/adddeadline?id='. $project->getId()) ?>" method="POST">
<input type="submit" name="add_deadline" value="<?php echo __('Add deadline') ?>">
</form>
<?php endif ?>

