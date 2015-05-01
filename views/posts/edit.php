<form action="/posts/edit/<?=$this->post['id']?>" method="POST">
	Title: <input type="text" name="title" value="<?=htmlspecialchars($this->post['title'])?>"><br/>
	<textarea name="content">
		<?=htmlspecialchars($this->post['content'])?>
	</textarea><br/>
	<input type="submit" value="Edit">
</form>