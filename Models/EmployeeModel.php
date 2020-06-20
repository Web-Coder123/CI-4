<?php namespace App\Models;

use CodeIgniter\Model;

class EmployeeModel extends Model
{
	protected $table      = 'employee_data';
	protected $db = '';
	protected $builder = '';
	protected $primaryKey = 'id';

	protected $returnType = 'array';
	protected $useSoftDeletes = false;

	// this happens first, model removes all other fields from input data
	protected $allowedFields = [
		'id', 's_id', 'f_name', 'l_name', 'email', 'tel', 'dep'
	];

	public function __construct() {
	    parent::__construct();

	}


	public function getEmployeeData($filters='', $limit='')
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


	    if(isset($filters['search_name']) && !empty($filters['search_name']))
	    {
	        $builder->like('f_name', $filters['search_name']);
	    }
	    return $builder->get()->getResultArray();
	}


}
