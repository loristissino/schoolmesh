<?php include_partial('content/breadcrumps', array(
  'breadcrumps'=>array(
    'dashboard/index'=>__('Dashboard'),
  ),
  'current'=>__('Projects')
  ))
?>

<?php include_partial('content/flashes'); ?>

<h2><?php echo __('Current state') ?></h2>
<?php stOfc::createChart(700, 400, url_for('dashboard/projectschart?type=bystate')); ?>

<hr />
<h2><?php echo __('Budget and activities') ?></h2>

<table cellspacing="0">
  <thead>
    <tr>
      <th class="sf_admin_text"><?php echo __('Code') ?></th>
      <th class="sf_admin_text"><?php echo __('Title') ?></th>
      <th class="sf_admin_text"><?php echo __('State') ?></th>
      <th class="sf_admin_text"><?php echo __('Total amount') ?>
      <div style="font-weight: normal">
        <ul class="sf_admin_td_actions"><?php echo li_link_to_if('action_graph', true, __('Graph'), url_for('dashboard/projectsgraph?type=totalbudget')) ?></li>
        </ul>
      </div>
      </th>
      <th class="sf_admin_text"><?php echo __('Amount int') ?>
      <div style="font-weight: normal">
        <ul class="sf_admin_td_actions"><?php echo li_link_to_if('action_graph', true, __('Graph'), url_for('dashboard/projectsgraph?type=internalbudget')) ?></li>
        </ul>
      </div>
      </th>
      <th class="sf_admin_text"><?php echo __('Amount ext') ?>
      <div style="font-weight: normal">
        <ul class="sf_admin_td_actions"><?php echo li_link_to_if('action_graph', true, __('Graph'), url_for('dashboard/projectsgraph?type=externalbudget')) ?></li>
        </ul>
      </div>
      </th>
      <th class="sf_admin_text"><?php echo __('Acknowledged activities') ?>
      <div style="font-weight: normal">
        <ul class="sf_admin_td_actions"><?php echo li_link_to_if('action_graph', true, __('Graph'), url_for('dashboard/projectsgraph?type=declaredactivities')) ?></li>
        </ul>
      </div>
      </th>
    </tr>
  </thead>
  <tbody>
	<?php $i=0 ?>
    <?php foreach ($projects as $project): ?>
    <tr class="sf_admin_row <?php echo (++$i & 1)? 'odd':'even' ?>">
      <td>
        <?php echo $project->CODE ?>
      </td>
      <td>
        <?php echo link_to($project->TITLE, url_for('@project_data?id='.$project->ID)) ?>
      </td>
      <td>
        <?php echo __($project->STATE) ?>
      </td>
      <td style="text-align: right" class="amount">
        <?php echo currencyvalue($project->TOTAL_AMOUNT) ?>
      </td>
      <td style="text-align: right" class="amount">
        <?php echo currencyvalue($project->INTERNAL_FUNDING) ?>
      </td>
      <td style="text-align: right" class="amount">
        <?php echo currencyvalue($project->EXTERNAL_FUNDING) ?>
      </td>
      <td style="text-align: right" class="amount">
        <?php echo currencyvalue($project->ACKNOWLEDGED_ACTIVITIES) ?>
      </td>
	</tr>
    <?php endforeach; ?>
  </tbody>
</table>


<hr />

<h2><?php echo __('Staff involved') ?></h2>

<table cellspacing="0">
  <thead>
    <tr>
      <th class="sf_admin_text"><?php echo __('Code') ?></th>
      <th class="sf_admin_text"><?php echo __('Title') ?></th>
      <th class="sf_admin_text"><?php echo __('Staff') ?></th>
    </tr>
  </thead>
  <tbody>
	<?php $i=0 ?>
    <?php $roles=array(); $count=0; foreach ($projects as $project): ?>
    <tr class="sf_admin_row <?php echo (++$i & 1)? 'odd':'even' ?>">
      <td>
        <?php echo $project->CODE ?>
      </td>
      <td>
        <?php echo link_to($project->TITLE, url_for('@project_data?id='.$project->ID)) ?>
      </td>
      <td>
      <?php if(sizeof($project->STAFF)): $count++ ?>
        <?php foreach($project->STAFF as $role => $number): if(isset($roles[$role])) $roles[$role]+=$number; else $roles[$role]=$number ?>
          <?php echo $role ?>: <?php echo $number ?><br />
        <?php endforeach ?>
      <?php endif ?>
      </td>
	</tr>
    <?php endforeach; ?>
  </tbody>
</table>

<?php if(sizeof($roles)): ?>
  <h3><?php echo __('Recapitulation for roles') ?></h3>

  <table cellspacing="0">
    <thead>
      <tr>
        <th class="sf_admin_text"><?php echo __('Role') ?></th>
        <th class="sf_admin_text"><?php echo __('Number') ?></th>
        <th class="sf_admin_text"><?php echo __('Average per project') ?></th>
      </tr>
    </thead>
    <tbody>
    <?php $i=0 ?>
      <?php foreach ($roles as $role=>$number): ?>
      <tr class="sf_admin_row <?php echo (++$i & 1)? 'odd':'even' ?>">
        <td>
          <?php echo $role ?>
        </td>
        <td style="text-align: right">
          <?php echo $number ?>
        </td>
        <td style="text-align: right">
          <?php echo printf('%3.1f', $number / $count) ?>
        </td>
    </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
<?php endif ?>
<hr />



<?php include_partial('content/year', array('year'=>$year, 'years'=>$years, 'back'=>'dashboard/projects')) ?>

