<?php include_partial('content/breadcrumps', array(
  'breadcrumps'=>array(
    'projects/activities' =>__("Activities")
    ),
  'current'=>__('New activity'),
  ))
?>

<?php include_partial('content/flashes'); ?>

<p><?php echo __('Choose the project (and resource) you performed your activity for:') ?></p>

<?php $category=''; $project='' ?>
<?php foreach($resources as $resource): ?>
<?php if($resource->getSchoolproject()->getProjCategory()->getTitle()!=$category): ?>
  <p style="font-weight: bold"><?php echo __('Category')?>: <?php echo $category=$resource->getSchoolproject()->getProjCategory()->getTitle() ?></p>
<?php endif ?>
<?php if($resource->getSchoolproject()->getTitle()!=$project): ?>
  <p style="margin-left: 20px; font-style: italic"><?php echo __('Project') ?>: <?php echo $project=$resource->getSchoolproject()->getTitle() ?></p>
<?php endif ?>
<div class="sf_admin_action_activity"> <?php echo link_to(
  $resource->getDescription(),
  url_for('projects/newactivity?id=' . $resource->getId()),
  array(
    'title'=>__('Declare an activity performed within this resource')
    )
  )
  ?>
  <?php if($resource->getChargedUserId()==$sf_user->getProfile()->getUserId()): ?>
  <?php echo image_tag(
    $sf_user->getProfile()->getIsMale()? 'male': 'female',
    array(
    'title'=>__('This is a resource you are in charge of')
    ))?>
  <?php endif ?>
</div>
<?php endforeach ?>