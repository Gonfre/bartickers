<script type="text/javascript">
<!--
function buscar(a) {
	var d = $("#selectDistance").val();
	var o = $( "#tabs" ).tabs( "option", "active" );
	a.href = "bartering/results?tipoBusqueda="+o+"&distance=" + d;
}

$(document).on("ready", function() {
	$("#ulDistance").hide();
	
	$("input[type=radio]").on("change", function(ev, ui) {
		var radio = $(this);
		if (radio.val() == "C") {
			$("#ulDistance").show();
		} else {
			$("#ulDistance").hide();
		}
	});
});
//-->
</script>

<!-- Types -->
<br />
<fieldset data-role="controlgroup" data-type="horizontal" data-theme="a" data-mini="true">
	<input name="radio-type" id="radio-1" value="P" checked="checked" type="radio">
	<label for="radio-1">
		Mis sitios
	</label>
	<input name="radio-type" id="radio-2" value="F" type="radio">
	<label for="radio-2">
		Mis amigos
	</label>
	<input name="radio-type" id="radio-3" value="C" type="radio">
	<label for="radio-3">
		Cerca de m&iacute;
	</label>
</fieldset>

<!-- Distance -->
<br />
<ul id="ulDistance" data-role="listview" data-split-icon="delete" data-theme="a" data-divider-theme="a" data-count-theme="c" data-inset="true">
	<li data-role="list-divider">
		<div class="ui-bar ui-bar-a" style="border:0px;">
			<label><strong>Distancia</strong></label>
		</div>
	</li>
	<li>
	    <select name="selectDistance" id="selectDistance" data-mini="true" data-native-menu="false">
	        <option value="500">500 m</option>
	        <option value="1000">1 km</option>
	        <option value="5000">5 km</option>
	        <option value="50000">50 km</option>
	    </select>
    </li>
</ul>

<!-- Button -->
<br />
<a onclick="javascript:buscar(this)" href="#" rel="external" class="ui-btn ui-corner-all ui-btn-a ui-icon-search ui-btn-icon-left ui-shadow">Realizar b&uacute;squeda</a>

<br />

