<?php
/* ----------------------------------------------------------------------
 * themes/default/views/bundles/ca_placess_default_html.php : 
 * ----------------------------------------------------------------------
 * CollectiveAccess
 * Open-source collections management software
 * ----------------------------------------------------------------------
 *
 * Software by Whirl-i-Gig (http://www.whirl-i-gig.com)
 * Copyright 2013-2022 Whirl-i-Gig
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

use function PHPUnit\Framework\isType;

$t_item = $this->getVar("item");
$va_comments = $this->getVar("comments");
$vn_comments_enabled = 	$this->getVar("commentsEnabled");
$vn_share_enabled = 	$this->getVar("shareEnabled");
?>
<div class="row">
	<div class='col-xs-12 navTop'><!--- only shown at small screen size -->
		{{{previousLink}}}{{{resultsLink}}}{{{nextLink}}}
	</div><!-- end detailTop -->
	<div class='navLeftRight col-xs-1 col-sm-1 col-md-1 col-lg-1'>
		<div class="detailNavBgLeft">
			{{{previousLink}}}{{{resultsLink}}}
		</div><!-- end detailNavBgLeft -->
	</div><!-- end col -->
	<div class='col-xs-12 col-sm-10 col-md-10 col-lg-10'>
		<div class="container">
			<div class="row">
				<div class='col-md-12 col-lg-12'>
					<H1>{{{<unit relativeTo="ca_places.hierarchy" delimiter=" &gt; "> <l>^ca_places.preferred_labels.name</l></unit>}}}</H1>

					<H2>{{{^ca_places.type_id}}}</H2>
					{{{<ifdef code="ca_places.description"><label>About</label>^ca_places.description<br/></ifdef>}}}

					<?php 
					
					$type_id = $t_item->get("ca_places.type_id");
					$o_search = new Db();
					$q_lists = $o_search->query("select idno from ca_list_items where item_id = ?", $type_id);
					while ($q_lists->nextRow()){
						$idno = $q_lists->get("ca_list_items.idno");
					}
					
					# TODO: create a most precise way to define zoom accordingly with the type of place

					if ($idno == "country"){
						$zoomlevel = 5;
					}
					elseif ($idno == "region"){
						$zoomlevel = 7;
					}
					elseif ($idno == "city"){
						$zoomlevel = 12;
					}
					else{
						$zoomlevel = 16;
					}

					?>
				</div><!-- end col -->
			</div><!-- end row -->
			<div class="row">
					<div id="map" style="height: 400px">
					<div id="expandButton" style="position: relative; top: 100px; left: 10px; z-index: 1000;">
  					<i class="fas fa-expand" style="font-size: 20px; cursor: pointer;"></i>
					</div>
					</div>

					<?php
					# Comment and Share Tools
					if ($vn_comments_enabled | $vn_share_enabled) {

						print '<div id="detailTools">';
						if ($vn_comments_enabled) {
					?>
							<div class="detailTool"><a href='#' onclick='jQuery("#detailComments").slideToggle(); return false;'><span class="glyphicon glyphicon-comment" aria-label="<?php print _t("Comments and tags"); ?>"></span>Comments (<?php print sizeof($va_comments); ?>)</a></div><!-- end detailTool -->
							<div id='detailComments'><?php print $this->getVar("itemComments"); ?></div><!-- end itemComments -->
					<?php
						}
						if ($vn_share_enabled) {
							print '<div class="detailTool"><span class="glyphicon glyphicon-share-alt" aria-label="' . _t("Share") . '"></span>' . $this->getVar("shareLink") . '</div><!-- end detailTool -->';
						}
						print '</div><!-- end detailTools -->';
					}
					?>

				

				<div class='col-md-6 col-lg-6'>
					{{{<ifcount code="ca_collections" min="1" max="1"><label>Related collection</label></ifcount>}}}
					{{{<ifcount code="ca_collections" min="2"><label>Related collections</label></ifcount>}}}
					{{{<unit relativeTo="ca_collections" delimiter="<br/>"><l>^ca_collections.preferred_labels.name</l> (^relationship_typename)</unit>}}}

					{{{<ifcount code="ca_entities" min="1" max="1"><label>Related person</label></ifcount>}}}
					{{{<ifcount code="ca_entities" min="2"><label>Related people</label></ifcount>}}}
					{{{<unit relativeTo="ca_entities" delimiter="<br/>"><l>^ca_entities.preferred_labels.displayname</l> (^relationship_typename)</unit>}}}

					{{{<ifcount code="ca_occurrences" min="1" max="1"><label>Related occurrence</label></ifcount>}}}
					{{{<ifcount code="ca_occurrences" min="2"><label>Related occurrences</label></ifcount>}}}
					{{{<unit relativeTo="ca_occurrences" delimiter="<br/>"><l>^ca_occurrences.preferred_labels.name</l> (^relationship_typename)</unit>}}}

				</div><!-- end col -->
			</div><!-- end row -->

			{{{<ifcount code="ca_objects" min="1">
						<div class="row">
						<div class="col-sm-12">
					<br/><label>Related Archival Item<ifcount code="ca_objects" min="2">s</ifcount></label>
				   </div>
				   </div>
							<div id="browseResultsContainer">
								
					<?php print caBusyIndicatorIcon($this->request) . ' ' . addslashes(_t('Loading...')); ?>
							</div><!-- end browseResultsContainer -->
						</div><!-- end row -->
				<script type="text/javascript">
				jQuery(document).ready(function() {
					jQuery("#browseResultsContainer").load("<?php print caNavUrl($this->request, '', 'Search', 'objects', array('search' => 'place_id:^ca_places.place_id'), array('dontURLEncodeParameters' => true)); ?>", function() {
						jQuery('#browseResultsContainer').jscroll({
							autoTrigger: true,
							loadingHtml: '<?php print caBusyIndicatorIcon($this->request) . ' ' . addslashes(_t('Loading...')); ?>',
							padding: 20,
							nextSelector: 'a.jscroll-next'
						});
					});
					
					
				});
			</script>
            </ifcount>}}}

			<!-- SetView should change related to objects location or place type. E.g. larger area for country smaller area for city.
                Currently it changes view depending on place type id.
                I add the alternatif script in which setView changes depending on the locations in the end of the original script-->
			<script>
				// CUSTOM LEAFLET SCRIPT

				var map = L.map('map').setView([0, 0], 10);
				L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
					maxZoom: 19,
					attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
				}).addTo(map);


				var georeferences = <?php print json_encode($t_item->get('ca_objects.related.georeference')); ?>;
				var titles = <?php print json_encode(explode(";", $t_item->get('ca_objects.related.preferred_labels'))); ?>;
				var objid = <?php print json_encode(explode(";", $t_item->get('ca_objects.related.idno'))); ?>;
				var caid = <?php print json_encode(explode(";", $t_item->get('ca_objects.related.object_id'))); ?>;
				var placeTypes = <?php print json_encode(explode(";", $t_item->get('ca_places.type_id'))); ?>;

				// Split the georeference string into an array of coordinates
				var coordinatesArray = georeferences.split(';');

				// Initialize min and max values for latitude and longitude
				var minLat = 90,
					maxLat = -90,
					minLon = 180,
					maxLon = -180;

				coordinatesArray.forEach(function(coordinate, index) {
					// Split the coordinate into latitude and longitude
					var [lat, lon] = coordinate.replace('[', '').replace(']', '').split(',');

					// Convert string values to numbers
					lat = parseFloat(lat);
					lon = parseFloat(lon);

					// Update min and max values
					minLat = Math.min(minLat, lat);
					maxLat = Math.max(maxLat, lat);
					minLon = Math.min(minLon, lon);
					maxLon = Math.max(maxLon, lon);

					// Get the title, place type, and other information for the current object
					var title = titles[index];
					var obj = objid[index];
					var ca = caid[index];
					var placeType = placeTypes[index];

					// Customize the popup content with the retrieved title and place type
					var popupContent = "<a href='http://172.24.20.211/ifrepo/index.php/Detail/objects/" + ca + "'>ID: " + obj + "<br>Title: " + title + "</a>";
					var marker = L.marker([lat, lon]).addTo(map);
					marker.bindPopup(popupContent);
				});

				document.getElementById('expandButton').addEventListener('click', function () {
					// Reset the map to the original fitBounds zoom level
					map.fitBounds(bounds);
				});

				// Calculate the center and zoom level based on the bounding box
				var bounds = L.latLngBounds(L.latLng(minLat, minLon), L.latLng(maxLat, maxLon));

				// map.fitBounds(bounds, { padding: [50, 50] });

				var zoomlevel = <?php print $zoomlevel; ?>

				map.setView(bounds.getCenter(), zoomlevel);
			</script>

		</div><!-- end container -->
	</div><!-- end row -->
	<div class='navLeftRight col-xs-1 col-sm-1 col-md-1 col-lg-1'>
		<div class="detailNavBgRight">
			{{{nextLink}}}
		</div><!-- end detailNavBgLeft -->
	</div><!-- end col -->
</div><!-- end row -->