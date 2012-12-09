<?php include_partial('content/breadcrumps', array(
  'breadcrumps'=>array(
    'documents/index' =>__('Documents'),
    'documents/details?id='.$Document->getId() => $Document->getTitle()
  ),
  'current'=>__('Content'),
  'title'=>$Document->getTitle()
  ))
?>
<?php use_stylesheet('markdown') ?>
<div class="numbered">
<?php echo majaxMarkdown::transform(html_entity_decode($Document->getContent())); ?>
</div>
