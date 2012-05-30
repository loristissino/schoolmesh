<?php

include(dirname(__FILE__).'/../../bootstrap/functional.php');

$helper = new SchoolmeshHelperTestFunctional();
$helper->loadData();

$browser=new sfTestBrowser();

// Jobeet dice di usare sfBrowser, ma nel forum ho trovato che è meglio sfTestBrowser

//$browser->initialize();

$browser-> info('1. Basic Authentication')->
   get('/track')->
   with('request')->
   begin()->
    isParameter('module', 'track')->
    isParameter('action', 'index')->
   end()->
   with('response')->
   begin()->
    checkElement('body', '/Restricted Area/')->
    info('1.1. Admin is user is authorized')->
   end()->
  setField('signin[username]', 'loris.tissino')->
  setField('signin[password]', 'lorisp')->
  click('sign in')->
  isRedirected()->
  followRedirect()->
  with('response')->
   checkElement('body', '/Track List/')->
  end()->
   get('/logout')->
   get('/track')->
   with('request')->
   begin()->
    isParameter('module', 'track')->
    isParameter('action', 'index')->
   end()->
   with('response')->
    checkElement('body', '/Restricted Area/')->
   end()->
  info('1.2. Not admin user is not authorized')->
  setField('signin[username]', 'helen.abram')->
  setField('signin[password]', 'helenp')->
  click('sign in')->
  isRedirected()->
  followRedirect()->
  with('response')->
    checkElement('body', "/You don't have the required permission/")->
  end()
  ;
  
