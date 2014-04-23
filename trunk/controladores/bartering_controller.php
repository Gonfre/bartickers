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
		//$this->layout = "buttonRight";
		$this->titleShowed = "Resultados";
		$this->pageTitle = "Resultados";
		$this->right = '<a href="bartering" rel="external" data-theme="b" data-icon="search" data-iconpos="notext" data-shadow="false" data-iconshadow="false">Buscar</a>';
		
		$this->distance = $_REQUEST['distance'];
		$this->tipo = $_REQUEST['tipoBusqueda'];

	}
	
	public function zoom() {
		$this->layout = "noMenu";
		
		$this->idTrueque = $_REQUEST['idTrueque'];
		
		$this->titleShowed = "Casper, Dayana";
		//$this->right = '<span class="ui-li-count" id="counter">E: 3 / R: 3</span>';
		$this->right = '<center><label>Entregar: <span id="entregar">3</span> / Recibir: <span id="recibir">3</span></label></center>';
	}
	
	
	public function mybarters() {
		$this->titleShowed = "Mis Trueques";
	}
}

?>
