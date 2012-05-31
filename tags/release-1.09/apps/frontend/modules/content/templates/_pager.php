<?php $querylink=isset($query)?'&query='.$query : '' ?>
<p><?php if ($pager->haveToPaginate()): ?>
  <?php echo link_to(image_tag('resultset_first', array('alt'=>__('First page'))), $link . '?page='.$pager->getFirstPage() . $querylink, array('title'=>__('First page'))) ?>
  <?php echo link_to(image_tag('resultset_previous', array('alt'=>__('Previous page'))), $link . '?page='.$pager->getPreviousPage() . $querylink, array('title'=>__('Previous page'))) ?>
  <?php $links = $pager->getLinks(20); foreach ($links as $page): ?>
    <?php if ($page == $pager->getPage()): ?>
		<strong><?php echo $page ?></strong>
	<?php else: ?>
		<?php echo link_to($page, $link . '?page='.$page . $querylink) ?>
	<?php endif ?>
    <?php if ($page != $pager->getCurrentMaxLink()): ?> - <?php endif ?>
  <?php endforeach ?>
  <?php echo link_to(image_tag('resultset_next', array('alt'=>__('Next page'))), $link . '?page='.$pager->getNextPage() . $querylink, array('title'=>__('Next page'))) ?>
  <?php echo link_to(image_tag('resultset_last', array('alt'=>__('Last page'))), $link . '?page='.$pager->getLastPage() . $querylink, array('title'=>__('Last page'))) ?>
<?php endif ?>
</p>
