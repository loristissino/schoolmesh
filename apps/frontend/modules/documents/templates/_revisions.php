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
          <?php echo li_link_to_if('td_action_activate', $sf_user->hasCredential('backadmin') && ($Document->getDocrevisionId()!=$Docrevision->getId()) && ($Docrevision->getRevisionNumber()>$Document->getRevisionNumber()), __('Activate'), url_for('documents/activaterevision?id='.$Docrevision->getId())) ?>
          <?php echo li_link_to_if('td_action_edit', $sf_user->hasCredential('backadmin'), __('Edit'), url_for('docrevisions/edit?id='.$Docrevision->getId())) ?>
          <?php echo li_link_to_if('td_action_clone', $sf_user->hasCredential('backadmin') &&  ($Docrevision->getRevisionNumber()>=$Document->getRevisionNumber()), __('Clone'), url_for('docrevisions/new?document='.$Document->getId() . '&fromrevision='.$Docrevision->getId())) ?>
          
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
            <?php if($Document->hasInlineContent()): ?>
             <?php echo li_link_to_if(
                'td_action_view', 
                $Document->getIsActive() && ($Document->getDocrevisionId()==$Docrevision->getId()),
                __('Show'),
                url_for('documents/show?id=' . $Document->getId()),
                array('title'=>__('Show the content of the document «%document%»', 
                  array('%document%'=>$Document->getTitle())
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

<ul class="sf_admin_actions">
<?php echo li_link_to_if(
  'action_new', 
  $sf_user->hasCredential('admin'),
  __('New revision'),
  url_for('docrevisions/new?document=' . $Document->getId()),
  array('title'=>__('Create a new revison for the document «%document%»', 
    array('%document%'=>$Document->getTitle())
  ))
) ?>
</ul>
