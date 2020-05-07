<?php

namespace Anax\View;

// if (!$resultset) {
//     return;
// }

?>
<div class="movie-list">

<form action="<?= url("movie/process") ?>" method="POST">

    <p>Movie title: <br><input type="text" name="title" autocomplete="off" required></p>
    <p>Release year: <br><input type="number" name="year" autocomplete="off" required></p>
    <p>Image name: <br><input type="text" name="image" autocomplete="off" required value="img/noimage.png"></p>
    <p><input type="submit" value="Add movie" name="create"></p>

</form>

</div>