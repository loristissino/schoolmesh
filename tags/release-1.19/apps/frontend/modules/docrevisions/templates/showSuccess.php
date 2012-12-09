<?php include_partial('content/breadcrumps', array(
  'breadcrumps'=>array(
    'documents/index' =>__('Documents'),
    'documents/show?id='.$Docrevision->getDocumentId() => $Docrevision->getDocument()
  ),
  'current'=>__('Revision # %revision%', array('%revision%'=>$Docrevision->getRevisionNumber()))
  ))
?>

<?php include_partial('content/flashes'); ?>

<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $Docrevision->getId() ?></td>
    </tr>
    <tr>
      <th>Document:</th>
      <td><?php echo $Docrevision->getDocumentId() ?></td>
    </tr>
    <tr>
      <th>Revision number:</th>
      <td><?php echo $Docrevision->getRevisionNumber() ?></td>
    </tr>
    <tr>
      <th>Revisioned at:</th>
      <td><?php echo $Docrevision->getRevisionedAt() ?></td>
    </tr>
    <tr>
      <th>Uploader:</th>
      <td><?php echo $Docrevision->getUploaderId() ?></td>
    </tr>
    <tr>
      <th>Revision grounds:</th>
      <td><?php echo $Docrevision->getRevisionGrounds() ?></td>
    </tr>
    <tr>
      <th>Content:</th>
      <td><?php echo $Docrevision->getContent() ?></td>
    </tr>
    <tr>
      <th>Content type:</th>
      <td><?php echo $Docrevision->getContentType() ?></td>
    </tr>
    <tr>
      <th>Source attachment:</th>
      <td><?php echo $Docrevision->getSourceAttachmentId() ?></td>
    </tr>
    <tr>
      <th>Published attachment:</th>
      <td><?php echo $Docrevision->getPublishedAttachmentId() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('docrevisions/edit?id='.$Docrevision->getId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('docrevisions/index') ?>">List</a>
