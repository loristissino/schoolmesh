<?xml version="1.0" encoding="utf-8"?>
       <feed xmlns="http://www.w3.org/2005/Atom">
         <title><?php echo sfConfig::get('app_school_name'); ?> - Who's on line</title>
         <subtitle>Who's on line at <?php echo sfConfig::get('app_school_name'); ?> - powered by SchoolMesh</subtitle>
         <link href="<?php echo url_for('@whosonline?sf_format=atom', true) ?>" rel="self" />
        <link href="<?php echo url_for('@homepage', true) ?>"/>
        <updated>TODO</updated>
         <author><name>SchoolMesh</name></author>
         <id><?php echo sha1(url_for('@whosonline?sf_format=atom', true)) ?></id>
<?php use_helper('Text') ?>
<?php foreach ($lanlog_list as $lanlog): ?>
         <entry>
           <title><?php echo $lanlog->getsfGuardUser()->getProfile()->getFullname() ?></title>
           <link href="" />
           <id><?php echo sha1($lanlog->getsfGuardUser()->getUsername() . $lanlog->getWorkstation() ) ?></id>
           <updated><?php echo gmstrftime('%Y-%m-%dT%H:%M:%SZ', $lanlog->getUpdatedAt('U')) ?></updated>
           <summary><?php echo $lanlog->getsfGuardUser()->getProfile()->getFullname() ?> (<?php echo $lanlog->getsfGuardUser()->getUsername() ?>) is logged on.</summary>
           <author><name>Company</name></author>
         </entry>
<?php endforeach; ?>
       </feed>
