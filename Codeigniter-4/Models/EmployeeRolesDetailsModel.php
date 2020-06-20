<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Libraries\EditorLib;


// Alias Editor classes so they are easy to use
use
DataTables\Editor,
DataTables\Editor\Field,
DataTables\Editor\Format,
DataTables\Editor\Mjoin,
DataTables\Editor\Options,
DataTables\Editor\Upload,
DataTables\Editor\Validate,
DataTables\Editor\ValidateOptions;


class EmployeeRolesDetailsModel extends Model {

    var $table = 'employee_roles_details';
    private $editorDb = null;
    private $order_by = null;

    public function __construct() {
        parent::__construct();

        //Load DataTable Editor librarie.
        $this->editorLib = new EditorLib();
        $this->editorDb = $this->editorLib->database();

    }


    /**
     * get datatable data
     * @param array $post
     */
    public function getDatatablesRows($post)
    {
        $this->order_by = $this->datatablesOrder($post);
        // Build our Editor instance and process the data coming from _POST
        Editor::inst( $this->editorDb, $this->table, 'id' )
        ->fields(
                Field::inst( 'f_name' )->validator( 'Validate::notEmpty' ),
                Field::inst( 'l_name' )->validator( 'Validate::notEmpty' ),
                Field::inst( 'email' )->validator( 'Validate::notEmpty' )->validator( 'Validate::email' ),
                Field::inst( 'role' )->validator( 'Validate::notEmpty' )
            )
            ->where( function ( $q ) {
                $q
                ->order( $this->order_by );
            })
            ->process( $post )
            ->json();
    }


    /**
     * dataTable order by
     * @param array $post
     * @return string
     */
    public function datatablesOrder($post)
    {
        $orderableKey = ['f_name','l_name','email','role'];
        $order_by = 'id desc';
        if(isset($post['order']))
        {
            $column = $orderableKey[$post['order'][0]['column']];
            $dir = $post['order'][0]['dir'];
            $order_by = $column.' '.$dir;
        }
        return $order_by;
    }
}