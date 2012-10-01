<?php include_partial('content/breadcrumps', array(
  'current'=>__('Common queries'),
  ))
?>

<?php foreach($info['groups'] as $key=>$values): ?>
<h2><?php echo $key ?></h2>
  <ul class="sf_admin_actions">
    <?php foreach($values as $value): ?>
    <?php echo li_link_to_if('action_'.$info['class'], true, $value['description'], url_for($info['url'].'?query=' .$value['query']), array('title'=>__('Execute the query «%query%»', array('%query%'=>$value['query'])))) ?>
    <?php endforeach ?>
  </ul>
<?php endforeach ?>

