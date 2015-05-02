<div>
	Recent posts:
	<div class="recent-posts">
	</div>
</div>

<script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
<script>
	var requestUrl = "/posts/recent";
	$.get(requestUrl, function(data){
        $(".recent-posts").html(data);
    });
</script>