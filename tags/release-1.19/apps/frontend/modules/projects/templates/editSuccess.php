<?php use_stylesheet('ui-lightness/jquery-ui-1.8.custom.css') ?>
<?php use_javascripts_for_form($form) ?>
<?php use_javascript('jquery-ui-1.8.custom.min.js') ?>
<?php use_javascript('datepicker') ?>
<?php //use_javascript('jquery.ui.datepicker-' . sfConfig::get('sf_default_culture') . '.js') ?>

<?php if($breadcrumpstype=='projects/monitoring'):?>
<?php include_partial('content/breadcrumps', array(
  'breadcrumps'=>array(
    'projects/monitor' => __("Projects management"),
    ),
  'current'=>$project->getTitle()
  ))
?>
<?php endif ?>
<?php if($breadcrumpstype=='projects/index'):?>
<?php include_partial('content/breadcrumps', array(
  'breadcrumps'=>array(
    'projects/index' => __("Projects"),
    ),
  'current'=>$project->getTitle()
  ))
?>
<?php endif ?>

<?php include_partial('content/flashes'); ?>

<form action="<?php echo url_for('projects/edit?id='. $project->getId()) ?>" method="POST">

<h2><?php echo __('Basic information') ?></h2>

  <table>
  <?php if(!isset($form['code'])): ?>
  <tr>
    <th><label for="schoolproject_code"><?php echo __('Code') ?></label></th>
    <td><?php echo $project->getCode() ?></td>
  </tr>
  <?php endif ?>
  <?php if(!isset($form['title'])): ?>
  <tr>
    <th><label for="schoolproject_title"><?php echo __('Title') ?></label></th>
    <td><?php echo $project->getTitle() ?></td>
  </tr>
  <?php endif ?>
  <?php if(!isset($form['reference_number']) && $project->getState() > Workflow::PROJ_DRAFT): ?>
  <tr>
    <th><label for="schoolproject_reference_number"><?php echo __('Reference number') ?></label></th>
    <td><?php echo $project->getReferenceNumber() ?></td>
  </tr>
  <?php endif ?>
  <tr>
    <th><label for="schoolproject_state"><?php echo __('State') ?></label></th>
    <td><?php include_partial('state', array('project'=>$project)) ?></td>
  </tr>
  <?php if(!isset($form['proj_category_id'])): ?>
  <tr>
    <th><label for="schoolproject_category"><?php echo __('Category') ?></label></th>
    <td><?php echo $project->getProjCategory() ?></td>
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

<hr />

<?php if($project->isSubmittable()): ?>

<h2><?php echo __('Actions') ?></h2>
<ul class="sf_admin_actions">
  <?php echo li_link_to_if(
    'action_edit',
    true,
    __('Edit details'),
    'projects/details?id=' . $project->getId(),
    array(
      'title'=>__('Edit resources, upshots and deadlines concerning this project')
    )
    )
  ?>
  <?php if($project->getState()==Workflow::PROJ_DRAFT): ?>
	<?php echo li_link_to_if(
    'action_submit',
    true,
    __('Submit project'),
    'projects/submit?id='. $project->getId(),
    array(
      'method' => 'post', 
      'title'=>__('Submit the project for approval'),
      'confirm' => format_number_choice(__('[0]Are you sure?|[1]Are you sure?'), null, $sf_user->getProfile()->getIsMale()) . ' ' . __('Documents submitted cannot be modified anymore.')
      ) 
    ) ?>
  <?php elseif($project->getState()==Workflow::PROJ_CONFIRMED): ?>
	<?php echo li_link_to_if(
    'action_budget',
    true,
    __('Check budget compatibility'),
    'projects/checkbudgetcompatibility?id='. $project->getId(),
    array(
      'title'=>__('Check whether the amounts of activities recognized is compatible with the ones approved'),
      ) 
    ) ?>
	<?php echo li_link_to_if(
    'action_submit',
    true,
    __('Submit report'),
    'projects/submit?id='. $project->getId(),
    array(
      'method' => 'post', 
      'title'=>__('Submit the report, confirming the data inserted'),
      'confirm' => format_number_choice(__('[0]Are you sure?|[1]Are you sure?'), null, $sf_user->getProfile()->getIsMale()) . ' ' . __('Documents submitted cannot be modified anymore.')
      ) 
    ) ?>
    <?php endif ?>
</ul>
<?php endif ?>

