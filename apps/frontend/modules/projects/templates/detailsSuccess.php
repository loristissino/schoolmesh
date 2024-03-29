<?php use_stylesheet('ui-lightness/jquery-ui-1.8.custom.css') ?>
<?php use_javascripts_for_form($form) ?>
<?php use_javascript('jquery-ui-1.8.custom.min.js') ?>
<?php use_javascript('datepicker') ?>
<?php //use_javascript('jquery.ui.datepicker-' . sfConfig::get('sf_default_culture') . '.js') ?>

<?php if($breadcrumpstype=='projects/monitoring'):?>
<?php include_partial('content/breadcrumps', array(
  'breadcrumps'=>array(
    'projects/monitor' => __('Projects management'),
    ),
  'current'=>$project->getTitle()
  ))
?>
<?php endif ?>
<?php if($breadcrumpstype=='projects/index'):?>
<?php include_partial('content/breadcrumps', array(
  'breadcrumps'=>array(
    'projects/index' => __('Projects'),
    'projects/edit?id=' . $project->getId() => $project->getTitle(),
    ),
  'current'=>__('Details'),
  'title'=>$project->getTitle(),
  ))
?>
<?php endif ?>

<?php include_partial('content/flashes'); ?>

<h2><?php echo __('Detailed information') ?></h2>

<a name="resources"></a>
<h3><?php echo __('Tasks, resources, schedule') ?></h3>

<?php if($project->mayHaveResources()): ?>

<?php if(sizeof($resources)>0): ?>

<table cellspacing="0">
  <thead>
    <tr>
      <th class="sf_admin_text"><?php echo link_to(__('Deadline'), url_for('projects/setsortorder?data=resources&key=deadline'), array('title'=>__('Sort this table by deadline'))) ?></th>
      <th class="sf_admin_text"><?php echo link_to(__('Type'), url_for('projects/setsortorder?data=resources&key=type'), array('title'=>__('Sort this table by type'))) ?></th>
      <th class="sf_admin_text"><?php echo __('Charged user') ?></th>
      <th class="sf_admin_text"><?php echo __('Description') ?></th>
      <th class="sf_admin_text">
      <?php if($project->getState()<Workflow::PROJ_APPROVED): ?>
        <?php echo __('Estimation') ?>
      <?php else: ?>
        <?php echo __('Financing') ?>
      <?php endif ?>
      </th>
      <?php if($project->getState()>Workflow::PROJ_DRAFT): ?>
      <th class="sf_admin_text"><?php echo __('Use') ?></th>
      <th><?php echo __('Activities') ?></th>
      <?php endif ?>
      <th class="sf_admin_text"><?php echo __('Actions') ?></th>
    </tr>
  </thead>
  <tbody>
  <?php $t=array() ?>
	<?php $i=0 ?>
    <?php foreach ($resources as $resource): ?>
    <tr class="sf_admin_row <?php echo (++$i & 1)? 'odd':'even' ?>">
      <td>
        <?php echo $resource->getScheduledDeadline('d/m/Y') ?>
      </td>
      <td>
        <?php if ($resource->getProjResourceType()): ?>
          <?php echo $resource->getProjResourceType()->getDescription() ?>
        <?php endif ?>
      </td>
      <td>
        <?php echo $resource->getChargedUserProfile() ?>
      </td>
      <td><?php echo $resource->getDescription() ?></td>
      <td style="text-align: right">
      <?php if($project->getState()<Workflow::PROJ_APPROVED): ?>
        <?php echo quantityvalue($resource->getQuantityEstimated(), $resource->getProjResourceType()->getMeasurementUnit()) ?>
      <?php else: ?>
        <?php echo quantityvalue($resource->getQuantityApproved(), $resource->getProjResourceType()->getMeasurementUnit()) ?>
      <?php endif ?>
      </td>
      <?php if($project->getState()>Workflow::PROJ_DRAFT): ?>
      <td style="text-align: right">
      <?php if($resource->getTotalQuantityForAcknowledgedActivities()>$resource->getQuantityApproved()): ?>
        <?php echo image_tag(
          'dubious',
          array(
            'title'=>__('The quantity acknowledged is greater than the one financed'),
            'size'=>'16x16',
            )
          )
        ?>
      <?php endif ?>
      <?php echo quantityvalue($resource->getTotalQuantityForAcknowledgedActivities(),$resource->getProjResourceType()->getMeasurementUnit()) ?>
      </td>
      <td style="text-align: right">
      <?php if($resource->getProjResourceType()->getRoleId()): ?>
        <?php if($resource->countActivities(false)): ?>
          <?php echo image_tag(
            'notdone',
            array(
              'title'=>format_number_choice(__('[0]There are no activities to acknowledge|[1]There is one activity to acknowledge|(1,+Inf]There are %number% activities to acknowledge', array('%number%'=>$resource->countActivities(false))), null, $resource->countActivities(false))
              )
            );
            
            ?>
        <?php endif ?>
        <?php echo $resource->countProjActivities() ?>
      <?php endif ?>
      </td>
      <?php endif ?>
      <td>
      <ul class="sf_admin_td_actions">
        <?php if($project->getState()==Workflow::PROJ_DRAFT and $project->isOwnedBy($sf_user)): ?>
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
        <?php if($resource->countProjActivities()): ?>
        <li class="sf_admin_action_view">
        <?php echo link_to(
            __('View'),
            url_for('projects/viewresourceactivities?id='. $resource->getId())
            )
             ?></li>
        <?php endif ?>
        <?php if($resource->getProjResourceType() and $resource->getProjResourceType()->getRoleId() and $project->getState()>Workflow::PROJ_SUBMITTED): ?> 
        <li class="sf_admin_action_new">
        <?php echo link_to(
              __('Add'),
              'projects/addacknowledgedactivity?id='. $resource->getId(),
              array(
                'title'=>__('Add an acknowledged activity of another user for this task'),
                ) 
              ) ?>
        </li>
        <?php endif ?>

        
          
      </ul>
      </td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>
<?php else: ?>
<p><?php echo __('No resource/task defined.') ?></p>
<?php endif ?>
<?php if ($project->getState()==Workflow::PROJ_DRAFT): ?>

<ul class="sf_admin_actions">
	<li class="sf_admin_action_new">
	<?php echo link_to(
				__('Add resource/task'),
				'projects/addresource?id='. $project->getId(),
				array('method' => 'post', 'title'=>__('Add a new resource/task to this project')) 
				)?>
</li>
</ul>

<?php endif ?>

<?php else: ?>

<p><em><?php echo __('The category of this project has not been set, or for projects of the selected category the resources cannot be defined.') ?></em></p>

<?php endif // mayhaveresources? ?>

<a name="upshots"></a>
<?php if ($project->getState()<=Workflow::PROJ_SUBMITTED): ?>
<h3><?php echo __('Expected upshots') ?></h3>
<?php else: ?>
<h3><?php echo __('Obtained upshots') ?></h3>
<?php endif ?>

<?php if(sizeof($upshots)>0): ?>

<table cellspacing="0">
  <thead>
    <tr>
      <th class="sf_admin_text"><?php echo __('Deadline') ?></th>
      <th class="sf_admin_text"><?php echo __('Description') ?></th>
      <th class="sf_admin_text"><?php echo __('Indicator') ?></th>
      <?php if($project->getState()>Workflow::PROJ_SUBMITTED): ?>
      <th class="sf_admin_text"><?php echo __('Upshot') ?></th>
      <th class="sf_admin_text"><?php echo __('Evaluation') ?></th>
      <?php endif ?>
      <th class="sf_admin_text"><?php echo __('Actions') ?></th>
    </tr>
  </thead>
  <tbody>
	<?php $i=0 ?>
    <?php foreach ($upshots as $upshot): ?>
    <tr class="sf_admin_row <?php echo (++$i & 1)? 'odd':'even' ?>">
      <td><?php echo Generic::datetime($upshot->getScheduledDate('U'), $sf_context) ?></td>
      <td><?php echo $upshot->getDescription() ?></td>
      <td><?php echo $upshot->getIndicator() ?></td>
      <?php if($project->getState()>Workflow::PROJ_SUBMITTED): ?>
        <td><?php echo $upshot->getUpshot() ?></td>
        <td><?php include_partial('upshotevaluation', array('upshot'=>$upshot, 'project'=>$project)) ?></td>
      <?php endif ?>
      <td>
      <ul class="sf_admin_td_actions">
        <?php echo li_link_to_if(
            'td_action_edit',
            $project->getState()>=Workflow::PROJ_DRAFT and $project->isEditableBy($sf_user, array()),
            __('Edit'),
            url_for('projects/editupshot?id='. $upshot->getId())
            )
             ?>
        <?php echo li_link_to_if(
            'td_action_delete',
            $project->getState()==Workflow::PROJ_DRAFT and $project->isEditableBy($sf_user, array()),
            __('Delete'),
            url_for('projects/deleteupshot?id='. $upshot->getId()),
            array('method'=>'post', 'confirm' => format_number_choice(__('[0]Are you sure?|[1]Are you sure?'), null, $sf_user->getProfile()->getIsMale()))
            )
             ?>
        
          
      </ul>
      </td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>
<?php else: ?>
<p><?php echo __('No upshots defined.') ?></p>
<?php endif ?>

<?php if ($project->getState()==Workflow::PROJ_DRAFT): ?>
<ul class="sf_admin_actions">
	<li class="sf_admin_action_new">
	<?php echo link_to(
				__('Add upshot'),
				'projects/addupshot?id='. $project->getId(),
				array('method' => 'post', 'title'=>__('Add a new expected upshot to this project')) 
				)?>
</li>
</ul>
<?php endif ?>

<a name="deadlines"></a>
<h3><?php echo __('Monitoring deadlines') ?></h3>

<?php if(sizeof($deadlines)>0): ?>

<table cellspacing="0">
  <thead>
    <tr>
      <th class="sf_admin_text"><?php echo $project->getState()==Workflow::PROJ_DRAFT ? __('Deadline') : __('Original deadline') ?></th>
      <?php if($project->getState()>Workflow::PROJ_DRAFT): ?>
      <th class="sf_admin_text"><?php echo __('Current deadline') ?></th>
      <?php endif ?>
      <th class="sf_admin_text"><?php echo __('Description') ?></th>
      <th class="sf_admin_text"><?php echo __('Needs attachment?') ?></th>
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
      <td><?php echo $deadline->getNeedsAttachment()? __('yes'): __('no') ?></td>
      <?php if($project->getState()>Workflow::PROJ_DRAFT): ?>
      <td><?php include_partial('deadlinestate', array('deadline'=>$deadline, 'with_description'=>false)) ?></td>
      <?php endif ?>
      <td><?php include_partial('content/notes', array('notes'=>$deadline->getNotes())) ?></td>
      <td>
      <ul class="sf_admin_td_actions">
        <?php echo li_link_to_if(
            'td_action_edit',
            $project->getState()>=Workflow::PROJ_DRAFT and $project->isEditableBy($sf_user, array()),
            __('Edit'),
            url_for('projects/editdeadline?id='. $deadline->getId())
            )
             ?>
        <?php echo li_link_to_if(
            'td_action_delete',
            $project->getState()==Workflow::PROJ_DRAFT and $project->isEditableBy($sf_user, array()),
            __('Delete'),
            url_for('projects/deletedeadline?id='. $deadline->getId()),
            array('method'=>'post', 'confirm' => format_number_choice(__('[0]Are you sure?|[1]Are you sure?'), null, $sf_user->getProfile()->getIsMale()))
            )
             ?>
          
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
				__('Add monitoring deadline'),
				'projects/adddeadline?id='. $project->getId(),
				array('method' => 'post', 'title'=>__('Add a new deadline to this project')) 
				)?>
</li>
</ul>


<?php endif ?>

<hr />

<?php if($project->isSubmittable()): ?>

<h2><?php echo __('Actions') ?></h2>
<ul class="sf_admin_actions">
  <?php echo li_link_to_if(
    'action_edit',
    true,
    __('Edit basic information'),
    'projects/edit?id=' . $project->getId(),
    array(
      'title'=>__('Edit basic information concerning this project')
    )
    )
  ?>
</ul>
<?php endif ?>

