<?php

namespace Resources\User;

class UserController extends \Core\Controller
{
	public function index()
	{
		$model = new UserModel();
		$users = $model->findAll();

		if($users)
		{
			foreach ($users as &$user)
			{
				// unset password
			    unset($user["password"]);
			}

			$this->response->renderOk($this->response::HTTP_OK, $users);
		}
		else
		{
			$this->response->renderFail($this->response::HTTP_NOT_FOUND, "Could not find users.");
		}
	}

	public function show($_id)
	{
		$model = new UserModel();
		$user = $model->findById($_id);

		if($user)
		{
			// unset password
			unset($user["password"]);

			$this->response->renderOk($this->response::HTTP_OK, $user);
		}
		else
		{
			$this->response->renderFail($this->response::HTTP_NOT_FOUND, "Could not find user for specified ID.");
		}
	}
}