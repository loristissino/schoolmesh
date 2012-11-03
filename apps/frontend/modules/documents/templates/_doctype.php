<h2><?php echo $Doctype->getTitle() ?></h2>

<?php if(sizeof($Documents)>0): ?>

<table>
  <thead>
    <tr>
      <th><?php echo __('Code') ?></th>
      <th><?php echo __('Title') ?></th>
      <th><?php echo __('Revision #') ?></th>
      <th><?php echo __('Revision date') ?></th>
      <th><?php echo __('Notes') ?></th>
      <th><?php echo __('Actions') ?></th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($Documents as $Document): ?>
    <tr>
      <td><?php echo $Document->getCode() ?></td>
      <td><?php echo link_to($Document->getTitle(), url_for('documents/details?id='.$Document->getId())) ?></td>
      <?php if($Document->getDocrevisionId()): ?>
        <td style="text-align: right">
          <?php echo $Document->getDocrevision()->getRevisionNumber() ?>
        </td>
        <td>
          <?php echo $Document->getDocrevision()->getRevisionedAt('d/m/Y') ?>
        </td>
      <?php else: ?>
        <td colspan="2">
          <?php echo __('Unknown') ?>
        </td>
      <?php endif ?>
    <td<?php if($Document->getIsDeprecated()) echo ' class="warning"' ?>>
      <?php echo $Document->getNotes() ?>
    </td>
    <td<?php if($Document->getIsDeprecated()) echo ' class="warning"' ?>>
      <ul class="sf_admin_td_actions">
        <?php echo li_link_to_if('td_action_documents', true, __('Details'), url_for('documents/details?id='.$Document->getId()), array('title'=>__('View the details about the document «%document%»', array('%document%'=>$Document->getTitle())))) ?>
        <?php echo li_link_to_if('td_action_view', $Document->hasInlineContent(), __('Show'), url_for('documents/show?id='.$Document->getId()), array('title'=>__('Show the content of the document «%document%»', array('%document%'=>$Document->getTitle())))) ?>
        <?php echo li_link_to_if('td_action_download', !$Document->getIsDeprecated() and $Document->hasDownloadableAttachment(), __('Download'), url_for('content/attachment?id='.$Document->getDownloadableAttachmentId()), array('title'=>__('Download the current revision of the document «%document%»', array('%document%'=>$Document->getTitle())))) ?>
      </ul>
    </td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>
<?php else: ?>
<p><?php echo __('There are no documents of this kind.') ?></p>
<?php endif ?>
