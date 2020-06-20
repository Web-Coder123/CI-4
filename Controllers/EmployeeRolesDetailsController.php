<?php
namespace App\Controllers;

use Config\Services;
use App\Models\EmployeeRolesDetailsModel;

class EmployeeRolesDetailsController extends BaseController
{
	protected $session;
	protected $config;

	public function __construct()
	{
		// start session
		$this->session = Services::session();

		// load auth settings
		$this->config = config('Auth');

		//Load the EmployeeRolesDetailsModel
		$this->EmployeeRolesDetailsModel = new EmployeeRolesDetailsModel();
	}


	public function index()
	{
		if (! $this->session->isLoggedIn) {
			return redirect()->to('login');
		}

		return view('employee_Roles_details/datatable', [
			'userData' => $this->session->userData,
			'config' => $this->config,
		]);
	}

	/**
	 * Data load, add, edit, delete
	 */
	public function ajax_add_edit(){
	    $this->EmployeeRolesDetailsModel->getDatatablesRows($this->request->getPost());
	}

}