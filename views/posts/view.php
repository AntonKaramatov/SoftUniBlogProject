<div>
	<h3><?= htmlspecialchars($this->post["title"])?></h3>
	<p><?= htmlspecialchars($this->post["date_created"])?></p>
	Author: <?= htmlspecialchars($this->post["username"])?>
	<p><?= htmlspecialchars($this->post["content"])?></p>
	<input id="postId" type="hidden" value="<?=$this->post['id']?>">
</div>

<?php include_once("views/comments/post.php");?>

<div class="comments"></div>

<script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
<script>
	var id = $("#postId").val();
	var requestUrl = "/comments/get/" + id;
	$.get(requestUrl, function(data){
        $(".comments").html(data);
    });
</script>