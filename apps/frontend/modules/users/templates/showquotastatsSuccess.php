<?php include_partial('content/breadcrumps', array(
  'breadcrumps'=>array(
    'users/index' =>__('User management'),
    'users/list'=>__('List/Search'),
    'users/list?query='. $sf_user->getAttribute('currently_selected')=>__('Selected users'),
    ),
    'current'=>__("Disk quota statistics")
  ))
?>

<?php include_partial('content/flashes'); ?>

<h2><?php echo __('Blocks usage') ?></h2>

<table cellspacing="0">
  <thead>
    <tr>
      <th class="sf_admin_text"><?php echo __('User') ?></th>
      <th class="sf_admin_text" style="text-align: right"><?php echo __('Used blocks') ?></th>
      <th class="sf_admin_text"><?php echo __('Chart') ?></th>
      <th class="sf_admin_text"><?php echo __('Actions') ?></th>
    </tr>
  </thead>
  <tbody>
  <?php $i=0 ?>
  <?php foreach ($userlist as $user): ?>
    <tr class="sf_admin_row <?php echo (++$i & 1)? 'odd':'even' ?>">
      <?php include_partial('users/quotachart', array('chart'=>'blocks', 'bpp'=>$max_blocks / $chart_width, 'user'=>$user, 'stats'=>$stats, 'quota_warning'=>$quota_warning, 'personal_profile'=>false, 'max_used'=>$max_used_blocks, 'accounts'=>implode(',',$accounts->getRawValue()))) ?>
    </tr>
  <?php endforeach ?>
    <tr>
    <td><em><?php echo __('Sum') ?></em></td>
    <td style="text-align:right"><?php echo $sum_used_blocks ?></td>
    <td></td>
    <td></td>
    </tr>
  
  </tbody>
</table>

<h2><?php echo __('Files usage') ?></h2>

<table cellspacing="0">
  <thead>
    <tr>
      <th class="sf_admin_text"><?php echo __('User') ?></th>
      <th class="sf_admin_text" style="text-align: right"><?php echo __('Used files') ?></th>
      <th class="sf_admin_text"><?php echo __('Chart') ?></th>
      <th class="sf_admin_text"><?php echo __('Actions') ?></th>
    </tr>
  </thead>
  <tbody>
  <?php $i=0 ?>
  <?php foreach ($userlist as $user): ?>
    <tr class="sf_admin_row <?php echo (++$i & 1)? 'odd':'even' ?>">
      <?php include_partial('users/quotachart', array('chart'=>'files', 'bpp'=>$max_files / $chart_width, 'user'=>$user, 'stats'=>$stats, 'quota_warning'=>$quota_warning, 'personal_profile'=>false, 'max_used'=>$max_used_files, 'accounts'=>implode(',',$accounts->getRawValue()))) ?>
    </tr>
  <?php endforeach ?>
    <tr>
    <td><em><?php echo __('Sum') ?></em></td>
    <td style="text-align:right"><?php echo $sum_used_files ?></td>
    <td></td>
    <td></td>
    </tr>
  
  </tbody>
</table>

<h2><?php echo __('Actions') ?></h2>

<ul class="sf_admin_actions">
  <?php if($sf_user->hasCredential('admin')):?>
    <li class="sf_admin_action_userchecks">
    <?php echo link_to(
          __('Run user checks'),
          'users/runuserchecks?ids='. implode(',',$ids->getRawValue()),
          array('title'=>__('Run user checks for all the users listed in this page'))
          )?>
    </li>
    <?php endif ?>
</ul>
