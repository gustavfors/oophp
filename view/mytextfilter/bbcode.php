<?php
namespace Anax\View;
?>

<nav class="pt-1">
    <a href="<?= url("mytextfilter?filter=bbcode") ?>">BBCode</a> | 
    <a href="<?= url("mytextfilter?filter=link") ?>">Clickable</a> | 
    <a href="<?= url("mytextfilter?filter=markdown") ?>">Markdown</a>
</nav>

<h1>Showing off BBCode</h1>

<h2>Source in bbcode.txt</h2>
<pre><?= wordwrap(htmlentities($text)) ?></pre>

<h2>Filter BBCode applied, source</h2>
<pre><?= wordwrap(htmlentities($html)) ?></pre>

<h2>Filter BBCode applied, HTML (including nl2br())</h2>
<?= nl2br($html) ?>
