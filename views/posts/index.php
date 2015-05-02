<?php foreach ($this->posts as $post) : ?>
	<div class="post">
        <input type="hidden" class="postId" value="<?=$post['id']?>">
        <a href="/posts/view/<?=$post['id']?>"><h3><?= htmlspecialchars($post['title']) ?></h3></a>
        Author: <?= htmlspecialchars($post['username']) ?> <br/>
        <?= htmlspecialchars($post['date_created']) ?>
        <div>
        	<?= htmlspecialchars($post['preview']) . "..." ?>
            <a href="/posts/view/<?=$post['id']?>">Continue reading</a>
        </div>
        <div id="tags_<?=$post['id']?>"></div>
        Visits: <?= htmlspecialchars($post['visits_count']) ?><br/>
        <?php if($this->isAdmin()) :?>
            <a href="/posts/edit/<?=$post['id']?>">Edit Post</a>
            <a href="/posts/delete/<?=$post['id']?>">Delete Post</a>
        <?php endif;?>
    </div>
<?php endforeach ?>

<?php include_once("views/layouts/pagination.php");?>

<script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
<script>
    $.each($(".post"), 
        function(i, el) {
            var input = el.getElementsByClassName("postId"); 
            var id = input[0].value;
            var requestUrl = "/tags/get/" + id;
            $.get(requestUrl, function(data){
                var divIdSelector = "#tags_" + id;
                $(divIdSelector).html(data);
            });
        })
</script>
