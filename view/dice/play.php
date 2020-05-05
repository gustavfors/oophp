<?php

namespace Anax\View;

/**
 * Render content within an article.
 */

// var_dump($app->session->get('dice'));

?>


<h1>Round <?= $app->session->get('dice')->getRound() + 1; ?></h1>



<?php if ($app->session->get('dice')->gameOver()) : ?>
    <?php if (count($app->session->get('dice')->getWinners()) == 1) : ?>
    <p>The winner is: <?= implode(", ", $app->session->get('dice')->getWinners()); ?></p>
    <?php else : ?>
    <p>The game was tied between: <?= implode(", ", $app->session->get('dice')->getWinners()); ?></p>
    <?php endif; ?>
<?php endif; ?>

<?php if ($app->session->get('dice')->getLastRoll()) : ?>
<p>You Rolled: <?= implode(", ", $app->session->get('dice')->getLastRoll()); ?></p>
<p>Round Total: <?= $app->session->get('dice')->getCurrentPlayer()->getCurrentScore(); ?></p>
<?php endif; ?>



<form action="process" method="POST">
    <?php if (!$app->session->get('dice')->gameOver()) : ?>
        <?php if (!$app->session->get('dice')->getPlayerRoundOver()) : ?>
        <input type="submit" name="roll" value="Roll Dices">
        <?php endif; ?>
        <?php if ($app->session->get('dice')->getLastRoll()) : ?>
        <input type="submit" name="save" value="Save Score">
        <?php endif; ?>
    <?php endif; ?>
    <input type="submit" name="reset" value="Reset">
</form>

<div class="histogram-container">
<?php foreach ($app->session->get('dice')->getPlayers() as $player) : ?>
<div class="histogram">
<p><?= $player->getName(); ?>
<pre class="m-0">
    <?= $player->printHistogram(); ?>
</pre>
</div>
<?php endforeach; ?>
</div>

<div class="game-board mt-1">
    <table class="game-info">
        <tr>
            <th>Players</th>
        </tr>
        <?php for ($i = 0; $i <= $app->session->get('dice')->getRound(); $i++) : ?>
            <tr>
                <th>Round <?= $i + 1 ?></th>
            </tr>
        <?php endfor; ?>
        <tr>
            <th>Total</th>
        </tr>
    </table>

    <?php foreach ($app->session->get('dice')->getPlayers() as $player) : ?>
    <table class="player-info">
        <tr>
            <th><?= $player->getName(); ?></th>
        </tr>
        <?php for ($i = 0; $i <= $app->session->get('dice')->getRound(); $i++) : ?>
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





