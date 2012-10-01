<td 
  <?php if ($year->getId()!=sfConfig::get('app_config_current_year'))
    echo 'class="notcurrent"' ?>
>
<?php echo $year ?>
</td>
