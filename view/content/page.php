<?php

namespace Anax\View;

?>

<article>
    <header>
        <h1><?= htmlspecialchars($resultset->title) ?></h1>
        <p>Published: <?= htmlspecialchars($resultset->published) ?></p>
    </header>
    <?= $resultset->data ?>
</article>
