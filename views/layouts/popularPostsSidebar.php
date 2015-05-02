<div>
	Popular posts:
	<div class="popular-posts">
	</div>
</div>

<script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
<script>
	var requestUrl = "/posts/popular";
	$.get(requestUrl, function(data){
        $(".popular-posts").html(data);
    });
</script>