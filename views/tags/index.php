<div>
All tags:<br/>
	<?php foreach ($this->tags as $tag) : ?>
	    <?= htmlspecialchars($tag['tag']) ?> 
	    <a href="/tags/edit/<?=$tag['id']?>">Edit</a>
	    <a href="/tags/delete/<?=$tag['id']?>">Delete</a>
	    <br/>
	<?php endforeach ?>
</div>
<?php include_once("views/layouts/pagination.php");?>