All tags: <br/>
<?php foreach ($this->tags as $tag) : ?>
	<a href="/posts/getByTag/<?=$tag['id']?>"><?=htmlspecialchars($tag['tag'])?></a>
	<a href="/posts/addTag/<?=htmlspecialchars($this->postId)?>/<?=$tag['id']?>">[Add to post]</a> <br/>
<?php endforeach; ?>