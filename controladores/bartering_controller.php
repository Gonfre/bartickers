<?php

require_once("libs/controller.php");

class BarteringController extends Controller {
	
	public function __construct() {
		$this->layout = "main";
		$this->titleShowed = "Truequear";	
		$this->pageTitle = "Truequear";
	}
	
	public function index() {
		
	}
	
	public function results() {
		$this->layout = "buttonRight";
		$this->titleShowed = "Resultados";
		$this->pageTitle = "Resultados";
		$this->buttonRightText = "";
		$this->buttonRightAction = "";
		$this->buttonRightIcon = "search";
		
		$this->distance = $_REQUEST['distance'];
		$this->tipo = $_REQUEST['tipoBusqueda'];
	}
	
	public function popup() {
		$this->layout = "noMenu";
		$this->titleShowed = "Resultados";
		
		$this->idTrueque = $_REQUEST['idTrueque'];
	}
}

?>
