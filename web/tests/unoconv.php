<?php

$return_var=0;

if($_SERVER['REQUEST_METHOD']=='POST')
{
  $output=array();
  $command='unoconv --stdout --server=127.0.0.1 --port=2002 -f pdf testdoc.odt > testdoc.pdf';
  exec($command, $status, $return_var);
  
}

$status=array();
$command='ps aux | grep soffice | grep -v grep';
exec($command, $status, $return_var);
$files=scandir('.');

?>
<html>
<head>
<title>Unoconv test</title>
</head>
<body>
<p>Unoconv status:</p>
<pre><?php print_r($status) ?></pre>
<p>Files:</p>
<pre><?php print_r($files) ?></pre>
<p>Actions:</p>
<form method="post">
<input type="submit" value="try the conversion" />
</form>

<?php if($_SERVER['REQUEST_METHOD']=='POST'): ?>
<p>Unoconv output:</p>
<pre><?php print_r($output) ?></pre>
<?php endif ?>
</body>
</html>
