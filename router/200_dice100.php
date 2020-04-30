<?php
/**
 * Create routes using $app programming style.
 */

/**
 * Play the game
 */
$app->router->post("dice100/process", function () use ($app) {
    /**
     * Setup the game
     */
    if (isset($_POST['setup'])) {
        $_SESSION['players'] = (int)$_POST['players'];
        $_SESSION['dices'] = (int)$_POST['dices'];

        $_SESSION['dice100'] = new Gufo\Dice100\Game($_SESSION['players'], $_SESSION['dices']);

        return $app->response->redirect("dice100/play");
    }

    if (isset($_POST['reset'])) {
        $_SESSION['dice100'] = new Gufo\Dice100\Game($_SESSION['players'], $_SESSION['dices']);

        return $app->response->redirect("dice100/play");
    }

    if (isset($_POST['roll'])) {
        $_SESSION['dice100']->rollDices();
        return $app->response->redirect("dice100/play");
    }

    if (isset($_POST['save'])) {
        $_SESSION['dice100']->endTurn();
        $_SESSION['dice100']->aiPlay();
        return $app->response->redirect("dice100/play");
    }
});


/**
 * Setup the game
 */
$app->router->get("dice100/init", function () use ($app) {

    $title = "setup";

    $app->page->add("dice100/setup");
    return $app->page->render([
        "title" => $title,
    ]);
});

/**
 * Setup the game
 */
$app->router->get("dice100/play", function () use ($app) {

    $title = "play";

    $app->page->add("dice100/play");
    return $app->page->render([
        "title" => $title,
    ]);
});
