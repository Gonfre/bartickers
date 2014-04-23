<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
    	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
		<meta name = "viewport" content="user-scalable=no, initial-scale=1.0, maximum-scale=1.0, width=device-width">
		<meta name="apple-mobile-web-app-capable" content="yes" />
		<meta name="mobile-web-app-capable" content="yes">
    
    	<link rel="apple-touch-icon" href="recursos/imgs/250x250.png" />
		<link rel="apple-touch-icon-precomposed" href="recursos/imgs/250x250.png" />
    	
    	<?php echo APP_BASE; ?>
		<title><?php echo APP_TITLE; ?> - <?php echo $this->pageTitle; ?></title>
		<script type="text/javascript" src="recursos/js/jquery-1.11.0.min.js"></script>
		<script type="text/javascript" src="recursos/js/jquery.mobile-1.4.2.min.js"></script>
		<script type="text/javascript" src="recursos/js/barticker.js"></script>
		
		<link rel="stylesheet" type='text/css' href="recursos/css/jquery.mobile.structure-1.4.2.min.css"/>
		<link rel="stylesheet" type='text/css' href="recursos/themes/jquery.mobile.icons.min.css"/>
		<link rel="stylesheet" type='text/css' href="recursos/themes/barticker-green.css"/>
		<link rel="stylesheet" type='text/css' href="recursos/css/albums.css"/>
		<link rel="stylesheet" type='text/css' href="recursos/css/responsive.css"/>
		
		<script type="text/javascript">
			$(document).ready(openMenuOnSwipe);
		</script>
		
    </head>
    <body>
    	<div data-role="page" data-theme="b" id="page" data-url="page">
	
			<!-- panel left -->
			<div data-role="panel" id="panel-menu" data-theme="b">
			    <!-- Menu -->
			    <div data-role="collapsibleset" data-theme="a" data-content-theme="a" data-mini="true" data-collapsed-icon="grid" data-expanded-icon="grid">
			    	<label>Mis &Aacute;lbumes:</label>
					<div data-role="collapsible">
					    <h5>Mi mundialito (55/640)</h5>
					    <fieldset data-role="controlgroup" data-mini="true">
			    			<a href="#" rel="external" class="ui-btn ui-mini ui-corner-all ui-btn-a ui-icon-eye ui-btn-icon-left">Ver &aacute;lbum</a>
					    	<a href="bartering" rel="external" class="ui-btn ui-corner-all ui-btn-a ui-icon-recycle ui-btn-icon-left">Truequear</a>
			    		</fieldset>
					</div>
				    <div data-role="collapsible" data-theme="c">
					    <h5>El de mi hermana (20/640)</h5>
					    <fieldset data-role="controlgroup" data-mini="true">
			    			<a href="#" rel="external" class="ui-btn ui-mini ui-corner-all ui-btn-a ui-icon-eye ui-btn-icon-left">Ver &aacute;lbum</a>
					    	<a href="bartering" rel="external" class="ui-btn ui-corner-all ui-btn-a ui-icon-recycle ui-btn-icon-left">Truequear</a>
			    		</fieldset>
					</div>
			    </div>
			    <hr />
			    <fieldset data-role="controlgroup" data-mini="true">
			    	<a href="bartering/mybarters" rel="external" class="ui-btn ui-corner-all ui-btn-a ui-icon-recycle ui-btn-icon-left">Mis Trueques</a>
			    </fieldset>
			    <hr />
			    <fieldset data-role="controlgroup" data-mini="true">
			    	<legend>Mi Perfil:</legend>
				    <a href="profile" rel="external" class="ui-btn ui-corner-all ui-btn-a ui-icon-user ui-btn-icon-left">Ver Mi Perfil</a>
				    <a href="profile/reputation" rel="external" class="ui-btn ui-corner-all ui-btn-a ui-icon-star ui-btn-icon-left">Ver Mi Reputaci&oacute;n</a>
			    </fieldset>
			    <hr />
			    <fieldset data-role="controlgroup" data-mini="true">
			    	<a href="inicio" rel="external" class="ui-btn ui-corner-all ui-btn-a ui-icon-power ui-btn-icon-left">Salir</a>
			    </fieldset>
			</div>
			
			<!-- header -->
			<div data-role="header" data-position="fixed">
				<h1><?php echo $this->titleShowed; ?></h1>
				
				<a href="#panel-menu" data-theme="b" data-icon="bars" data-iconpos="notext" data-shadow="false" data-iconshadow="false">Open left panel</a>
				<?php echo (isset($this->right) ? $this->right : "");?>
			</div>
			
			<!-- content -->
			<div data-role="content" data-theme="c" id="content">
				<?php $this->showContent(); ?>
			</div>
			
			<!-- footer -->
			<div data-role="footer" data-theme="a">
				<h2>..:: Powered by El_nombre ::..</h2>
			</div>
					
		</div><!-- page -->

    </body>
</html>
