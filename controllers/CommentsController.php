<?php

class CommentsController extends BaseController{
	private $commentsModel;

	protected function onInit() {
		$this->title = "Comments controller";
		$this->commentsModel = new CommentsModel();
	}

	public function get($id) {
		$this->comments = $this->commentsModel->getCommentsByPostId($id);
		$this->renderView("comments", true);
	}

	public function index() {
		$this->comments = $this->commentsModel->getAllComments();
		$this->renderView("comments");
	}

	public function post($id){
		if($this->isPost()) { 
			$commentText = $_POST["comment_text"];
			if($this->isLoggedIn()) {	
				$result = $this->commentsModel->postUserComment($id, $commentText);
			}
			else {
				$name = $_POST["guest_name"];
				$email = $_POST["guest_email"];	
				$result = $this->commentsModel->postGuestComment($id, $name, $email, $commentText);
			}
			if($result != null) {
				$this->addErrorMessage($result);
			}
			else {
				$this->addInfoMessage("Comment posted successfully.");
			}

			$this->redirect("posts", "view", [$id]);
		}

		$this->renderView("post", true);
	}

	public function editUserComment($id) {
		$this->authorizeAdmin();
		if(!$this->isPost()) {
			$this->comment = $this->commentsModel->getUserCommentById($id);
			if($this->comment == null) {
				$this->addErrorMessage("Comment not found.");
				$this->redirectToUrl("/comments");
			}
		}
		else {
			$this->comment = array();
			$this->comment["id"] = $id;		
			$this->comment["content"] = trim($_POST["content"]);
			$result = $this->commentsModel->editUserComment($id, $this->comment["content"]);
			if($result != null) {
				$this->addErrorMessage($result);
			}
			else {
				$this->addInfoMessage("Comment edited successfully.");
				$this->redirectToUrl("/comments");
			}
		}

		$this->renderView();
	}
	
	public function deleteUserComment($id) {
		$this->authorizeAdmin();
		$result = $this->commentsModel->deleteUserComment($id);
		if($result) {
			$this->addInfoMessage("Comment deleted successfully.");
		}
		else {
			$this->addErrorMessage("Comment not found.");
		}
		$this->redirectToUrl("/comments");
	}

	public function editGuestComment($id) {
		$this->authorizeAdmin();
		if(!$this->isPost()) {
			$this->comment = $this->commentsModel->getGuestCommentById($id);
			if($this->comment == null) {
				$this->addErrorMessage("Comment not found.");
				$this->redirectToUrl("/comments");
			}
		}
		else {
			$this->comment = array();
			$this->comment["id"] = $id;
			$this->comment["username"] = trim($_POST["username"]);			
			$this->comment["email"] = trim($_POST["email"]);
			$this->comment["content"] = trim($_POST["content"]);
			$result = $this->commentsModel->editGuestComment($id, $this->comment["username"], $this->comment["email"], $this->comment["content"]);
			if($result != null) {
				$this->addErrorMessage($result);
			}
			else {
				$this->addInfoMessage("Comment edited successfully.");
				$this->redirectToUrl("/comments");
			}
		}

		$this->renderView();
	}

	public function deleteGuestComment($id) {
		$this->authorizeAdmin();
		$result = $this->commentsModel->deleteGuestComment($id);
		if($result) {
			$this->addInfoMessage("Comment deleted successfully.");
		}
		else {
			$this->addErrorMessage("Comment not found.");
		}
		$this->redirectToUrl("/comments");
	}
}