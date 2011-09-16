<div id="help">
<ul>
<li><?php echo link_to(
  __('Help'),
  $helplink,
  array(
    'title'=>__('Online help on action «%module%/%action%»', array('%module%'=>$module, '%action%'=>$action)) . ' ' . __('(opens in a new window)'),
    'popup' => array('popupWindow', 'width=600,height=300,left=250,top=0,scrollbars=yes')
    )
  )
?>
</li>
</ul>
</div>
