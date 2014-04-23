<?php

require_once("libs/controller.php");

class MybartersController extends Controller {
	
	public function __construct() {
		$this->layout = "main";
		$this->titleShowed = "Truequear";	
		$this->pageTitle = "Truequear";
	}
	
	public function index() {
		$this->titleShowed = "Mis Trueques";
		$this->pageTitle = "Mis Trueques";
	}
	
	public function pending() {
		
	}
	
	public function confirmed() {
	
	}
}

?>
