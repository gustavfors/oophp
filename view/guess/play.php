<?php

namespace Anax\View;

/**
 * Render content within an article.
 */


?>

<h1>Guess my number (POST)</h1>

<?php if (!$_SESSION['game']->gameOver()) : ?>
<p>Guess a number between 1 and 100, you have <?= $_SESSION['game']->tries(); ?> tries left.</p>
<?php else : ?>
<p>Guess a number between 1 and 100.</p>
<?php endif; ?>

<form action="process" method="POST">
    <input type="number" name="input" autocomplete="off">
    <?php if (!$_SESSION['game']->gameOver()) : ?>
    <input type="submit" name="guess" value="Make Guess">
    <input type="submit" name="cheat" value="Cheat">
    <?php endif; ?>
    <input type="submit" name="reset" value="Reset Game">
</form>

<?php if (isset($_SESSION['feedback'])) : ?>
<p><?= $_SESSION['feedback']; ?></p>
    <?php unset($_SESSION["feedback"]); ?>
<?php endif; ?>

<?php if (isset($_SESSION['cheat'])) : ?>
<p>The secret number is: <?= $_SESSION['game']->number(); ?></p>
    <?php unset($_SESSION["cheat"]); ?>
<?php endif; ?>
