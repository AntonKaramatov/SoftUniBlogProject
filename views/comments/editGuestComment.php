<div>
	<form action="/comments/editGuestComment/<?=$this->comment['id']?>" method="POST">
		Name: <input type="text" name="username" value="<?=htmlspecialchars($this->comment['username'])?>"><br/>
		Email: <input type="text" name="email" value="<?=htmlspecialchars($this->comment['email'])?>"><br/>
		<textarea name="content"><?=htmlspecialchars($this->comment['content'])?></textarea><br/>
		<input type="submit" value="Edit">
	</form>
</div>

