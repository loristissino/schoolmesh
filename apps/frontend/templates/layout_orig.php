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

<link rel="shortcut icon" href="<?php echo sfConfig::get('app_config_favicon_url', 'no address specified in app.yml') ?>" />
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
       <li><?php echo link_to(__("Home"), '@homepage') ?></li>
       <?php if($sf_user->hasCredential('admin')): ?><li><?php echo link_to(__("Who's on line"), '@whosonline') ?></li><?php endif ?>
       <li><?php echo link_to(__("My profile"), '@profile')  ?></li>
       <li><?php echo link_to(__("Documents"), url_for('content/documents'))  ?></li>
       <li><?php echo link_to(__("Organization"), '@organization')  ?></li>
    </ul>
</div>

<?php include_component('profile', 'info') ?>

<div class="feedback">
  <h3><?php echo __('Feedback') ?></h3>
    <p><?php echo __('This application is under active development. Please open issues about anomalies either by writing to %address% or by filling the issue web page at www.schoolmesh.mattiussilab.net. Thank you.', array('%address%'=>sfConfig::get('app_mail_webmaster'))) ?></p>
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
          <em>released under the <?php echo link_to('GNU General Public License', url_for('content/license')) ?></em>
          
          <?php if(is_readable(sfConfig::get('app_config_lastrevisionfile', ''))):?> - <?php readfile(sfConfig::get('app_config_lastrevisionfile')) ?><?php endif ?>

        </div>
      </div>
      

</body>
</html>
