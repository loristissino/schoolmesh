<h1>Translations</h1>

<p>Instructions:</p>
<ol>
<li>Check the reference localization file and see that there are no duplicates in ids or items</li>
<li>Check the other translations, one by one</li>
<li>Generate the file to use for automatic translation using the "clean" template</li>
<li>Save the translations in a file called 'translations.txt' in the same directory of the xliff file</li>
<li>Generate the xliff file, and use the part of it which is new to update the main file</li>
<li>Remove the translations.txt file</li>
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
