<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>

<?php include_http_metas() ?>
<?php include_metas() ?>

<?php include_title() ?>

<link rel="shortcut icon" href="/favicon.ico" />

</head>
<body>
<h1>SchoolMesh Backend Administration</h1>

<?php echo $sf_content ?>

<div id="menu">
<ul>
<li><?php echo link_to('Roles', '@role') ?></li>
<li><?php echo link_to('Classes', '@schoolclass') ?></li>
<li><?php echo link_to('Appointments', '@appointment') ?></li>
<li><?php echo link_to('Enrolments', '@enrolment') ?></li>
<li><?php echo link_to('Workstations', '@workstation') ?></li>
<li><?php echo link_to('Subnets', '@subnet') ?></li>

</ul>
</div>

</body>
</html>
