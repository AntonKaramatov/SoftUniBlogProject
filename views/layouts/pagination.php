<div class="pager">
<ul>
<?php for($i = 1; $i <= $this->pagesCount; $i++): ?>
	<li><a href="<?=htmlspecialchars($this->requestUrl)?>?page=<?=$i?>">
		<?=$i?>
	</a></li>
<?php endfor;?>
</ul>
</div>