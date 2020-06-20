<?php
namespace App\Controllers;

use Config\Services;
use App\Models\CompanyStructureModel;

class CompanyStructureController extends BaseController
{
	protected $session;
	protected $config;

	public function __construct()
	{
		// start session
		$this->session = Services::session();

		// load auth settings
		$this->config = config('Auth');

		//Load the JohnModel
		$this->CompanyStructureModel = new CompanyStructureModel();
	}


	public function index()
	{
		if (! $this->session->isLoggedIn) {
			return redirect()->to('login');
		}
		$getStructureData = '';
		$getTopLevelsIds = '';
		$getTopLevels = $this->CompanyStructureModel->where(['parent_id'=>0])->get()->getResultArray();
		if($getTopLevels)
		{
		    //$getTopLevelsIds = array_column($getTopLevels,'id');
		    $getTopLevelsIds = $getTopLevels;
		}

		//$getStructureData = $this->CompanyStructureModel->getLevelData(27);
		return view('company_structure/company_structure', [
			'userData' => $this->session->userData,
			'config' => $this->config,
		    'getTopLevelsIds' => ($getTopLevelsIds) ? json_encode($getTopLevelsIds) : false,
		    'getStructureData' => $getStructureData,
		]);
	}


	/**
     * Get All structure Data
     */
	public function getStructureData()
    {
          $data = [];
          $parent_key = '0';
          $row = $this->CompanyStructureModel->findAll();

          if($row > 0)
          {
              $data = $this->getStructureByParent($parent_key);
          }
          else
          {
              $data=["id"=>"0","name"=>"No levels presnt in list","text"=>"No Levels is presnt in list","nodes"=>[]];
          }
          echo json_encode(array_values($data));
    }

    /**
     * Get All structure Data by parent
     */
    public function getStructureByParent($parent_key, $expandIds='',$selectedEntryId='', $selectedEntryPId='', $selectedEntryLevelPId='',$rootId='', $expand_level_ids='', $collaps_level_ids='', $slectedNodeId='')
    {
        $row1 = [];
        $row = $this->CompanyStructureModel->getByParentId($parent_key);

        foreach($row as $key => $value)
        {
            $id = $value['id'];
            $row1[$key]['id'] = $value['id'];
            $row1[$key]['p_id'] = $value['parent_id'];
            $row1[$key]['level'] = $value['level'];
            $row1[$key]['name'] = $value['name'];
            $row1[$key]['text'] = $value['name'];


            /* if(!empty($expandIds) && in_array($value['id'], $expandIds))
            {
                //$row1[$key]['state']['expanded'] =  true;
            }
            elseif(!empty($selectedEntryPId) &&  $value['id'] == $selectedEntryPId)
            {
                //$row1[$key]['state']['expanded'] =  true;
            }*/

            if(!empty($rootId) && $value['id'] == $rootId)
            {
                $row1[$key]['state']['expanded'] =  true;
            }

            if(!empty($expand_level_ids) && in_array($value['id'], $expand_level_ids))
            {
                $row1[$key]['state']['expanded'] =  true;
            }

            if(!empty($collaps_level_ids) && in_array($value['id'], $collaps_level_ids))
            {
                $row1[$key]['state']['expanded'] =  false;
            }

            $row1[$key]['nodes'] = array_values($this->getStructureByParent($value['id'], $expandIds, $selectedEntryId, $selectedEntryPId, $selectedEntryLevelPId, $rootId, $expand_level_ids, $collaps_level_ids, $slectedNodeId));
        }
        return $row1;
    }


    /**
     * Add Hierarchy Leavel & Save levels
     */
    public function addHierarchyLeavel()
    {
        $response['status'] = 0;
        //add new entry level
        if($this->request->getPost('entry_level') || $this->request->getPost('init_level') || $this->request->getPost('addTopLevel'))
        {
            $res = $this->CompanyStructureModel->createNewLevel($this->request->getPost());
            $getTopLevelsIds = '';
            $getTopLevels = $this->CompanyStructureModel->where(['parent_id'=>0])->get()->getResultArray();
            if($getTopLevels)
            {
                $getTopLevelsIds = $getTopLevels;
            }
            $response['getTopLevelsIds'] = ($getTopLevelsIds) ? json_encode($getTopLevelsIds) : false;
            if($res)
            {
                $getLastLevel = $this->CompanyStructureModel->where(['id'=>$res])->get()->getResultArray();
                $response['getLastLevel'] = $getLastLevel[0];
                $response['status'] = 1;
            }
        }
        echo json_encode($response); exit;
    }

    /**
     * save Entries
     */
    public function saveEntries()
    {
        $response['status'] = 0;
        if($this->request->getPost('name'))
        {
            $input = $this->request->getPost();
            $saveData = [];
            foreach ($this->request->getPost()['name'] as $parent_id=>$name)
            {
                if(!empty($name))
                {
                    $saveData[] = [
                        'parent_id' => empty($parent_id) ? 0 : $parent_id,
                        'name' => !empty($name) ? $name : 'Sub level',
                    ];
                }
            }

            if($saveData)
            {
                //save data
                if ($this->CompanyStructureModel->insertBatch($saveData)) {
                    $response['status'] = 1;
                }
            }
        }
        echo json_encode($response); exit;
    }


    /**
     * Delete level & sub level
     * @param string $id
     */
    public function deleteLevel($id='')
    {
        $response['status'] = 0;
        if($id)
        {
            //check parent data exist
            $parentData = $this->getStructureByParent($id);
            if($parentData)
            {
                $response['status'] = 0;
                $response['message'] = lang('Auth.LevelBelow');
            }
            else
            {
                //delete id
                $this->CompanyStructureModel->where('id', $id)->delete();

                //delete parent id
                $this->CompanyStructureModel->where('parent_id', $id)->delete();
                $response['status'] = 1;
            }
        }
        echo json_encode($response);exit;
    }


    /**
     * Edit level name by post data
     */
    public function editLevelName()
    {
        if($this->request->getPost('value') && !empty($this->request->getPost('value')))
        {
            $id = $this->request->getPost('pk');
            $updateData = [
                'name' => $this->request->getPost('value')
            ];
            $updated = $this->CompanyStructureModel->update(['id'=>$id],$updateData);
            if($updated)
            {
                $data = $this->getStructureByParent(0);
                echo json_encode(array_values($data));
            }
        }
    }


    public function getTopLevelData()
    {
        $slectedNodeId = $this->request->getPost('slectedNodeId');
        $id = $this->request->getPost('nodeId');
        $rootId = $this->request->getPost('rootId');
        $getStructureData = '';
        if($id)
        {
            $getStructureData = $this->CompanyStructureModel->getLevelData(false,false,$id);
            $response['nodes_data'] = $this->getStructureByParent(0,false,false,false,false,$rootId, false, false, $slectedNodeId);
            $response['html'] = $getStructureData;
            echo json_encode($response);
            exit;
        }
    }


    /**
     * load data by ajax
     */
    public function ajaxLloadLevelData()
    {
        $collapsId = $this->request->getPost('collapsId');
        $slectedNodeId = $this->request->getPost('slectedNodeId');


        $expand_level = $this->request->getPost('expand_level');
        
        $expand_level = (isset($expand_level['items']) && !empty($expand_level['items'])) ? $expand_level['items'] : '';
        $collaps_level = $this->request->getPost('collaps_level');
        $collaps_level = (isset($collaps_level['items']) && !empty($collaps_level['items'])) ? $collaps_level['items'] : '';

        $expand_level_ids = '';
        $collaps_level_ids ='';
        if($expand_level)
        {
            $expand_level_ids = array_column($expand_level, 'id');
        }


        if($collaps_level)
        {
            $collaps_level_ids = array_column($collaps_level, 'id');
        }

        $rootId = $this->request->getPost('rootId');
        $selectedEntryId = $this->request->getPost('selectedEntryId');
        $selectedEntryPId = $this->request->getPost('selectedEntryPId');
        $selectedEntryLevelPId = $this->request->getPost('selectedEntryLevelPId');

        $level_ids = $this->request->getPost('level_ids');
        if(empty($expand_level_ids))
        {
            $response['status'] = 0;
            $response['html'] = '';
            $response['nodes_data'] = $this->getStructureByParent(0);
            echo json_encode($response);
            exit;
        }
        $level_ids = $level_ids['items'];
        $level_ids = array_column($level_ids, 'id');
        $level_pIds = array_column($level_ids, 'pId');
        //array_push($level_ids, $selectedEntryId);


        if($expand_level_ids)
        {
            $getStructureData = $this->CompanyStructureModel->getLevelData(false,$expand_level_ids);
            $response['status'] = 1;
            $response['nodes_data'] = $this->getStructureByParent(0,$level_ids,$selectedEntryId,$selectedEntryPId, $selectedEntryLevelPId,$rootId, $expand_level_ids, $collaps_level_ids,$slectedNodeId);
            $response['html'] = $getStructureData;
            echo json_encode($response);
            exit;
        }
    }
}