<?php

namespace App\Models;

use CodeIgniter\Model;


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

class EditorModel extends Model {

    var $table = 'toms';
    public $editorDb = null;
    public $order_by = null;

    public function __construct() {
        parent::__construct();

    }

    public function init($editorDb,$order_by)
    {
        $this->editorDb = $editorDb;
        $this->order_by = $order_by;
    }

    public function getData($post)
    {
        // Build our Editor instance and process the data coming from _POST
        Editor::inst( $this->editorDb, 'toms', 'id' )
        ->fields(
            Field::inst( 'description' )->validator( 'Validate::notEmpty' ),
            Field::inst( 'scope' )
            )
            ->where( function ( $q ) {
                $q
                ->order( $this->order_by );
            } )
            ->process( $post )
            ->json();
    }

    public function getOrderBY($post)
    {
        $orderableKey = ['description','scope'];
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