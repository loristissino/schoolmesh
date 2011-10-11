<?php include_partial('content/breadcrumps', array(
  'breadcrumps'=>array(
    'syllabi/index'=>__('Syllabi'),
    ),
  'current'=>__('Syllabus «%title%»', array('%title%'=>$syllabus->getName()))
  ))
?>


<table>
  <tbody>
    <tr>
      <th><?php echo __('Version') ?>:</th>
      <td><?php echo $syllabus->getVersion() ?></td>
    </tr>
    <tr>
      <th><?php echo __('Author') ?>:</th>
      <td><?php echo $syllabus->getAuthor() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<?php include_partial('syllabi/items', array('syllabus'=>$syllabus, 'maxlevel'=>$maxlevel)) ?>

<h2><?php echo __('Actions') ?></h2>
<ul class="sf_admin_actions">
  <li class="sf_admin_action_list">
    <?php echo link_to(
      __('List'),
      url_for('syllabi/index'),
      array(
        'title'=>__('Show the list of active syllabi')
        )
      )?>
  </li>
</ul>
