<?php slot('title', __('Data upload')) ?>
	
<?php slot('breadcrumbs',
	link_to(__("User management"), 'users/index') . ' » ' .
	__("Data upload")
	)

?><h1><?php echo __("Data upload")?>: <?php echo __($what) ?></h1>

<p><?php echo image_tag('users_big.png') ?></p>

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


<?php if(isset($checkList)): ?>

<?php include_partial('content/checks', array('checkList'=>$checkList, 'start_closed'=>false)) ?>
<?php endif ?>

<h2><?php echo __('Upload form') ?></h2>

<p><?php echo __(SentencePeer::getSentence('users_bulk_upload_'. $what)) ?></p>

<p><?php echo __('The file should have the following format:') ?></p>
<div class="example">
<pre>
<?php echo __(SentencePeer::getSentence('users_bulk_upload_'. $what . '_format')) . "\n"?>
<?php echo __(SentencePeer::getSentence('users_bulk_upload_'. $what . '_example')) ?>
</pre>
</div>

<p><?php echo __(SentencePeer::getSentence('ga_csv_upload_after')) ?></p>

<form action="<?php echo url_for('users/upload?what='.$what) ?>" method="POST" enctype="multipart/form-data">

  <table>
    <?php echo $form ?>
	<tr>
      <td colspan="2">
         <input type="submit" name="save" value="<?php echo __('Upload') ?>">
      </td>
    </tr>
  </table>
</form>

