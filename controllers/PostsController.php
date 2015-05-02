<?php

class PostsController extends BaseController {
	private $postsModel;

	protected function onInit() {
		$this->title = "Posts controller";
		$this->postsModel = new PostsModel();
	}

	public function index() {
		$this->posts = $this->postsModel->getPostsWithPreview();
		$this->renderView();
	}

	public function view($id) {
		$this->post = $this->postsModel->getPostById($id);
		if($this->post == null) {
			$this->addErrorMessage("Post not found.");
			$this->redirectToUrl("/posts");
		}
		$this->postsModel->increaseViews($id);
		$this->renderView();
	}

	public function getByTag($id) {
		$this->posts = $this->postsModel->getPostsWithPreviewByTagId($id);
		$this->renderView("index");
	}

	public function recent() {
		$this->posts = $this->postsModel->getRecentPostTitles();
		$this->renderView("postTitleList", true);
	}

	public function popular() {
		$this->posts = $this->postsModel->getPopularPostTitles();
		$this->renderView("postTitleList", true);
	}

	public function create() {
		$this->authorizeAdmin();
		if($this->isPost()) {
			$this->postTitle = trim($_POST["title"]);			
			$this->postContent = trim($_POST["content"]);
			$result = $this->postsModel->post($this->postTitle, $this->postContent);
			if($result != null) {
				$this->addErrorMessage($result);
			}
			else {
				$this->addInfoMessage("Post created successfully.");
				$this->redirectToUrl("/posts");
			}
		}
		$this->renderView();
	}

	public function edit($id) {
		$this->authorizeAdmin();
		if(!$this->isPost()) {
			$this->post = $this->postsModel->getPostById($id);
			if($this->post == null) {
				$this->addErrorMessage("Post not found.");
				$this->redirectToUrl("/posts");
			}
		}
		else {
			$this->post = array();
			$this->post["id"] = $id;
			$this->post["title"] = trim($_POST["title"]);			
			$this->post["content"] = trim($_POST["content"]);
			$result = $this->postsModel->edit($id, $this->post["title"], $this->post["content"]);
			if($result != null) {
				$this->addErrorMessage($result);
			}
			else {
				$this->addInfoMessage("Post edited successfully.");
				$this->redirectToUrl("/posts");
			}
		}

		$this->renderView();
	}

	public function delete($id) {
		$this->authorizeAdmin();
		$result = $this->postsModel->delete($id);
		if($result) {
			$this->addInfoMessage("Post deleted successfully.");
		}
		else {
			$this->addErrorMessage("Post not found.");
		}
		$this->redirectToUrl("/posts");
	}

	public function addTag($postId, $tagId) {
		$this->authorizeAdmin();
		$result = $this->postsModel->addTagToPost($postId, $tagId);
		if($result != null) {
			$this->addErrorMessage($result);
		}
		else {			
			$this->addInfoMessage("Tag added successfully.");
		}

		$this->redirect("posts", "edit", [$postId]);
	}

	public function removeTag($postId, $tagId) {
		$this->authorizeAdmin();
		$result = $this->postsModel->removeTagFromPost($postId, $tagId);
		if($result != null) {
			$this->addErrorMessage($result);
		}
		else {			
			$this->addInfoMessage("Tag removed successfully.");
		}

		$this->redirect("posts", "edit", [$postId]);
	}
}