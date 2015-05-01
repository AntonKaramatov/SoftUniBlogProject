<?php

class UsersModel extends BaseModel {
	public function login($username, $password) {
		$statement = self::$db->prepare("SELECT id, username, password_hash, isAdmin FROM users WHERE username = ?");
		$statement->bind_param("s", $username);
		$statement->execute();
		$result = $statement->get_result()->fetch_assoc();
		if(!password_verify($password, $result["password_hash"]))
		{
			return "Login failed.";
		}

		$_SESSION["userId"] = $result["id"];
		$_SESSION["username"] = $username;
		$_SESSION["isAdmin"] = $result["isAdmin"];
		return null;
	}

	public function register($username, $password, $repeatPassword, $email) {
		$usernameValidationError = $this->validateUserName($username);
		if($usernameValidationError != null) {
			return $usernameValidationError;
		}

		$passwordValidationError = $this->validatePassword($password, $repeatPassword);
		if($passwordValidationError != null) {
			return $passwordValidationError;
		}

		$emailValidationError = $this->validateEmail($email);
		if($emailValidationError != NULL) {
			return $emailValidationError;
		}

		$passwordHash = password_hash($password, PASSWORD_BCRYPT);
		$statement = self::$db->prepare("INSERT INTO users (username, password_hash, email) 
			VALUES (?, ?, ?)");
		$statement->bind_param("sss", $username, $passwordHash, $email);
		$statement->execute();
		
		if($statement->affected_rows > 0) {
			return null;
		}

		return "Registration failed.";
	}

	private function validateUserName($username) {
		if((strlen($username) < USERNAME_MIN_LENGTH) || (strlen($username) > USERNAME_MAX_LENGTH)) {
			return "Username must be between " . USERNAME_MIN_LENGTH .
				" and " . USERNAME_MAX_LENGTH . " characters long.";
		}

		if(preg_match('/[^\w]/', $username)) {
			return "Username can only contain letters, numbers and \"_\".";
		}

		$statement = self::$db->prepare("SELECT COUNT(id) FROM users WHERE username = ?");
		$statement->bind_param("s", $username);
		$statement->execute();
		$result = $statement->get_result()->fetch_assoc();
		if($result["COUNT(id)"] != 0) {
			return "Username already taken.";
		}

		return null;
	}

	private function validatePassword($password, $repeatPassword) {
		if((strlen($password) < PASSWORD_MIN_LENGTH) || (strlen($password) > PASSWORD_MAX_LENGTH)) {
			return "Password must be between " . PASSWORD_MIN_LENGTH .
			" and " . PASSWORD_MAX_LENGTH . " characters long.";
		}

		if (preg_match('/[^\w]/', $password)) {			
			return "Password can only contain letters, numbers and \"_\".";
		}

		if($password != $repeatPassword) {
			return "Passwords don't match.";
		}

		return null;
	}

	private function validateEmail($email) {
		if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			return "The chosen email is invalid.";
		}

		$statement = self::$db->prepare("SELECT COUNT(id) FROM users WHERE email = ?");
		$statement->bind_param("s", $email);
		$statement->execute();
		$result = $statement->get_result()->fetch_assoc();
		if($result["COUNT(id)"] != 0) {
			return "Email already taken.";
		}

		return null;
	}
}