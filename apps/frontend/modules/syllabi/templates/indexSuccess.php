<?php include_partial('content/breadcrumps', array(
  'current'=>__('Syllabi')
  ))
?>

<div class="sf_admin_list">

<table>
  <thead>
    <tr>
      <th><?php echo __('Name') ?></th>
      <th><?php echo __('Version') ?></th>
      <th><?php echo __('Author') ?></th>
      <th><?php echo __('Actions') ?></th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($syllabi as $syllabus): ?>
    <tr>
      <td><?php echo $syllabus->getName() ?></td>
      <td><?php echo $syllabus->getVersion() ?></td>
      <td><?php echo $syllabus->getAuthor() ?></td>
      <td>
        <ul class="sf_admin_td_actions">
          <li class="sf_admin_action_view">
            <?php echo link_to(
              __('View'),
              url_for('syllabi/show?id='.$syllabus->getId())
              )?>
          </li>
        </ul>
      </td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>
</div>