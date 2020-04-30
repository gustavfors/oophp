<?php

namespace Anax\View;

/**
 * Render content within an article.
 */

//var_dump($_SESSION['dice100']);
?>


<h1>Round <?= $_SESSION['dice100']->getRound() + 1; ?></h1>

<?php if ($_SESSION['dice100']->gameOver()) : ?>
    <?php if (count($_SESSION['dice100']->getWinners()) == 1) : ?>
    <p>The winner is: <?= implode(", ", $_SESSION['dice100']->getWinners()); ?></p>
    <?php else : ?>
    <p>The game was tied between: <?= implode(", ", $_SESSION['dice100']->getWinners()); ?></p>
    <?php endif; ?>
<?php endif; ?>

<?php if ($_SESSION['dice100']->getLastRoll()) : ?>
<p>You Rolled: <?= implode(", ", $_SESSION['dice100']->getLastRoll()); ?></p>
<p>Round Total: <?= $_SESSION['dice100']->getCurrentPlayer()->getCurrentScore(); ?></p>
<?php endif; ?>

<form action="process" method="POST">
    <?php if (!$_SESSION['dice100']->gameOver()) : ?>
        <?php if (!$_SESSION['dice100']->getPlayerRoundOver()) : ?>
        <input type="submit" name="roll" value="Roll Dices">
        <?php endif; ?>
        <?php if ($_SESSION['dice100']->getLastRoll()) : ?>
        <input type="submit" name="save" value="Save Score">
        <?php endif; ?>
    <?php endif; ?>
    <input type="submit" name="reset" value="Reset">
</form>

<div class="game-board mt-1">
    <table class="game-info">
        <tr>
            <th>Players</th>
        </tr>
        <?php for ($i = 0; $i <= $_SESSION['dice100']->getRound(); $i++) : ?>
            <tr>
                <th>Round <?= $i + 1 ?></th>
            </tr>
        <?php endfor; ?>
        <tr>
            <th>Total</th>
        </tr>
    </table>

    <?php foreach ($_SESSION['dice100']->getPlayers() as $player) : ?>
    <table class="player-info">
        <tr>
            <th><?= $player->getName(); ?></th>
        </tr>
        <?php for ($i = 0; $i <= $_SESSION['dice100']->getRound(); $i++) : ?>
        <tr>
            <?php if (array_key_exists($i, $player->getRoundScore())) : ?>
            <td><?= $player->getRoundScore()[$i]; ?></td>
            <?php else : ?>
            <td>...</td>
            <?php endif; ?>
        </tr>
        <?php endfor; ?>
        <tr>
            
            <td><?= $player->getTotalScore(); ?></td>
        </tr>
    </table>

    <?php endforeach; ?>

    

</div>





