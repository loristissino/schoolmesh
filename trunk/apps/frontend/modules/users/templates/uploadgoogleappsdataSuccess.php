<?php use_helper('Javascript') ?>
<?php use_helper('Form') ?>
<?php use_helper('Object') ?>

<?php slot('title', __('Google Apps data upload')) ?>
	
<?php slot('breadcrumbs',
	link_to(__("User management"), 'users/index') . ' » ' .
	__("Google Apps data upload")
	)

?><h1><?php echo __("Google Apps data upload")?></h1>

<p><?php echo image_tag('googleapps_big.png') ?></p>

<?php if ($sf_user->hasFlash('notice')): ?>
  <div class="notice"><?php echo $sf_user->getFlash('notice')?></div>
<?php endif; ?>
<?php if ($sf_user->hasFlash('error')): ?>
  <div class="error"><?php echo $sf_user->getFlash('error')?></div>
<?php endif; ?>

<?php if(isset($checks)&&sizeof($checks)>0): ?>

<h2><?php echo __('Uploaded data') ?></h2>

<?php foreach($checks as $check): ?>
<p><?php echo image_tag($check->getImageTag(), 'title=' . __($check->getImageTitle())) ?> 
<strong><?php echo $check->getContent() ?></strong>: <?php echo $check->getMessage() ?></p>
<?php endforeach ?>
<?php endif ?>


<h2><?php echo __('Upload form') ?></h2>

<form action="<?php echo url_for('users/uploadgoogleappsdata') ?>" method="POST" enctype="multipart/form-data">
  <table>
    <?php echo $form ?>
	<tr>
      <td colspan="2">
         <input type="submit" name="save" value="<?php echo __('Upload') ?>">
      </td>
    </tr>
  </table>
</form>

