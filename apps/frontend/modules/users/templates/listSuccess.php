<?php use_helper('Javascript') ?>
<?php use_helper('Form') ?>
<?php use_helper('Object') ?>

<?php slot('title', __('User management')) ?>
	
<?php slot('breadcrumbs',
	link_to(__("User management"), 'users/index') . ' » ' .
	__("User list")
	)

?><h1><?php echo __("User management")?></h1>

<?php //include_partial('filter', array('filtered_role_id'=>$filtered_role_id, 'filtered_schoolclass_id'=>$filtered_schoolclass_id)) ?>
<?php //include_partial('filter2', array('roles'=>$roles, 'filtered_role_id'=>$filtered_role_id, 'filtered_schoolclass_id'=>$filtered_schoolclass_id, 'schoolclasses'=>$schoolclasses)) ?>

<?php if ($sf_user->hasFlash('notice')): ?>
  <div class="notice"><?php echo $sf_user->getFlash('notice')?></div>
<?php endif; ?>
<?php if ($sf_user->hasFlash('error')): ?>
  <div class="error"><?php echo $sf_user->getFlash('error')?></div>
<?php endif; ?>

<?php include_partial('content/searchbox', array('query'=>$query)) ?>

<?php include_partial('content/pagerhead', array('pager'=>$pager)) ?>

<?php include_partial('content/pager', array('pager'=>$pager, 'link'=>'users/list', 'query'=>$query)) ?>


<?php if($pager->getNbResults()>0): ?>
  
<form action="<?php echo url_for('users/batch') ?>" method="post">

<table cellspacing="0">
  <thead>
    <tr>
	  <th id="sf_admin_list_batch_actions"><input id="sf_admin_list_batch_checkbox" type="checkbox" onclick="checkAll();" /></th>
      <th class="sf_admin_text" style="text-align: right"><?php echo __('#') ?></th>
      <th class="sf_admin_text"><?php echo link_to(__('G'), url_for( 'users/setsortlistpreference?sortby=gender&query='.$query)) ?></th>
      <th class="sf_admin_text"><?php echo link_to(__('Username'), url_for( 'users/setsortlistpreference?sortby=username&query='.$query)) ?></th>
      <th class="sf_admin_text"><?php echo link_to(__('Import Code'), url_for( 'users/setsortlistpreference?sortby=importcode&query='.$query)) ?></th>
      <th class="sf_admin_text"><?php echo link_to(__('Role'), url_for( 'users/setsortlistpreference?sortby=role&query='.$query)) ?></th>
      <th class="sf_admin_text"><?php echo link_to(__('First name'), url_for('users/setsortlistpreference?sortby=firstname&query='.$query)) ?></th>
      <th class="sf_admin_text"><?php echo link_to(__('Last name'), url_for( 'users/setsortlistpreference?sortby=lastname&query='.$query)) ?></th>
      <th class="sf_admin_text"><?php echo link_to(__('Alerts'), url_for('users/setsortlistpreference?sortby=alerts&query='.$query)) ?></th>
      <th class="sf_admin_text"><?php echo __('Accounts') ?></th>
      <th class="sf_admin_text"><?php echo __('Actions') ?></th>
    </tr>
  </thead>
  <tbody>
	<?php $i=0 ?>
	<?php $ga_states=Workflow::getGoogleappsAccountStatusses(); ?>
    <?php foreach ($pager->getResults() as $user): ?>
    <tr class="sf_admin_row <?php echo (++$i & 1)? 'odd':'even' ?>">
	<td>
  <input type="checkbox" name="ids[]" value="<?php echo $user->getUserId() ?>" class="sf_admin_batch_checkbox" />
</td>
      <td style="text-align: right"><?php echo $i ?></td>
      <td><?php include_partial('gender', array('gender'=>$user->getGender())) ?></td>
      <td<?php if(!$user->getSfGuardUser()->getIsActive()) echo ' class="notcurrent"' ?>>
      
      <?php echo link_to(
				 $user->getUsername(),
				'users/edit?id='.$user->getSfGuardUser()->getId(),
				array('title'=>__('Edit information about %user%', array('%user%'=>$user->getFullName())))
				)
      ?>
      
      </td>
      <td><?php echo $user->getImportCode() ?></td>
      <td><?php echo $user->getRoleDescription() ?></td>
      <td><?php echo $user->getFirstName() ?></td>
      <td><?php echo $user->getLastName() ?></td>
	  <td>
		<?php if($user->getSystemAlerts()!=''): ?>
			<?php echo image_tag('error', 'title=' . $user->getSystemAlerts()) ?>
		<?php endif ?>
	  </td>
	  <td>
		<?php foreach ($user->getAccounts() as $account): ?>
			<?php echo link_to(
        image_tag($account->getAccountType()),
        url_for('users/editaccount?id='. $account->getId()),
        array('title'=>
        __('Edit account «%accounttype%» of %user%', 
          array(
            '%accounttype%'=>$account->getAccountType(),
            '%user%'=>$user->getFullname()
            )))
        ) ?>
		<?php endforeach ?>
	 </td>
	<td><?php include_partial('actions', array('user'=>$user)) ?></td>
 	

    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<?php include_partial('content/pager', array('pager'=>$pager, 'link'=>'users/list', 'query'=>$query)) ?>

<?php include_partial('plansandreports/checkalljs') ?>
 <ul class="sf_admin_actions">
      <li class="sf_admin_batch_actions_choice">
  <select name="batch_action">

<?php echo options_for_select(array(
  '' => __('Choose an action'),
  'Delete' => __('Delete selected users'),
  'runuserchecks' => __('Run user checks'),
  'getletter' => __('Get welcome letter'),
  'getgoogleappsletter' => __('Get GoogleApps letter'),
  'getgoogleappsdata' => __('Get GoogleApps data'),
  'getlist' => __('Get list choosing a template'),
  'email' => __('Write an email'),
), 0) ?>
  </select>

<?php echo submit_tag(_('Ok')) ?>
</li>
<li class="sf_admin_action_new">
<?php
echo link_to(
__('New user'),
url_for('users/new')
) ?>
</li>

</ul>

</form>
<?php endif ?>

<?php use_javascript('searchfocus.js') ?>

