<?php foreach($project->getProjDeadlines() as $deadline): ?>
<?php include_partial('deadlinestate', array('deadline'=>$deadline, 'with_description'=>true)) ?>
<?php endforeach ?>