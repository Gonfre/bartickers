<script type="text/javascript">
<!--
function buscar(a, id) {
	a.href = "bartering/zoom?idTrueque="+id;
}
//-->
</script>

<center>
	<fieldset data-role="controlgroup" data-type="horizontal" data-theme="a" data-mini="true">
		<input name="radio-choice-h-2" id="radio1" value="on" checked="checked" type="radio">
		<label for="radio1">
			Todos (4)
		</label>
		<input name="radio-choice-h-2" id="radio2" value="off" type="radio">
		<label for="radio2">
			Directos (5)
		</label>
		<input name="radio-choice-h-2" id="radio3" value="other" type="radio">
		<label for="radio3">
			Varios (1)
		</label>
	</fieldset>
</center>

<ul data-role="listview" data-inset="true" data-divider-theme="a" data-theme="a">
    <li data-role="list-divider">
    	Medellin, AN, Colombia
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
    
    <li data-role="list-divider">
    	Envigado, AN, Colombia
    	<span class="ui-li-count">1</span>
    </li>
    <li>
    	<a onclick="javascript:buscar(this, 4)" href="#" data-rel="dialog">
    		<label>Perroti</label>
    		<span class="ui-li-count">E: 2 / R: 2</span>
    	</a>
    </li>
</ul>
