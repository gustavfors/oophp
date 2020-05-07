<?php

namespace Anax\View;

if (!$res) {
    return;
}

?>
<div class="movie-list">

<h1>Update movie</h1>

<form action="<?= url("movie/process") ?>" method="POST">
    <input type="hidden" name="id" value="<?= $res[0]->id; ?>"
    <p>Movie title: <br><input type="text" name="title" autocomplete="off" required value="<?= $res[0]->title; ?>"></p>
    <p>Release year: <br><input type="number" name="year" autocomplete="off" required value="<?= $res[0]->year; ?>"></p>
    <p>Image name: <br><input type="text" name="image" autocomplete="off" required value="<?= $res[0]->image; ?>"></p>
    <p><input type="submit" value="update" name="edit"></p>

</form>

</div>