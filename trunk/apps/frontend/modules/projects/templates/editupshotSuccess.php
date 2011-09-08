<?php use_stylesheet('ui-lightness/jquery-ui-1.8.custom.css') ?>
<?php use_javascripts_for_form($form) ?>
<?php use_javascript('jquery-ui-1.8.custom.min.js') ?>
<?php use_javascript('datepicker') ?>
<?php use_javascript('jquery.ui.datepicker-' . sfConfig::get('sf_default_culture') . '.js') ?>

<?php include_partial('content/breadcrumps', array(
  'breadcrumps'=>array(
    'projects/index' => __("Projects"),
    'projects/edit?id=' . $upshot->getSchoolproject()->getId() => $upshot->getSchoolproject(),
    ),
  'current'=>__('Upshot #%id%', array('%id%'=>$upshot->getId()))
    )
  )
?>

<?php include_partial('content/flashes'); ?>

<form action="<?php echo url_for('projects/editupshot?id='. $upshot->getId()) ?>" method="POST">

<h2><?php echo __('Basic information') ?></h2>

  <table>
  <?php if(!isset($form['description'])): ?>
  <tr>
    <th><label for="upshot_description"><?php echo __('Description') ?></label></th>
    <td><?php echo $upshot->getDescription() ?></td>
  </tr>
  <?php endif ?>

    <?php echo $form ?>
	<tr>
      <td colspan="2">
         <input type="submit" name="save" value="<?php echo __('Save') ?>">
      </td>
    </tr>
  </table>
</form>

