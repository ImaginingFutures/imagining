<?php
/* ----------------------------------------------------------------------
 * themes/default/views/bundles/ca_objects_default_html.php : 
 * ----------------------------------------------------------------------
 * CollectiveAccess
 * Open-source collections management software
 * ----------------------------------------------------------------------
 *
 * Software by Whirl-i-Gig (http://www.whirl-i-gig.com)
 * Copyright 2013-2018 Whirl-i-Gig
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

$t_object = 			$this->getVar("item");
$va_comments = 			$this->getVar("comments");
$va_tags = 				$this->getVar("tags_array");
$vn_comments_enabled = 	$this->getVar("commentsEnabled");
$vn_share_enabled = 	$this->getVar("shareEnabled");
$vn_pdf_enabled = 		$this->getVar("pdfEnabled");
$vn_id =				$t_object->get('ca_objects.object_id');
$va_access_values = caGetUserAccessValues($this->request);

require_once(__CA_THEMES_DIR__ . "/imagining/views/Details/data/rightsstatement.php");
require_once(__CA_THEMES_DIR__ . "/imagining/views/Details/data/cite.php");
require_once(__CA_THEMES_DIR__ . "/imagining/views/Details/data/external_resources.php");

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
				<?php

				$media_access = $t_object->get('ca_object_representations.access');

				$no_media_placeholder = "<div class='repViewerNoCont'>" . caGetThemeGraphic($this->request, 'media-.webp') . "</div>";

				if ($media_access === '1') {
					echo "{{{representationViewer}}}";
					echo "</div>";
					echo "
						<div class='panel panel-default'>
						<div class='panel-heading'>
							<h5>Media information
							<button id='togglePanel' data-toggle='tooltip' data-placement='top' title='Media info' class='icon-button'>
							<i id='toggleIcon' class='fas fa-chevron-down'></i></h5>
						</button>
							</button>
						</div>
						<div class='panel-body' id='panelContent'>
							<!-- Content to be shown/hidden goes here -->
							<!-- Content and Scope -->
							
							{{{
							<ifdef code='ca_object_representations.media_class'><div class='unit'><unit relativeTo='ca_object_representations.media_class' delimiter='<br/>'><b>Format:</b> ^ca_object_representations.media_class</unit></div></ifdef>
							}}}
							{{{
							<ifdef code='ca_object_representations.media_filesize'><div class='unit'><unit relativeTo='ca_object_representations.media_filesize' delimiter='<br/>'><b>Extent:</b> ^ca_object_representations.media_filesize</unit></div></ifdef>
							}}}";

					$media_format = $t_object->get('ca_object_representations.media_format');
					
					if ($media_format != 'PDF') {
						echo '{{{<ifcode code=\'ca_object_representations.media_dimensions\'><div class=\'unit\'><unit relativeTo=\'ca_object_representations.media_dimensions\' delimiter=\'<br/>\'><b>Media dimensions:</b> ^ca_object_representations.media_dimensions</unit></div></ifcode>}}}';
					} elseif ($media_format == 'PDF') {
						echo '{{{<ifcode code=\'ca_object_representations.page_count\'><div class=\'unit\'><unit relativeTo=\'ca_object_representations.page_count\' delimiter=\'<br/>\'><b>Pages:</b> ^ca_object_representations.page_count</unit></div></ifcode>}}}';
					}

					echo "{{{
							<ifcode code='ca_object_representations.media_format'><div class='unit'><unit relativeTo='ca_object_representations.media_format' delimiter='<br/>'><b>Media format:</b> ^ca_object_representations.media_format</unit></div></ifcode>
						}}}
						</div>
					</div>
						";
				} elseif ($media_access === '0') {
					echo $no_media_placeholder;
				} else {
					$external_media = $t_object->get('ca_objects.exlink.exlink_url');

					// get the embed code
					$embed_media = get_embed_html($external_media);
					if ($embed_media) {
						echo "<div class='repViewerExtCont'>";
						echo $embed_media;
						echo "</div>";
						echo "
						<div class='panel panel-default no-media-panel'>
						<div class='panel-heading'>
							<h5>Media information
							<button id='togglePanel' data-toggle='tooltip' data-placement='top' title='Media info' class='icon-button'>
							<i id='toggleIcon' class='fas fa-chevron-down'></i></h5>
						</button>
							</button>
						</div>
						<div class='panel-body' id='panelContent'>
						<b>External resource:</b> <a href='$external_media' target='_blank'>$external_media <i class='fas fa-external-link-alt'></i> </a>

						</div>
						</div>
							";
					} else {
						echo $no_media_placeholder;
					}
				}
				?>

				<!-- identifiers -->
				<HR>
				<div class="row">
					<H1>{{{ca_objects.preferred_labels.name}}}</H1>

					<div class='col-sm-6 col-md-6'>
						{{{
					<ifdef code="ca_objects.idno"><div class='unit'><label>Resource id:</label> ^ca_objects.idno</div></ifdef>
					<ifdef code="ca_objects.alternativetitle"><div class="unit">
					<ifdef code="ca_objects.ai"><button class="btn btn-warning btn-xs pull-left warning-translation-button" id="togglePanel" data-toggle="tooltip" data-placement="top" title="^ca_objects.ai">
                    <i class="fas fa-exclamation-triangle"></i>
					</button></ifdef>
					<label>Translated title:</label>^ca_objects.alternativetitle
					</div><HR></ifdef>
					}}}

						{{{<unit relativeTo="ca_collections" delimiter="<br/>"><label>Project:</label><l>^ca_collections.preferred_labels.name</l></unit><ifcount min="1" code="ca_collections"><HR></ifcount>}}}
						{{{
					<ifcount code="ca_objects.exlink.exlink_name" min="1"><div class="unit">
						<label>External Link:</label>
						<unit relativeTo="ca_objects.exlink.exlink_url" delimiter="<br/>">
							<a href="^ca_objects.exlink.exlink_url" delimiter="<br/>" target="_blank" class="url">
								<i class="fa fa-external-link" aria-hidden="true"></i>
								^ca_objects.exlink.exlink_name</a>
						</unit>
					</div></ifcount>
					}}}
						{{{
					<ifdef code="ca_objects.originalid"><div class="unit"><label>Local ID:</label>^ca_objects.originalid</div></ifdef>
					}}}

						<!-- end of identification labels -->

						<!-- Scope and Content -->

						{{{
					<ifdef code="ca_objects.description"><div class="unit"><label>Description:</label>^ca_objects.description</div></ifdef>
					}}}

						{{{<ifdef code="ca_objects.descriptionalt"><div class="unit">
					<ifdef code="ca_objects.ai"><button class="btn btn-warning btn-xs pull-left warning-translation-button" id="togglePanel" data-toggle="tooltip" data-placement="top" title="^ca_objects.ai">
                    <i class="fas fa-exclamation-triangle"></i>
					</button></ifdef>
					<label>Translated description:</label>^ca_objects.descriptionalt					
					</div><HR></ifdef>}}}

						{{{<ifcount code="ca_objects.primarylang" min="1"><div class="unit"><label>Primary Language:</label><unit relativeTo="ca_objects.primarylang" delimiter="<br/>">^ca_objects.primarylang</unit></div></ifcount>}}}
						{{{<ifcount code="ca_objects.otherlang" min="1"><div class="unit"><label>Other Language:</label><unit relativeTo="ca_objects.otherlang" delimiter="<br/>">^ca_objects.otherlang</unit></div></ifcount>}}}

						{{{
					<ifcount code="ca_list_items" restrictToRelationshipTypes="resource_type" min="1">    
						<label>Resource Type:</label>
							<unit relativeTo="ca_list_items" restrictToRelationshipTypes="resource_type" delimiter="</br>">   <l>^ca_list_items.preferred_labels.name_singular</l></unit><HR>
					</ifcount>
					}}}

											{{{
					<ifcount code="ca_list_items" restrictToRelationshipTypes="keyword" min="1">    
						<label>Keywords:</label>
							<unit relativeTo="ca_list_items" restrictToRelationshipTypes="keyword" delimiter="</br>">   <l>^ca_list_items.preferred_labels.name_singular</l></unit><HR>
					</ifcount>
					}}}

						{{{
					<ifdef code="ca_objects.notes"><div class="unit"><label>Notes:</label>^ca_objects.notes</div></ifdef>
					}}}
					
						<!-- end of Content and Scope labels -->

						<!-- Custom labels -->

						{{{<ifdef code="ca_objects.timeperiod">
					<div class="unit">
						<label>Time Period</label>
						<unit relativeTo="ca_objects.time_period" delimiter="<br/>">
							^ca_objects.time_period
						</unit>
					</div>
				</ifdef>}}}

						{{{<ifdef code="ca_objects.genre">
					<div class="unit">
						<label>Genre</label>
						<unit relativeTo="ca_objects.genre" delimiter="<br/>">
							^ca_objects.genre
						</unit>
					</div>
				</ifdef>}}}

						{{{<ifdef code="ca_objects.object">
					<div class="unit">
						<label>Objects</label>
						<unit relativeTo="ca_objects.object" delimiter="<br/>">
							^ca_objects.object
						</unit>
					</div>
				</ifdef>}}}

						{{{<ifdef code="ca_objects.slogan">
					<div class="unit">
						<label>Slogans</label>
						<unit relativeTo="ca_objects.slogan" delimiter="<br/>">
							^ca_objects.slogan
						</unit>
					</div>
				</ifdef>}}}

						{{{<ifdef code="ca_objects.pandemicevent">
					<div class="unit">
						<label>Pandemic Event</label>
						<unit relativeTo="ca_objects.pandemicevent" delimiter="<br/>">
							^ca_objects.pandemicevent
						</unit>
					</div>
				</ifdef>}}}

						{{{<ifdef code="ca_objects.setting">
					<div class="unit">
						<label>Setting</label>
						<unit relativeTo="ca_objects.setting" delimiter="<br/>">
							^ca_objects.setting
						</unit>
					</div>
				</ifdef>}}}

						{{{<ifdef code="ca_objects.emotion">
					<div class="unit">
						<label>Emotions</label>
						<unit relativeTo="ca_objects.emotion" delimiter="<br/>">
							^ca_objects.pandemicevent
						</unit>
					</div>
				</ifdef>}}}

						{{{<ifdef code="ca_objects.wayofliving">
					<div class="unit">
						<label>Way of Living</label>
						<unit relativeTo="ca_objects.wayofliving" delimiter="<br/>">
							^ca_objects.wayofliving
						</unit>
					</div>
					<HR>
				</ifdef>}}}

						<!-- end of Custom labels -->


					</div><!-- end col -->

					<div class='col-sm-1 col-md-2 col-lg-2'></div>

					<!-- end col -->


					<div class='col-sm-5 col-md-4 col-lg-4'>
						<!-- PID -->
						{{{
						<ifdef code="ca_objects.handle"><div class="unit"><label>URI:</label><a href ="^ca_objects.handle">^ca_objects.handle</a></div></ifdef>
						}}}
						<!-- Dates -->
						{{{<ifcount code="ca_objects.date_create" min="1"><div class="unit"><label>Creation Date:</label><unit relativeTo="ca_objects.date_create" delimiter="<br/>">^ca_objects.date_create</unit></div></ifcount>}}}
						{{{<ifcount code="ca_objects.date_digit" min="1"><div class="unit"><label>Digitization Date:</label><unit relativeTo="ca_objects.date_digit" delimiter="<br/>">^ca_objects.date_digit</unit></div></ifcount>}}}
						{{{<ifcount code="ca_objects.date_publish" min="1"><div class="unit"><label>Publication Date:</label><unit relativeTo="ca_objects.date_publish" delimiter="<br/>">^ca_objects.date_publish</unit></div></ifcount>}}}

						<!-- end of Dates labels -->

						<!-- Socio-cultural Context -->

						{{{
						<ifcount code="ca_objects.cultgroup" min="1"><div class="unit">
							<label>Cultural Group:</label>
							<unit relativeTo="ca_objects.cultgroup" delimiter="<br/>">
								^ca_objects.cultgroup
							</unit>
						</div></ifcount>
						}}}

												{{{
						<ifcount code="ca_list_items" restrictToRelationshipTypes="culturalcontext" min="1">    
						<label>Cultural Context:</label>
						<unit relativeTo="ca_list_items" restrictToRelationshipTypes="culturalcontext" delimiter="</br>">   <l>^ca_list_items.preferred_labels.name_singular</l></unit><HR>
						</ifcount>
						}}}

												{{{
						<ifcount code="ca_objects.socialgroup" min="1"><div class="unit">
							<label>Social Group:</label>
							<unit relativeTo="ca_objects.socialgroup" delimiter="<br/>">
								^ca_objects.socialgroup
							</unit>
						</div></ifcount>
						}}}


						<!-- end of Socio-cultural Context -->

						<!-- Technology -->

						{{{
<ifcount code="ca_objects.prodtech" min="1"><div class="unit">
	<label>Production Technique:</label>
	<unit relativeTo="ca_objects.prodtech" delimiter="<br/>">
		^ca_objects.prodtech
	</unit>
</div></ifcount>
}}}
						{{{
<ifcount code="ca_objects.equipused" min="1"><div class="unit">
	<label>Equipment:</label>
	<unit relativeTo="ca_objects.equipused" delimiter="<br/>">
		^ca_objects.equipused
	</unit>
</div></ifcount>
}}}

						<!-- End Of Technology -->

						<!-- Intellectual Property	-->

						<?php
						if ($va_entity_rels = $t_object->get('ca_objects_x_entities.relation_id', array('returnAsArray' => true))) {
							$va_entities_by_type = array();
							foreach ($va_entity_rels as $va_key => $va_entity_rel) {
								$t_rel = new ca_objects_x_entities($va_entity_rel);
								$vn_type_id = $t_rel->get('ca_relationship_types.preferred_labels');
								$va_entities_by_type[$vn_type_id][] = caNavLink($this->request, $t_rel->get('ca_entities.preferred_labels'), '', '', 'Detail', 'entities/' . $t_rel->get('ca_entities.entity_id'));
							}
							print "<div class='unit'><label>Intellectual Property:</label>";
							foreach ($va_entities_by_type as $va_type => $va_entity_id) {
								foreach ($va_entity_id as $va_key => $va_entity_link) {
									$output = $va_type . ": " . $va_entity_link . "<br/>";
									print $output;
								}
							}
							print "</div>";
						}
						?>

						<!-- end of Intellectual Property labels -->

						<!-- Access and Sensitivity -->
						{{{
<ifdef code="ca_objects.cultsens"><div class="unit"><label>Cultural Sensitivity:</label>^ca_objects.cultsens</div></ifdef>
}}}
						{{{
<ifdef code="ca_objects.reasonforrest"><div class="unit"><label>Reasons for Restriction:</label>^ca_objects.reasonforrest</div></ifdef>
}}}

						<!-- End of Access and Sensitivity -->

						<!-- Licences amd Notices -->
						<!-- Licences display. TODO: I couldn't work this -->

						<?php
						$right_id = $t_object->get("ca_objects.rights");

						if ($right_id) {
							
							$rights_idno = $t_object->get("ca_objects.rights.idno");
							$rights_label = $t_object->get("ca_objects.rights.preferred_labels");

							$rights = new Rights();
							$rights->rightsstatement($rights_idno, $rights_label);
						}
						?>

						<!-- End of Licences amd Notices -->

					</div><!-- end col -->

				</div><!-- end row -->

				<div class='row'>
					<hr>
					<div class='col-sm-6 col-md-6'>
						<!-- Geographical Coverage -->

						{{{<ifcount code="ca_places" min="1" max="1"><label>Related place</label></ifcount>}}}
						{{{<ifcount code="ca_places" min="2"><label>Related places</label></ifcount>}}}
						{{{<unit relativeTo="ca_places" delimiter="<br/>"><l>^ca_places.preferred_labels.name</l> ^ca_places.type_id</unit>}}}



					</div>
					<div class='col-sm-6 col-md-6'>

						<div id="map" style="height: 180px;"></div>

						{{{
						<script>
// Assuming ^ca_objects.georeference contains a string like "[39.920124257515,32.855112550338]"
var georeferenceString = '^ca_objects.georeference';
var titles = '^ca_objects.preferred_labels';
var objid = '^ca_objects.idno';
var caid = '^ca_objects.object_id';
var currentURL = window.location.href;

// Get the current page URL
var currentURL = window.location.href;

// Find the index of "Detail" in the URL
var detailIndex = currentURL.indexOf("Detail");

// Extract the substring after "Detail"
var baseURL = currentURL.substring(0, detailIndex);

console.log(baseURL);
console.log(georeferenceString);

// Remove unwanted characters and ensure proper JSON format
georeferenceString = georeferenceString.replace(/[\[\]\s]/g, ''); // Remove brackets and whitespaces

try {
  if (georeferenceString) {
    var placesLabels = '^ca_places.preferred_labels';
    const placesLabelsArray = placesLabels.split(";");
    var lastPlaceLabel = placesLabelsArray[placesLabelsArray.length - 1];

    var placesIDs = '^ca_places.place_id';
    const placesIDsArray = placesIDs.split(";");
    var lastPlaceID = placesIDsArray[placesIDsArray.length - 1];
    console.log(placesIDs);

    var placeType = '^ca_places.type_id';
    const placeTypesArray = placeType.split(";");
    var lastPlaceType = placeTypesArray[placeTypesArray.length - 1];
    console.log(placeType);

	var detailPageURL = baseURL + 'Detail/places/' + lastPlaceID; // Use the city name as the identifier

    // Parse the georeference string into a JavaScript array
    var georeferenceArray = JSON.parse("[" + georeferenceString + "]");

    // Extract latitude and longitude
    var lat = georeferenceArray[0];
    var lon = georeferenceArray[1];

    // Create the Leaflet map
    var map = L.map('map').setView([lat, lon], 10);
    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
      maxZoom: 19,
      attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);

    if (lastPlaceType.toLowerCase() === 'address') {
      var popupContent = `<a href="${detailPageURL}">${lastPlaceLabel}</a>`;

      var marker = L.marker([lat, lon]).addTo(map);
      marker.bindPopup(popupContent);
    }
  }

} catch (error) {
  console.error("Error:", error);
}
</script>


}}}

						<!-- end of Geographical Coverage labels -->
					</div>
				</div>


				<div class='row'>
					<hr>
					<div class='col-sm-6 col-md-6'>

						<H3>History</H3>
						<?php
						$date_created = intval($t_object->get('ca_objects.created.timestamp'));
						$item_creator = $t_object->get('ca_objects.created.user');
						$date_modified = intval($t_object->get('ca_objects.lastModified.timestamp'));
						$item_modifier = $t_object->get('ca_objects.lastModified.user');

						// Format dates to display only month, day, and year
						$date_created_formatted = date("F j Y", $date_created);
						$date_modified_formatted = date("F j Y", $date_modified);

						/* if date_created and date_modified are the same, just print date_created */
						if ($date_created_formatted == $date_modified_formatted) {
							echo "<div class='unit'><label>First online date, Posted date:</label>" . $date_created_formatted . " by " . $item_creator . "</div>";
						} else {
							echo "<div class='unit'><label>First online date, Posted date:</label>" . $date_created_formatted . " by " . $item_creator . "</div>";
							echo "<div class='unit'><label>Last modified date:</label>" . $date_modified_formatted . " by " . $item_modifier . "</div>";
						}
						?>
					</div>

					<div class='col-sm-6 col-md-6'>
						<?php
						if ($va_entity_rels = $t_object->get('ca_objects_x_entities.relation_id', array('returnAsArray' => true))) {
							$va_entities_by_type = array();
							foreach ($va_entity_rels as $va_key => $va_entity_rel) {
								$t_rel = new ca_objects_x_entities($va_entity_rel);
								$vn_type_id = $t_rel->get('ca_relationship_types.preferred_labels');
								$va_entities_by_type[$vn_type_id][] = caNavLink($this->request, $t_rel->get('ca_entities.preferred_labels'), '', '', 'Detail', 'entities/' . $t_rel->get('ca_entities.entity_id'));
							}
						}

						$contributors = '';

						// Check if there are creators in the array
						if (isset($va_entities_by_type['creator'])) {
							$creators = array_unique($va_entities_by_type['creator']);
							$contributors = implode(', ', $creators);
						} else if (isset($va_entities_by_type['contributor'])) {
							$authors = array_unique($va_entities_by_type['contributor']);
							$contributors = implode(', ', $authors);
						} else {
							$contributors = "";
						}

						$yearofcreation = date("Y", $date_created);
						$title = $t_object->get('ca_objects.preferred_labels.name');
						$object_idno = $t_object->get('ca_objects.idno');
						$collection = $t_object->get('ca_collections.preferred_labels.name');

						// retrieve PID from object
						$pid = $t_object->get('ca_objects.handle');

						// fallback URL if PID is not set.
						if(empty($pid)) {
							$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
							$pid = "{$protocol}://{$_SERVER['HTTP_HOST']}/Detail/objects/{$object_idno}";
						}

						$citation = new Cite($contributors, $yearofcreation, $title, $object_idno, $collection, $pid);

						$citations = array(
							'apa' => $citation->apa(),
							'mla' => $citation->mla(),
							'chicago' => $citation->chicago()
						);

						?>

						<div>
							<label for="citation-style">Choose citation style:</label>
							<select id="citation-style" onchange="updateCitation()">
								<option value="apa">APA 7</option>
								<option value="mla">MLA</option>
								<option value="chicago">Chicago</option>
							</select>
							<button onclick="copyCitation()" title="Copy to Clipboard" class='icon-button'>
								<i class="far fa-copy"></i>
							</button>
						</div>

						<div class='unit'>
							<label>Use and reproduction:</label>
							<span id="citation-text"><?= $citation->apa(); ?></span>
						</div>

						<div id="detailAnnotations"></div>

						<?php print caObjectRepresentationThumbnails($this->request, $this->getVar("representation_id"), $t_object, array("returnAs" => "bsCols", "linkTo" => "carousel", "bsColClasses" => "smallpadding col-sm-3 col-md-3 col-xs-4", "primaryOnly" => $this->getVar('representationViewerPrimaryOnly') ? 1 : 0)); ?>

						<?php
						# Comment and Share Tools
						if ($vn_comments_enabled | $vn_share_enabled | $vn_pdf_enabled) {

							print '<div id="detailTools">';
							if ($vn_comments_enabled) {
						?>
								<div class="detailTool">
									<a href='#' onclick='jQuery("#detailComments").slideToggle(); return false;'><i class="far fa-comments"></i>Comments and Tags (<?php print sizeof($va_comments) + sizeof($va_tags); ?>)</a>
								</div><!-- end detailTool -->
								<div id='detailComments'><?php print $this->getVar("itemComments"); ?></div><!-- end itemComments -->
							<?php
							}
							if ($vn_share_enabled) {
								print '<div class="detailTool"><i class="fas fa-share"></i></span>' . $this->getVar("shareLink") . '</div><!-- end detailTool -->';
							}
							if ($vn_pdf_enabled) {
								print "<div class='detailTool'><i class='fas fa-file-pdf'></i></span>" . caDetailLink($this->request, "Download as PDF", "faDownload", "ca_objects",  $vn_id, array('view' => 'pdf', 'export_format' => '_pdf_ca_objects_summary')) . "</div>";
							}
							?>
							<div class='detailTool'><a href='#' onclick='caMediaPanel.showPanel("<?= caNavUrl($this->request, '', 'Lightbox', 'addItemForm', array('object_id' => $vn_id)); ?>"); return false;' title='Add to lightbox'><span class='fa fa-suitcase'></span><?= _t('Add to favorites'); ?></a></div>
						<?php
							print '</div><!-- end detailTools -->';
						}

						?>
						<?php
						print "<div class='inquireButton'>" . caNavLink($this->request, "<i class='far fa-envelope'></i> Inquire", "btn btn-default btn-small", "", "Contact", "Form", array("table" => "ca_objects", "id" => $t_object->get("object_id"))) . "</div>";
						?>
					</div>


				</div>
			</div><!-- end container -->
		</div><!-- end col -->
		<div class='navLeftRight col-xs-1 col-sm-1 col-md-1 col-lg-1'>
			<div class="detailNavBgRight">
				{{{nextLink}}}
			</div><!-- end detailNavBgLeft -->
		</div><!-- end col -->
	</div><!-- end row -->



	<script type="text/javascript">
		jQuery(document).ready(function() {
			$('.trimText').readmore({
				speed: 75,
				maxHeight: 200
			});
		});

		$(document).ready(function() {
			// Initialize Bootstrap Tooltip
			$('[data-toggle="tooltip"]').tooltip();

			// Hide the panel content initially
			$('#panelContent').hide();

			// Toggle panel content and icon when the button is clicked
			$('#togglePanel').click(function() {
				$('#panelContent').slideToggle(function() {
					var icon = $('#toggleIcon');
					if ($('#panelContent').is(':visible')) {
						icon.removeClass('fa-chevron-down').addClass('fa-chevron-up');
					} else {
						icon.removeClass('fa-chevron-up').addClass('fa-chevron-down');
					}
				});
			});
		});
	</script>


	<script>
		var citations = <?= json_encode($citations); ?>;

		function updateCitation() {
			var style = document.getElementById('citation-style').value;
			var citationText = citations[style];
			document.getElementById('citation-text').innerHTML = citationText;
		}

		function copyCitation() {
			var citationText = document.getElementById('citation-text').innerText;
			navigator.clipboard.writeText(citationText).then(function() {
				alert('Citation copied to clipboard!');
			}, function(err) {
				alert('Failed to copy citation: ', err);
			});
		}
	</script>