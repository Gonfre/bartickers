<style>
<!--
.ui-dialog .ui-dialog-contain { 
	margin-top: 0px;
}
-->
</style>

<!-- Quienes -->
<ul data-role="listview" data-inset="true" data-split-icon="forbidden" data-divider-theme="a" data-theme="a" data-split-theme="a">
    <li data-role="list-divider">
    	Casper
    	<span class="ui-li-count">2</span>
    </li>
    <li>
    	<a href="#">
	    	<h2>304</h2>
	    	<p>Messi (Argentina)</p>
	    	<span class="ui-li-count">1 x 1</span>
	    </a>
	    <a href="#" name="check" data-icon="check"></a>
    </li>
    <li>
    	<a href="#">
	    	<h2>033</h2>
	    	<p>Juan Merino (Nidea)</p>
	    	<span class="ui-li-count">2 x 1</span>
	    </a>
	    <a href="#" name="check"></a>
    </li>
    <li>
    	<a href="#">
	    	<h2>243</h2>
	    	<p>Falcao (Colombia)</p>
	    	<span class="ui-li-count">1 x 1</span>
	    </a>
	    <a href="#" name="check" data-icon="check"></a>
    </li>
    
    <li data-role="list-divider">
    	Dayana
    	<span class="ui-li-count">1</span>
    </li>
    <li>
    	<a href="#">
	    	<h2>156</h2>
	    	<p>Pedro Perez (Porahi)</p>
	    	<span class="ui-li-count">1 x 1</span>
	    </a>
	    <a href="#" name="check" data-icon="check"></a>
    </li>
</ul>

<!-- boton -->
<a onclick="javascript:go()" href="#" data-rel="back" class="ui-btn ui-corner-all ui-btn-a ui-icon-check ui-btn-icon-left ui-shadow">Enviar Solicitud</a>
<a href="#" data-rel="back" class="ui-btn ui-corner-all ui-btn-a ui-icon-alert ui-btn-icon-left ui-shadow ui-state-disabled">Solicitud ya enviada</a>



<!-- Script -->
<script type="text/javascript">
<!--
$("[name=check]").each(function() {
    $(this).bind( "tap", function() {
		if ($(this).hasClass("ui-icon-check")) { //marcado
			$(this).removeClass("ui-icon-check").addClass("ui-icon-forbidden");
		} else { //desmarcado
			$(this).removeClass("ui-icon-forbidden").addClass("ui-icon-check");
		}
		$(this).trigger("refresh");
    } );
});


function go() {
	alert("guardando, viteh");
}
//-->
</script>