<?php
namespace App\Controllers;

use Config\Services;
use App\Models\EmployeeInfoModel;
use App\Models\EmployeeModel;
use App\Models\TomsModel;
use App\Models\CompanyStructureModel;


class EmployeeInfoController extends BaseController
{
	protected $session;
	protected $config;

	public function __construct()
	{
		// start session
		$this->session = Services::session();

		// load auth settings
		$this->config = config('Auth');

		//Load model
		$this->EmployeeInfoModel = new EmployeeInfoModel();
		$this->EmployeeModel = new EmployeeModel();
		$this->TomsModel = new TomsModel();
		$this->CompanyStructureModel = new CompanyStructureModel();
	}


	public function index()
	{
		if (! $this->session->isLoggedIn) {
			return redirect()->to('login');
		}

		$validRequest = '';
		$company_structure_id = '';
		if($this->request->getGetPost('company_structure_id') && !empty($this->request->getGetPost('company_structure_id')))
		{
		    $companyStructureData = $this->CompanyStructureModel->find($this->request->getGetPost('company_structure_id'));
		    if($companyStructureData)
		    {
		        $company_structure_id = $this->request->getGetPost('company_structure_id');
		        $validRequest = 1;
		    }
		}
		elseif ($this->request->getGetPost('id') && !empty($this->request->getGetPost('id')))
		{
		    $empInfoData = $this->EmployeeInfoModel->find($this->request->getGetPost('id'));
		    if($empInfoData)
		    {
		        $company_structure_id = $empInfoData['company_structure_id'];
		        $validRequest = 1;
		    }
		}

		if(empty($validRequest))
		{
		    throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		}

		return view('employee_Info/index', [
			'userData' => $this->session->userData,
			'config' => $this->config,
		    'validRequest' =>$validRequest,
		    'company_structure_id' =>$company_structure_id
		]);
	}

	/**
	 * save data
	 */
	public function saveEmplyeeInfo()
	{
	    $response['status'] = 0;
	    $insertedId = $this->EmployeeInfoModel->saveInfo($this->request->getPost());
	    if($insertedId)
	    {
	        $response['status'] = 1;
	        $response['id'] = $insertedId;
	        echo json_encode($response); exit;
	    }
	}

	/**
	 * get employee details by id
	 */
	public function getEmployeeDataById()
	{
	    $id = $this->request->getGetPost('id');
	    $response['status']= 0;
	    if($id && !empty($id))
	    {
	        $fetchData = $this->EmployeeModel->getEmployeeData(['id'=>$id]);
	        if($fetchData && !empty($fetchData))
	        {
	            $response['status']= 1;
	            $response['data']= $fetchData[0];
	        }
	    }
	    echo json_encode($response);exit;
	}

	public function getEmployeeData()
	{
	    $response['status'] = 0;
	    if(isset($_POST['id']))
	    {
	        $filters['id'] = $_POST['id'];
	        $fetchData = $this->EmployeeModel->getEmployeeData($filters);
	        if($fetchData)
	        {
	            $response['status'] = 1;
	            $data = array("id"=>$fetchData[0]['id'], "text"=>$fetchData[0]['f_name'].' '.$fetchData[0]['l_name']);
	            $response['data']= $data;
	        }
	        echo json_encode($response); exit;
	    }

	    if(!isset($_POST['searchTerm']))
	    {
	        $fetchData = $this->EmployeeModel->getEmployeeData(false,5);
	    }
	    else
	    {
	        $filters['search_name'] = $_POST['searchTerm'];
	        $fetchData = $this->EmployeeModel->getEmployeeData($filters,5);
	    }

	    $data = array();
	    foreach ($fetchData as $row) {
	        $data[] = array("id"=>$row['id'], "text"=>$row['f_name'].' '.$row['l_name']);
	    }
	    echo json_encode($data);
	}

	public function getTomsData()
	{
	    if(!isset($_POST['searchTerm']))
	    {
	        $fetchData = $this->TomsModel->getTomsData(false,5);
	    }
	    else
	    {
	        $filters['search_description'] = $_POST['searchTerm'];
	        $fetchData = $this->TomsModel->getTomsData($filters,5);
	    }

	    $data = array();
	    foreach ($fetchData as $row) {
	        $data[] = array("id"=>$row['id'], "text"=>$row['description']);
	    }
	    echo json_encode($data);
	}

	public function getEmployeeInfo()
	{
	    $response['status'] = 0;
	    if($this->request->getVar('id'))
	    {
	        $fetchData = $this->EmployeeInfoModel->getEmployeeInfo(['id'=>$this->request->getVar('id')]);
	        if($fetchData)
	        {
	            $response['status'] = 1;
	            $response['data'] = $fetchData[0];
	        }
	        echo json_encode($response);exit;
	    }

	    if(!isset($_POST['searchTerm']))
	    {
	        $fetchData = $this->EmployeeInfoModel->getEmployeeInfo(false,5);
	    }
	    else
	    {
	        $filters['searchTerm'] = $_POST['searchTerm'];
	        $fetchData = $this->EmployeeInfoModel->getEmployeeInfo($filters,5);
	    }

	    $data = array();
	    foreach ($fetchData as $row) {
	        $data[] = array("id"=>$row['id'], "text"=>$row['title']);
	    }
	    echo json_encode($data);
	}


}