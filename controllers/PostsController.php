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
		$this->renderView();
	}
}