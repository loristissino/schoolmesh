<ul>
<?php foreach($userlist as $profile): ?>
  <li><?php echo $profile->getFullName() ?></li>
<?php endforeach ?>
</ul>
