<?php
namespace Anax\View;
?>

<table>
    <tr class="first">
        <th>Id</th>
        <th>path</th>
        <th>slug</th>
        <th>Title</th>
        <th>Type</th>
        <th>Published</th>
        <th>Created</th>
        <th>Updated</th>
        <th>Deleted</th>
        <th>Actions</th>
    </tr>
<?php $id = -1; foreach ($resultset as $row) :
    $id++; ?>
    <tr>
        <td><?= $row->id ?></td>
        <td><?= $row->path ?></td>
        <td><?= $row->slug ?></td>
        <td><?= $row->title ?></td>
        <td><?= $row->type ?></td>
        <td><?= $row->published ?></td>
        <td><?= $row->created ?></td>
        <td><?= $row->updated ?></td>
        <td><?= $row->deleted ?></td>
        <td>
            <a href="<?= url("content/update?id={$row->id}") ?>">
                Edit
            </a>
            <a href="<?= url("content/delete?id={$row->id}") ?>">
                Delete  
            </a>
        </td>
    </tr>
<?php endforeach; ?>
</table>