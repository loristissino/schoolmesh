<div class="module_content">
	<?php foreach ($wpmodule->getWpitemGroups() as $wpitem_group): ?>
		<?php if($wpitem_group->countWpmoduleItems()): ?>

			<h4><?php echo $wpitem_group->getWpitemType()->getTitle() ?></h4>
      <?php $ev_min=$wpitem_group->getWpitemType()->getEvaluationMin() ?>
				<?php if($wpitem_group->countWpmoduleItems()): ?>
					
					<ul>
						<?php foreach($wpitem_group->getWpmoduleItems() as $wpmodule_item): ?>
							<?php /* if (!$wpmodule_item->getIsEditable()): */?>
							<li>
              <?php if($ev_min==$wpmodule_item->getEvaluation()):?><strike><?php endif ?>
							<?php echo html_entity_decode($wpmodule_item->getContent()) ?>
              <?php if($ev_min==$wpmodule_item->getEvaluation()):?></strike><?php endif ?>
							<?php if (isset($workplan) && ($workplan->getState()>=Workflow::IR_DRAFT) && ($wpmodule_item->getEvaluation()>0)): ?>
								<?php /*
<?php for($i=0;$i<$wpmodule_item->getEvaluation(); $i++): ?>
									<?php echo image_tag('award', 'title=' . sprintf(__('(Evaluation: %d)'), $wpmodule_item->getEvaluation())) ?>
								<?php endfor ?>
*/ ?>

							<?php echo sprintf("(%d)", $wpmodule_item->getEvaluation()) ?>
							<?php endif ?>
							</li>
							<?php /* endif */ ?>
						<?php endforeach ?>
					</ul>
				<?php endif /* modules present*/ ?>
		<?php endif ?>
	<?php endforeach; ?>
  
  <?php if($wpmodule->getAppointment()->getSyllabus() && $wpmodule->getAppointment()->getSyllabus()->getIsActive()): ?>
  <h4><?php echo __('Syllabus links') ?></h4>
  <?php include_partial('plansandreports/syllabus', array('syllabus_contributions'=>$wpmodule->getSyllabusContributionsWithRefs())) ?>
  <?php endif ?>
</div>
