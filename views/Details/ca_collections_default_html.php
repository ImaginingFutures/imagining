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
$vs_browse_key 		= $this->getVar('key');					// cache key for current browse
$va_access_values 	= $this->getVar('access_values');		// list of access values for this user
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

# Prepare values for search inside collection

$o_browse = caGetBrowseInstance("ca_objects");
$o_browse->addCriteria("collection_facet", $t_item->get("ca_collections.collection_id"));
$o_browse->execute(array('checkAccess' => $va_access_values));
$vb_show_objects_link = false;
# include conditional to display only where is not hierarchical tree
if ($o_browse->numResults() && !$t_item->get("ca_collections.children.collection_id", array("checkAccess" => $va_access_values))) {
	$vb_show_objects_link = true;
}
$vb_show_collections_link = false;
if ($t_item->get("ca_collections.children.collection_id", array("checkAccess" => $va_access_values))) {
	$vb_show_collections_link = true;
}

$qr_res = $o_browse->getResults(); // retrieve all objects

# --------------------
# Mimetypes
#$mimetypes = $this->render("Details/data/mimetypes.php");
require_once(__CA_THEMES_DIR__ . "/imagining/views/Details/data/mimetypes.php");

# --------------------

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

		<div class="row">


			<?php

			$mimes = new MimeTypes();
			$mimetypes = $mimes->mimetypes();
			?>

			<div class='col-md-12 col-lg-12'>
				<H1>{{{^ca_collections.preferred_labels.name}}}</H1>
				<H2>{{{^ca_collections.type_id}}}{{{<ifdef code="ca_collections.idno">, ^ca_collections.idno</ifdef>}}}</H2>
				{{{<ifdef code="ca_collections.parent_id"><div class="unit">Part of: <unit relativeTo="ca_collections.hierarchy" delimiter=" &gt; "><l>^ca_collections.preferred_labels.name</l></unit></div></ifdef>}}}

				<?php
				if ($vn_pdf_enabled) {
					print "<div class='exportCollection'><i class='far fa-file-pdf' aria-label='" . _t("Download") . "'></i> " . caDetailLink($this->request, "Download as PDF", "", "ca_collections",  $vn_top_level_collection_id, array('view' => 'pdf', 'export_format' => '_pdf_ca_collections_summary')) . "</div>";
				}
				?>
			</div><!-- end col -->
		</div><!-- end row -->

				<!-- Header image -->
				{{{<ifdef code="ca_object_representations.media">
					<div class="collectionsHeader">
					^ca_object_representations.media.original
					</div>
					</ifdef>
				}}}

		
		<div class="col-sm-8 col-md-8 col-lg-8">

		<div class="row">
			<div class='col-sm-8 col-md-8 col-lg-8'>
				<label>People:</label>
			</div>
		</div>

		<?php
		$v_ents = 0;

		$qr_entities = $t_item->get("ca_entities.entity_id", array('returnAsArray' => true));
		$o_entities = new EntitySearch();
		foreach ($qr_entities as $qr_entity) {
			if ($v_ents == 0) {
				print "<div class='row'>";
			}
			$q_res = $o_entities->search("ca_entities.entity_id:" . $qr_entity);
			print "<div class='col-4 col-xs-4 col-sm-4 col-md-2'>";
			while ($q_res->nextHit()) {

				print "<div class='entitiesTile'>";
				$ca_entity_media = $q_res->get('ca_object_representations.media.preview170');

				if (!$ca_entity_media) {
					$ca_entity_media = caGetThemeGraphic($this->request, "people.webp");
				}
				print "<div class='entitiesThumbnail'>" . $ca_entity_media . "</div>";
				print caDetailLink($this->request, "<div class='entityName'>" . $q_res->get('ca_entities.preferred_labels') . "</div>", "", "ca_entities", $q_res->get('ca_entities.entity_id'));
				print "</div>";
			}
			print "</div>";
			$v_ents++;
			if ($v_ents == 4) {
				print "</div><!-- end row -->\n";
				$v_ents = 0;
			}
		}
		if ($v_ents > 0) {
			print "</div><!-- end row -->\n";
		}

		?>
			<div class="font-size-control">
				<button type="button" name="btn1" onclick="changeSizeByBtn(-2)">-A</button>
				<button type="button" name="btn2" onclick="resetSize()">A</button>
				<button type="button" name="btn3" onclick="changeSizeByBtn(2)">A+</button>
			</div>
			<div class="row projects-description" id="projects-description-container">
				
					{{{
						<ifcount code="ca_list_items" restrictToRelationshipTypes="prjtype" min="1">    						
						<label>Project Type:</label>
						<unit relativeTo="ca_list_items" restrictToRelationshipTypes="prjtype" delimiter="</br>">   
						<l>^ca_list_items.preferred_labels.name_singular</l></unit><HR>
						</ifcount>

						<ifcount code="ca_list_items" restrictToRelationshipTypes="prjregion" min="1">       
						<label>Project Region:</label>
						<unit relativeTo="ca_list_items" restrictToRelationshipTypes="prjregion" delimiter="</br>">   
						<l>^ca_list_items.preferred_labels.name_singular</l></unit><HR>
						</ifcount>
						<ifdef code="ca_collections.synopsis"><label>Synopsis and Position</label>^ca_collections.synopsis<br/></ifdef>
						<ifdef code="ca_collections.objectivesmethods"><label>Objectives and Methods</label>^ca_collections.objectivesmethods<br/></ifdef>
						<ifdef code="ca_collections.workshopsevents"><label>Workshops and Events</label>^ca_collections.workshopsevents<br/></ifdef>
						<ifdef code="ca_collections.activities"><label>Activities</label>^ca_collections.activities<br/></ifdef>
						<ifdef code="ca_collections.descriptionalt"><label>Project Description Alternative</label>^ca_collections.descriptionalt<br/></ifdef>

						<ifcount code="ca_list_items" restrictToRelationshipTypes="keyword" min="1">    
						<label>Keywords:</label>
						<unit relativeTo="ca_list_items" restrictToRelationshipTypes="keyword" delimiter="</br>">   <l>^ca_list_items.preferred_labels.name_singular</l></unit><HR>
						</ifcount>
						<ifdef code="ca_collections.ifwebpage"><label>Project IF Page:</label><a href="^ca_collections.ifwebpage" target="_blank">^ca_collections.ifwebpage <i class="fas fa-external-link-alt"></i></a></ifdef>
						<ifdef code="ca_collections.exwebpage"><label>Project Website:</label><a href="^ca_collections.exwebpage" target="_blank">^ca_collections.exwebpage <i class="fas fa-external-link-alt"></i></a></ifdef>
					}}}

					
					<?php
					# Comment and Share Tools
					if ($vn_comments_enabled | $vn_share_enabled) {

						print '<div id="detailTools">';
						if ($vn_comments_enabled) {
					?>
							<div class="detailTool"><a href='#' onclick='jQuery("#detailComments").slideToggle(); return false;'><i class="far fa-comment-dots" aria-label="<?php print _t("Comments and tags"); ?>"></i>Comments (<?php print sizeof($va_comments); ?>)</a></div><!-- end detailTool -->
							<div id='detailComments'><?php print $this->getVar("itemComments"); ?></div><!-- end itemComments -->
					<?php
						}
						if ($vn_share_enabled) {
							print '<div class="detailTool"><i class="fas fa-share" aria-label="' . _t("Share") . '"></i>' . $this->getVar("shareLink") . '</div><!-- end detailTool -->';
						}
						print '</div><!-- end detailTools -->';
					}
					?>

				
				
					

			</div><!-- end row -->

			<?php if ($vb_show_objects_link || $t_item->get('ca_collections.exresource')): ?>
				<?php
				$icon_map = [
						'Map' => 'fa-map',
						'Interactive Form' => 'fa-file-alt',
						'Channel' => 'fa-video',
						'Exhibition' => 'fa-photo-video',
					];?>

				<div class="row">
				<?php 
				$exresource = $t_item->get('ca_collections.exresource');
				$resource_types = $t_item->get('ca_collections.exresource.exlist.preferred_labels'); // Assuming this also returns a semicolon-separated string
				
				if ($exresource) {
					$resources = explode(';', $exresource);
					$types = explode(';', $resource_types);
				
					if (count($resources) % 3 == 0) {
						echo '<div class="row">';
						echo '<label>External Resources:</label>';
						for ($i = 0; $i < count($resources); $i += 3) {
							$name = $resources[$i];
							$url = $resources[$i + 1];
							$id = $resources[$i + 2];
							$type = $types[intval($i / 3)];
							$icon = $icon_map[$type] ?? 'fa-question'; // Fallback to a generic icon if type is not defined
							?>
							<div class="col-sm-4">
								<div class="card">
									<div class="card-body">
										<a href="<?= htmlspecialchars($url); ?>">
										<i class="fas <?= htmlspecialchars($icon); ?>"></i> <?= htmlspecialchars($name); ?>
										</a>
									</div>
								</div>
							</div>

							<?php
						}
						echo '</div>';
					} 
				}
				?>
				</div>
			<?php endif; ?>


			<?php

			// COLLECTIONS MAP

			# Retrieving objects data for map
			$vs_cache_key = md5($vs_browse_key);
			

			if (($o_collections_config->get("cache_timeout") > 0) && ExternalCache::contains($vs_cache_key,'ca_collections_default')) {
				// Data found in cache, use it
				$cachedData = ExternalCache::fetch($vs_cache_key, 'ca_collections_default');
				$labels_places = json_decode($cachedData, true);
				$objectsidsData = ExternalCache::fetch($vs_cache_key, 'ca_collections_objectids');
				$object_id_array = json_decode($objectsidsData, true);
			} else {

				$object_id_array = array();
				$labels_places = array();

				while ($qr_res->nextHit()) {
					$object_id = $qr_res->get('object_id'); 
					$object_id_array[] = $object_id;
				
					$o_coordinates = $qr_res->get('georeference');
				
					if (!is_null($o_coordinates)) {
						$decoded_coordinates = json_decode($o_coordinates, true);
						if (json_last_error() === JSON_ERROR_NONE && is_array($decoded_coordinates)) {
							$labels_places[] = array(
								"object_id" => $object_id,
								"object_label" => $qr_res->get("preferred_labels"),
								"coordinates" => $decoded_coordinates // Using decoded coordinates
							);
						} else {
							print json_last_error_msg(); // More informative error message
						}
					}
				}
			}
			if(count($labels_places)){

				ExternalCache::save($vs_cache_key, json_encode($labels_places), 'ca_collections_default', $o_collections_config->get("cache_timeout"));
				ExternalCache::save($vs_cache_key, json_encode($object_id_array), 'ca_collections_objectids', $o_collections_config->get("cache_timeout"));
				print "<div><h4>Location of resources:</h4>";
				print "<div id='map' style='height: 400px;'></div>";
				print "</div>";
			} 
		?>

<div class="row">

{{{<ifcount code="ca_objects" min="1">
	<div class="row">
		<div id="browseResultsContainer">
			<?php print caBusyIndicatorIcon($this->request).' '.addslashes(_t('Loading...')); ?>
		</div><!-- end browseResultsContainer -->
	</div><!-- end row -->
	<script type="text/javascript">
		jQuery(document).ready(function() {
			jQuery("#browseResultsContainer").load("<?php print caNavUrl($this->request, '', 'Search', 'objects', array('search' => 'collection_id:^ca_collections.collection_id'), array('dontURLEncodeParameters' => true)); ?>", function() {
				jQuery('#browseResultsContainer').jscroll({
					autoTrigger: true,
					loadingHtml: '<?php print caBusyIndicatorIcon($this->request).' '.addslashes(_t('Loading...')); ?>',
					padding: 20,
					nextSelector: 'a.jscroll-next'
				});
			});
			
			
		});
	</script>
</ifcount>}}}
</div>


			<?php
			 
			// MIMETYPES SCRIPT

			// Initialize the database connection and get the collection ID
			$o_db = new Db();
			$s_object = new ObjectSearch();

			if (($o_collections_config->get("cache_timeout") > 0) && ExternalCache::contains($vs_cache_key, 'ca_collections_mimetypes')) {
				// Data found in cache, use it
				$cachedDataScript = ExternalCache::fetch($vs_cache_key, 'ca_collections_mimetypes');
				$category_counts = json_decode($cachedDataScript, true);
				$objectsidsData = ExternalCache::fetch($vs_cache_key, 'ca_collections_objectids');
				$object_id_array = json_decode($objectsidsData, true);
			} else {
			// Fetch representation IDs for the objects
			$representation_ids = [];
			foreach ($object_id_array as $object_id) {
				$representations = $o_db->query("SELECT representation_id FROM ca_objects_x_object_representations WHERE object_id = $object_id");
				while ($representations->nextRow()) {
					$representation_ids[] = $representations->get("representation_id");
				}
			}
		
			// Fetch mimetypes and count them
			$mimetype_counts = [];
			foreach ($representation_ids as $representation_id) {
				$mimetype_result = $o_db->query("SELECT mimetype FROM ca_object_representations WHERE representation_id = $representation_id");
				while ($mimetype_result->nextRow()) {
					$mimetype = $mimetype_result->get("mimetype");
					$mimetype_counts[$mimetype] = isset($mimetype_counts[$mimetype]) ? $mimetype_counts[$mimetype] + 1 : 1;
				}
			}
			// Initialize an array to store counts for each category
			$category_counts = [];
		
			// Iterate through the mimetype counts and categorize them
			foreach ($mimetype_counts as $mimetype => $count) {
				foreach ($mimetypes as $category => $mimetype_data) {
					if (in_array($mimetype, $mimetype_data['types'])) {
						$category_counts[$category] = isset($category_counts[$category]) ? $category_counts[$category] + $count : $count;
						break;
					}
				}
			}
			ExternalCache::save($vs_cache_key, json_encode($category_counts), 'ca_collections_mimetypes', $o_collections_config->get("cache_timeout"));
		}
			?>

		</div><!-- end container -->
		<div class="col-sm-4 col-md-3 col-lg-3">
			<div class="row">
				<div class='col-sm-12'>

					<?php
					if ($object_id_array and count($object_id_array) > 0) {
						# search for case studies or words into actions objects types.

						$case_study_id = $o_db->query("SELECT item_id, name_singular FROM ca_list_item_labels WHERE name_singular = 'Case Study' OR name_singular = 'Words into Action'");

						# get the label_id for cases or words
						$works_ids = [];
						while ($case_study_id->nextRow()) {
							$works_ids[] = [$case_study_id->get("name_singular") => $case_study_id->get("item_id")];
						}

						# construct the panel (bootstrap 3)

						if ($works_ids) {
							$works_for_search = [];

							foreach ($works_ids as $work) {
								foreach ($work as $item_id) {
									$works_for_search[] = $item_id;
								}
							}

							$works_cases = $o_db->query("SELECT object_id FROM ca_objects WHERE object_id IN (?) AND type_id IN (?)", array($object_id_array, $works_for_search));
							while ($works_cases->nextRow()) {
								$works_objects = $s_object->search("ca_objects.object_id:" . $works_cases->get('ca_objects.object_id'));
								while ($works_objects->nextHit()) {
									foreach ($works_ids as $work) {
										foreach ($work as $key => $value) {
											if ($value == $works_objects->get("ca_objects.type_id")) {
												$label = $key;
												break;
											}
										}
									}
									print "<div class='panel panel-primary'>";
									print "<div class='panel-heading'>";
									print "<h3 class='panel-title'>" . $label . "</h3></div>";
									print "<div class='panel-body'>";
									print caDetailLink($this->request, $works_objects->get("ca_objects.preferred_labels") . " <i class='fas fa-file-pdf'></i>", "", "ca_objects", $works_objects->get("ca_objects.object_id"));
									print("</div></div>");
								}
							}
						}
					}

					?>
					<?php
					if ($vb_show_objects_link || $vb_show_collections_link) {
					?>
						<div class='collectionBrowseItems'>

							<?php
							if ($vb_show_objects_link) {
								print caNavLink($this->request, "<button type='button' class='btn btn-default btn-sm'><i class='far fa-eye' aria-label='Search'></i> Look inside the Collection</button>", "browseRemoveFacet", "", "browse", "objects", array("facet" => "collection_facet", "id" => $t_item->get("ca_collections.collection_id")));
							}
							if ($vb_show_collections_link) {
								print caNavLink($this->request, "<button type='button' class='btn btn-default btn-sm'><i class='fas fa-eye' aria-label='Search'></i> Look in all collection</button>", "browseRemoveFacet", "", "browse", "objects", array("facet" => "collection_facet", "id" => $t_item->get("ca_collections.collection_id")));
							}
							?>

						</div>
					<?php
					}

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


					<div class='counter'>
						<?php
						if (!$category_counts) {
							echo "<div class='mimetypeCat  col-4 col-xs-4 col-sm-4 col-md-2'><i class='fas fa-plus-circle'></i><div class='value'>0</div><div class='mimeLabel'>No items yet</div></div>";
						}
						$colors = ['first', 'second', 'third', 'fourth'];

						$counter = 0;
						foreach ($category_counts as $category => $count) {
							$catData = $mimetypes[$category];
							$colorClass = 'value ' . $colors[$counter % count($colors)];
							if ($count > 1) {
								$cat_label = $catData['label'] . 's';
							} else {
								$cat_label = $catData['label'];
							}
							echo "<div class='mimetypeCat'><i class='fas fa-" . strtolower($category) . "'></i><div class='$colorClass' akhi='$count'>0</div><div class='mimeLabel'>" . strtoupper($cat_label) . "</div></div>";

							if ($counter == 4) {
								$counter = 0;
							} else {
								$counter++;
							}
						}
						?>
					</div>
					
					<div class='col-sm-8 col-md-8 col-lg-8'>
					{{{<ifcount code="ca_collections.related" min="1" max="1"><label>Related collection</label> This project </ifcount>}}}
					{{{<ifcount code="ca_collections.related" min="2"><label>Related collections</label> This project </ifcount>}}}
					{{{<unit relativeTo="ca_collections_x_collections" delimiter="<br/>">^relationship_typename <l>^ca_collections.related.preferred_labels.name</l></unit>}}}


					{{{<ifcount code="ca_occurrences" min="1" max="1"><label>Related occurrence</label></ifcount>}}}
					{{{<ifcount code="ca_occurrences" min="2"><label>Related occurrences</label></ifcount>}}}
					{{{<unit relativeTo="ca_occurrences" delimiter="<br/>"><l>^ca_occurrences.preferred_labels.name</l> ^relationship_typename</unit>}}}

					{{{<ifcount code="ca_places" min="1" max="1"><label>Related place</label></ifcount>}}}
					{{{<ifcount code="ca_places" min="2"><label>Related places</label></ifcount>}}}
					{{{<unit relativeTo="ca_places" delimiter="<br/>">This project ^relationship_typename <l>^ca_places.preferred_labels</l></unit>}}}
				</div><!-- end col -->

				</div><!-- end col -->
			</div><!-- end row -->
			</div>
		
		
			

		</div><!-- end col -->

	<div class='navLeftRight col-xs-1 col-sm-1 col-md-1 col-lg-1'>
		<div class="detailNavBgRight">
			{{{nextLink}}}
		</div><!-- end detailNavBgLeft -->
	</div><!-- end col -->
</div><!-- end row -->


<script>
	const counters = document.querySelectorAll('.value');
	const speed = 200;

	counters.forEach(counter => {
		const animate = () => {
			const value = +counter.getAttribute('akhi');
			const data = +counter.innerText;

			const time = value / speed;
			if (data < value) {
				counter.innerText = Math.ceil(data + time);
				setTimeout(animate, 1);
			} else {
				counter.innerText = value;
			}
		}

		animate();
	});


	// CUSTOM LEAFLET SCRIPT

	var labelsPlaces = <?php echo json_encode($labels_places); ?>;

    // Initialize the Leaflet map
    var map = L.map('map').setView([0, 0], 6);

    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);

    // Initialize variables for calculating the average coordinates
    var totalLat = 0;
    var totalLon = 0;

    // Create an object to store labels for each coordinate
    var labelsObject = {};

    labelsPlaces.forEach(function(place) {
        // Extract relevant information from the data array
        var objectID = place.object_id;
        var objectLabel = place.object_label;
		var lat = place.coordinates[0];
		var lon = place.coordinates[1];

        // Convert string values to numbers
        lat = parseFloat(lat);
        lon = parseFloat(lon);

        // Add the converted values to the totals
        totalLat += lat;
        totalLon += lon;

        // Create a unique key for the coordinates
        var coordsKey = lat + ',' + lon;

        // Add a label to the object for the current coordinates
        if (!labelsObject[coordsKey]) {
            labelsObject[coordsKey] = [];
        }
        
		// Get the base URL using JavaScript
		var baseUrl = window.location.href.split('/Detail')[0];

		// Construct the URL using JavaScript
		var detailLink = baseUrl + "/Detail/objects/" + objectID;

		// Create links only for labels without repeating "Object ID: x"
		labelsObject[coordsKey].push(`<a href="${detailLink}">${objectLabel}</a>`);

		// Customize the popup content with the retrieved title
		var popupContent = `${labelsObject[coordsKey].slice(0, 10).join('<br>')}`;

		// If there are more than 10 items, add a link to browse all elements
		if (labelsObject[coordsKey].length > 10) {
			<?php
			$browseLink = caNavLink($this->request, "<i class='far fa-plus-square' aria-label='Search'></i> Browse all elements", "browseRemoveFacet", "", "browse", "objects", array("facet" => "collection_facet", "id" => $t_item->get("ca_collections.collection_id")));
			$escapedBrowseLink = str_replace("'", "\'", $browseLink);
			echo "popupContent += '<br>{$escapedBrowseLink}';";
			?>
		}

        // Create markers and popups, and add them to the map
        var marker = L.marker([lat, lon]).addTo(map);
        marker.bindPopup(popupContent);
    });

    // Calculate the average coordinates
    var avgLat = totalLat / labelsPlaces.length;
    var avgLon = totalLon / labelsPlaces.length;

    // Set the center of the map based on the average coordinates
    map.setView([avgLat, avgLon]);

    // Fit the map to contain all the markers
	
    var bounds = L.latLngBounds(labelsPlaces.map(function(place) {
		var lat = place.coordinates[0];
		var lon = place.coordinates[1];
        // var [lat, lon] = place.coordinates.replace('[', '').replace(']', '').split(',');
        return [parseFloat(lat), parseFloat(lon)];
    }));

    map.fitBounds(bounds);
</script>


<script>
	// Control the size of the font in projects-description

	let cont = document.getElementById("projects-description-container");

	function changeSizeByBtn(increment) {
		let currentSize = window.getComputedStyle(cont, null).getPropertyValue('font-size');
		let newSize = parseFloat(currentSize) + increment;
		cont.style.fontSize = newSize + 'px';
	}

	function resetSize() {
		cont.style.fontSize = ''; // Resets to the original CSS value
	}
</script>
