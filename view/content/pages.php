<?php

namespace Anax\View;

?>

<table>
    <tr class="first">
        <th>Id</th>
        <th>Title</th>
        <th>Type</th>
        <th>Status</th>
        <th>Published</th>
        <th>Deleted</th>
    </tr>
<?php $id = -1; foreach ($resultset as $row) :
    $id++; ?>
    <tr>
        <td><?= $row->id ?></td>
        <?php if (!$row->path) : ?>
        <td><a href="page/<?= $row->slug ?>"><?= $row->title ?></a></td>
        <?php else : ?>
        <td><a href="page/<?= $row->path ?>"><?= $row->title ?></a></td>
        <?php endif; ?>
        <td><?= $row->type ?></td>
        <td><?= $row->status ?></td>
        <td><?= $row->published ?></td>
        <td><?= $row->deleted ?></td>
    </tr>
<?php endforeach; ?>
</table>