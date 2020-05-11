<?php
namespace Anax\View;
?>

<article>

<h1>Blog posts</h1>
<?php foreach ($resultset as $row) : ?>
<section>
    <header>
        <h1><a href="blog/<?= htmlspecialchars($row->slug) ?>"><?= htmlspecialchars($row->title) ?></a></h1>
        <p><i>Published: <time datetime="<?= htmlspecialchars($row->published_iso8601) ?>" pubdate><?= htmlspecialchars($row->published) ?></time></i></p>
    </header>
    <?= htmlspecialchars($row->data) ?>
</section>
<?php endforeach; ?>

</article>
