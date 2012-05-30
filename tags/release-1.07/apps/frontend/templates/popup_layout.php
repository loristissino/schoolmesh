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
<body style="background-color: #e0ffde">
<div id="container">
<div id="sf_admin_container">
<?php echo $sf_content ?>
</div>
<div>


</body>
</html>
