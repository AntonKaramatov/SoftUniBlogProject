<?php

class TagsController extends BaseController {
	private $tagsModel;

	protected function onInit() {
		$this->title = "Tags controller";
		$this->tagsModel = new TagsModel();
	}

	public function index() {
		$this->authorizeAdmin();
		$this->tags = $this->tagsModel->getTags();
		$this->renderView();
	}

	public function get($id) {
		$this->postId = $id;
		$this->tags = $this->tagsModel->getTagsByPostId($id);
		$this->renderView("tags", true);
	}

	public function getEdit($id) {
		$this->postId = $id;
		$this->tags = $this->tagsModel->getTagsByPostId($id);
		$this->renderView("tagsEdit", true);
	}

	public function getAdd($id) {
		$this->postId = $id;
		$this->tags = $this->tagsModel->getAllTagsNotOnPost($id);
		$this->renderView("tagsAdd", true);
	}

	public function create() {
		$this->authorizeAdmin();
		if($this->isPost()) {
			$this->tag = trim($_POST["tag"]);			
			$result = $this->tagsModel->create($this->tag);
			if($result != null) {
				$this->addErrorMessage($result);
			}
			else {
				$this->addInfoMessage("Tag created successfully.");
				$this->redirectToUrl("/tags");
			}
		}
		$this->renderView();
	}

	public function delete($id) {
		$this->authorizeAdmin();
		$result = $this->tagsModel->delete($id);
		if($result) {
			$this->addInfoMessage("Tag deleted successfully.");
		}
		else {
			$this->addErrorMessage("Failed to delete tag.");
		}
		$this->redirectToUrl("/tags");
	}

	public function edit($id) {
		$this->authorizeAdmin();
		if(!$this->isPost()) {
			$this->tag = $this->tagsModel->getTagById($id);
			if($this->tag == null) {
				$this->addErrorMessage("Tag not found.");
				$this->redirectToUrl("/tag");
			}
		}
		else {
			$this->tag = array();
			$this->tag["id"] = $id;
			$this->tag["tag"] = trim($_POST["tag"]);
			$result = $this->tagsModel->edit($id, $this->tag["tag"]);
			if($result != null) {
				$this->addErrorMessage($result);
			}
			else {
				$this->addInfoMessage("Tag edited successfully.");
				$this->redirectToUrl("/tags");
			}
		}

		$this->renderView();
	}

	public function popular() {
		$this->tags = $this->tagsModel->getPopularTags();
		$this->renderView("tagsList", true);
	}
}