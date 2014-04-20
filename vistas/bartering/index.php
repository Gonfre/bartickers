<script type="text/javascript">
<!--
function buscar(a) {
	var d = $("#selectDistance").val();
	var o = $( "#tabs" ).tabs( "option", "active" );
	a.href = "bartering/results?tipoBusqueda="+o+"&distance=" + d;
}
//-->
</script>

<br />
<br />

<div data-role="tabs" id="tabs">
  <div data-role="navbar">
    <ul>
      <li>
      	<a class="ui-btn-active" href="bartering#one" data-theme="a" data-ajax="false">
      		Mis sitios
      	</a>
      </li>
      <li>
      	<a href="bartering#two" data-theme="a" data-ajax="false">
      		Cerca de m&iacute;
      	</a>
      </li>
    </ul>
  </div>
  <div id="one" class="ui-body-d ui-content">
  </div>
  <div id="two">
	<ul data-role="listview" data-split-icon="delete" data-theme="a" data-divider-theme="a" data-count-theme="c" data-inset="true">
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
  </div>
</div>

<a onclick="javascript:buscar(this)" href="#" rel="external" class="ui-btn ui-corner-all ui-btn-a ui-icon-search ui-btn-icon-left ui-shadow">Realizar b&uacute;squeda</a>

<br />
<br />
