<div id='googleapps'>
<table>
	<tr>
		<th><label><?php echo __('Has account?') ?></label></th>
		<td>
		<?php echo $current_user->getHasGoogleAppsAccount()? __('yes'): __('no') ?>
		</td>
	</tr>
</table>
</div>


