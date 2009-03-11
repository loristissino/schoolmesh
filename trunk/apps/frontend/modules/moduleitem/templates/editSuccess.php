<?php $unit_item = $form->getObject() ?>
<h1><?php echo $unit_item->isNew() ? 'New' : 'Edit' ?> Unititem</h1>

<form action="<?php echo url_for('unititem/update'.(!$unit_item->isNew() ? '?id='.$unit_item->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
  <table>
    <tfoot>
      <tr>
        <td colspan="2">
          &nbsp;<a href="<?php echo url_for('unititem/index') ?>">Cancel</a>
          <?php if (!$unit_item->isNew()): ?>
            &nbsp;<?php echo link_to('Delete', 'unititem/delete?id='.$unit_item->getId(), array('post' => true, 'confirm' => 'Are you sure?')) ?>
          <?php endif; ?>
          <input type="submit" value="Save" />
        </td>
      </tr>
    </tfoot>
    <tbody>
      <?php echo $form->renderGlobalErrors() ?>
      <tr>
        <th><?php echo $form['item_type_id']->renderLabel() ?></th>
        <td>
          <?php echo $form['item_type_id']->renderError() ?>
          <?php echo $form['item_type_id'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['unit_id']->renderLabel() ?></th>
        <td>
          <?php echo $form['unit_id']->renderError() ?>
          <?php echo $form['unit_id'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['position']->renderLabel() ?></th>
        <td>
          <?php echo $form['position']->renderError() ?>
          <?php echo $form['position'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['content']->renderLabel() ?></th>
        <td>
          <?php echo $form['content']->renderError() ?>
          <?php echo $form['content'] ?>

        <?php echo $form['id'] ?>
        </td>
      </tr>
    </tbody>
  </table>
</form>
