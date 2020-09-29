<?php
namespace App\Controllers;

/**
 * Class SecureController
 *
 * @package CodeIgniter
 */

use CodeIgniter\API\ResponseTrait;
use CodeIgniter\Controller;
use App\Libraries\Permissions;



class SecureController extends Controller
{
    /**
	 * An array of helpers to be loaded automatically upon
	 * class instantiation. These helpers will be available
	 * to all other controllers that extend BaseController.
	 *
	 * @var array
	 */
	protected $helpers = [];

	protected $permissions; 

	use ResponseTrait;

	/**
	 * Constructor.
	 */
	public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
	{
		// Do Not Edit This Line
		parent::initController($request, $response, $logger);

		//--------------------------------------------------------------------
		// Preload any models, libraries, etc, here.
		//--------------------------------------------------------------------
		// E.g.
        // $this->session = \Config\Services::session();
        
        if(!session()->get('isLoggedIn')){
			header("Location: ".base_url("/Login"));
            die();
		}
		
		$this->permissions = new Permissions();

		$segments = $this->request->uri->getSegments();

		if(count($segments)>=2){
			$controller = $segments[0];
			$action = $segments[1]; 

			if(!$this->permissions->hasPermission(session()->get('user_name'),$controller,$action)){				

				if(strpos($this->request->getHeaderLine('Accept'),"json")>0) {
					//Es una peticion de json
					$json['error'] = 1;
					$json['message'] = "No authorization";
					return $this->respond($json, 500);
					die();
				} else {
					header("Location: ".base_url("/TemplateBlank"));
					die();
				}
			}

		}

	}
}
