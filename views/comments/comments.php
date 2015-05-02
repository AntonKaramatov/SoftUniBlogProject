<?php foreach ($this->comments as $comment) : ?>
	<div class="comment">
		<span><?= htmlspecialchars($comment['content']) ?></span> <br/>
        <p class="blog-post-meta">
        <b><?= htmlspecialchars($comment['username']) ?>
		<?php if($comment["type"] == 0) :?>
        	(guest)
    	<?php endif;?>
        </b>
        <?= htmlspecialchars($comment['date_created']) ?>
        </p>
        <?php if($this->isAdmin()):?>
        	<?php if($comment["type"] == 1) :?>
	            <a class="btn btn-sm btn-warning" href="/comments/editUserComment/<?= htmlspecialchars($comment['id']) ?>">Edit Comment</a>
	            <a class="btn btn-sm btn-danger" href="/comments/deleteUserComment/<?= htmlspecialchars($comment['id']) ?>">Delete Comment</a>
        	<?php endif;?>
        	<?php if($comment["type"] == 0) :?>
	            <a class="btn btn-sm btn-warning" href="/comments/editGuestComment/<?= htmlspecialchars($comment['id']) ?>">Edit Comment</a>
	            <a class="btn btn-sm btn-danger" href="/comments/deleteGuestComment/<?= htmlspecialchars($comment['id']) ?>">Delete Comment</a>
        	<?php endif;?>
        <?php endif; ?>
    </div>
<?php endforeach; ?>

<?php include_once("views/layouts/pagination.php");