<?php include_stylesheets_for_form($form) ?>
<?php include_javascripts_for_form($form) ?>

<form action="<?php echo url_for('appointment/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="POST" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="PUT" />
<?php endif; ?>
  <table>
    <tfoot>
      <tr>
        <td colspan="2">
          <?php echo $form->renderHiddenFields() ?>
          &nbsp;<a href="<?php echo url_for('appointment/index') ?>">Cancel</a>
          <?php if (!$form->getObject()->isNew()): ?>
            &nbsp;<?php echo link_to('Delete', 'appointment/delete?id='.$form->getObject()->getId(), array('method' => 'delete', 'confirm' => 'Are you sure?')) ?>
          <?php endif; ?>
          <input type="submit" value="Save" />
        </td>
      </tr>
    </tfoot>
    <tbody>
      <?php echo $form->renderGlobalErrors() ?>
      <tr>
        <th><?php echo $form['user_id']->renderLabel() ?></th>
        <td>
          <?php echo $form['user_id']->renderError() ?>
          <?php echo $form['user_id'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['subject_id']->renderLabel() ?></th>
        <td>
          <?php echo $form['subject_id']->renderError() ?>
          <?php echo $form['subject_id'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['schoolclass_id']->renderLabel() ?></th>
        <td>
          <?php echo $form['schoolclass_id']->renderError() ?>
          <?php echo $form['schoolclass_id'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['year_id']->renderLabel() ?></th>
        <td>
          <?php echo $form['year_id']->renderError() ?>
          <?php echo $form['year_id'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['created_at']->renderLabel() ?></th>
        <td>
          <?php echo $form['created_at']->renderError() ?>
          <?php echo $form['created_at'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['updated_at']->renderLabel() ?></th>
        <td>
          <?php echo $form['updated_at']->renderError() ?>
          <?php echo $form['updated_at'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['import_code']->renderLabel() ?></th>
        <td>
          <?php echo $form['import_code']->renderError() ?>
          <?php echo $form['import_code'] ?>
        </td>
      </tr>
    </tbody>
  </table>
</form>
