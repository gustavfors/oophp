<?php
namespace Anax\View;
?>

<nav class="pt-1">
    <a href="<?= url("mytextfilter?filter=bbcode") ?>">BBCode</a> | 
    <a href="<?= url("mytextfilter?filter=link") ?>">Clickable</a> | 
    <a href="<?= url("mytextfilter?filter=markdown") ?>">Markdown</a>
</nav>

<h1>Showing off Clickable</h1>

<h2>Source in clickable.txt</h2>
<pre><?= wordwrap(htmlentities($text)) ?></pre>

<h2>Source formatted as HTML</h2>
<?= $text ?>

<h2>Filter Clickable applied, source</h2>
<pre><?= wordwrap(htmlentities($html)) ?></pre>

<h2>Filter Clickable applied, HTML</h2>
<?= $html ?>