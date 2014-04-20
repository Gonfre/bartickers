<script type="text/javascript">
<!--
$( document ).on( "pagecreate", "#page", function() {
    loadGeoData("placeList");
});
//-->
</script>


<h2><?php echo $this->name; ?></h2> <label>(<?php echo $this->email; ?>)</label>


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
			 	<input data-mini="true" data-theme="a" data-clear-btn="true" name="number" pattern="[0-9]*" id="number" value="" type="tel">
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
		<ul id="placeList" data-role="listview" data-inset="true" data-filter="true" data-filter-placeholder="Buscar un lugar..." data-filter-theme="a"></ul>
    </li>
</ul>
 
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
	echo '  <a href="#confirmDialog" onclick="javascript:showConfirmDialog(\'Eliminar?\',\'Desea eliminar el album '.$n.'?\', \'Esto no se puede deshacer.\', \'alert(1)\');" data-rel="popup" data-position-to="window" data-transition="flip"></a>';
	echo '</li>';
}
?>
</ul>

<!-- Sitios de trueque -->
<ul data-role="listview" data-split-icon="delete" data-theme="a" data-divider-theme="a" data-count-theme="c" data-inset="true">
	<li data-role="list-divider">
		<div class="ui-bar ui-bar-a" style="border:0px;">
		    <label><strong>Mis sitios de trueque</strong></label>
		    <a href="#" data-icon="plus" class="ui-btn-right" data-iconpos="notext">Agregar</a>
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

<!-- Notificaciones -->
<input name="checkNotif" id="checkNotif" data-mini="false" type="checkbox" data-theme="a"<?php if ($this->notif == "Y") { echo ' checked="checked"'; }?>>
<label for="checkNotif">Deseo recibir notificaciones en mi email.</label>
