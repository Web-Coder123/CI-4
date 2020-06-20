<?php

namespace App\Models;

use CodeIgniter\Model;

class EditorQuillModel extends Model {

    var $table = 'editor_quill';
    protected $primaryKey = 'id';

    protected $returnType = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['content', 'created_at','updated_at'];

    protected $useTimestamps = false;

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    public function __construct() {
        parent::__construct();

    }


    public function saveContent($post='')
    {
        if($post && !empty($post))
        {
            $data = array(
                'content' =>$post['article']['content'],
                'created_at' => time(),
                'updated_at' => time(),
            );
            return $this->save($data);
        }
    }
}