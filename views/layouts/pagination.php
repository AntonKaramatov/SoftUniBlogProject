<div>
<?php for($i = 1; $i <= $this->pagesCount; $i++): ?>
<a href="<?=htmlspecialchars($this->requestUrl)?>?page=<?=$i?>">
<?=$i?>
</a>
<?php endfor;?>
</div>