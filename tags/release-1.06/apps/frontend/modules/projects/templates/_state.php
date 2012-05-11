<?php $states=Workflow::getProjSteps() ?>
<?php echo __($states[$project->getState()]['stateDescription']) ?>
