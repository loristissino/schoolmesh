<h1>Compila il questionario 2010</h1>
<?php /* this will be modified into a generic Moodle access page in a few weeks */ ?>

<p>Dopo aver seguito il link qui sotto, dovrai entrare nel corso (<em>Attività generiche...</em>) e selezionare il Questionario (in alto a sinistra).</p>

<h2><?php echo __('Actions') ?></h2>

<ul class="sf_admin_actions">
<li  class="sf_admin_action_moodle"><?php echo link_to(
  __('Moodle e-learning platform'),
  $url,
  array('absolute'=>true, 'popup'=>true)
  )
?></li>
</ul>
