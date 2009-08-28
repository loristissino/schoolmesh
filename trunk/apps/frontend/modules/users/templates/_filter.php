<div id="sf_admin_bar">
<div class="sf_admin_filter">
  
<form action="<?php echo url_for('users/setfilterlistpreference?filter=set' ) ?>" method="get">
    <table cellspacing="0">
      <tfoot>
        <tr>
          <td colspan="2">
               <a onclick="var f = document.createElement('form'); f.style.display = 'none'; this.parentNode.appendChild(f); f.method = 'post'; f.action = this.href;f.submit();return false;" href="<?php echo url_for('users/setfilterlistpreference?filter=reset') ?>"><?php echo __('Reset') ?></a>            <input type="submit" value="<?php echo __('Filter') ?>" />
          </td>
        </tr>
      </tfoot>
      <tbody>
<tr class="sf_admin_form_row sf_admin_foreignkey sf_admin_filter_field_role_id">
    <td>
      <label for="users_filters_role_id"><?php echo __('Role') ?></label>    </td>
    <td>
<?php echo object_select_tag($filtered_role_id, 'getFilteredRoleId',
array('related_class'=>'Role',
  'include_custom'=>__('Choose a role'),
  'peer_method'=>'retrieveMainRoles'
  ))?>
          </td>
  </tr>
<tr class="sf_admin_form_row sf_admin_foreignkey sf_admin_filter_field_schoolclass_id">
    <td>
      <label for="users_filter_schoolclass_id"><?php echo __('Class') ?></label>    </td>
    <td>
<?php echo object_select_tag($filtered_schoolclass_id, 'getFilteredSchoolclassId',
array('related_class'=>'Schoolclass',
  'include_custom'=>__('Choose a class'),
  'peer_method'=>'retrieveCurrentSchoolclasses'
  ))?>
          </td>
  </tr>
              </tbody>
    </table>
  </form>
</div>
</div>
