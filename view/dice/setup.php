<?php

namespace Anax\View;

/**
 * Render content within an article.
 */


?>


<h1>Game setup</h1>

<form class="setup" action="<?= url("dicev2/process") ?>" method="POST">
    <label>Number of players?</label>
    <input type="number" name="players" placeholder="Amount..." required>
    <label>Number of dice?</label>
    <input type="number" name="dices" placeholder="Amount..." required>
    <input type="submit" value="Play" name="setup">
</form>

