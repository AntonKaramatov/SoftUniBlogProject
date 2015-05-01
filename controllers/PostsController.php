<?php

class PostsController extends BaseController {
	private $postsModel;
	private $commentsModel;

	protected function onInit() {
		$this->title = "Posts controller";
		$this->postsModel = new PostsModel();
		$this->commentsModel = new CommentsModel();
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
		$this->renderView();
	}
}