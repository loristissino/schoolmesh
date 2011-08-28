<?php slot('breadcrumbs', breadcrumps_to_html(isset($breadcrumps)? $breadcrumps->getRawValue(): array(), $current)) ?>

<?php slot('title', html_entity_decode(isset($title) ? $title : $current)) ?>
<?php if(@!$hide_title): ?>
<h1><?php echo html_entity_decode(isset($title) ? $title : $current) ?></h1>
<?php endif ?>
<?php /*

To use this partial, follow this example:

<?php include_partial('content/breadcrumps', array(
  'breadcrumps'=>array(
    'linktostep1' => "Description of step 1",
    'linktostep2' => "Description of step 2",
    ),
  'current' => "Description of current step",
  'title'   => "Title of the current page"
  'hide_title' => true | false (default false)
  ))
?>

Each item but "current" can be omitted. If "title" is omitted, "current" is used.
In breadcrumps, descriptions are to be passed pre-i18n.

If link names begin with an underscore, they are not rendered as links.

*/?>