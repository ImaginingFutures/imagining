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
						<div class="line2">Imagining Futures<br/> Repository</div>
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
		<a href="https://imaginingfutures.world/imagining-futures-overview/" class="btn btn-outline-dark btn-lg">More <i class="fas fa-angle-double-right"></i></a>
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
				<a href=<?php print caNavUrl($this->request, "Browse", "collections", "") ?>>
				<?php print caGetThemeGraphic($this->request, 'projects_thumbnail.jpg', array('alt' => "Imagining Futures, Trough Un/Archived Pasts", 'class' => "card-img-top")); ?></a>
				</div>
			<div class="card-body">
			<?php print caNavLink($this->request, "<h3 class='card-title'>Projects</h3>", "card-title-link", "", "Browse", "collections"); ?>
  			</div>
            </div>
        </div>

        <!-- Card 2 -->
        <div class="col-sm-4">
            <div class="card">
			<div class="card-img-top-container">
			<a href=<?php print caNavUrl($this->request, "Browse", "participants", "") ?>>
			<?php print caGetThemeGraphic($this->request, 'people_thumbnail.jpg', array('alt' => "Imagining Futures, Trough Un/Archived Pasts", 'class' => "card-img-top")); ?></a>
			</div>
			<div class="card-body">
    		<?php print caNavLink($this->request, "<h3 class='card-title'>People</h3>", "card-title-link", "", "Browse", "participants"); ?>
			
  			</div>
            </div>
        </div>
        <!-- Card 3 -->
        <div class="col-sm-4">
            <div class="card">
			<div class="card-img-top-container">
			<a href=<?php print caNavUrl($this->request, "Browse", "objects", "") ?>>
			<?php print caGetThemeGraphic($this->request, 'resources_thumbnail.jpg', array('alt' => "Imagining Futures, Trough Un/Archived Pasts", 'class' => "card-img-top")); ?></a>
			</div>
			<div class="card-body">
    		<?php print caNavLink($this->request, "<h3 class='card-title'>Resources</h3>", "card-title-link", "", "Browse", "objects"); ?>
  			</div>
            </div>
        </div>
    </div>
	
</div>
