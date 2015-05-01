<?php

class PostsModel extends BaseModel {
	public function getPostById($id) {
		$statement = self::$db->prepare(
			"SELECT p.id, p.title, p.content, p.date_created, p.visits_count, u.username 
			FROM posts AS p INNER JOIN users AS u ON p.author_id = u.id WHERE p.id = ?");
		$statement->bind_param("i", $id);
		$statement->execute();
		$result = $statement->get_result()->fetch_all(MYSQLI_ASSOC);
		if(count($result) < 1) {
			return null;
		}

		return $result[0];
	}

	public function getRecentPostTitles() {
		$statement = self::$db->prepare("SELECT id, title FROM posts ORDER BY date_created DESC LIMIT 5");
		$statement->execute();
		$result = $statement->get_result()->fetch_all(MYSQLI_ASSOC);
		return $result;
	}

	public function getPopularPostTitles() {
		$statement = self::$db->prepare("SELECT id, title FROM posts ORDER BY visits_count DESC LIMIT 5");
		$statement->execute();
		$result = $statement->get_result()->fetch_all(MYSQLI_ASSOC);
		return $result;
	}

	public function getPostsWithPreview($page = 1, $pageSize = DEFAULT_PAGE_SIZE) {
		$page--;
		$statement = self::$db->prepare(
			"SELECT p.id, p.title, SUBSTRING(content, 1, 500) as preview, p.date_created, p.visits_count, u.username
			FROM posts AS p INNER JOIN users AS u ON p.author_id = u.id 
			ORDER BY date_created DESC LIMIT ?, ?");
		$statement->bind_param("ii", $page, $pageSize);
		$statement->execute();
		$result = $statement->get_result()->fetch_all(MYSQLI_ASSOC);
		return $result;
	}

	public function increaseViews($id) {
		$statement = self::$db->prepare(
			"UPDATE posts SET visits_count=visits_count + 1 WHERE id=?");
		$statement->bind_param("i", $id);
		$statement->execute();
	}

	public function post($title, $content) {
		if (strlen($title) == 0) {
			return "Title cannot be empty.";
		}

		if (strlen(trim($content)) == 0) {
			return "Content cannot be empty.";
		}

		$date = $this->getDate();
		$statement = self::$db->prepare("INSERT INTO posts (title, content, date_created, author_id)
			VALUES (?, ?, ?, ?)");
		$statement->bind_param("sssi", $title, $content, $date, $_SESSION["userId"]);
		$statement->execute();

		return null;
	}

	public function edit($id, $title, $content) {
		if (strlen($title) == 0) {
			return "Title cannot be empty.";
		}

		if (strlen(trim($content)) == 0) {
			return "Content cannot be empty.";
		}

		$statement = self::$db->prepare("SELECT COUNT(id) FROM posts WHERE id = ?");
		$statement->bind_param("i", $id);
		$statement->execute();
		$result = $statement->get_result()->fetch_assoc();
		if($result["COUNT(id)"] == 0) {
			return "Post not found.";
		}

		$statement = self::$db->prepare("UPDATE posts
			SET Title=?, Content=?
			WHERE id=?");
		$statement->bind_param("ssi", $title, $content, $id);
		$statement->execute();

		return null;
	}
}