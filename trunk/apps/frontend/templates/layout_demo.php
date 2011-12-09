<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>


<?php include_http_metas() ?>
<?php include_metas() ?>

<?php use_stylesheet('print', 'last', array('media'=>'print')) ?>

<title>SchoolMesh - 
	<?php if (!include_slot('title')): ?>
	<?php echo __('An integrated environment for school applications'); ?>
	<?php endif; ?>
</title>

<link rel="shortcut icon" href="http://www.schoolmeshdemo.tuxfamily.org/images/favicon.ico" />
    <?php use_helper('jQuery') ?>
    <?php include_javascripts() 
    /* the book says it could be at the end of the page for performance reasons 
    but that way it doesn't work with FlowPlayer (which is not unobtrusive) */?>

</head>
<body>
<div id="container">
	<?php if ($sf_user->hasFlash('schoolmesh_alerts')): ?>
		<div id="schoolmesh_alerts">
			<?php echo $sf_user->getFlash('schoolmesh_alerts') ?>
		</div>
	<?php endif ?>
  <?php if(sfConfig::get('app_demo_is_active', false)): ?>
    <?php $minutes_missing=minutes_missing_to_restore() ?>
    <div style="background-color: <?php echo $minutes_missing>5? '#DBF8E7': ($minutes_missing>1? '#FFF5A5': 'red') ?>"><?php echo __('This is a <a href="http://www.schoolmesh.mattiussilab.net/demo">demo version</a>, and the contents need to be cleaned up every hour.')?> <?php echo format_number_choice(
      '[0]The database will be reset to default in few seconds.|[1]The database will be reset to default in one minute.|(1,+Inf]The database will be reset to default in %minutes% minutes.', 
      array('%minutes%' => minutes_missing_to_restore()), minutes_missing_to_restore()) ?>
    </div>
  <?php endif ?>
	<?php if (has_slot('breadcrumbs')): ?>
		<div id="breadcrumbs">
			<p><?php echo __('Where am I? ') . link_to(__("Home"), "@homepage") ?> » <?php include_slot('breadcrumbs') ?></p>
		</div>
	<?php endif ?>
  <?php include_component('help', 'help', array('sf_user'=>$sf_user, 'module'=>$sf_params->get('module'), 'action'=>$sf_params->get('action'))) ?>
	<?php if (has_slot('general_alerts')): ?>
    <div id="general_alerts">
    <?php include_slot('general_alerts'); ?>
    </div>
	<?php endif; ?>
<div id="sf_admin_container">
<?php echo $sf_content ?>
</div>
  <div id="navigation">
    <ul>
       <li><?php echo link_to(__("Home"), "@homepage") ?></li>
       <li><?php echo link_to(__("Who's on line"), "@whosonline") ?></li>
       <li><?php echo link_to(__("My profile"), "@profile")  ?></li>
       <li><?php echo link_to(__("Documents"), url_for('content/documents'))  ?></li>
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
            <?php echo link_to(
              image_tag(
                'schoolmesh-mini',
                array(
                  'title'=>'SchoolMesh',
                  'size'=>'102x21',
                  'alt'=>'SchooMesh',
                  )
                ),
                'http://schoolmesh.mattiussilab.net'
              )
            ?>, written by 
            <?php echo link_to(
              'Loris Tissino',
              'http://loris.tissino.it'
              )
            ?>, powered by 
            <?php echo link_to(
              image_tag(
                'symfony.gif',
                array(
                  'title'=>'Symfony',
                  'size'=>'50x15',
                  'alt'=>'Symfony',
                  )
                ),
                'http://www.symfony-project.org'
              )
            ?>
          </span>
          <br />
          <em>released under the <a href="license/gpl.txt">GNU General Public License, version 3</a></em>

        </div>
      </div>
      <hr />
      <div><a href="http://tuxfamily.org "><img src="http://logo.tuxfamily.org/hosted_by_tf2.png" alt="hosted by
tuxfamily.org" /></a></div>

      

</body>
</html>
