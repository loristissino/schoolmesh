<?php

require_once dirname(__FILE__).'/../../bootstrap/Propel.php';

$t = new lime_test(27, new lime_output_color());

$t->comment('Check class');

$t->comment('1. A passed check');
$passedCheck = new Check(Check::PASSED, 'it worked', 'groupB');

$t->is($passedCheck->getImageTag(), 'done', '->getImageTag() works');
$t->is($passedCheck->getImageTitle(), 'passed', '->getImageTitle() works');
$t->is($passedCheck->getResult(), Check::PASSED, '->getResult() works');
$t->is($passedCheck->getCommand(), '', '->getCommand() works');

$t->comment('2. A failed check');
$failedCheck = new Check(Check::FAILED, 'it did not work', 'groupB', array('command'=>'you should do something'));

$t->is($failedCheck->getImageTag(), 'notdone', '->getImageTag() works');
$t->is($failedCheck->getImageTitle(), 'failed', '->getImageTitle() works');
$t->is($failedCheck->getResult(), Check::FAILED, '->getResult() works');
$t->is($failedCheck->getCommand(), 'you should do something', '->getCommand() works');

$t->comment('3. A warning check');
$warningCheck = new Check(Check::WARNING, 'it worked, but...', 'groupA', array('command'=>'pay attention to this'));

$t->is($warningCheck->getImageTag(), 'dubious', '->getImageTag() works');
$t->is($warningCheck->getImageTitle(), 'warning', '->getImageTitle() works');
$t->is($warningCheck->getResult(), Check::WARNING, '->getResult() works');
$t->is($warningCheck->getCommand(), 'pay attention to this', '->getCommand() works');

$t->comment('CheckList class');

$checkList = new CheckList();

$checkList->addCheck($passedCheck);
$t->pass('->addCheck() allows to add a check');
$t->is(sizeof($checkList->getAllChecks()), 1, '->getAllChecks() returns the correct number of checks');

$checkList->addCheck($failedCheck);
$t->pass('->addCheck() allows to add a check');
$t->is(sizeof($checkList->getAllChecks()), 2, '->getAllChecks() returns the correct number of checks');

$checkList->addCheck($warningCheck);
$t->pass('->addCheck() allows to add a check');

$t->is(sizeof($checkList->getAllChecks()), 3, '->getAllChecks() returns the correct number of checks');

$t->is_deeply($checkList->getGroupNames(), array('groupB', 'groupA'), '->getGroupNames() returns the correct names of groups');
$t->is_deeply($checkList->getChecksByGroupName('groupB'), array($passedCheck, $failedCheck), '->getChecksByGroupName() returns the correct list of checks');
$t->is_deeply($checkList->getChecksByGroupName('groupA'), array($warningCheck), '->getChecksByGroupName() returns the correct list of checks');

$t->is($checkList->getResultsByGroupName('groupB', Check::PASSED), 1, '->getResultsByGroupName() returns the correct number of passed checks');
$t->is($checkList->getResultsByGroupName('groupB', Check::FAILED), 1, '->getResultsByGroupName() returns the correct number of failed checks');

$t->is($checkList->getResultsByGroupName('groupB', Check::WARNING), 0, '->getResultsByGroupName() returns the correct number of warnings');

$checkList->addCheck(new Check(Check::WARNING, 'strange behaviour 1', 'groupA'));
$checkList->addCheck(new Check(Check::WARNING, 'strange behaviour 2', 'groupA'));
$checkList->addCheck(new Check(Check::PASSED, 'everything ok', 'groupA'));
$checkList->addCheck(new Check(Check::FAILED, 'everything wrong', 'groupA'));
$checkList->addCheck(new Check(Check::FAILED, 'too bad!', 'groupB'));

$t->is($checkList->getResultsByGroupName('groupA', Check::WARNING), 3, '->getResultsByGroupName() returns the correct number of warnings');

$t->is($checkList->countChecksByGroupName('groupA'), 5, '->countChecksByGroupName() returns the correct number of checks for a group');

$t->is($checkList->getTotalResults(Check::FAILED), 3, '->getTotalResults() returns the correct grandtotal');
