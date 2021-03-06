<?php

namespace Anax\View;

// if (!$resultset) {
//     return;
// }

?>
<div class="movie-list">
<h1>Movie list</h1>
<form>
    <input type="text" placeholder="Search by year or title" name="search" autocomplete="off">
    <input type="submit" value="search">
</form>

<?php if ($resultset) : ?>
<table>
    <tr class="first">
        <th>Id</th>
        <th>Bild</th>
        <th>Titel</th>
        <th>År</th>
        <th>Action</th>
    </tr>
    <?php $id = -1; foreach ($resultset as $row) : ?>
    <tr>
        <td><?= $row->id ?></td>
        <td><img class="thumb" src="<?= $row->image ?>"></td>
        <td><?= $row->title ?></td>
        <td><?= $row->year ?></td>
        <td><a href="<?= url("movie/edit?id={$row->id}") ?>">Edit</a> | <a href="<?= url("movie/process?delete={$row->id}") ?>">Delete</a></td>
    </tr>
    <?php endforeach; ?>
</table>
<?php else : ?>
<p>No movies to display...</p>
<?php endif; ?>
<div class="button">
<a href="<?= url("movie/create") ?>">Add new movie</a>
</div>
</div>