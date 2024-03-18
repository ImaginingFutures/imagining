<?php
/** ---------------------------------------------------------------------
 * themes/default/Front/front_page_html : Front page of site 
 * ----------------------------------------------------------------------
 * CollectiveAccess
 * Open-source collections management software
 * ----------------------------------------------------------------------
 *
 * Software by Whirl-i-Gig (http://www.whirl-i-gig.com)
 * Copyright 2013 Whirl-i-Gig
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
 * @package CollectiveAccess
 * @subpackage Core
 * @license http://www.gnu.org/copyleft/gpl.html GNU Public License version 3
 *
 * ----------------------------------------------------------------------
 */
	$va_access_values = $this->getVar("access_values");
	$vs_hero = $this->request->getParameter("hero", pString);
	if(!$vs_hero){
 		$vs_hero = rand(1, 1);
	}
?>

<div class="parallax hero<?php print $vs_hero; ?>">
	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-md-8 col-md-offset-2 col-lg-6 col-lg-offset-3">
				
				<div class="heroSearch">
					<H1>
						<div class="line1">Welcome to</div>
						<div class="line2">Imagining Futures<br/> Repository (Pilot)</div>
					</H1>
					<form role="search" action="<?php print caNavUrl($this->request, '', 'MultiSearch', 'Index'); ?>">
						<div class="formOutline">
							<div class="form-group">
								<input type="text" class="form-control" id="heroSearchInput" placeholder="<?php print _t("Search"); ?>" name="search" autocomplete="off" aria-label="<?php print _t("Search"); ?>" />
							</div>
							<button type="submit" class="btn-search" id="heroSearchButton"><i class="fas fa-search" aria-label="<?php print _t("Submit Search"); ?>"></i></button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<!-- Attribution div -->
	<div class="image-attribution">
	<a href="#" data-toggle="modal" data-target="#attributionModal"><i>Fashion of Resistance</i></a> Manu Luksch © 2023. <p xmlns:cc="http://creativecommons.org/ns#" >This work is openly licensed under <a href="http://creativecommons.org/licenses/by/4.0/?ref=chooser-v1" target="_blank" rel="license noopener noreferrer" style="display:inline-block;">CC BY 4.0<img style="height:22px!important;margin-left:3px;vertical-align:text-bottom;" src="https://mirrors.creativecommons.org/presskit/icons/cc.svg?ref=chooser-v1"><img style="height:22px!important;margin-left:3px;vertical-align:text-bottom;" src="https://mirrors.creativecommons.org/presskit/icons/by.svg?ref=chooser-v1"></a></p>
	</div>
</div>

<!-- Description -->
<div class="container description-container">
	<div class="row">
		<div class="col-md-4 col-lg-3">
			<div class="hpCallout">Who decides what gets to be remembered into the future, and to shape it?</div>
		</div>
		<div class="col-md-8">
			<div class="description">
		We draw on the widest meaning of archive by including documents, material remains and creations, landscapes, oral transmissions, song, bodily movements, daily customs and ancestral laws. Join us in our aim is to build methodologies of egalitarian archiving practices that allow for co-existence and recognition of multiple experiences and narratives of the past that challenge a singular ‘we’.
		</div>
		</div>
	</div>
	<div class="row">
	<div class="home-more-btn">
		<a href="https://imaginingfutures.world/imagining-futures-overview/" class="btn btn-outline-dark btn-lg">More <i class="far fa-plus-square"></i></a>
		</div>
	</div>
</div>
<div class="container">
	<div class="row">
	<div class="col-md-12">
            <div class="explore-header"><h1>Explore</h1></div>
        </div>
	</div>
	<div class="row explore-cards">
        <!-- Card 1 -->
        <div class="col-sm-4">
            <div class="card">
				<div class="card-img-top-container">
				<?php print caGetThemeGraphic($this->request, 'projects_thumbnail.jpg', array('alt' => "Imagining Futures, Trough Un/Archived Pasts", 'class' => "card-img-top")); ?>
				</div>
			<div class="card-body">
			<?php print caNavLink($this->request, "<h3 class='card-title'>Projects</h3>", "", "", "Collections", "index"); ?>
    		
  			</div>
            </div>
        </div>
        <!-- Card 2 -->
        <div class="col-sm-4">
            <div class="card">
			<div class="card-img-top-container">
			<?php print caGetThemeGraphic($this->request, 'people_thumbnail.jpg', array('alt' => "Imagining Futures, Trough Un/Archived Pasts", 'class' => "card-img-top")); ?>
			</div>
			<div class="card-body">
    		<?php print caNavLink($this->request, "<h3 class='card-title'>People</h3>", "", "", "Browse", "participants"); ?>
  			</div>
            </div>
        </div>
        <!-- Card 3 -->
        <div class="col-sm-4">
            <div class="card">
			<div class="card-img-top-container">
			<?php print caGetThemeGraphic($this->request, 'resources_thumbnail.jpg', array('alt' => "Imagining Futures, Trough Un/Archived Pasts", 'class' => "card-img-top")); ?>
			</div>
			<div class="card-body">
    		<?php print caNavLink($this->request, "<h3 class='card-title'>Resources</h3>", "", "", "Browse", "objects"); ?>
  			</div>
            </div>
        </div>
    </div>
	
</div>

	<!-- attribution modal -->
	<div class="modal fade" id="attributionModal" tabindex="-1" role="dialog" aria-labelledby="attributionModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="attributionModalLabel">Fashion of Resistance</h4>
      </div>
      <div class="modal-body">
        <p><strong>Concept costume, digital video, 2023</strong></p>
        <p>Conceived by Manu Luksch as part of <a href="https://artefactsofresistance.org/" target="_blank"><i>Artefacts of Resistance: Creating Archives of Transnational Protest Movements</i></a> - a collaboration with Srilata Sircar (India Institute, King’s College London), Ufaque Paikar (Ashoka University), Mukul Patel (Royal College of Art), and Raktim Ray (University College London).</p>
		<p><strong>Photo document ‘Shaheen Bagh’:</strong> Apeksha Priyadarshini.</p>
		<p><strong>Hand-balance performance:</strong> Natalie Reckert.</p>
      </div>
    </div>
  </div>
</div>


		<script type="text/javascript">
			$(document).ready(function(){
				$(window).scroll(function(){
					$("#hpScrollBar").fadeOut();
				});
			});
		</script>