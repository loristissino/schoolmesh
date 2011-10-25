<?php include_partial('content/breadcrumps', array(
  'breadcrumps'=>array(
    '@plansandreports' => "Plans and Reports",
    'plansandreports/fill?id='.$workplan->getId() => $workplan,
    'wpmodule/view?id='.$wpmodule->getId() => $wpmodule->getTitle(),
    ),
  'current'=>__('Edit module heading'),
  ))
?>

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

