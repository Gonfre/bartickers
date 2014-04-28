<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
    	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
		<meta name="viewport" content="user-scalable=no, initial-scale=1.0, maximum-scale=1.0, width=device-width" />
		<meta name="apple-mobile-web-app-capable" content="yes" />
		<meta name="mobile-web-app-capable" content="yes" />
    
    	<link rel="apple-touch-icon" href="recursos/imgs/250x250.png" />
		<link rel="apple-touch-icon-precomposed" href="recursos/imgs/250x250.png" />
    	
    	<?php echo APP_BASE; ?>
		<title><?php echo APP_TITLE; ?> - <?php echo $this->pageTitle; ?></title>
		<script type="text/javascript" src="recursos/js/jquery-1.11.0.min.js"></script>
		<script type="text/javascript" src="recursos/js/jquery.mobile-1.4.2.min.js"></script>
		<script type="text/javascript" src="recursos/js/barticker.js"></script>
		<script type="text/javascript" src="recursos/js/peticiones.js"></script>
		
		<link rel="stylesheet" type='text/css' href="recursos/css/jquery.mobile.structure-1.4.2.min.css"/>
		<link rel="stylesheet" type='text/css' href="recursos/themes/jquery.mobile.icons.min.css"/>
		<link rel="stylesheet" type='text/css' href="recursos/themes/barticker-green.css"/>
		<link rel="stylesheet" type='text/css' href="recursos/css/barticker.css"/>
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
			    <div id="menuAlbums" data-role="collapsibleset" data-theme="a" data-content-theme="a" data-mini="true" data-collapsed-icon="grid" data-expanded-icon="grid">
			    	<label>Mis &Aacute;lbumes:</label>
			    	<?php
			    	if (!isset($this->albums)) {
						require_once 'modelos/albums.php';
						require_once 'modelos/album_stickers.php';

						$this->albums = new Albums();
						$this->albums->addCondition("user_id", LocalUser::getCurrentUser()->getId()); //LocalUser
						$this->albums->doSelectAllWithForeign("album_types", "album_type", DB_SAME_FIELD);
					}
					
					while ($this->albums->next()) {
						$i = $this->albums->getValue("album_id");
						$n = $this->albums->getValue("album_name");
						$t = $this->albums->getValue("stickers");
						$s = new Album_stickers();
						$s->addCondition("album_id", $this->albums->getId());
						if ($s->doSelectCount()) {
							$c = $s->getValueByPos(0);
						}
						
						echo '<div id="menuAlbum-'.$i.'" data-role="collapsible">';
						echo '   <h5>'.$n.' (<span id="menuCant-'.$i.'">'.$c.'</span>/'.$t.')</h5>';
						echo '   <fieldset data-role="controlgroup" data-mini="true">';
						echo '      <a href="#" rel="external" class="ui-btn ui-mini ui-corner-all ui-btn-a ui-icon-eye ui-btn-icon-left">';
						echo           'Ver &aacute;lbum';
						echo        '</a>';
						echo '      <a href="bartering?album_id='.$i.'" rel="external" class="ui-btn ui-corner-all ui-btn-a ui-icon-recycle ui-btn-icon-left">';
						echo           'Truequear';
						echo        '</a>';
						echo '   </fieldset>';
						echo '</div>';
					}
					?>

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
			    	<a href="home" rel="external" class="ui-btn ui-corner-all ui-btn-a ui-icon-power ui-btn-icon-left">Salir</a>
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
