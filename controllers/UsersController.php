<?php

class UsersController extends BaseController {
	private $usersModel;

	protected function onInit() {
		$this->title = "Users controller";
		$this->usersModel = new UsersModel();
	}

	public function logout() {
		unset($_SESSION["username"]);
		unset($_SESSION["userId"]);
		unset($_SESSION["isAdmin"]);
		$this->redirectToUrl("/");
	}

	public function register() {
		if($this->isPost()) {
			$this->username = $_POST["username"];
			$this->password = $_POST["password"];
			$this->repeatPassword = $_POST["repeatPassword"];
			$this->email = $_POST["email"];
			$result = $this->usersModel->register($this->username, $this->password, $this->repeatPassword, $this->email);
			if($result != null) {
				$this->addErrorMessage($result);
			}
			else {
				$this->addInfoMessage("Registration successful.");
				$this->redirect("users", "login");
			}
		}

		$this->renderView();
	}

	public function login() {
		if($this->isPost()) {
			$username = $_POST["username"];
			$password = $_POST["password"];
			$result = $this->usersModel->login($username, $password);
			if($result != null) {
				$this->addErrorMessage($result);
			}
			else {
				$this->addInfoMessage("Login successful.");
				$this->redirectToUrl("/");
			}
		}

		$this->renderView();
	}
}