<?php

namespace App\Models;
use CodeIgniter\Model;

class EmployeeInfoModel extends Model {

    var $table = 'employee_info';
    protected $primaryKey = 'id';

    protected $returnType = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['title', 'employee_id', 'company_structure_id', 'content', 'created_at', 'updated_at'];

    protected $useTimestamps = false;

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    public function __construct() {
        parent::__construct();

    }


    public function getEmployeeInfo($filters='', $limit='')
    {
        $builder = $this->builder();

        if($limit)
        {
            $builder->limit($limit);
        }

        if(isset($filters['id']) && !empty($filters['id']))
        {
            $builder->where('id', $filters['id']);
        }

        if(isset($filters['company_structure_id']) && !empty($filters['company_structure_id']))
        {
            $builder->where('company_structure_id', $filters['company_structure_id']);
        }


        if(isset($filters['searchTerm']) && !empty($filters['searchTerm']))
        {
            $builder->like('title', $filters['searchTerm'],'both');
        }
        return $builder->get()->getResultArray();
    }


    public function saveInfo($post='')
    {
        if($post && !empty($post))
        {
            $data = array(
                'title' => $post['title'],
                'company_structure_id' => (isset($post['company_structure_id']))? $post['company_structure_id'] : '',
                'employee_id' => $post['employee_id'],
                'content'   => $post['content'],
                'created_at' => time(),
                'updated_at' => time(),
            );

            if(isset($post['id']) && !empty($post['id']))
            {
                $this->update($post['id'],$data);
                return $post['id'];
            }
            else
            {
                $this->insert($data);
                return $this->getInsertID();
            }
        }
    }




}