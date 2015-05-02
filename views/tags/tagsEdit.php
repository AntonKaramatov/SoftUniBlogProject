Tags on post: 
<?php foreach ($this->tags as $tag) : ?>
	<a href="/posts/getByTag/<?=$tag['id']?>"><?=htmlspecialchars($tag['tag'])?></a>
	<a href="/posts/removeTag/<?=htmlspecialchars($this->postId)?>/<?=$tag['id']?>">[Remove from post]</a>
<?php endforeach; ?>