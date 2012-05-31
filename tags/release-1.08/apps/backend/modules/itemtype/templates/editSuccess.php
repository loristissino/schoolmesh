<?php $item_type = $form->getObject() ?>
<h1><?php echo $item_type->isNew() ? 'New' : 'Edit' ?> Itemtype</h1>

<form action="<?php echo url_for('itemtype/update'.(!$item_type->isNew() ? '?id='.$item_type->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
  <table>
    <tfoot>
      <tr>
        <td colspan="2">
          &nbsp;<a href="<?php echo url_for('itemtype/index') ?>">Cancel</a>
          <?php if (!$item_type->isNew()): ?>
            &nbsp;<?php echo link_to('Delete', 'itemtype/delete?id='.$item_type->getId(), array('post' => true, 'confirm' => 'Are you sure?')) ?>
          <?php endif; ?>
          <input type="submit" value="Save" />
        </td>
      </tr>
    </tfoot>
    <tbody>
      <?php echo $form->renderGlobalErrors() ?>
      <tr>
        <th><?php echo $form['title']->renderLabel() ?></th>
        <td>
          <?php echo $form['title']->renderError() ?>
          <?php echo $form['title'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['description']->renderLabel() ?></th>
        <td>
          <?php echo $form['description']->renderError() ?>
          <?php echo $form['description'] ?>

        <?php echo $form['id'] ?>
        </td>
      </tr>
    </tbody>
  </table>
</form>
