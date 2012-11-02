<h2><?php echo __('Revisions') ?></h2>

<?php if(sizeof($Docrevisions)>0): ?>

<table>
  <thead>
    <tr>
      <th><?php echo __('Revision #') ?></th>
      <th><?php echo __('Revision date') ?></th>
      <th><?php echo __('Grounds') ?></th>
      <th><?php echo __('Actions') ?></th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($Docrevisions as $Docrevision): ?>
    <tr>
      <td<?php if($Docrevision->getId()!=$Document->getDocrevisionId()) echo ' class="notcurrent"' ?> style="text-align: right"><?php echo $Docrevision->getRevisionNumber() ?></td>
      <td><?php echo $Docrevision->getRevisionedAt('d/m/Y') ?></td>
      <td><?php echo $Docrevision->getRevisionGrounds() ?></td>
      <td>
        <ul class="sf_admin_td_actions">
          <?php echo li_link_to_if('td_action_activate', $sf_user->hasCredential('backadmin') && ($Document->getDocrevisionId()!=$Docrevision->getId()), __('Activate'), url_for('documents/activaterevision?id='.$Docrevision->getId())) ?>
          <?php echo li_link_to_if('td_action_edit', $sf_user->hasCredential('backadmin'), __('Edit'), url_for('docrevisions/edit?id='.$Docrevision->getId())) ?>
          
          <?php if($Docrevision->getDocument()->getIsForm()): ?>
            <?php if($Docrevision->getSourceAttachmentId()): ?>
             <?php echo li_link_to_if(
                'td_action_download', 
                $Document->getIsActive() && ($Document->getDocrevisionId()==$Docrevision->getId()),
                sprintf('«%s» (%d bytes)', $Docrevision->getSourceAttachment()->getOriginalFileName(), $Docrevision->getSourceAttachment()->getFileSize()),
                url_for('content/attachment?id=' . $Docrevision->getSourceAttachment()->getId()),
                array('title'=>__('Download file %filename%', 
                  array('%filename%'=>$Docrevision->getSourceAttachment()->getOriginalFileName())
                ))
              ) ?>
            <?php endif ?>
          <?php else: ?>
            <?php if($Docrevision->getPublishedAttachmentId()): ?>
             <?php echo li_link_to_if(
                'td_action_download', 
                $Document->getIsActive() && ($Document->getDocrevisionId()==$Docrevision->getId()),
                __('«%filename%» (%bytes% bytes)', array('%filename%'=>$Docrevision->getPublishedAttachment()->getOriginalFileName(), '%bytes%'=>$Docrevision->getPublishedAttachment()->getFileSize())),
                url_for('content/attachment?id=' . $Docrevision->getPublishedAttachment()->getId()),
                array('title'=>__('Download file «%filename%»', 
                  array('%filename%'=>$Docrevision->getPublishedAttachment()->getOriginalFileName())
                ))
              ) ?>
            <?php endif ?>
          <?php endif ?>
        </ul>
      </td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>
<?php else: ?>
<p><?php echo __('There are no revisions of this document.') ?></p>
<?php endif ?>
