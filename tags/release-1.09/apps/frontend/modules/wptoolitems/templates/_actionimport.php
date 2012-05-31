<ul class="sf_admin_td_actions">
  <li class="sf_admin_action_import">
    <?php echo link_to(
  __('Import'),
  'wptoolitems/import?type=' . $current->getId() . '&from=' . $candidate->getId(), 
  array('method' => 'post', 'title'=>__('Import the items from this group'))
  )?>
  </li>
</ul>
