<?php $workgroup = $form->getObject() ?>
<h1><?php echo $workgroup->isNew() ? 'New' : 'Edit' ?> Workgroup</h1>

<form action="<?php echo url_for('workgroup/update'.(!$workgroup->isNew() ? '?id='.$workgroup->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
  <table>
    <tfoot>
      <tr>
        <td colspan="2">
          &nbsp;<a href="<?php echo url_for('workgroup/index') ?>">Cancel</a>
          <?php if (!$workgroup->isNew()): ?>
            &nbsp;<?php echo link_to('Delete', 'workgroup/delete?id='.$workgroup->getId(), array('post' => true, 'confirm' => 'Are you sure?')) ?>
          <?php endif; ?>
          <input type="submit" value="Save" />
        </td>
      </tr>
    </tfoot>
    <tbody>
      <?php echo $form->renderGlobalErrors() ?>
      <tr>
        <th><?php echo $form['name']->renderLabel() ?></th>
        <td>
          <?php echo $form['name']->renderError() ?>
          <?php echo $form['name'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['person_group_list']->renderLabel() ?></th>
        <td>
          <?php echo $form['person_group_list']->renderError() ?>
          <?php echo $form['person_group_list'] ?>

        <?php echo $form['id'] ?>
        </td>
      </tr>
    </tbody>
  </table>
</form>
