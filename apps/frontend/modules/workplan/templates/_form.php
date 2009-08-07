<?php include_stylesheets_for_form($form) ?>
<?php include_javascripts_for_form($form) ?>
<div class="sf_admin_form">

<form action="<?php echo url_for('workplan/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="POST" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>

<fieldset id="sf_fieldset_none">

<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="PUT" />
<?php endif; ?>
  <table>
    <tfoot>
      <tr>
        <td colspan="2">
          <?php echo $form->renderHiddenFields() ?>
          &nbsp;<a href="<?php echo url_for('workplan/index') ?>">Cancel</a>
          <?php if (!$form->getObject()->isNew()): ?>
            &nbsp;<?php echo link_to('Delete', 'workplan/delete?id='.$form->getObject()->getId(), array('method' => 'delete', 'confirm' => 'Are you sure?')) ?>
          <?php endif; ?>
          <input type="submit" value="Save" />
        </td>
      </tr>
    </tfoot>
    <tbody>
      <?php echo $form->renderGlobalErrors() ?>
      <tr>
        <th><?php echo $form['year_id']->renderLabel() ?></th>
        <td>
          <?php echo $form['year_id']->renderError() ?>
          <?php echo $form['year_id'] ?>
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
        <th><?php echo $form['subject_id']->renderLabel() ?></th>
        <td>
          <?php echo $form['subject_id']->renderError() ?>
          <?php echo $form['subject_id'] ?>
        </td>
      </tr>
    </tbody>
  </table>

</fieldset>
</form>
</div>


