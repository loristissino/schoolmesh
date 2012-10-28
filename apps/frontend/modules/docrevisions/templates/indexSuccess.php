<h1>Document revisions List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Document</th>
      <th>Revision number</th>
      <th>Revisioned at</th>
      <th>Uploader</th>
      <th>Revision grounds</th>
      <th>Content</th>
      <th>Content type</th>
      <th>Source attachment</th>
      <th>Published attachment</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($Docrevisions as $Docrevision): ?>
    <tr>
      <td><a href="<?php echo url_for('docrevisions/show?id='.$Docrevision->getId()) ?>"><?php echo $Docrevision->getId() ?></a></td>
      <td><?php echo $Docrevision->getDocumentId() ?></td>
      <td><?php echo $Docrevision->getRevisionNumber() ?></td>
      <td><?php echo $Docrevision->getRevisionedAt() ?></td>
      <td><?php echo $Docrevision->getUploaderId() ?></td>
      <td><?php echo $Docrevision->getRevisionGrounds() ?></td>
      <td><?php echo $Docrevision->getContent() ?></td>
      <td><?php echo $Docrevision->getContentType() ?></td>
      <td><?php echo $Docrevision->getSourceAttachmentId() ?></td>
      <td><?php echo $Docrevision->getPublishedAttachmentId() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('docrevisions/new') ?>">New</a>
