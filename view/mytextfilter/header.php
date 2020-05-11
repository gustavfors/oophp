<?php

namespace Anax\View;

?>

<nav class="pt-1">
    <a href="<?= url("mytextfilter?filter=bbcode") ?>">BBCode</a> | 
    <a href="<?= url("mytextfilter?filter=link") ?>">Clickable</a> | 
    <a href="<?= url("mytextfilter?filter=markdown") ?>">Markdown</a>
</nav>