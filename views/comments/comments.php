<?php foreach ($this->comments as $comment) : ?>
	<div>
		<span><?= htmlspecialchars($comment['content']) ?></span> <br/>
        <?= htmlspecialchars($comment['username']) ?>
		<?php if($comment["type"] == 0) :?>
        	(guest)
    	<?php endif;?>

        <?= htmlspecialchars($comment['date_created']) ?>
        
        <?php if($this->isAdmin()):?>
        	<br/>
        	<?php if($comment["type"] == 1) :?>
	            <a href="/comments/editUserComment/<?= htmlspecialchars($comment['id']) ?>">Edit Comment</a>
	            <a href="/comments/deleteUserComment/<?= htmlspecialchars($comment['id']) ?>">Delete Comment</a>
        	<?php endif;?>
        	<?php if($comment["type"] == 0) :?>
	            <a href="/comments/editGuestComment/<?= htmlspecialchars($comment['id']) ?>">Edit Comment</a>
	            <a href="/comments/deleteGuestComment/<?= htmlspecialchars($comment['id']) ?>">Delete Comment</a>
        	<?php endif;?>
        <?php endif; ?>
    </div>
    <br/>
<?php endforeach; ?>

<?php include_once("views/layouts/pagination.php");