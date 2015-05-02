<?php

class TagsModel extends BaseModel {
	public function getTagById($id) {
		$statement = self::$db->prepare(
			"SELECT id, tag
			FROM tags WHERE id = ?");
		$statement->bind_param("i", $id);
		$statement->execute();
		$result = $statement->get_result()->fetch_all(MYSQLI_ASSOC);
		if(count($result) < 1) {
			return null;
		}

		return $result[0];
	} 

	public function getTagsByPostId($id) {
		$statement = self::$db->prepare(
			"SELECT t.id, t.tag 
			FROM tags AS t JOIN posts_tags AS pt ON pt.tag_id = t.id 
			WHERE pt.post_id = ?");
		$statement->bind_param("i", $id);
		$statement->execute();
		$result = $statement->get_result()->fetch_all(MYSQLI_ASSOC);
		return $result;
	}

	public function getAllTagsNotOnPost($id) {
		$statement = self::$db->prepare(
			"SELECT t.id, t.tag 
			FROM tags AS t
			WHERE t.id NOT IN 
				(SELECT ti.id FROM tags AS ti 
			    JOIN posts_tags AS pt 
			    ON pt.tag_id = ti.id 
				WHERE pt.post_id = ?)");
		$statement->bind_param("i", $id);
		$statement->execute();
		$result = $statement->get_result()->fetch_all(MYSQLI_ASSOC);
		return $result;
	}

	public function getTags($page = 1, $pageSize = DEFAULT_PAGE_SIZE) {
		$page--;
		$statement = self::$db->prepare(
			"SELECT id, tag 
			FROM tags LIMIT ?, ?");
		$statement->bind_param("ii", $page, $pageSize);
		$statement->execute();
		$result = $statement->get_result()->fetch_all(MYSQLI_ASSOC);
		return $result;
	}

	public function getPopularTags() {
		$statement = self::$db->prepare("SELECT t.id, t.tag, COUNT(pt.post_id) as count
			FROM tags AS t LEFT JOIN posts_tags AS pt ON t.id = pt.tag_id 
			GROUP BY t.id LIMIT 5");
		$statement->execute();
		$result = $statement->get_result()->fetch_all(MYSQLI_ASSOC);
		return $result;
	}

	public function create($tag) {
		$tagValidationError = $this->validateTag($tag);
		if($tagValidationError != null) {
			return $tagValidationError;
		}

		$statement = self::$db->prepare("INSERT INTO tags(tag) VALUES(?)");
		$statement->bind_param("s", $tag);
		$statement->execute();

		return null;		
	}

	public function edit($id, $tag) {
		$tagValidationError = $this->validateTag($tag);
		if($tagValidationError != null) {
			return $tagValidationError;
		}

		$statement = self::$db->prepare("SELECT COUNT(id) FROM tags WHERE id = ?");
		$statement->bind_param("i", $id);
		$statement->execute();
		$result = $statement->get_result()->fetch_assoc();
		if($result["COUNT(id)"] == 0) {
			return "Tag not found.";
		}

		$statement = self::$db->prepare("UPDATE tags
			SET Tag=?
			WHERE id=?");
		$statement->bind_param("si", $tag, $id);
		$statement->execute();

		return null;
	}

	public function delete($id) {
		$statement = self::$db->prepare("DELETE FROM tags WHERE id = ?");
		$statement->bind_param("i", $id);
		$statement->execute();		
        return $statement->affected_rows > 0;
	}

	private function validateTag($tag) {
		if((strlen($tag) < TAG_MIN_LENGTH) || (strlen($tag) > TAG_MAX_LENGTH)) {
			return "Tag must be between " . TAG_MIN_LENGTH .
				" and " . TAG_MAX_LENGTH . " characters long.";
		}

		$statement = self::$db->prepare("SELECT COUNT(id) FROM tags WHERE tag = ?");
		$statement->bind_param("s", $tag);
		$statement->execute();
		$result = $statement->get_result()->fetch_assoc();
		if($result["COUNT(id)"] != 0) {
			return "Tag already exists.";
		}

		return null;
	}
}