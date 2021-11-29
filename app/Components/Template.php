<? namespace App\Components;

use Model as Model;


/*
	Housing connects with providers via API. This script will manage importing, searching and viewing housing properties. 
	It'll also be re-usable as an API Source for other providers and the website.
*/
class Template extends Model 
{
	public function __construct() {
		 parent::__construct();

	}


	public function updateUser() { 
		echo "UpdateUser";
	}
	
	
	public function deleteUser() {
		echo "delete User";
	}
	
	public function getUsers() { 
		echo "Retrieve Users"; 
	}

	


}