<?php
/* ----------------------------------------------------------------------
 * themes/default/views/bundles/ca_collections_default_html.php : 
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

$t_item = $this->getVar("item");
$va_comments = $this->getVar("comments");
$vn_comments_enabled = 	$this->getVar("commentsEnabled");
$vn_share_enabled = 	$this->getVar("shareEnabled");
$vn_pdf_enabled = 		$this->getVar("pdfEnabled");

# --- get collections configuration
$o_collections_config = caGetCollectionsConfig();
$vb_show_hierarchy_viewer = true;
if ($o_collections_config->get("do_not_display_collection_browser")) {
	$vb_show_hierarchy_viewer = false;
}
# --- get the collection hierarchy parent to use for exportin finding aid
$vn_top_level_collection_id = array_shift($t_item->get('ca_collections.hierarchy.collection_id', array("returnWithStructure" => true)));

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
					<H1>{{{^ca_collections.preferred_labels.name}}}</H1>
					<H2>{{{^ca_collections.type_id}}}{{{<ifdef code="ca_collections.idno">, ^ca_collections.idno</ifdef>}}}</H2>
					{{{<ifdef code="ca_collections.parent_id"><div class="unit">Part of: <unit relativeTo="ca_collections.hierarchy" delimiter=" &gt; "><l>^ca_collections.preferred_labels.name</l></unit></div></ifdef>}}}
					<?php
					if ($vn_pdf_enabled) {
						print "<div class='exportCollection'><span class='glyphicon glyphicon-file' aria-label='" . _t("Download") . "'></span> " . caDetailLink($this->request, "Download as PDF", "", "ca_collections",  $vn_top_level_collection_id, array('view' => 'pdf', 'export_format' => '_pdf_ca_collections_summary')) . "</div>";
					}
					?>
				</div><!-- end col -->
			</div><!-- end row -->

			<h1>Locations of Related Objects</h1>

			<div id="map" style="height: 180px;"></div>
			<div class="row">

				<div class='col-sm-12'>
					<?php
					if ($vb_show_hierarchy_viewer) {
					?>
						<div id="collectionHierarchy"><?php print caBusyIndicatorIcon($this->request) . ' ' . addslashes(_t('Loading...')); ?></div>
						<script>
							$(document).ready(function() {
								$('#collectionHierarchy').load("<?php print caNavUrl($this->request, '', 'Collections', 'collectionHierarchy', array('collection_id' => $t_item->get('collection_id'))); ?>");
							})
						</script>
					<?php
					}
					?>
				</div><!-- end col -->
			</div><!-- end row -->


			<div class="row">
				<div class='col-md-6 col-lg-6'>
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
				</div><!-- end col -->
				<div class='col-md-6 col-lg-6'>
					{{{<ifcount code="ca_collections.related" min="1" max="1"><label>Related collection</label></ifcount>}}}
					{{{<ifcount code="ca_collections.related" min="2"><label>Related collections</label></ifcount>}}}
					{{{<unit relativeTo="ca_collections" delimiter="<br/>"><l>^ca_collections.related.preferred_labels.name</l> ^relationship_typename</unit>}}}

					{{{<ifcount code="ca_entities" min="1" max="1"><label>Related person</label></ifcount>}}}
					{{{<ifcount code="ca_entities" min="2"><label>Related people</label></ifcount>}}}
					{{{<unit relativeTo="ca_entities" delimiter="<br/>"><l>^ca_entities.preferred_labels.displayname</l> ^relationship_typename</unit>}}}

					{{{<ifcount code="ca_occurrences" min="1" max="1"><label>Related occurrence</label></ifcount>}}}
					{{{<ifcount code="ca_occurrences" min="2"><label>Related occurrences</label></ifcount>}}}
					{{{<unit relativeTo="ca_occurrences" delimiter="<br/>"><l>^ca_occurrences.preferred_labels.name</l> ^relationship_typename</unit>}}}

					{{{<ifcount code="ca_places" min="1" max="1"><label>Related place</label></ifcount>}}}
					{{{<ifcount code="ca_places" min="2"><label>Related places</label></ifcount>}}}
					{{{<unit relativeTo="ca_places" delimiter="<br/>"><l>^ca_places.preferred_labels.name</l> ^relationship_typename</unit>}}}
				</div><!-- end col -->
			</div><!-- end row -->
			{{{<ifcount code="ca_objects" min="2">
                <div class="row">
                    <div id="browseResultsContainer">
                        <?php print caBusyIndicatorIcon($this->request) . ' ' . addslashes(_t('Loading...')); ?>
                    </div>
                </div>
                <script type="text/javascript">
                    jQuery(document).ready(function() {
                        jQuery("#browseResultsContainer").load("<?php print caNavUrl($this->request, '', 'Search', 'objects', array('search' => 'collection_id:^ca_collections.collection_id'), array('dontURLEncodeParameters' => true)); ?>", function() {
                            jQuery('#browseResultsContainer').jscroll({
                                autoTrigger: true,
                                loadingHtml: '<?php print caBusyIndicatorIcon($this->request) . ' ' . addslashes(_t('Loading...')); ?>',
                                padding: 20,
                                nextSelector: 'a.jscroll-next'
                            });
                            // Fetch and update georeference information
                            updateGeoreferenceInfo();
                        });
                    });
                </script>				
            </ifcount>}}}

			<script>
				var map = L.map('map').setView([39.925533, 32.866287], 10);
				L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
					maxZoom: 19,
					attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
				}).addTo(map);

				function updateGeoreferenceInfo() {

					var markerCoordinates = [];

					// Iterate over each result container
					jQuery('#browseResultsContainer .bResultItemCol').each(function() {
						var $resultContainer = jQuery(this);
						var objectId = $resultContainer.find('.bResultItemText a:first').attr('href').match(/\/objects\/(\d+)/)[1];
						var preferredLabel = $resultContainer.find('.bResultItemText a:last').text();
						var idno = $resultContainer.find('.bResultItemText a:first').text();

						// Make an AJAX request to fetch the object detail page
						jQuery.ajax({
							url: 'http://172.24.20.211/ifrepo/index.php/Detail/objects/' + objectId,
							method: 'GET',
							success: function(data) {

								// Extract pointListmap information
								var pointListmapRegex = /var pointListmap = (\{[^;]*\});/;
								var pointListmapMatch = data.match(pointListmapRegex);

								if (pointListmapMatch) {
									// Parse the JSON data
									var pointListmapData = JSON.parse(pointListmapMatch[1]);

									// Log pointListmap information
									console.log('PointListmap Data for Object ID:', objectId, pointListmapData);

									var label = pointListmapData._default_[0].label;
									console.log('Label for Object ID:', objectId, idno, preferredLabel, label);
									if (!pointListmapData || !pointListmapData._default_ || pointListmapData._default_.length === 0) {
										console.log('PointListmap data not found for Object ID:', objectId);
										return;
									}
									// Extract coordinates from the label
									var coordinates = label.split(',');

									var lat = parseFloat(coordinates[0]);
									var lon = parseFloat(coordinates[1]);
									console.log(lat, lon);

									var popupContent = "<a href='http://172.24.20.211/ifrepo/index.php/Detail/objects/" + objectId + "'> ID: " + idno + "<br>Title: " + preferredLabel + "</a>";
                        var marker = L.marker([lat, lon]).addTo(map);
                        marker.bindPopup(popupContent);

                        // Add coordinates to the array
                        markerCoordinates.push([lat, lon]);

                    } else {
                        console.error('PointListmap data not found for Object ID:', objectId);
                    }

                    // Update map view to center on the markers
                    if (markerCoordinates.length > 0) {
                        var bounds = L.latLngBounds(markerCoordinates);
                        map.fitBounds(bounds);
                    }
                },
							error: function() {
								console.error('Error fetching data for Object ID:', objectId);
							}
						});
					});
				}
			</script>

		   </div><!-- end container -->
	      </div><!-- end col -->
	      <div class='navLeftRight col-xs-1 col-sm-1 col-md-1 col-lg-1'>
		  <div class="detailNavBgRight">
			{{{nextLink}}}
		</div><!-- end detailNavBgLeft -->
	</div><!-- end col -->
</div><!-- end row -->