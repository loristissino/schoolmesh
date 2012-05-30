<h1><?php echo __('Plurals') ?></h1>
<p>
<?php for($i=0; $i<=1000; $i++): ?>
  <?php echo format_number_choice(
    '[0]There are no files|[1]There is one file|(1,+Inf]There are %number% files',
    array('%number%'=>$i),
    $i
    )
  ?><br />
<?php endfor ?>
</p>
