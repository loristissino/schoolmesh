<!--<h2><?php echo __('Current profile (year %year%)', array('%year%' => sfConfig::get('app_config_current_year'))) ?></h2>-->
<?php slot('title') ?>
<?php echo __('%fullname%\'s profile', array('%fullname%' => $sf_user->getProfile()->getFullname())) ?>
<?php end_slot() ?>

<h2><?php echo __('%fullname%: my profile', array('%fullname%' => $sf_user->getProfile()->getFullname())) ?></h2>

<?php if (sizeof($appointments)>0): ?>
<h3><?php echo __('What I teach') ?></h3>
<ul>
<?php for($i=0; $i<sizeof($appointments); $i++): ?>
    <li><?php echo $appointments[$i]->getSubject()->getDescription() . ' -> '. $appointments[$i]->getSchoolclass() . ' (' . $appointments[$i]->getYear() . ')'; ?></li>    
<?php endfor ?>

</ul>
<?php endif ?>

<?php if (sizeof($teams)>0): ?>

<h3><?php echo __('Which groups I belong to') ?></h3>
<ul>
<?php for($i=0; $i<sizeof($teams); $i++): ?>
    <li><?php echo $teams[$i]->getTeam()->getDescription(); ?> (<?php echo $teams[$i]->getRole()->getDescription(); ?>)</li>    
<?php endfor ?>

</ul>
<?php endif ?>

