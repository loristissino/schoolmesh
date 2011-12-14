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
<?php if (has_slot('breadcrumbs')): ?>
<div id="breadcrumbs">
<p><?php echo __('Where am I? ') . link_to(__("Home"), "@homepage") ?> » <?php include_slot('breadcrumbs') ?></p>
</div>
<?php endif ?>
<?php echo $sf_content ?>
</div>


</div>
      <div id="footer">
        <div class="content">
          <span class="schoolmesh">
            <a href="http://schoolmesh.mattiussilab.net"><img src="/schoolmesh/images/schoolmesh-mini.png" /></a>
            powered by <a href="http://www.symfony-project.org/">
            <img src="/schoolmesh/images/symfony.gif" alt="symfony framework" /></a>
          </span>

        </div>
      </div>
      
</div>




</body>
</html>
