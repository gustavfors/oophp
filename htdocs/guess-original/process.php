<?php

require(__DIR__ . "/config.php");

if (isset($_POST['reset'])) {
    $_SESSION["game"] = new Guess();
    header("Location: index.php");
}

if (isset($_POST['guess'])) {
    try {
        $_SESSION['feedback'] = $_SESSION["game"]->makeGuess($_POST['input']);
        header("Location: index.php");
    } catch (GuessException $e) {
        echo 'Caught exception: ', get_class($e), ": ",  $e->getMessage(), "\n";
        echo '<br>';
        echo '<a href="index.php">return to game</a>';
    }
}

if (isset($_POST['cheat'])) {
    $_SESSION['cheat'] = $_SESSION["game"]->number();
    header("Location: index.php");
}
