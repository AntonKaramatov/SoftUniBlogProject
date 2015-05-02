<div>
	<form action="/comments/editUserComment/<?=$this->comment['id']?>" method="POST">
		<textarea name="content"><?=htmlspecialchars($this->comment['content'])?></textarea><br/>
		<input type="submit" value="Edit">
	</form>
</div>

