<p><?php echo format_number_choice('[0]No result found.|[1]One result found.|(1,+Inf]%1%
results found.', array('%1%' => $pager->getNbResults()), $pager->getNbResults()) ?> 
<?php echo sprintf(__('Displaying results %d to %d.'), $pager->getFirstIndice(), $pager->getLastIndice()) ?></p>