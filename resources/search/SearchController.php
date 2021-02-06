<?php

namespace Resources\Search;

class SearchController extends \Core\Controller
{
	public function index()
	{
		$model = new SearchModel();
		$search = $model->findAll();

		if($search)
		{
			$this->response->renderOk($this->response::HTTP_OK, $search);
		}
		else
		{
			$this->response->renderFail($this->response::HTTP_NOT_FOUND, "Could not find search.");
		}
	}

}