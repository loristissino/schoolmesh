<h2><?php echo __('Attachments') ?></h2>
<p><?php echo __($description) ?></p>


<?php if(sizeof($attachments)>0): ?>

<table cellspacing="0">
  <thead>
    <tr>
      <th class="sf_admin_text"><?php echo __('Type') ?></th>
      <th class="sf_admin_text"><?php echo __('File name') ?></th>
      <th class="sf_admin_text"><?php echo __('Size') ?></th>
      <th class="sf_admin_text"><?php echo __('Actions') ?></th>
    </tr>
  </thead>
  <tbody>
	<?php $i=0 ?>
    <?php foreach ($attachments as $attachment): ?>
    <tr class="sf_admin_row <?php echo (++$i & 1)? 'odd':'even' ?>">
      <td><?php include_component('filebrowser', 'mimetype', array('mimetype'=>$attachment->getInternetMediaType())) ?></td>
      <td><?php echo $attachment->getOriginalFileName() ?></td>
      <td style="text-align: right"><?php echo Generic::getHumanReadableSize($attachment->getFileSize()) ?></td>
      <td>
      <ul class="sf_admin_td_actions">
      <li class="sf_admin_action_download"><?php echo link_to(
				__('Download'),
				url_for('content/attachment?id='. $attachment->getId())
				)
			?>
			</li>
      </ul>
      </td>
    </tr>
    <?php endforeach ?>
  </tbody>
</table>
<?php else: ?>
<p><?php echo __('No attachments.') ?></p>
<?php endif ?>