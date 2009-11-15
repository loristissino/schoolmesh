<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>


<?php include_http_metas() ?>
<?php include_metas() ?>

<title>SchoolMesh - 
	<?php if (!include_slot('title')): ?>
	<?php echo __('An integrated environment for school applications'); ?>
	<?php endif; ?>
</title>

<link rel="shortcut icon" href="/schoolmesh/images/favicon.ico" />

</head>
<body>
<div id="container">
	<?php if ($sf_user->hasFlash('schoolmesh_alerts')): ?>
		<div id="schoolmesh_alerts">
			<?php echo $sf_user->getFlash('schoolmesh_alerts') ?>
		</div>
	<?php endif ?>
	<?php if (has_slot('breadcrumbs')): ?>
		<div id="breadcrumbs">
			<p><?php echo __('Where am I? ') . link_to(__("Home"), "@homepage") ?> » <?php include_slot('breadcrumbs') ?></p>
		</div>
	<?php endif ?>
<div id="sf_admin_container">
<?php echo $sf_content ?>
</div>
  <div id="navigation">
    <ul>
       <li><?php echo link_to(__("Home"), "@homepage") ?></li>
       <li><?php echo link_to(__("Who's on line"), "@whosonline") ?></li>
       <li><?php echo link_to(__("My profile"), "@profile")  ?></li>
       <li><?php echo link_to(__("Workstation list"), "@workstation")  ?></li>
       <li><?php //echo link_to(__("Plans and Reports"), "@plansandreports")  ?></li>	   
    </ul>
</div>

<?php include_component('profile', 'info') ?>

<div class="feedback">
  <h3>Feedback</h3>
    <p>Questa applicazione è in via di sviluppo. Si prega di segnalare qualsiasi anomalia inviando un'email
    all'indirizzo <em><?php echo sfConfig::get('app_mail_webmaster'); ?></em>. Grazie.</p>
</div>


</div>
      <div id="footer">
        <div class="content">
          <span class="schoolmesh">
            <a href="http://schoolmesh.mattiussilab.net"><img src="/schoolmesh/images/schoolmesh-mini.png" alt='schoolmesh' /></a>
            powered by <a href="http://www.symfony-project.org/">
            <img src="/schoolmesh/images/symfony.gif" alt="symfony framework" /></a>
          </span>

        </div>
      </div>
      

</body>
</html>
