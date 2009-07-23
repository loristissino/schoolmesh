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
<text:p text:style-name="P7">ANNO SCOLASTICO <?php echo "2008-2009" ?></text:p>
<text:p text:style-name="P1"/>
<text:p text:style-name="P1"/>
<text:p text:style-name="P1"/>
<text:p text:style-name="P1"/>
<text:p text:style-name="P1"/>
<text:p text:style-name="P1"/>
<text:p text:style-name="P15"><?php echo __('Teacher') ?>:<text:tab/><?php echo sprintf(__('Prof. %s'), $workplan->getFullname()) ?></text:p>
<text:p text:style-name="P15"><?php echo __('Subject') ?>:<text:tab/><?php echo $workplan->getSubject() ?></text:p>
<text:p text:style-name="P15"><?php echo __('Class') ?>:<text:tab/><?php echo $workplan->getSchoolclass() ?></text:p>
<text:p text:style-name="P16"/><?php /* page break */ ?>
<?php foreach($workplan->getWpinfos() as $wpinfo): ?>
	<?php if($workplan->getState()>=$wpinfo->getWpinfoType()->getState()): ?>
		<text:p text:style-name="P4"><?php echo $wpinfo->getWpinfoType()->getTitle() ?></text:p>
		<text:p text:style-name="P18"><?php echo Opendocument::html2odtxml($wpinfo->getContent()) ?></text:p>
		<text:p text:style-name="P4"></text:p>
	<?php endif ?>
<?php endforeach ?>
<text:p text:style-name="P16"/><?php /* page break */ ?>
<text:p text:style-name="P4">TAVOLA DI PROGRAMMAZIONE DELLA DISCIPLINA</text:p>
<text:p text:style-name="P4"></text:p>
<?php foreach($workplan->getWpmodules() as $wpmodule): ?>
	<text:p text:style-name="P10">Titolo del modulo</text:p>
	<text:p text:style-name="P9"><?php echo $wpmodule->getTitle() ?></text:p>
	<text:p text:style-name="P10">Periodo di svolgimento</text:p>
	<text:p text:style-name="P9"><?php echo $wpmodule->getPeriod() ?></text:p>
	<text:p />
	<?php foreach($wpmodule->getWpitemGroups() as $wpitemgroup): ?>
		<text:p text:style-name="P10"><?php echo $wpitemgroup->getWpitemType()->getTitle() ?></text:p>
		<text:list text:style-name="L2">
		<?php foreach($wpitemgroup->getWpmoduleItems() as $wpmoduleitem): ?>
			<text:list-item><text:p text:style-name="P1"><?php echo Opendocument::html2odtxml($wpmoduleitem->getContent()) ?></text:p></text:list-item>
		<?php endforeach ?>
		</text:list>
		<text:p/>
	<?php endforeach ?>
<?php echo Opendocument::html2odtxml('<hr />'); ?>
<?php /*	<text:p text:style-name="P16"/><?php /* page break */ ?> 
<?php endforeach ?>
<text:p text:style-name="Standard"/>
<text:p text:style-name="P1"/>
<table:table table:name="Tabella7" table:style-name="Tabella7">
<table:table-column table:style-name="Tabella7.A"/>
<table:table-column table:style-name="Tabella7.B"/>
<table:table-column table:style-name="Tabella7.C"/>
<table:table-row table:style-name="Tabella7.1">
<table:table-cell table:style-name="Tabella7.A1" office:value-type="string">
<text:p text:style-name="P5">METODOLOGIA DI LAVORO
</text:p>
</table:table-cell>
<table:table-cell table:style-name="Tabella7.A1" office:value-type="string">
<text:p text:style-name="P5">TIPOLOGIA DELLE VERIFICHE
</text:p>
</table:table-cell>
<table:table-cell table:style-name="Tabella7.C1" office:value-type="string">
<text:p text:style-name="P5">STRUMENTI
</text:p>
</table:table-cell>
</table:table-row>
<table:table-row table:style-name="Tabella7.1">
<table:table-cell table:style-name="Tabella7.A1" office:value-type="string">
<text:p text:style-name="P12">
<text:span text:style-name="T1">
</text:span>
<text:span text:style-name="T2"> Lezione frontale
</text:span>
</text:p>
<text:p text:style-name="Standard">
<text:span text:style-name="T1">
</text:span>
<text:span text:style-name="T2"> Lezione dialogata
</text:span>
</text:p>
<text:p text:style-name="Standard">
<text:span text:style-name="T1">
</text:span>
<text:span text:style-name="T2"> Lavori di gruppo
</text:span>
</text:p>
<text:p text:style-name="Standard">
<text:span text:style-name="T1">
</text:span>
<text:span text:style-name="T2"> Compiti a casa
</text:span>
</text:p>
<text:p text:style-name="Standard">
<text:span text:style-name="T1">
</text:span>
<text:span text:style-name="T2"> Risoluzione di problemi
</text:span>
</text:p>
<text:p text:style-name="Standard">
<text:span text:style-name="T1">
</text:span>
<text:span text:style-name="T2"> Problem Posing
</text:span>
</text:p>
<text:p text:style-name="Standard">
<text:span text:style-name="T1">
</text:span>
<text:span text:style-name="T2"> Ricerche 
</text:span>
</text:p>
<text:p text:style-name="P14">
</text:p>
<text:p text:style-name="P14">
</text:p>
<text:p text:style-name="P14">
</text:p>
</table:table-cell>
<table:table-cell table:style-name="Tabella7.A1" office:value-type="string">
<text:p text:style-name="P12">
<text:span text:style-name="T1">
</text:span>
<text:span text:style-name="T2"> Test
</text:span>
</text:p>
<text:p text:style-name="Standard">
<text:span text:style-name="T1">
</text:span>
<text:span text:style-name="T2"> Domande alla classe
</text:span>
</text:p>
<text:p text:style-name="Standard">
<text:span text:style-name="T1">
</text:span>
<text:span text:style-name="T2"> Interrogazione
</text:span>
</text:p>
<text:p text:style-name="Standard">
<text:span text:style-name="T1">
</text:span>
<text:span text:style-name="T2"> Domande aperte
</text:span>
</text:p>
<text:p text:style-name="Standard">
<text:span text:style-name="T1">
</text:span>
<text:span text:style-name="T2"> Prove di laboratorio
</text:span>
</text:p>
<text:p text:style-name="Standard">
<text:span text:style-name="T1">
</text:span>
<text:span text:style-name="T2"> Relazioni 
<text:s/>scritte 
<text:s/>ed orali 
</text:span>
</text:p>
<text:p text:style-name="P14">
</text:p>
<text:p text:style-name="P29">
</text:p>
<text:p text:style-name="P14">
</text:p>
<text:p text:style-name="P14">
</text:p>
</table:table-cell>
<table:table-cell table:style-name="Tabella7.C1" office:value-type="string">
<text:p text:style-name="P12">
<text:span text:style-name="T1">
</text:span>
<text:span text:style-name="T2"> Libri di testo
</text:span>
</text:p>
<text:p text:style-name="Standard">
<text:span text:style-name="T1">
</text:span>
<text:span text:style-name="T2"> Laboratorio di Informatica
</text:span>
</text:p>
<text:p text:style-name="Standard">
<text:span text:style-name="T1">
</text:span>
<text:span text:style-name="T2"> Lavagna Luminosa
</text:span>
</text:p>
<text:p text:style-name="Standard">
<text:span text:style-name="T1">
</text:span>
<text:span text:style-name="T2"> Proiettore
</text:span>
</text:p>
<text:p text:style-name="Standard">
<text:span text:style-name="T1">
</text:span>
<text:span text:style-name="T2"> Help in linea
</text:span>
</text:p>
<text:p text:style-name="Standard">
<text:span text:style-name="T1">
</text:span>
<text:span text:style-name="T2"> Appunti delle lezioni
</text:span>
</text:p>
<text:p text:style-name="Standard">
<text:span text:style-name="T1">
</text:span>
<text:span text:style-name="T2"> Fotocopie
</text:span>
</text:p>
<text:p text:style-name="Standard">
<text:span text:style-name="T1">
</text:span>
<text:span text:style-name="T2"> Ricerche su Internet 
</text:span>
</text:p>
<text:p text:style-name="Standard">
<text:span text:style-name="T1">
</text:span>
<text:span text:style-name="T2"> Calcolatrice
</text:span>
</text:p>
<text:p text:style-name="P14">
</text:p>
</table:table-cell>
</table:table-row>
</table:table>
<text:p text:style-name="Standard"/>
<text:p text:style-name="P1"/>
</office:text>
</office:body>