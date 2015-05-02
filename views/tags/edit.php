<form action="/tags/edit/<?=$this->tag['id']?>" method="POST">
	Tag: <input type="text" name="tag" value="<?=htmlspecialchars($this->tag['tag'])?>"><br/>
	<input type="submit" value="Edit">
</form>