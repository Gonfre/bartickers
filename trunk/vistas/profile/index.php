<script type="text/javascript">
<!--
var initLocation = function ( response ) {
	val = response.geonames[0];
	var texto = val.name + (val.adminName1 ? (val.adminName1 != val.name ? ", "+val.adminName1 : "") : "") + ", " + val.countryName;
	getFilterlistInputObj("txtLocation").val(omitirAcentos(texto));
}

$( document ).on( "pagecreate", "#page", function() {
	loadGeoData("txtLocation");
	loadGeoData("txtNewPlace");

    if ("<?php echo (isset($this->location) ? $this->location : ""); ?>" == "") {
		//$("#txtLocation").parent().children(":first").children(":first").children("first").val(sGeobytesCity + ", " + sGeobytesCountry);
		//getPlaces( currentCity+","+currentRegion, currentCity, currentCountry, initLocation);
		getCurrentLocationByIP(function() {
			getPlaces( currentCity+","+currentRegion, currentCity, currentCountry, initLocation);
		});
	} else {
		getCurrentLocationByIP();
	}

	//Geo location
	getCurrentLocationByGPS(function(position) {
		saveUserLocation(position.coords.latitude, position.coords.longitude);
	}, function() {});


	$("#txtAlbumName").on("input", function(e, ui) {
		var input = $(this);
		if (input.val() == "") {
			$("#btnNewAlbumOk").addClass('ui-state-disabled');
		} else {
			if ($("#btnNewAlbumOk").hasClass('ui-state-disabled')) {
				$("#btnNewAlbumOk").removeClass('ui-state-disabled');
			}
		}
	});
});


function selectAlbum(id, name, stickers) {
	if ($("#txtAlbumName").val() == "") {
		$("#txtAlbumName").val(name);
	}
	$("#txtAlbumId").val(id);
	$("#txtAlbumStickers").val(stickers);
	$("#btnNewAlbumOk").removeClass('ui-state-disabled');
	$("#txtAlbumName").focus();
}
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
				 	<input data-mini="true" data-theme="a" data-clear-btn="true" id="txtPhone" pattern="[0-9]*" id="number" value="<?php echo $this->telephone;?>" type="tel">
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
	<ul id="ulAlbums" data-role="listview" data-mini="true" data-split-icon="delete" data-theme="a" data-divider-theme="a" data-count-theme="c" data-inset="true">
		<li data-role="list-divider">
			<div class="ui-bar ui-bar-a" style="border:0px;">
			    <label><strong>Mis &aacute;lbumes</strong></label>
			    <a href="#popupAlbums" data-rel="popup" data-position-to="window" data-icon="plus" data-theme="a" class="ui-btn-right" data-iconpos="notext">Agregar</a>
			</div>
		</li>
	<?php
	while ($this->albums->next()) {
		$i = $this->albums->getValue("album_id");
		$n = $this->albums->getValue("album_name");
		$t = $this->albums->getValue("stickers");
		$s = new Album_stickers();
		$s->addCondition("album_id", $this->albums->getId());
		if ($s->doSelectCount()) {
			$c = $s->getValueByPos(0);
		}
		echo '<li id="liAlbum-'.$i.'">';
		echo '  <a href="#"><label>'.$n.'</label><span class="ui-li-count">'.$c.'/'.$t.'</span></a>';
		echo '  <a href="#" onclick="javascript:showConfirmDialog(\'Eliminar?\',\'Desea eliminar el album &quot;'.$n.'&quot;?\', \'Esto no se puede deshacer.\', \'deleteIt(\\\'album\\\','.$i.')\');" data-rel="popup" data-position-to="window" data-transition="flip"></a>';
		echo '</li>';
	}
	?>
	</ul>
	
	<!-- Sitios de trueque -->
	<ul id="ulLocations" data-role="listview" data-split-icon="delete" data-theme="a" data-divider-theme="a" data-count-theme="c" data-inset="true">
		<li data-role="list-divider">
			<div class="ui-bar ui-bar-a" style="border:0px;">
			    <label><strong>Mis sitios de trueque</strong></label>
			    <a href="#popupLocation" data-rel="popup" data-position-to="window" data-icon="plus" class="ui-btn-right" data-iconpos="notext">Agregar</a>
			</div>
		</li>
	<?php 
	while ($this->userLocations->next()) {
		$n = $this->userLocations->getValue("location_name");
		$i = $this->userLocations->getValue("location_id");
		echo '<li id="liLocation-'.$i.'">';
		echo '	<a href="#"><label>'.$n.'</label></a>';
		echo '	<a href="#confirmDialog" onclick="javascript:showConfirmDialog(\'Eliminar?\',\'Desea eliminar la ubicacion &quot;'.$n.'&quot;?\', \'Esto no se puede deshacer.\', \'deleteIt(\\\'location\\\','.$i.')\');" data-rel="popup" data-position-to="window" data-transition="flip"></a>';
		echo '</li>';
	}
	?>
	</ul>
	  
  </div>
</div>


<br />

</div>


<!-- Popups -->
<div data-role="popup" id="popupLocation" data-theme="a" class="ui-corner-all">
	<div data-role="header" data-theme="a" role="banner" class="ui-header ui-bar-a">
		<h1 class="ui-title" role="heading">Agregar ubicacion</h1>
	</div>
	<div class="ui-content" role="main">
		<p>Seleccione una ubicacion:</p>
		<ul id="txtNewPlace" data-role="listview" data-inset="true" data-filter="true" data-filter-placeholder="Buscar un lugar..." data-filter-theme="a"></ul>
		<a href="javascript:addIt('location', 'popupLocation');" class="ui-btn ui-btn-inline ui-icon-check ui-btn-icon-left ui-corner-all ui-shadow ui-btn-b ui-btn-icon-notext">Ok</a>
		<a href="#" class="ui-btn ui-btn-inline ui-icon-delete ui-btn-icon-left ui-corner-all ui-shadow ui-btn-b ui-btn-icon-notext" data-rel="back">Cancel</a>
	</div>
</div>


<div data-role="popup" id="popupAlbums" data-theme="a" class="ui-corner-all" style="min-width:280px;">
	<div data-role="header" data-theme="a" role="banner" class="ui-header ui-bar-a">
		<h1 class="ui-title" role="heading">Agregar &aacute;lbum</h1>
	</div>
	<div class="ui-content" role="main">
		<p>Seleccione un &aacute;lbum:</p>
		<fieldset data-role="controlgroup" data-mini="true" data-iconpos="right">
		<?php
		while ($this->albumTypes->next()) {
			$i = $this->albumTypes->getValue("album_type");
			$sn = $this->albumTypes->getValue("short_name");
			$n = $this->albumTypes->getValue("name");
			$s = $this->albumTypes->getValue("stickers");
			
			//echo '<li id="liNewAlbum-'.$i.'" data-icon="false" onclick="selectAlbum('.$i.',\''.$sn.'\')">';
			//echo '  <a href="#"><p><strong>'.$sn.'</strong></p><p>'.$n.'</p><span class="ui-li-count">'.$s.'</span></a>';
			//echo '</li>';
			
			
			echo '<input id="radio-'.$i.'" name="radioAlbum" value="on" type="radio" onclick="selectAlbum('.$i.',\''.$n.'\','.$s.')">';
			echo '<label for="radio-'.$i.'">';
			//echo    $n.'<br><span style="font-weight:normal;">'.$sn.'</span>';
			echo    '<span style="font-weight:normal;">'.$n.'</span>';
			echo '</label>';
		}
		?>
		</fieldset>
		
		<input id="txtAlbumName" value="" placeholder="Nombre personalizado" type="text" required="required">
		<input id="txtAlbumId" type="hidden">
		<input id="txtAlbumStickers" type="hidden">
		
		<a id="btnNewAlbumOk" href="javascript:addIt('album', 'popupAlbums');" class="ui-btn ui-btn-inline ui-icon-check ui-btn-icon-left ui-corner-all ui-shadow ui-btn-b ui-btn-icon-notext ui-state-disabled">Ok</a>
		<a href="#" class="ui-btn ui-btn-inline ui-icon-delete ui-btn-icon-left ui-corner-all ui-shadow ui-btn-b ui-btn-icon-notext" data-rel="back">Cancel</a>
	</div>
</div>