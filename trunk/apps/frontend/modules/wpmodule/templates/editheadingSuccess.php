<?php slot('title', sprintf('%s -- %s --  %s', $wpmodule->getTitle(), $workplan->__toString(), $owner->getFullName())) ?>
<?php slot('breadcrumbs',
	link_to(__("Plans and Reports"), "@plansandreports") . ' » ' . 
	link_to($workplan, 'plansandreports/fill?id='.$workplan->getId()) . ' » ' . 
	$wpmodule->getTitle() . ' » ' .
	__('Edit module heading')
	)
	
	?>

<?php include_partial('content/breadcrumps', array(
  'breadcrumps'=>array(
    '@plansandreports' => "Plans and Reports",
    'plansandreports/fill?id='.$workplan->getId() => $workplan,
    
    ),
  'current'=>__('Edit module heading'),
  'title'=>$workplan . ' -- ' . $wpmodule->getTitle(),
  ))
?>

<h1><?php echo __('Edit module heading') ?></h1>

<?php include_partial('content/flashes'); ?>

<form action="<?php echo url_for('wpmodule/editheading?id=' . $wpmodule->getId()) ?>" method="post" id="editform">

  <table>
    <?php echo $form ?>
	<tr>
      <td colspan="2">
<ul class="sf_admin_actions">
	<li class="sf_admin_action_saveandback">
	<a href="<?php echo url_for('wpmodule/editheading?id='.$wpmodule->getId()) ?>" 
		onClick="var f = document.getElementById('editform'); var m = document.createElement('input'); m.setAttribute('type', 'hidden'); m.setAttribute('name', 'save'); m.setAttribute('value', 'Save'); f.appendChild(m); f.submit(); return false;"
		title="<?php echo __('Save this contents and go back to the module') ?>"
	><?php echo __("Save and go back to the module") ?></a>
	</li>

</ul>


		</td>
    </tr>
  </table>
  
</form>

