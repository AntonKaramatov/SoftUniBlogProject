<div>
	Leave a comment:
	<form action="/comments/post/<?=$this->post['id']?>" method="POST">
		<?php if(!$this->isLoggedIn()):?>
			Name: <input type="text" name="guest_name"><br/>
			Email: <input type="text" name="guest_email"><br/>
		<?php endif;?>

		<textarea name="comment_text"></textarea><br/>
		<input type="submit" value="Post">
	</form>
</div>

