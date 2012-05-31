<?php

pake_desc('checks syntax of a YAML file');
pake_task('check-yaml');

function _run_check_yaml_help()
{
  pake_echo_action('Usage', 'symfony check-yaml filename [application [environment]]');
  pake_echo_comment('Read and print out a YAML file using the symfony library');
  pake_echo_comment('Example: symfony check-yaml config/schema.yml');
  pake_echo_action('Help', 'Detecting typical problems:');
  pake_echo_comment('Carefully examine the output this script creates.');
  pake_echo_comment('Each parent and attribute should be on their own line,');
  pake_echo_comment('using the syntax: "attribute: value"');
  pake_echo_comment('If *any* deviation from this syntax is visible, then the YAML may be in error.');
  pake_echo_action('Examples', 'Typical problems include:');
  pake_echo_comment('1. If a dash appears where a label was expected, then the YAML is missing a');
  pake_echo_comment('   colon ":" for that label. This shows up for higher-level labels.');
  pake_echo_comment('2. If the output shows more than one label on a line, or labels appear to run');
  pake_echo_comment('   together, then the source YAML could be missing a bracket or a colon, or');
  pake_echo_comment('   both. This shows up for lower-level labels.');
  pake_echo_comment('3. If the script gives an error message from the Spyc.class.php file then the');
  pake_echo_comment('   YAML is definitely in error.');
  pake_echo_comment('4. If the script gives an "Undefined" message then the YAML is also definitely');
  pake_echo_comment('   in error. Check the YAML indentation, colons on labels, and bracketing.');
}

function run_check_yaml($task, $args)
{

  if (!count($args)) {
    _run_check_yaml_help();
    throw new Exception('You must provide the YAML file to check, please check arguments.');
  }
  $filename = $args[0];
  if (!is_file($filename)) {
    throw new Exception(sprintf('The file "%s" does not exist (run task with no argument to see help).', $filename));
  }
  
  $app = isset($args[1]) ? $args[1] : 'frontend';
  if (!is_dir(sfConfig::get('sf_app_dir').DIRECTORY_SEPARATOR.$app)) {
    throw new Exception(sprintf('The app "%s" does not exist (run task with no argument to see help).', $app));
  }

  $env = isset($args[2]) ? $args[2] : 'dev';

  define('SF_ROOT_DIR',    realpath(dirname(__file__).'/../../../..'));
  define('SF_APP',         $app);
  define('SF_ENVIRONMENT', $env);
  define('SF_DEBUG',       1);
  require_once(SF_ROOT_DIR.DIRECTORY_SEPARATOR.'apps'.DIRECTORY_SEPARATOR.SF_APP.DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'config.php');
  
  pake_echo_action('Check', 'Reading and printing ' . $filename);
  $myreadyaml = sfYaml::load($filename);
  $myyaml = sfYaml::dump($myreadyaml);
  echo $myyaml;
  pake_echo_action('Done', 'Please check the validity of the output');
}
