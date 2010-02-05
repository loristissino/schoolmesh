<div class="sf_admin_list">
<?php foreach($content['sections'] as $section): ?>
	<h2><?php echo $section['title'] ?></h2>
	<ul class="sf_admin_actions">
	<?php foreach ($section['links'] as $link): ?>
		<?php if(@$link['link']): ?>
			<li  class="sf_admin_action_open"><?php echo link_to(
				$link['title'],
				url_for('content/documents?index=' . $link['link'])
				)
			?>
			</li><br />
		<?php endif ?>
		<?php if(@$link['file']): ?>
			<li  class="sf_admin_action_open"><?php echo link_to(
				str_replace('\#', '#', $link['title']),
				url_for('content/serve?file=' . urlencode($link['file']))
				)
			?> <?php echo __('(Date: %date%)', array('%date%'=>$link['date'])) ?>
			</li><br />
		<?php endif ?>
	<?php endforeach ?>
	</ul>	

<?php endforeach ?>
</div>