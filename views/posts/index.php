<?php foreach ($this->posts as $post) : ?>
	<div>
        <a href="/posts/view/<?=$post['id']?>"><h3><?= htmlspecialchars($post['title']) ?></h3></a>
        Author: <?= htmlspecialchars($post['username']) ?> <br/>
        <?= htmlspecialchars($post['date_created']) ?>
        <div>
        	<?= htmlspecialchars($post['preview']) . "..." ?>
        </div>
        Visits: <?= htmlspecialchars($post['visits_count']) ?><br/>
        <?php if($this->isAdmin()) :?>
            <a href="/posts/edit/<?=$post['id']?>">Edit Post</a>
            <a href="/posts/delete/<?=$post['id']?>">Delete Post</a>
        <?php endif;?>
    </div>
<?php endforeach ?>