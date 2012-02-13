<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>


<?php include_http_metas() ?>
<?php include_metas() ?>

<title>SchoolMesh - 
	<?php if (!include_slot('title')): ?>
	<?php echo __('An integrated environment for school applications - Backend'); ?>
	<?php endif; ?>
</title>

<link rel="shortcut icon" href="/schoolmesh/images/favicon.ico" />

</head>
<body>
<div id="container">

<?php echo $sf_content ?>
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

        </div>
      </div>
      
</div>

<hr />

<p><?php echo link_to(__('Back end home'), url_for('content/index')) ?></p>

</body>
</html>
