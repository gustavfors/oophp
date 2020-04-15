<?php
/**
 * Create routes using $app programming style.
 */
//var_dump(array_keys(get_defined_vars()));



/**
 * Init the game and redirect to play the game
 */
$app->router->post("guess/process", function () use ($app) {

    if (isset($_POST['reset'])) {
        $_SESSION["game"] = new \Gufo\Guess\Guess();
    }

    if (isset($_POST['guess'])) {
        try {
            $_SESSION['feedback'] = $_SESSION["game"]->makeGuess($_POST['input']);
            return $app->response->redirect("guess/play");
        } catch (\Gufo\Guess\GuessException $e) {
            $_SESSION['error'] = 'Caught exception: ' . get_class($e) . ": " .  $e->getMessage();
            return $app->response->redirect("guess/play");
        }
    }

    if (isset($_POST['cheat'])) {
        $_SESSION['cheat'] = $_SESSION["game"]->number();
    }

    return $app->response->redirect("guess/play");
});



/**
 * Play the game
 */
$app->router->get("guess/play", function () use ($app) {

    if (!isset($_SESSION["game"])) {
        $_SESSION["game"] = new \Gufo\Guess\Guess();
    }

    $title = "Play the game";
    // $data = [
    //     "who" => "mumin",
    // ];

    $app->page->add("guess/play");
    // echo "Some debugging information";
    return $app->page->render([
        "title" => $title,
    ]);
});
