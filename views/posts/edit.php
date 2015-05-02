<form action="/posts/edit/<?=$this->post['id']?>" method="POST">
	<input type="hidden" id="postId" value="<?=$this->post['id']?>">
	Title: <input type="text" name="title" value="<?=htmlspecialchars($this->post['title'])?>"><br/>
	<textarea name="content">
		<?=htmlspecialchars($this->post['content'])?>
	</textarea><br/>
	<div class="tags" id="postTagsEdit"></div>
	<div class="tags" id="postTagsAdd"></div>
	<input type="submit" value="Edit">
</form>

<script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
<script> 
    var id = $("#postId").val();
    var requestUrl = "/tags/getEdit/" + id;
    $.get(requestUrl, function(data){
        $("#postTagsEdit").html(data);
    });

    requestUrl = "/tags/getAdd/" + id;
    $.get(requestUrl, function(data){
        $("#postTagsAdd").html(data);
    });
</script>