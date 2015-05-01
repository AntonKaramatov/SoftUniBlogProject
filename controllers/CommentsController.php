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
}