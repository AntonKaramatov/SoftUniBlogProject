<?php foreach ($this->posts as $post) : ?>
	<div>
        <a href="/posts/view/<?=$post['id']?>"><h3><?= htmlspecialchars($post['title']) ?></h3></a>
        Author: <?= htmlspecialchars($post['username']) ?> <br/>
        <?= htmlspecialchars($post['date_created']) ?>
        <div>
        	<?= htmlspecialchars($post['preview']) . "..." ?>
        </div>
        Visits: <?= htmlspecialchars($post['visits_count']) ?>
    </div>
    <br/>
<?php endforeach ?>