<script type="text/javascript" src="http://gd.geobytes.com/gd?after=-1&variables=GeobytesCode,GeobytesInternet,GeobytesCity,GeobytesCountry,GeobytesRegion"></script>
<script type="text/javascript">
<!--
var initLocation = function ( response ) {
	val = response.geonames[0];
	var texto = val.name + (val.adminName1 ? (val.adminName1 != val.name ? ", "+val.adminName1 : "") : "") + ", " + val.countryName;
    //eval(callback + "('"+texto+"')");
    //alert(texto);
    //alert( $("#txtLocation").parent().children(":first").children(":first").children(":first").val() );
    $("#txtLocation").parent().children(":first").children(":first").children(":first").val(omitirAcentos(texto));
}

$( document ).on( "pagecreate", "#page", function() {
	loadGeoData("txtLocation");
	loadGeoData("txtNewPlace");

    if ("<?php echo (isset($this->location) ? $this->location : ""); ?>" == "") {
		//$("#txtLocation").parent().children(":first").children(":first").children("first").val(sGeobytesCity + ", " + sGeobytesCountry);
		getPlaces( sGeobytesCity+","+sGeobytesRegion, sGeobytesCity, sGeobytesInternet, initLocation);
	}
});
//-->
</script>


<div class="bgboy">
<h2><?php echo $this->name; ?></h2> <label>(<?php echo $this->email; ?>)</label>

<br />

<div data-role="tabs" id="tabs">
  <div data-role="navbar">
    <ul>
      <li>
      	<a href="profile#one" data-theme="a" data-ajax="false" class="ui-btn-active ui-corner-all">
      		Datos B&aacute;sicos
      	</a>
      </li>
      <li>
      	<a href="profile#two" data-theme="a" data-ajax="false" class="ui-corner-all">
      		Otros Datos
      	</a>
      </li>
    </ul>
  </div>
  
  <!-- Datos basicos -->
  <div id="one">

	<br />
	<!-- Telefono -->
	<ul data-role="listview" data-split-icon="delete" data-theme="a" data-divider-theme="a" data-count-theme="c" data-inset="true">
		<li data-role="list-divider">
			<div class="ui-bar ui-bar-a" style="border:0px;">
			    <label><strong>Tel&eacute;fono</strong></label>
			</div>
		</li>
		<li>
			<div class="ui-grid-a">
				 <div class="ui-block-a" style="width:65%;">
				 	<input data-mini="true" data-theme="a" data-clear-btn="true" id="txtPhone" pattern="[0-9]*" id="number" value="" type="tel">
				 </div>
				 <div class="ui-block-b" style="width:35%;">
				 	<h1>&nbsp;(opcional)</h1>
				 </div>
			</div>
		 	<p>
		 		(El n&uacute;mero no ser&aacute; p&uacute;blico. S&oacute;lo se utilizar&aacute; <br />
		 		a la hora de contactarte con la persona a truequear)
		 	</p>
	    </li>
	</ul>
	
	<!-- Ubicacion -->
	<ul data-role="listview" data-split-icon="delete" data-theme="a" data-divider-theme="a" data-count-theme="c" data-inset="true">
		<li data-role="list-divider">
			<div class="ui-bar ui-bar-a" style="border:0px;">
				<label><strong>Ubicaci&oacute;n</strong></label>
			</div>
		</li>
		<li>
			<ul id="txtLocation" data-role="listview" data-inset="true" data-filter="true" data-filter-placeholder="<?php echo (isset($this->location) ? $this->location : "Buscar un lugar...");?>" data-filter-theme="a"></ul>
	    </li>
	</ul>
	
	<!-- Notificaciones -->
	<input name="checkNotif" id="checkNotif" data-mini="false" type="checkbox" data-theme="a"<?php if ($this->notif == "Y") { echo ' checked="checked"'; }?>>
	<label for="checkNotif">Deseo recibir notificaciones en mi email.</label>
	
	<br />
	<button class="ui-btn ui-icon-save ui-btn-icon-left ui-shadow ui-corner-all ui-btn-a" onclick="saveBasicData()">
		Guardar Datos B&aacute;sicos 
	</button>  
  
  </div>
  
  <!-- Otros datos -->
  <div id="two">
  
  	<br />
	<!-- Albumes -->		
	<ul data-role="listview" data-mini="true" data-split-icon="delete" data-theme="a" data-divider-theme="a" data-count-theme="c" data-inset="true">
		<li data-role="list-divider">
			<div class="ui-bar ui-bar-a" style="border:0px;">
			    <label><strong>Mis &aacute;lbumes</strong></label>
			    <a href="#" data-icon="plus" data-theme="a" class="ui-btn-right" data-iconpos="notext">Agregar</a>
			</div>
		</li>
	<?php
	while ($this->albums->next()) {
		$n = $this->albums->getValue("album_name");
		$t = $this->albums->getValue("stickers");
		$s = new Album_stickers();
		$s->addCondition("album_id", $this->albums->getId());
		if ($s->doSelectCount()) {
			$c = $s->getValueByPos(0);
		}
		echo '<li>';
		echo '  <a href="#"><label>'.$n.'</label></p><span class="ui-li-count">'.$c.'/'.$t.'</span></a>';
		echo '  <a href="#" onclick="javascript:showConfirmDialog(\'Eliminar?\',\'Desea eliminar el album '.$n.'?\', \'Esto no se puede deshacer.\', \'alert(1)\');" data-rel="popup" data-position-to="window" data-transition="flip"></a>';
		echo '</li>';
	}
	?>
	</ul>
	
	<!-- Sitios de trueque -->
	<ul data-role="listview" data-split-icon="delete" data-theme="a" data-divider-theme="a" data-count-theme="c" data-inset="true">
		<li data-role="list-divider">
			<div class="ui-bar ui-bar-a" style="border:0px;">
			    <label><strong>Mis sitios de trueque</strong></label>
			    <a href="#popupLogin" data-rel="popup" data-position-to="window" data-icon="plus" class="ui-btn-right" data-iconpos="notext">Agregar</a>
			</div>
		</li>
		<li>
			<a href="#"><label>Medellin, AN, Colombia</label></a>
	    	<a  href="#confirmDialog" onclick="javascript:showConfirmDialog('Eliminar?','Desea eliminar la ubicacion Medellin, AN, Colombia?', 'Esto no se puede deshacer.', 'alert(1)');" data-rel="popup" data-position-to="window" data-transition="flip"></a>
	    </li>
	    <li>
	    	<a href="#"><label>Envigado, AN, Colombia</label></a>
	        <a  href="#confirmDialog" onclick="javascript:showConfirmDialog('Eliminar?','Desea eliminar la ubicacion Envigado, AN, Colombia?', 'Esto no se puede deshacer.', 'alert(1)');" data-rel="popup" data-position-to="window" data-transition="flip"></a>
	    </li>
	</ul>
	  
  </div>
</div>


<br />

</div>


<!-- Popups -->
<div data-role="popup" id="popupLogin" data-theme="a" class="ui-corner-all">
	<div data-role="header" data-theme="a" role="banner" class="ui-header ui-bar-a">
		<h1 class="ui-title" role="heading">Agregar ubicacion</h1>
	</div>
	<div class="ui-content" role="main">
		<p>Seleccione una ubicacion:</p>
		<ul id="txtNewPlace" data-role="listview" data-inset="true" data-filter="true" data-filter-placeholder="Buscar un lugar..." data-filter-theme="a"></ul>
		<div class="ui-grid-a">
			<div class="ui-block-a">
				<a href="#" class="ui-btn ui-icon-check ui-btn-icon-left ui-corner-all ui-shadow ui-btn-b" data-mini="true">OK</a>
			</div>
			<div class="ui-block-b">
				<a href="#" class="ui-btn ui-icon-delete ui-btn-icon-left ui-corner-all ui-shadow ui-btn-b" data-rel="back">Cancelar</a>
			</div>
		</div>
	</div>
</div>