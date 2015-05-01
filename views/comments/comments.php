<?php foreach ($this->comments as $comment) : ?>
	<div>
		<span><?= htmlspecialchars($comment['content']) ?></span> <br/>
        <?= htmlspecialchars($comment['username']) ?>
        <?= htmlspecialchars($comment['date_created']) ?>
    </div>
    <br/>
<?php endforeach ?>