<form action="/posts/create" method="POST">
	Title: <input type="text" name="title" value="<?=htmlspecialchars($this->postTitle)?>"><br/>
	<textarea name="content"><?=htmlspecialchars($this->postContent)?></textarea><br/>
	<input type="submit" value="Post">
</form>