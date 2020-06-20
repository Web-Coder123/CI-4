<?php
namespace App\Controllers;

use Config\Services;
use App\Models\EditorQuillModel;

class EditorQuillController extends BaseController
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
		$this->EditorQuillModel = new EditorQuillModel();
	}


	public function index()
	{
		if (! $this->session->isLoggedIn) {
			return redirect()->to('login');
		}

		return view('editor_quill/index', [
			'userData' => $this->session->userData,
			'config' => $this->config,
		]);
	}

	public function saveEditorContent()
	{
	    $res = $this->EditorQuillModel->saveContent($this->request->getGetPost());
	    if($res)
	    {
	        return redirect()->route('editor_quill');
	    }
	}
}