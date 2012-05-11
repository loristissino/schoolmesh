<office:body>
<office:text text:use-soft-page-breaks="true">
<office:forms form:automatic-focus="false" form:apply-design-mode="false"/>
<text:sequence-decls>
<text:sequence-decl text:display-outline-level="0" text:name="Illustration"/>
<text:sequence-decl text:display-outline-level="0" text:name="Table"/>
<text:sequence-decl text:display-outline-level="0" text:name="Text"/>
<text:sequence-decl text:display-outline-level="0" text:name="Drawing"/>
</text:sequence-decls>

<?php $number=0 ?>
<?php foreach($profiles as $profile): ?>
<?php $number++ ?>
<text:p text:style-name="P9"><?php echo $profile->getFullname() ?></text:p>
<?php /*<text:p text:style-name="P9">Data di nascita: <?php echo $profile->getBirthdate('d/m/Y') ?></text:p>
<text:p text:style-name="P9">Matricola: <?php echo $profile->getImportCode() ?></text:p>
*/ ?>

<text:p text:style-name="P9"/>
<text:p text:style-name="P9"/>
<text:p text:style-name="P12">Pordenone, <?php echo date('d/m/Y') ?></text:p><text:p text:style-name="P9"/><text:p text:style-name="P9"/><text:p text:style-name="P12"><?php echo $profile->getIsMale()? 'Caro': 'Cara' ?> <?php echo $profile->getFirstName() ?>,</text:p><text:p text:style-name="P9"/><text:p text:style-name="P12">Ti è stato creato un account utente per l&apos;uso dei calcolatori dell&apos;Istituto.</text:p><text:p text:style-name="P9"/><text:p text:style-name="P12">Questo account ti consentirà di:</text:p><text:list text:style-name="L1">
<text:list-item><text:p text:style-name="P10">autenticarti in tutti i laboratori;</text:p></text:list-item>
<text:list-item><text:p text:style-name="P10">avere a disposizione uno spazio su disco per la memorizzazione dei tuoi documenti;</text:p></text:list-item>
<text:list-item><text:p text:style-name="P10">avere uno spazio comune per gruppi di lavoro di cui eventualmente fai parte;</text:p></text:list-item>
<text:list-item><text:p text:style-name="P10">accedere in maniera semplificata alla piattaforma di e-learning dell&apos;istituto, se e quando sarà necessario;</text:p></text:list-item>
<text:list-item><text:p text:style-name="P10">accedere all&apos;applicazione per la gestione dei piani di lavoro e delle relazioni finali.</text:p></text:list-item>
</text:list><text:p text:style-name="P9"/><text:p text:style-name="P12">L&apos;uso dell&apos;account comporta l&apos;accettazione del Regolamento di Istituto in merito.</text:p><text:p text:style-name="P9"/><text:p text:style-name="P12">Riepiloghiamo di seguito le informazioni rilevanti:</text:p><text:p text:style-name="P9"/>
<text:p text:style-name="P10">Nome utente (username): </text:p>
<text:p text:style-name="P12"><text:span text:style-name="T5"><?php echo $profile->getUsername() ?></text:span></text:p>
<text:p text:style-name="P10">Password assegnata provvisoriamente: </text:p>
<text:p text:style-name="P12"><text:span text:style-name="T5">
<?php $account=$profile->getAccountByType('samba') ?>
<?php if ($account): ?>
	<?php echo $account->getTemporaryPassword() ?>
<?php else: ?>
	<?php echo 'ACCOUNT NON PRESENTE' ?>
<?php endif ?>
</text:span></text:p>
<text:p text:style-name="P10">Indirizzo applicazione:  </text:p>
<text:p text:style-name="P12"><text:a xlink:type="simple" xlink:href="http://www.mattiussilab.net/help">http://www.mattiussilab.net/intranet</text:a> (l'applicazione è disponibile sia dall'interno sia dall'esterno della rete scolastica, ma l'accesso dall'esterno è sperimentale e attivo solo fino alle ore 18.00).</text:p>
<text:p text:style-name="P9"/><text:p text:style-name="P12">È bene ricordare due cose importanti.</text:p><text:p text:style-name="P9"/><text:p text:style-name="P12">La prima è che la password non va condivisa con altri utenti e dovrebbe essere cambiata al più presto, secondo le modalità indicate alla pagina web <text:a xlink:type="simple" xlink:href="http://www.mattiussilab.net/help">http://www.mattiussilab.net/help</text:a>.</text:p><text:p text:style-name="P9"/><text:p text:style-name="P12">La seconda è che i "nomi utente" (username) sono stati predisposti seguendo lo schema <text:span text:style-name="T6">nome.cognome</text:span>. Può essere però capitato che nel tuo caso non si sia potuto seguire questo schema (ad esempio in casi di omonimia – due persone con lo stesso nome e cognome – oppure quando per la presenza di più nomi e/o più cognomi si sarebbe arrivati a superare i venti caratteri) e sia stata adottata una soluzione diversa. Sappi che, se vuoi, puoi chiedere che il tuo nome utente (<?php echo $profile->getUsername() ?>) venga cambiato. Rivolgiti ad uno dei tecnici per ulteriori informazioni in merito.</text:p><text:p text:style-name="P9"/><text:p text:style-name="P12">Buon lavoro.</text:p><text:p text:style-name="P9"/>

<?php if ($number<sizeof($profiles)): ?>
<text:p text:style-name="P16"/><?php /* page break */ ?> 
<?php endif ?>
<?php endforeach ?></office:text>
</office:body>