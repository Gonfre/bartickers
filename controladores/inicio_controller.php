<?php

require_once("libs/controller.php");

class InicioController extends Controller {
	
	public function __construct() {
		$this->layout = "noMenu";
		$this->titleShowed = "Inicio";	
		$this->pageTitle = "Inicio";
	}
	
	public function index() {
		
	}
}

?>
