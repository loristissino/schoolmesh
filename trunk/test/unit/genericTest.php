<?php

require_once dirname(__FILE__).'/../bootstrap/unit.php';
 
$t = new lime_test(6, new lime_output_color());

$date=time();

$t->todo('Must take timezone into account');

$t->like(Generic::datetime($date), '/Today.*/', '::datetime() returns Today for now');

$infodate=getdate(time());
$date=mktime(2, 0, 0, $infodate['mon'], $infodate['mday'], $infodate['year']);

$t->like(Generic::datetime($date), '/Today.*/', '::datetime() returns Today for today\'s 2 AM');

$infodate=getdate(time());
$date=mktime(12, 0, 0, $infodate['mon'], $infodate['mday']-1, $infodate['year']);

$t->like(Generic::datetime($date), '/Yesterday.*/', '::datetime() returns Yesterday for yesterday\'s noon');

$infodate=getdate(time());
$date=mktime(2, 0, 0, $infodate['mon'], $infodate['mday']-1, $infodate['year']);

$t->like(Generic::datetime($date), '/Yesterday.*/', '::datetime() returns Yesterday for yesterday\'s 2 AM');

$infodate=getdate(time());
$date=mktime(2, 0, 0, $infodate['mon'], $infodate['mday']-2, $infodate['year']);

$t->like(Generic::datetime($date), '/[0-9].*/', '::datetime() returns a date for previuos timestamps');
