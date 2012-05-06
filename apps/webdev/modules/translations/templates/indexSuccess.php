<h1>Translations</h1>

<p>Instructions:</p>
<ol>
<li>Check the reference localization file and see that there are no duplicates in ids or items</li>
<li>Check the other translations, one by one</li>
</ol>

<hr />

<p>Reference localization file:</p>
<ul>
<li><?php echo link_to($reference, url_for('translations/reference?lang='. $reference)) ?></li>
</ul>
<p>Other available localization files:</p>
<ul>
<?php foreach($languages as $language): ?>
<li><?php echo link_to($language, url_for('translations/show?lang='. $language)) ?></li>
<?php endforeach ?>
</ul>
