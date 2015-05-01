<?php

class HomeController extends BaseController {
	private $postsModel;

	protected function onInit() {
		$this->title = "Home controller";
		$this->postsModel = new PostsModel();
	}

	public function index() {
		$this->post = $this->postsModel->getMostRecentPost();
		$this->renderView();
	}
} 