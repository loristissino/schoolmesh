<office:body>
<office:text text:use-soft-page-breaks="true">
<office:forms form:automatic-focus="false" form:apply-design-mode="false"/>
<text:sequence-decls>
<text:sequence-decl text:display-outline-level="0" text:name="Illustration"/>
<text:sequence-decl text:display-outline-level="0" text:name="Table"/>
<text:sequence-decl text:display-outline-level="0" text:name="Text"/>
<text:sequence-decl text:display-outline-level="0" text:name="Drawing"/>
</text:sequence-decls>
<text:p text:style-name="P30"/>
<text:p text:style-name="P1"/>
<text:p text:style-name="P1"/>
<text:p text:style-name="P1"/>
<text:p text:style-name="P1"/>
<text:p text:style-name="P1"/>
<text:p text:style-name="P1"/>
<text:p text:style-name="P1"/>
<text:p text:style-name="P1"/>
<text:p text:style-name="P1"/>
<text:p text:style-name="P6">PIANO DI LAVORO</text:p>
<text:p text:style-name="P1"/>
<text:p text:style-name="P1"/>
<text:p text:style-name="P1"/>
<text:p text:style-name="P1"/>
<text:p text:style-name="P1"/>
<text:p text:style-name="P7">ANNO SCOLASTICO <?php echo $workplan->getYear() ?></text:p>
<text:p text:style-name="P1"/>
<text:p text:style-name="P1"/>
<text:p text:style-name="P1"/>
<text:p text:style-name="P1"/>
<text:p text:style-name="P1"/>
<text:p text:style-name="P1"/>
<text:p text:style-name="P15"><?php echo __('Teacher') ?>: <?php echo format_number_choice(__('[0]Ms %s|[1]Mr %s'), array('%s'=>$workplan->getFullname()), $workplan->getSfGuardUser()->getProfile()->getIsMale()) ?></text:p>
<text:p text:style-name="P15"><?php echo __('Subject') ?>: <?php echo $workplan->getSubject() ?></text:p>
<text:p text:style-name="P15"><?php echo __('Class') ?>: <?php echo $workplan->getSchoolclass() ?></text:p>
<text:p text:style-name="P16"/><?php /* page break */ ?>
<?php foreach($workplan->getWpinfos() as $wpinfo): ?>
	<?php if($workplan->getState()>=$wpinfo->getWpinfoType()->getState()): ?>
		<?php if($wpinfo->getContent()!=''): ?>
			<text:p text:style-name="P9"><?php echo $wpinfo->getWpinfoType()->getTitle() ?></text:p>
			<text:p text:style-name="P17"><?php echo Opendocument::html2odtxml($wpinfo->getContent()) ?></text:p>
			<text:p text:style-name="P10">(<?php echo sprintf(__('filled on %s'), $wpinfo->getUpdatedAt('d/m/Y')) ?>)</text:p>
			<text:p text:style-name="P1" />
			<?php endif ?>
	<?php endif ?>
<?php endforeach ?>
<text:p text:style-name="P1"></text:p>
<text:p text:style-name="P9">Tavola di programmazione della disciplina</text:p>
<?php foreach($workplan->getWpmodules() as $wpmodule): ?>
	<text:p text:style-name="P17"><?php echo $wpmodule->getRank() ?>. <?php echo $wpmodule->getTitle() ?> (<?php echo $wpmodule->getPeriod() ?>)</text:p>
<?php endforeach ?>

<text:p text:style-name="P16"/><?php /* page break */ ?> 

<text:p text:style-name="P4"></text:p>
<?php foreach($workplan->getWpmodules() as $wpmodule): ?>
	<text:p text:style-name="P10">Titolo del modulo</text:p>
	<text:p text:style-name="P9"><?php echo $wpmodule->getTitle() ?></text:p>
	<text:p text:style-name="P10">Periodo di svolgimento</text:p>
	<text:p text:style-name="P9"><?php echo $wpmodule->getPeriod() ?></text:p>
	<text:p />
	<?php foreach($wpmodule->getWpitemGroups() as $wpitemgroup): ?>
	<?php if ($workplan->getState() >= $wpitemgroup->getWpitemType()->getState()): ?>
		<text:p text:style-name="P10"><?php echo $wpitemgroup->getWpitemType()->getTitle() ?></text:p>
		<text:list text:style-name="L2">
		<?php foreach($wpitemgroup->getWpmoduleItems() as $wpmoduleitem): ?>
			<text:list-item><text:p text:style-name="P1"><?php echo Opendocument::html2odtxml($wpmoduleitem->getContent()) ?></text:p></text:list-item>
		<?php endforeach ?>
		</text:list>
		<text:p/>
	<?php endif ?>
	<?php endforeach ?>
<?php echo Opendocument::html2odtxml('<hr />'); ?>
<text:p text:style-name="P16"/><?php /* page break */ ?> 
<?php endforeach ?>
<text:p text:style-name="Standard"/>
<?php foreach($tools as $group): ?>
<text:p text:style-name="P9"><?php echo $group['description'] ?></text:p>
	<?php if (@sizeof($group['elements'])>0): ?>
			<?php foreach($group['elements'] as $tool): ?>
				<text:p text:style-name="P1">
				<?php echo $tool['chosen']? "▣ ": "▢ " ?>
				<?php echo $tool['description'] ?>
				</text:p>
			<?php endforeach ?>
	<?php else: ?>
		<text:p text:style-name="P1"><?php echo __('No choice done.') ?></text:p>
	<?php endif ?>
<text:p text:style-name="P1" />
<?php endforeach ?>
</office:text>
</office:body>