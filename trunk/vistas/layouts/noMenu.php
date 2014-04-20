<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
    	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
		<meta name = "viewport" content = "user-scalable=no, initial-scale=1.0, maximum-scale=1.0, width=device-width">
		<meta name="apple-mobile-web-app-capable" content="yes" />
		<meta name="mobile-web-app-capable" content="yes">
    
    	<?php echo APP_BASE; ?>
		<title><?php echo APP_TITLE; ?> - <?php echo $this->pageTitle; ?></title>
		<script type="text/javascript" src="recursos/js/jquery-1.11.0.min.js"></script>
		<script type="text/javascript" src="recursos/js/jquery.mobile-1.4.2.min.js"></script>
		
		<link rel="stylesheet" type='text/css' href="recursos/css/jquery.mobile.structure-1.4.2.min.css"/>
		<link rel="stylesheet" type='text/css' href="recursos/themes/jquery.mobile.icons.min.css"/>
		<link rel="stylesheet" type='text/css' href="recursos/themes/barticker-green.css"/>

    </head>
    <body>
    	<div data-role="page" data-theme="a" id="page" data-url="page">
			
			<!-- header -->
			<div data-role="header" data-position="fixed">
				<h1><?php echo $this->titleShowed; ?></h1>
			</div>
			
			<!-- content -->
			<div data-role="content" data-theme="a">
				<?php $this->showContent(); ?>
			</div>
			
			<!-- footer -->
			<div data-role="footer" data-theme="a">
				<h2>..:: Powered by El_nombre ::..</h2>
			</div>
					
		</div><!-- page -->

    </body>
</html>
