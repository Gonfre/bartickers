<?php

require_once("libs/controller.php");
require_once("modelos/users.php");

class AlbumsController extends Controller {
	
	public function __construct() {
		$this->layout = "main";
		$this->titleShowed = "Mi Mundialito";	
		$this->pageTitle = "Mi Mundialito";
	}
	
	public function albums() {
		
	}

}

?>
