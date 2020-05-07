<?php

namespace Anax\View;

// if (!$resultset) {
//     return;
// }

?>
<div class="movie-list">
<form>
    <input type="text" placeholder="Search by year or title" name="search" autocomplete="off">
    <input type="submit" value="search">
</form>

<?php if ($resultset) : ?>
<table>
    <tr class="first">
        <th>Rad</th>
        <th>Id</th>
        <th>Bild</th>
        <th>Titel</th>
        <th>År</th>
        <th>Action</th>
    </tr>
<?php $id = -1; foreach ($resultset as $row) :
    $id++; ?>
    <tr>
        <td><?= $id ?></td>
        <td><?= $row->id ?></td>
        <td><img class="thumb" src="<?= $row->image ?>"></td>
        <td><?= $row->title ?></td>
        <td><?= $row->year ?></td>
        <td><a href="#">Edit</a> | <a href="#">Delete</a></td>
    </tr>
<?php endforeach; ?>
</table>
<?php else : ?>
<p>Nothing matches your search...</p>
<?php endif; ?>

<form>
    <input type="submit" value="Add movie">
</form>
</div>