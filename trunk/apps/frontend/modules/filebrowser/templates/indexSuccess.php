<h1><?php echo $profile->getFullName() ?></h1>

<h2><?php echo $path ?></h2>

<?php if ($sf_user->hasFlash('notice')): ?>
  <div class="notice"><?php echo $sf_user->getFlash('notice')?></div>
<?php endif; ?>
<?php if ($sf_user->hasFlash('error')): ?>
  <div class="error"><?php echo $sf_user->getFlash('error')?></div>
<?php endif; ?>


<p><?php echo link_to(
	__('Up'),
	url_for('filebrowser/up')
	)
?></p>


<?php if (sizeof($folder_items)>0): ?>
<?php $i=0 ?>
<div class="sf_admin_list">

<table cellspacing="0">
  <thead>
    <tr>
      <th class="sf_admin_text" ><?php echo __('Type') ?></th>
      <th class="sf_admin_text"><?php echo __('Name') ?></th>
      <th class="sf_admin_text"><?php echo __('Quoted File Name') ?></th>
      <th class="sf_admin_text"><?php echo __('Size') ?></th>
      <th class="sf_admin_text"><?php echo __('Date') ?></th>
      <th class="sf_admin_text"><?php echo __('Actions') ?></th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($folder_items as $item): ?>
    <tr class="sf_admin_row <?php echo (++$i & 1)? 'odd':'even' ?>">
      <td><?php echo $item->getFiletype() ?></td>
      <td><?php echo $item->getName() ?></td>
      <td><?php echo $item->getQuotedfilename() ?></td>
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
	  </td>
	</tr>
	<?php endforeach ?>
  </tbody>
</table>  
<?php endif ?>