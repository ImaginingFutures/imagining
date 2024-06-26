<?php
/* ----------------------------------------------------------------------
 * views/pageFormat/pageHeader.php : 
 * ----------------------------------------------------------------------
 * CollectiveAccess
 * Open-source collections management software
 * ----------------------------------------------------------------------
 *
 * Software by Whirl-i-Gig (http://www.whirl-i-gig.com)
 * Copyright 2014-2017 Whirl-i-Gig
 *
 * For more information visit http://www.CollectiveAccess.org
 *
 * This program is free software; you may redistribute it and/or modify it under
 * the terms of the provided license as published by Whirl-i-Gig
 *
 * CollectiveAccess is distributed in the hope that it will be useful, but
 * WITHOUT ANY WARRANTIES whatsoever, including any implied warranty of 
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  
 *
 * This source code is free and modifiable under the terms of 
 * GNU General Public License. (http://www.gnu.org/copyleft/gpl.html). See
 * the "license.txt" file for details, or visit the CollectiveAccess web site at
 * http://www.CollectiveAccess.org
 *
 * ----------------------------------------------------------------------
 */
	$va_lightboxDisplayName = caGetLightboxDisplayName();
	$vs_lightbox_sectionHeading = ucFirst($va_lightboxDisplayName["section_heading"]);
	$va_classroomDisplayName = caGetClassroomDisplayName();
	$vs_classroom_sectionHeading = ucFirst($va_classroomDisplayName["section_heading"]);
	
	# Collect the user links: they are output twice, once for toggle menu and once for nav
	$va_user_links = array();
	if($this->request->isLoggedIn()){
		$va_user_links[] = '<li role="presentation" class="dropdown-header">'.trim($this->request->user->get("fname")." ".$this->request->user->get("lname")).', '.$this->request->user->get("email").'</li>';
		$va_user_links[] = '<li class="divider nav-divider"></li>';
		if(caDisplayLightbox($this->request)){
			$va_user_links[] = "<li>".caNavLink($this->request, $vs_lightbox_sectionHeading, '', '', 'Lightbox', 'Index', array())."</li>";
		}
		if(caDisplayClassroom($this->request)){
			$va_user_links[] = "<li>".caNavLink($this->request, $vs_classroom_sectionHeading, '', '', 'Classroom', 'Index', array())."</li>";
		}
		$va_user_links[] = "<li>".caNavLink($this->request, _t('User Profile'), '', '', 'LoginReg', 'profileForm', array())."</li>";
		
		if ($this->request->config->get('use_submission_interface')) {
			$va_user_links[] = "<li>".caNavLink($this->request, _t('Submit content'), '', '', 'Contribute', 'List', array())."</li>";
		}
		$va_user_links[] = "<li>".caNavLink($this->request, _t('Logout'), '', '', 'LoginReg', 'Logout', array())."</li>";
	} else {	
		if (!$this->request->config->get(['dontAllowRegistrationAndLogin', 'dont_allow_registration_and_login']) || $this->request->config->get('pawtucket_requires_login')) { $va_user_links[] = "<li><a href='#' onclick='caMediaPanel.showPanel(\"".caNavUrl($this->request, '', 'LoginReg', 'LoginForm', array())."\"); return false;' >"._t("Login")."</a></li>"; }
		if (!$this->request->config->get(['dontAllowRegistrationAndLogin', 'dont_allow_registration_and_login']) && !$this->request->config->get('dontAllowRegistration')) { $va_user_links[] = "<li><a href='#' onclick='caMediaPanel.showPanel(\"".caNavUrl($this->request, '', 'LoginReg', 'RegisterForm', array())."\"); return false;' >"._t("Register")."</a></li>"; }
	}
	$vb_has_user_links = (sizeof($va_user_links) > 0);
	$va_access_values = caGetUserAccessValues($this->request);

?><!DOCTYPE html>
<html lang="en" <?php print ((strtoLower($this->request->getController()) == "front")) ? "class='frontContainer'" : ""; ?>>
	<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0"/>

	<link rel="apple-touch-icon" sizes="180x180" href="<?php print caGetThemeAssetURL('graphics/favicon/apple-touch-icon.png') ?>">
	<link rel="icon" type="image/png" sizes="32x32" href="<?php print caGetThemeAssetURL('graphics/favicon/favicon-32x32.png') ?>">
	<link rel="icon" type="image/png" sizes="16x16" href="<?php print caGetThemeAssetURL('graphics/favicon/favicon-16x16.png') ?>">
	<link rel="manifest" href="<?php print caGetThemeAssetURL('graphics/favicon/site.webmanifest') ?>">
	<link rel="mask-icon" href="<?php print caGetThemeAssetURL('graphics/favicon/safari-pinned-tab.svg') ?>" color="#5bbad5">
	<meta name="msapplication-TileColor" content="#da532c">
	<meta name="theme-color" content="#ffffff">


	<?= AssetLoadManager::getLoadHTML($this->request); ?>
	
	<title><?= (MetaTagManager::getWindowTitle()) ? MetaTagManager::getWindowTitle() : $this->request->config->get("app_display_name"); ?></title>

	<meta property="og:url" content="<?php print $this->request->config->get("site_host").caNavUrl($this->request, "*", "*", "*"); ?>" />
	<meta property="og:type" content="website" />
	
	<!-- Dynamic meta tags -->
	<?= MetaTagManager::getHTML(); ?>
	<!-- Select2 CSS -->
	<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />

	<!-- Select2 JavaScript -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>


<?php
	if(!in_array(strToLower($this->request->getAction), array("objects"))){
		# --- this is set on detail page
?>
	<meta property="og:description" content="<?php print htmlspecialchars((MetaTagManager::getWindowTitle()) ? MetaTagManager::getWindowTitle() : $this->request->config->get("app_display_name")); ?>" />
	<meta property="og:title" content="<?php print $this->request->config->get("app_display_name"); ?>" />
<?php
	}
?>	
	
	<script type="text/javascript">
		jQuery(document).ready(function() {
    		jQuery('#browse-menu').on('click mouseover mouseout mousemove mouseenter',function(e) { e.stopPropagation(); });
    	});
	</script>
<?php
	if(Debug::isEnabled()) {		
		//
		// Pull in JS and CSS for debug bar
		// 
		$o_debugbar_renderer = Debug::$bar->getJavascriptRenderer();
		$o_debugbar_renderer->setBaseUrl(__CA_URL_ROOT__.$o_debugbar_renderer->getBaseUrl());
		print $o_debugbar_renderer->renderHead();
	}
?>
	<!-- manually download the css for versioning -->
	<link rel="stylesheet" href="<?php print caGetThemeAssetURL('css/theme.css') ?>?v=20240619" type="text/css" media="all">

</head> 

<body class='<?php print (strtoLower($this->request->getController()) == "front") ? "frontContainer" : ""; ?>'>
	<div id="skipNavigation"><a href="#main">Skip to main content</a></div>
	<nav class="navbar navbar-default yamm" role="navigation">
		<div class="container menuBar">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
<?php
	if ($vb_has_user_links) {
?>
				<button type="button" class="navbar-toggle navbar-toggle-user" data-toggle="collapse" data-target="#user-navbar-toggle">
					<span class="sr-only">User Options</span>
					<i class="fas fa-user-circle"></i>
				</button>
<?php
	}
?>
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-main-navbar-collapse-1">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				
				<?php $homeurl = caNavUrl($this->request, "", "", "", ""); 
					if ($homeurl === "") {
						$homeurl = '/';
					}
				?>

				<a href="<?php print $homeurl ?>" class="navbar-brand"><?php print caGetThemeGraphic($this->request, 'IF_logo.webp') ?> Imagining Futures</a>
			</div>

		<!-- Collect the nav links, forms, and other content for toggling -->
			<!-- bs-user-navbar-collapse is the user menu that shows up in the toggle menu - hidden at larger size -->
<?php
	if ($vb_has_user_links) {
?>
			<div class="collapse navbar-collapse" id="user-navbar-toggle">
				<ul class="nav navbar-nav" role="list" aria-label="<?php print _t("Mobile User Navigation"); ?>">
					<?php print join("\n", $va_user_links); ?>
				</ul>
			</div>
<?php
	}
?>
			<div class="collapse navbar-collapse" id="bs-main-navbar-collapse-1">
<?php
	if ($vb_has_user_links) {
?>
				<ul class="nav navbar-nav navbar-right" id="user-navbar" role="list" aria-label="<?php print _t("User Navigation"); ?>">
					<li class="dropdown" style="position:relative;">
						<a href="#" class="dropdown-toggle icon" data-toggle="dropdown"><i class="fas fa-user-alt" aria-label="<?php print _t("User options"); ?>"></i> <?php print ($this->request->isLoggedIn()) ? "Account" : "LOGIN"; ?></a>
						<ul class="dropdown-menu" role="list"><?php print join("\n", $va_user_links); ?></ul>
					</li>
				</ul>
<?php
	}
?>
				<form class="navbar-form navbar-right" role="search" action="<?php print caNavUrl($this->request, '', 'MultiSearch', 'Index'); ?>" aria-label="<?php print _t("Search"); ?>">
					<div class="formOutline">
						<div class="form-group">
							<input type="text" class="form-control" id="headerSearchInput" placeholder="<?php print _t("Search"); ?>" name="search" autocomplete="off" aria-label="<?php print _t("Search text"); ?>" />
						</div>
						<div class="btn-group">
							<button type="submit" class="btn-search" id="headerSearchButton"><i class="fas fa-search" aria-label="<?php print _t("Submit"); ?>"></i></button>
							<button type="button" class="btn btn-search dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<i class="fas fa-chevron-down"></i>
							</button>
							<div class="dropdown-menu advancedSearchContainer" aria-labelledby="headerSearchButton">
								<div id="advancedSearchOptions" class="headerAdvancedSearch">
									<?php print caNavLink($this->request, _t("Advanced Search"), "", "", "Search", "advanced/objects"); ?>
								</div>
							</div>
						</div>
					</div>
				</form>


				<script type="text/javascript">

						$(document).ready(function () {
							$('#headerSearchButton').prop('disabled', true);
							$('#headerSearchInput').on('keyup', function () {
								$('#headerSearchButton').prop('disabled', this.value == "" ? true : false);
							});
						});
					
				</script>

				<ul class="nav navbar-nav navbar-right menuItems" role="list" aria-label="<?php print _t("Primary Navigation"); ?>">
				<li <?php print (strToLower($this->request->getController()) == "front") ? 'class="active"' : ''; ?>><?php print caNavLink($this->request, _t("Home"), "", "", "", ""); ?></li>
					<li <?php print (strToLower($this->request->getController()) == "Browse") && ((strToLower($this->request->getAction()) == "collections")) ? 'class="active"' : ''; ?>><?php print caNavLink($this->request, _t("Projects"), "", "", "Browse", "collections"); ?></li>
					<li <?php print (strToLower($this->request->getController()) == "Browse") && ((strToLower($this->request->getAction()) == "labs")) ? 'class="active"' : ''; ?>><?php print caNavLink($this->request, _t("Labs"), "", "", "Browse", "labs"); ?></li>
					<li <?php print (strToLower($this->request->getController()) == "Browse") && ((strToLower($this->request->getAction()) == "entities")) ? 'class="active"' : ''; ?>><?php print caNavLink($this->request, _t("Participants"), "", "", "Browse", "participants"); ?></li>				
					<li <?php print (strToLower($this->request->getController()) == "Browse") && ((strToLower($this->request->getAction()) == "objects")) ? 'class="active"' : ''; ?>><?php print caNavLink($this->request, _t("Resources"), "", "", "Browse", "objects"); ?></li>				
					<li><?= caNavLink($this->request, _t("Collected Works"), "", "", "CollectedWorks", "Index"); ?></li>

				</ul>
			</div><!-- /.navbar-collapse -->
		</div><!-- end container -->
	</nav>
	<div class="container"><div class="row"><div class="col-xs-12">
		<div role="main" id="main"><div id="pageArea" <?php print caGetPageCSSClasses(); ?>>

