<div>
	<form action="/comments/post" method="POST">
		<input type="hidden" value="<?=$this->post['id']?>" name="postId">
		<?php if(!$this->isLoggedIn()):?>
			Name: <input type="text" name="guest_name"><br/>
			Email: <input type="text" name="guest_email"><br/>
		<?php endif;?>

		<textarea name="comment_text"></textarea><br/>
		<input type="submit" value="Post">
	</form>
</div>

