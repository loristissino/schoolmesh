<?php slot('title', __("Who's on line")) ?>
<?php slot('breadcrumbs',
	__("Who's on line")
	)
	
	?>


<h1><?php echo __("Who's on line") ?></h1>

<div class="sf_admin_list">

<?php if(sizeof($lanlog_list)>0): ?>

<table cellspacing="0" summary="List of users online">

  <thead>
    <tr>
      <th class="sf_admin_text"><?php echo __('Username') ?></th>
      <th class="sf_admin_text"><?php echo __('Full name') ?></th>
      <th class="sf_admin_text"><?php echo __('Host') ?></th>
      <th class="sf_admin_text"><?php echo __('Subnet') ?></th>
      <th class="sf_admin_text"><?php echo __('Online since') ?></th>
      <th class="sf_admin_text"><?php echo __('Last action') ?></th>
      <th class="sf_admin_text"><?php echo __('Internet access enabled?') ?></th>
    </tr>
  </thead>
  <tbody>
  <?php $i=0; ?>
    <?php foreach ($lanlog_list as $lanlog): ?>
    <tr class="sf_admin_row <?php echo (++$i & 1)? 'odd':'even' ?>">

      <td><strong><?php echo $lanlog->getsfGuardUser()->getUsername() ?></strong></td>
	  <td><?php echo $lanlog->getsfGuardUser()->getProfile()->getFullname() ?></td>
      <td><?php //echo $lanlog->getWorkstation() ?></td>
      <td><?php //echo $lanlog->getWorkstation()->getSubnet() ?></td>
      <td><?php echo Generic::datetime($lanlog->getsfGuardUser()->getProfile()->getLastLoginAt('U'), $sf_context) ?></td>
      <td><?php echo Generic::datetime($lanlog->getsfGuardUser()->getProfile()->getLastActionAt('U'), $sf_context) ?></td>
      <td><?php //if ($lanlog->getWorkstation()->getIsEnabled()): ?>
                    <?php //echo image_tag(sfConfig::get('sf_admin_module_web_dir').'/images/tick.png', array('alt' => __('Checked', array(), 'sf_admin'), 'title' => __('Checked', array(), 'sf_admin'))) ?>
                <?php //else: ?>
                    &nbsp;
            <?php //endif; ?>
</td>
</td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<?php endif ?>

</div>

</div>

<div>
<p><?php echo image_tag('feed-icon-14x14', 'alt=atom feed') ?>&nbsp;<a href="<?php echo url_for('@whosonline?sf_format=atom') ?>">Full feed</a></p>
