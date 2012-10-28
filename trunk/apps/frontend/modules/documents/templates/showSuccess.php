<?php include_partial('content/breadcrumps', array(
  'breadcrumps'=>array(
    'documents/index' =>__('Documents'),
  ),
  'current'=>$Document->getTitle()
  ))
?>

<?php include_partial('content/flashes'); ?>

<table>
  <tbody>
    <tr>
      <th><?php echo __('Type') ?>:</th>
      <td><?php echo $Document->getDoctype() ?></td>
    </tr>
    <tr>
      <th><?php echo __('Code') ?>:</th>
      <td><?php echo $Document->getCode() ?></td>
    </tr>
    <tr>
      <th><?php echo __('Title') ?>:</th>
      <td><?php echo $Document->getTitle() ?></td>
    </tr>
    <tr>
      <th><?php echo __('Revision') ?>:</th>
      <td><?php echo $Document->getRevisionNumber() ?> (<?php echo $Document->getRevisionedAt('d/m/Y') ?>)</td>
    </tr>
    <tr>
      <th><?php echo __('Notes') ?>:</th>
      <td><?php echo $Document->getNotes() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<?php if($Document->getContentType()==Document::CONTENT_TYPE_MARKDOWN): ?>
  <?php echo majaxMarkdown::transform(html_entity_decode($Document->getContent())); ?>
  <hr />
<?php endif ?>

<?php include_component('documents', 'revisions', array('Document' => $Document)) ?>

