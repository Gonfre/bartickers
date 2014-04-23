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
      	<a class="ui-btn-active" href="mybarters#one" data-theme="a" data-ajax="false">
      		Pendientes
      	</a>
      </li>
      <li>
      	<a href="mybarters#two" data-theme="a" data-ajax="false">
      		Confirmados
      	</a>
      </li>
      <li>
      	<a href="mybarters#three" data-theme="a" data-ajax="false">
      		Completados
      	</a>
      </li>
    </ul>
  </div>
  <div id="one" class="ui-body-d ui-content">
  	Uno
  </div>
  <div id="two" class="ui-body-d ui-content">
  	dos
  </div>
  <div id="three" class="ui-body-d ui-content">
  	tres
  </div>
</div>

<a onclick="javascript:buscar(this)" href="#" rel="external" class="ui-btn ui-corner-all ui-btn-a ui-icon-search ui-btn-icon-left ui-shadow">Realizar b&uacute;squeda</a>

<br />
<br />
