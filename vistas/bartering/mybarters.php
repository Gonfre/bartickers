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
      	<a href="bartering/mybarters#one" data-theme="a" data-ajax="false" class="ui-btn-active ui-corner-all">
      		Pend.
      	</a>
      </li>
      <li>
      	<a href="bartering/mybarters#two" data-theme="a" data-ajax="false" class="ui-corner-all">
      		Conf.
      	</a>
      </li>
      <li>
      	<a href="bartering/mybarters#three" data-theme="a" data-ajax="false" class="ui-corner-all">
      		Comp.
      	</a>
      </li>
    </ul>
  </div>
  
<!-- Pendientes -->
  <div id="one" class="ui-body-d ui-content">
	<ul data-role="listview" data-inset="true" data-divider-theme="a" data-theme="a" id="listPending">
		<li data-role="list-divider">
	    	Pendientes de Confirmaci&oacute;n
	    	<span class="ui-li-count">3</span>
	    </li>
	    <li>
	    	<a onclick="javascript:buscar(this, 1)" href="#" data-rel="dialog">
	    		<label>Luis G.</label>
	    		<span class="ui-li-count">E: 6 / R: 6</span>
	    	</a>
	    </li>
	    <li>
	    	<a onclick="javascript:buscar(this, 2)" href="#" data-rel="dialog">
	    		<label>Jhongo</label>
	    		<span class="ui-li-count">E: 5 / R: 4</span>
	    	</a>
	    </li>
	    <li>
	    	<a onclick="javascript:buscar(this, 3)" href="#" data-rel="dialog">
	    		<label>Casper, Dayana</label>
	    		<span class="ui-li-count">E: 3 / R: 3</span>
	    	</a>
	    </li>
	</ul>
  </div>
  
<!-- Confirmados -->
  <div id="two" class="ui-body-d ui-content">
  	<ul data-role="listview" data-inset="true" data-divider-theme="a" data-theme="a" id="listPending">
  		<li data-role="list-divider">
	    	Confirmados
	    	<span class="ui-li-count">2</span>
	    </li>
	    <li>
	    	<a onclick="javascript:buscar(this, 2)" href="#" data-rel="dialog">
	    		<label>Jhongo</label>
	    		<span class="ui-li-count">E: 5 / R: 4</span>
	    	</a>
	    </li>
	    <li>
	    	<a onclick="javascript:buscar(this, 3)" href="#" data-rel="dialog">
	    		<label>Casper, Dayana</label>
	    		<span class="ui-li-count">E: 3 / R: 3</span>
	    	</a>
	    </li>
	</ul>
  </div>
  
<!-- Completados -->  
  <div id="three" class="ui-body-d ui-content">
  	<ul data-role="listview" data-inset="true" data-divider-theme="a" data-theme="a" id="listPending">
	  	<li data-role="list-divider">
	    	Trueques Completados
	    	<span class="ui-li-count">3</span>
	    </li>
	    <li>
	    	<a onclick="javascript:buscar(this, 1)" href="#" data-rel="dialog">
	    		<label>Luis G.</label>
	    		<span class="ui-li-count">E: 6 / R: 6</span>
	    	</a>
	    </li>
	    <li>
	    	<a onclick="javascript:buscar(this, 2)" href="#" data-rel="dialog">
	    		<label>Jhongo</label>
	    		<span class="ui-li-count">E: 5 / R: 4</span>
	    	</a>
	    </li>
	    <li>
	    	<a onclick="javascript:buscar(this, 3)" href="#" data-rel="dialog">
	    		<label>Casper, Dayana</label>
	    		<span class="ui-li-count">E: 3 / R: 3</span>
	    	</a>
	    </li>
	</ul>
  </div>
</div>

