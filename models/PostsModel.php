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

	public function getPostTitlesFiltered($filter) {

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

	public function getMostRecentPost() {
		$query = self::$db->query("SELECT id, title, content, date_created 
			FROM posts ORDER BY date_created DESC LIMIT 1");
		return $query->fetch_all(MYSQLI_ASSOC)[0];
	}
}