<h1>Song List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Title</th>
      <th>Author</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($song_list as $song): ?>
    <tr>
      <td><a href="<?php echo url_for('song/edit?id='.$song->getId()) ?>"><?php echo $song->getId() ?></a></td>
      <td><?php echo $song->getTitle() ?></td>
      <td><?php echo $song->getAuthor() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('song/new') ?>">New</a>
