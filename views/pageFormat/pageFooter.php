<?php
/* ----------------------------------------------------------------------
 * views/pageFormat/pageFooter.php : 
 * ----------------------------------------------------------------------
 * CollectiveAccess
 * Open-source collections management software
 * ----------------------------------------------------------------------
 *
 * Software by Whirl-i-Gig (http://www.whirl-i-gig.com)
 * Copyright 2015-2018 Whirl-i-Gig
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
?>
		<div style="clear:both; height:1px;"><!-- empty --></div>
		</div><!-- end pageArea --></div><!-- end main --></div><!-- end col --></div><!-- end row --></div><!-- end container -->
		<footer id="footer">
			<div class="container">
				<div class="row">
					<div class="col-sm-12 col-md-4">
					<p><a href="https://imaginingfutures.world/" target="_blank"><?php print caGetThemeGraphic($this->request, 'logo-one-line-light-bg.webp', array('alt' => "Imagining Futures, Trough Un/Archived Pasts")); ?></a></p>
					<br/><b><i class="fas fa-envelope"></i> <a href="mailto:admin@ifrepo.world">admin@ifrepo.world</a></b>	
					<br/><b><i class="fas fa-envelope"></i> <a href="mailto:imaginingfutures@exeter.ac.uk">imaginingfutures@exeter.ac.uk</a></b>
					</div>

					<div class="col-sm-12 col-md-4">
						<dl class="nav-list">
						<dt>About</dt> <!-- You can style this header as needed -->
						<!-- <dd><a href="#">Team</a></dd> -->
						<dd><?= caNavLink($this->request, _t("Repository Policies"), "", "", "About", "policies"); ?></dd>
						<dd><?= caNavLink($this->request, _t("Privacy Policy"), "", "", "About", "privacy"); ?></dd>
						<dd><?= caNavLink($this->request, _t("Image Credits"), "", "", "About", "credits"); ?></dd>
						<!-- <dd><a href="#">Overview</a></dd>
						<dd><a href="#">Labs</a></dd> -->
						</dl>
					</div>

					<div class="col-sm-12 col-md-4">
						<p>The Imagining Futures Repository is co-funded by the <a href="https://ugleventisrc.com" target="_blank">Digital Leventis Resource Centre</a> and the Arts and Humanities Research Council's GCRF Network+, funded by UKRI.</p>
						<div class="main-logo">
						<a href="https://ugleventisrc.com" target="_blank">
								<?php print caGetThemeGraphic($this->request, 'LDRC_logo_2024.webp', array('alt' => " A. G. Leventis Digital Resource Centre for African Culture (LDRC)")); ?>
 						</a>
						</div>
						<div id="footerLogos" class="d-flex flex-wrap justify-content-between align-items-center">
							
							<a href="https://www.ukri.org/councils/ahrc/" target="_blank" class="footer-logo">
								<img src="https://imaginingfutures.world/wp-content/uploads/2021/02/footer-logo-ukri.png" alt="UK Research and Innovation" class="img-fluid">
							</a>
							<a href="https://www.ukri.org/what-we-do/our-main-funds-and-areas-of-support/browse-our-areas-of-investment-and-support/global-challenges-research-fund/" target="_blank" class="footer-logo">
								<img src="https://imaginingfutures.world/wp-content/uploads/2021/02/footer-logo-gcrf.png" alt="Global Challenges Research Fund" class="img-fluid">
							</a>
							<a href="https://www.exeter.ac.uk/" target="_blank" class="footer-logo">
								<img src="https://imaginingfutures.world/wp-content/uploads/2021/02/footer_logo_exeter.png" alt="University of Exeter" class="img-fluid">
							</a>
						</div>
						<div class="social-media-links">
						<a href="https://github.com/ImaginingFutures/" target="_blank" title="Follow us on GitHub">
							<i class="fab fa-github"></i>
						</a>

						<a href="https://www.youtube.com/channel/UCK0xrPfEPqbSE79-BxtmBGQ" target="_blank" title="Subscribe to our YouTube channel">
							<i class="fab fa-youtube"></i>
						</a>

						<a href="https://twitter.com/imaginesfutures" target="_blank" title="Follow us on Twitter">
							<i class="fab fa-twitter"></i>
						</a>
						</div>

					</div>


				</div>
				<div class="row">
				<p><span class="text-muted version">Repository Version: 1.3.14 [19-06-2024]</span></p>
				</div>
			</div>
		</footer><!-- end footer -->
<?php
	//
	// Output HTML for debug bar
	//
	if(Debug::isEnabled()) {
		print Debug::$bar->getJavascriptRenderer()->render();
	}
?>
	
		<?php print TooltipManager::getLoadHTML(); ?>
		<div id="caMediaPanel"> 
			<div id="caMediaPanelContentArea">
			
			</div>
		</div>

		<!-- Tooltip and Select2 scripts -->
		<script>
			$(document).ready(function(){
		$('[data-toggle="tooltip"]').tooltip();   
		});

		</script>




		<script type="text/javascript">
			/*
				Set up the "caMediaPanel" panel that will be triggered by links in object detail
				Note that the actual <div>'s implementing the panel are located here in views/pageFormat/pageFooter.php
			*/
			var caMediaPanel;
			jQuery(document).ready(function() {
				if (caUI.initPanel) {
					caMediaPanel = caUI.initPanel({ 
						panelID: 'caMediaPanel',										/* DOM ID of the <div> enclosing the panel */
						panelContentID: 'caMediaPanelContentArea',		/* DOM ID of the content area <div> in the panel */
						exposeBackgroundColor: '#FFFFFF',						/* color (in hex notation) of background masking out page content; include the leading '#' in the color spec */
						exposeBackgroundOpacity: 0.7,							/* opacity of background color masking out page content; 1.0 is opaque */
						panelTransitionSpeed: 400, 									/* time it takes the panel to fade in/out in milliseconds */
						allowMobileSafariZooming: true,
						mobileSafariViewportTagID: '_msafari_viewport',
						closeButtonSelector: '.close'					/* anything with the CSS classname "close" will trigger the panel to close */
					});
				}
			});
			/*(function(e,d,b){var a=0;var f=null;var c={x:0,y:0};e("[data-toggle]").closest("li").on("mouseenter",function(g){if(f){f.removeClass("open")}d.clearTimeout(a);f=e(this);a=d.setTimeout(function(){f.addClass("open")},b)}).on("mousemove",function(g){if(Math.abs(c.x-g.ScreenX)>4||Math.abs(c.y-g.ScreenY)>4){c.x=g.ScreenX;c.y=g.ScreenY;return}if(f.hasClass("open")){return}d.clearTimeout(a);a=d.setTimeout(function(){f.addClass("open")},b)}).on("mouseleave",function(g){d.clearTimeout(a);f=e(this);a=d.setTimeout(function(){f.removeClass("open")},b)})})(jQuery,window,200);*/
		</script>

		<?php
			print $this->render("Cookies/banner_html.php");	
		?>
	</body>
</html>
