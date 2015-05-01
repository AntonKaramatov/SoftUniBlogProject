<?php

class CommentsModel extends BaseModel {
	public function getCommentsByPostId($id) {
		$statement = self::$db->prepare(
			"(SELECT c.id, c.content, c.date_created, u.username 
			FROM user_comments AS c INNER JOIN users AS u ON c.author_id = u.id WHERE c.post_id = ?)
			UNION (SELECT id, content, date_created, username FROM guest_comments WHERE post_id = ?)
			ORDER BY date_created DESC");
		$statement->bind_param("ii", $id, $id);
		$statement->execute();
		$result = $statement->get_result()->fetch_all(MYSQLI_ASSOC);
		return $result;
	}

	public function postGuestComment($id, $name, $email, $content) {
		$postValidationError = $this->validatePostId($id);
		if($postValidationError != null) {
			return $postValidationError;
		}

		$contentValidationError = $this->validateContent($content);
		if($contentValidationError != null) {
			return $contentValidationError;
		}

		$usernameValidationError = $this->validateUserName($name);
		if($usernameValidationError != null) {
			return $usernameValidationError;
		}

		$emailValidationError = $this->validateEmail($email);
		if($emailValidationError != NULL) {
			return $emailValidationError;
		}

		$date = date('Y-m-d H:i:s');
		$name .= "(guest)";

		$statement = self::$db->prepare(
			"INSERT INTO guest_comments (content, date_created, username, email, post_id)
			VALUES (?, ?, ?, ?, ?)");
		$statement->bind_param("ssssi", $content, $date, $name, $email, $id);
		$statement->execute();

		return null;
	}

	public function postUserComment($id, $content) {
		$postValidationError = $this->validatePostId($id);
		if($postValidationError != null) {
			return $postValidationError;
		}

		$contentValidationError = $this->validateContent($content);
		if($contentValidationError != null) {
			return $contentValidationError;
		}

		$date = date('Y-m-d H:i:s');
		$statement = self::$db->prepare(
			"INSERT INTO user_comments (content, date_created, author_id, post_id)
			VALUES (?, ?, ?, ?)");
		$statement->bind_param("ssii", $content, $date, $_SESSION["userId"], $id);
		$statement->execute();

		return null;
	}

	private function validatePostId($id) {
		$statement = self::$db->prepare("SELECT COUNT(id) FROM posts WHERE id = ?");
		$statement->bind_param("i", $id);
		$statement->execute();
		$result = $statement->get_result()->fetch_assoc();
		if($result["COUNT(id)"] == 0) {
			return "Post does not exist.";
		}

		return null;
	}

	private function validateContent($content) {
		if((strlen($content) < COMMENT_MIN_LENGTH) || (strlen($content) > COMMENT_MAX_LENGTH)) {
			return "Comment must be between " . COMMENT_MIN_LENGTH .
				" and " . COMMENT_MAX_LENGTH . " characters long.";
		}

		return null;
	}

	private function validateUserName($username) {
		if((strlen($username) < USERNAME_MIN_LENGTH) || (strlen($username) > USERNAME_MAX_LENGTH)) {
			return "Username must be between " . USERNAME_MIN_LENGTH .
				" and " . USERNAME_MAX_LENGTH . " characters long.";
		}

		if(preg_match('/[^\w]/', $username)) {
			return "Username can only contain letters, numbers and \"_\".";
		}

		return null;
	}

	private function validateEmail($email) {
		if(!filter_var($email, FILTER_VALIDATE_EMAIL) && $email != null) {
			return "The chosen email is invalid.";
		}

		return null;
	}
}