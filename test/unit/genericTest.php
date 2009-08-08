<?php

require_once dirname(__FILE__).'/../bootstrap/unit.php';
 
$t = new lime_test(10, new lime_output_color());

$date=time();

$t->like(Generic::datetime($date), '/Today.*/', '::datetime() returns Today for now');

$offset=date('Z');

$infodate=getdate(time());
$date=mktime(0, 0, 0, $infodate['mon'], $infodate['mday'], $infodate['year'])+$offset;

$t->like(Generic::datetime($date), '/Today.*/', '::datetime() returns Today for today\'s Midnight');

$t->like(Generic::datetime($date-1), '/Yesterday.*/', '::datetime() returns Yesterday for today\'s Midnight minus 1 second');

$infodate=getdate(time());
$date=mktime(12, 0, 0, $infodate['mon'], $infodate['mday']-1, $infodate['year'])+$offset;

$t->like(Generic::datetime($date), '/Yesterday.*/', '::datetime() returns Yesterday for yesterday\'s noon');

$infodate=getdate(time());
$date=mktime(0, 0, 0, $infodate['mon'], $infodate['mday']-1, $infodate['year'])+$offset;

$t->like(Generic::datetime($date), '/Yesterday.*/', '::datetime() returns Yesterday for yesterday\'s midnight');

$t->like(Generic::datetime($date-1), '/[0-9].*/', '::datetime() returns a date for yesterday\'s midnight minus 1 second');


$infodate=getdate(time());
$date=mktime(0, 0, 0, $infodate['mon'], $infodate['mday']-2, $infodate['year'])+$offset;

$t->like(Generic::datetime($date), '/[0-9].*/', '::datetime() returns a date for previuos timestamps');

$string=date('Ymd');

$t->is(Generic::date_difference_from_now($string), 0, '::date_difference_from_now() returns 0 for now');

$string=date('Ymd', mktime(0, 0, 0, $infodate['mon'], $infodate['mday']-1, $infodate['year'])+$offset);

$t->is(Generic::date_difference_from_now($string), 1, '::date_difference_from_now() returns 1 for yesterday, midnight');

$string=date('Ymd', mktime(0, 0, 0, $infodate['mon'], $infodate['mday']-2, $infodate['year'])+$offset);

$t->is(Generic::date_difference_from_now($string), 2, '::date_difference_from_now() returns 2 for two days ago');
