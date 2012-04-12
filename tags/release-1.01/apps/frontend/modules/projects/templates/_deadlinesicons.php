<?php if($project->getState()<Workflow::PROJ_FINISHED): ?>
<?php foreach($project->getProjDeadlines() as $deadline): ?>
<?php include_partial('deadlinestate', array('deadline'=>$deadline, 'with_description'=>true)) ?>
<?php endforeach ?>
<?php endif ?>