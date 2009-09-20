<p><?php if ($pager->haveToPaginate()): ?>
  <?php echo link_to('&lt;&lt;', 'users/list?page='.$pager->getFirstPage()) ?>
  <?php echo link_to('&lt;', 'users/list?page='.$pager->getPreviousPage()) ?>
  <?php $links = $pager->getLinks(20); foreach ($links as $page): ?>
    <?php if ($page == $pager->getPage()): ?>
		<strong><?php echo $page ?></strong>
	<?php else: ?>
		<?php echo link_to($page, 'users/list?page='.$page) ?>
	<?php endif ?>
    <?php if ($page != $pager->getCurrentMaxLink()): ?> - <?php endif ?>
  <?php endforeach ?>
  <?php echo link_to('&gt;', 'users/list?page='.$pager->getNextPage()) ?>
  <?php echo link_to('&gt;&gt;', 'users/list?page='.$pager->getLastPage()) ?>
<?php endif ?>
</p>
