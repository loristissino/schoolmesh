<h1><?php echo $profile->getFullName() ?></h1>

<h2><?php echo $path ?></h2>

<?php if ($sf_user->hasFlash('notice')): ?>
  <div class="notice"><?php echo $sf_user->getFlash('notice')?></div>
<?php endif; ?>
<?php if ($sf_user->hasFlash('error')): ?>
  <div class="error"><?php echo $sf_user->getFlash('error')?></div>
<?php endif; ?>

<?php if($path!='/'): ?>
<p><?php echo link_to(
	__('Up'),
	url_for('filebrowser/up')
	)
?></p>
<?php endif ?>


<?php if (sizeof($folder_items)>0): ?>
<?php $i=0 ?>
<div class="sf_admin_list">

<table cellspacing="0">
  <thead>
    <tr>
      <th class="sf_admin_text"><?php echo __('Type') ?></th>
      <th class="sf_admin_text"><?php echo __('Name') ?></th>
      <th class="sf_admin_text"><?php echo __('Size') ?></th>
      <th class="sf_admin_text"><?php echo __('Date') ?></th>
      <th class="sf_admin_text"><?php echo __('Actions') ?></th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($folder_items as $item): ?>
    <tr class="sf_admin_row <?php echo (++$i & 1)? 'odd':'even' ?>">
      <td><?php include_component('filebrowser', 'mimetype', array('mimetype'=>$item->getMimeType())) ?></td>
      <td><?php echo $item->getName() ?></td>
      <td><?php echo $item->getSize() ?></td>
      <td><?php echo Generic::datetime($item->getTimestamp(), $sf_context) ?></td>
      <td>
		<?php if($item->getFiletype()=='directory'): ?>
			<?php echo link_to(
				__('Open'),
				url_for('filebrowser/open?name='. $item->getName())
				)
			?>
		<?php endif ?>
		<?php if($item->getIsDownloadable()): ?>
			<?php echo link_to(
				__('Download'),
				url_for('filebrowser/download?name='. urlencode($item->getName()))
				)
			?>
		<?php endif ?>
	  </td>
	</tr>
	<?php endforeach ?>
  </tbody>
</table>

<?php else: ?>
<p><?php echo __('This directory is empty.') ?></p>
<?php endif ?>

<hr />

<form action="<?php echo url_for('filebrowser/upload') ?>" method="POST" enctype="multipart/form-data">

  <table>
    <?php echo $form ?>
	<tr>
      <td colspan="2">
         <input type="submit" name="save" value="<?php echo __('Upload') ?>">
      </td>
    </tr>
  </table>
</form>

