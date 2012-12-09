<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="it" lang="it">

<head>
<?php include_http_metas() ?>
<?php include_metas() ?>

<title>
	<?php if (!include_slot('title')): ?>
	SchoolMesh - <?php echo __('An integrated environment for school applications'); ?>
	<?php endif; ?>
</title>
<link rel="shortcut icon" href="/schoolmesh/images/favicon.ico" />
</head>

<body>

<div class="left">
	
	<div class="header">
		<h2><span>SchoolMesh a supporto della didattica</span></h2>
		<h1><?php echo sfConfig::get('app_school_name'); ?></h1>
	</div>

	<div class="content">
	<?php echo $sf_content ?>
	</div>

</div>

<div class="nav">
	
	<div class="logo"><span></span></div>

	<ul>
		<li><a href="index.html">consequat molestie</a></li>
		<li><a href="index.html">sem justo</a></li>
		<li><a href="index.html">semper</a></li>
		<li><a href="index.html">sociis natoque</a></li>
		<li><a href="index.html">convallis</a></li>
	</ul>

</div>

<div class="right">

	<div class="round">		
		<div class="roundtl"><span></span></div>
		<div class="roundtr"><span></span></div>
		<div class="clearer"><span></span></div>
	</div>

	<div class="subnav">

		<h1>Area docenti</h1>
		<ul>
			<li><a href="index.html">pellentesque</a></li>
			<li><a href="index.html">sociis natoque</a></li>
			<li><a href="index.html">convallis</a></li>
			<li><a href="index.html">sociis natoque</a></li>
		</ul>

		<h1>Documentazione qualità</h1>
		<ul>
			<li><a href="index.html">consequat molestie</a></li>
			<li><a href="index.html">sem justo</a></li>
			<li><a href="index.html">semper</a></li>
			<li><a href="index.html">magna sed purus</a></li>
			<li><a href="index.html">tincidunt</a></li>
		</ul>

		<h1>Chi è online</h1>
		<ul>
			<li><a href="index.html">sociis natoque</a></li>
			<li><a href="index.html">magna sed purus</a></li>
			<li><a href="index.html">tincidunt</a></li>
			<li><a href="index.html">sociis natoque</a></li>
			<li><a href="index.html">consequat molestie</a></li>
			<li><a href="index.html">sem justo</a></li>
		</ul>

	</div>

	<div class="round">
		<div class="roundbl"><span></span></div>
		<div class="roundbr"><span></span></div>
		<span class="clearer"></span>
	</div>

</div>

</div>
      <div id="footer">
        <div class="content">
          <span class="schoolmesh">
            <img src="/schoolmesh/images/schoolmesh-mini.png" />
            powered by <a href="http://www.symfony-project.org/">
            <img src="/schoolmesh/images/symfony.gif" alt="symfony framework" /></a>
          </span>

        </div>
      </div>
      
</div>

</body>

</html>