<h1>Translations</h1>

<ul>
<?php foreach($languages as $language): ?>
<li><?php echo link_to($language, url_for('translations/show?lang='. $language)) ?></li>
<?php endforeach ?>
</ul>
