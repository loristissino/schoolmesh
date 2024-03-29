<?php

include(dirname(__FILE__).'/../../bootstrap/functional.php');

// create a new test browser
$browser = new sfTestBrowser();

$browser->
  get('/content/index')->
 
  with('request')->begin()->
    isParameter('module', 'content')->
    isParameter('action', 'index')->
  end()->
 
  with('response')->begin()->
    isStatusCode(200)->
    checkElement('body', '!/This is a temporary page/')->
  end()
;