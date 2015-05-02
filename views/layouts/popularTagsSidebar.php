<div>
	Popular tags:
	<div class="popular-tags">
	</div>
</div>

<script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
<script>
	var requestUrl = "/tags/popular";
	$.get(requestUrl, function(data){
        $(".popular-tags").html(data);
    });
</script>