<script src="/content/js/getPostComments.js"></script>
<div class="blog-post">
	<h3 class="blog-post-title"><?= htmlspecialchars($this->post["title"])?></h3>
	<p class="blog-post-meta"><?= htmlspecialchars($this->post['date_created']) ?> by <b><?= htmlspecialchars($this->post['username']) ?></b></p>
	<p><?= htmlspecialchars($this->post["content"])?></p>
	<input id="postId" type="hidden" value="<?=$this->post['id']?>">
	<input id="page" type="hidden" value="<?=$this->page?>">
	<?php if($this->isAdmin()) :?>
        <a class="btn btn-warning" href="/posts/edit/<?=$this->post['id']?>">Edit Post</a>
        <a class="btn btn-danger" href="/posts/delete/<?=$this->post['id']?>">Delete Post</a>
    <?php endif;?>
</div>

<?php include_once("views/comments/post.php");?>

<div class="comments"></div>
