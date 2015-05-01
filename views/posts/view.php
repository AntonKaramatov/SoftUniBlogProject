<div>
	<h3><?= htmlspecialchars($this->post["title"])?></h3>
	<p><?= htmlspecialchars($this->post["date_created"])?></p>
	Author: <?= htmlspecialchars($this->post["username"])?>
	<p><?= htmlspecialchars($this->post["content"])?></p>
</div>