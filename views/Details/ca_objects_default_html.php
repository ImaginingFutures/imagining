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
	

	require_once(__CA_THEMES_DIR__ . "/imagining/views/Details/data/rightsstatement.php");
	
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
		<div class="container"><div class="row">
			
				{{{representationViewer}}}

		</div>
		<div class="panel panel-default">
			<div class="panel-heading">
			{{{
					<ifdef code="ca_objects.idno"><div class="unit">Object ID: ^ca_objects.idno
		<button class="btn btn-default btn-xs pull-left button-circled" id="togglePanel" data-toggle="tooltip" data-placement="top" title="Media info">
					<i class="fas fa-info-circle"></i>
					</button></div></ifdef>
				}}}
		</div>
		<div class="panel-body" id="panelContent">
                <!-- Content to be shown/hidden goes here -->
                <!-- Content and Scope -->
				<h3>Media information</h3>
				{{{
					<ifdef code="ca_object_representations.media_class"><div class="unit"><unit relativeTo="ca_object_representations.media_class" delimiter="<br/>"><b>Format:</b> ^ca_object_representations.media_class</unit></div></ifdef>
					}}}

				{{{
					<ifdef code="ca_object_representations.media_filesize"><div class="unit"><unit relativeTo="ca_object_representations.media_filesize" delimiter="<br/>"><b>Extent:</b> ^ca_object_representations.media_filesize</unit></div></ifdef>
					}}}

					<?php
					$media_format = $t_object->get('ca_object_representations.media_format');
					if ($media_format != "PDF") {
						echo "{{{<ifcode code=\"ca_object_representations.media_dimensions\"><div class=\"unit\"><unit relativeTo=\"ca_object_representations.media_dimensions\" delimiter=\"<br/>\"><b>Media dimensions:</b> ^ca_object_representations.media_dimensions</unit></div></ifcode>}}}";
					} elseif ($media_format == "PDF") {
						echo "{{{<ifcode code=\"ca_object_representations.page_count\"><div class=\"unit\"><unit relativeTo=\"ca_object_representations.page_count\" delimiter=\"<br/>\"><b>Pages:</b> ^ca_object_representations.page_count</unit></div></ifcode>}}}";
					}
					?>


				{{{
					<ifcode code="ca_object_representations.media_format"><div class="unit"><unit relativeTo="ca_object_representations.media_format" delimiter="<br/>"><b>Media format:</b> ^ca_object_representations.media_format</unit></div></ifcode>
				}}}
            </div>
		</div>
		<div class="row">

				<H1>{{{ca_objects.preferred_labels.name}}}</H1>

				<div class='col-sm-6 col-md-6'>
				
				{{{
					<ifdef code="ca_objects.alternativetitle"><div class="unit">
					<ifdef code="ca_objects.ai"><button class="btn btn-warning btn-xs pull-left warning-translation-button" id="togglePanel" data-toggle="tooltip" data-placement="top" title="^ca_objects.ai">
                    <i class="fas fa-hand-point-right"></i>
					</button></ifdef>
					<label>Translated title:</label>^ca_objects.alternativetitle
					</div><HR></ifdef>
					}}}
				

				{{{<unit relativeTo="ca_collections" delimiter="<br/>"><label>Is part of:</label><l>^ca_collections.preferred_labels.name</l></unit><ifcount min="1" code="ca_collections"><HR></ifcount>}}}
				

				<!-- identification -->

				{{{
					<ifdef code="ca_objects.external_link.url_source"><div class="unit"><label>External Link:</label><a href="^ca_objects.external_link.url_entry" target="_blank" class="url"><i class="fa fa-external-link" aria-hidden="true"></i>^ca_objects.external_link.url_source</a></div><HR></ifdef>
					}}}
				

				<!-- end of identification labels -->

				

				{{{
					<ifdef code="ca_objects.description"><div class="unit"><label>Description:</label>^ca_objects.description</div></ifdef>
					}}}

				{{{<ifdef code="ca_objects.translationofdescription"><div class="unit">
					<ifdef code="ca_objects.ai"><button class="btn btn-warning btn-xs pull-left warning-translation-button" id="togglePanel" data-toggle="tooltip" data-placement="top" title="^ca_objects.ai">
                    <i class="fas fa-hand-point-right"></i>
					</button></ifdef>
					<label>Translated description:</label>^ca_objects.translationofdescription
					
				</div><HR></ifdef>}}}

				{{{<ifcount code="ca_objects.langmaterial.language" min="1"><div class="unit"><label>Language:</label><unit relativeTo="ca_objects.langmaterial" delimiter="<br/>">^ca_objects.langmaterial.material: ^ca_objects.langmaterial.language</unit></div></ifcount>}}}

				{{{
					<ifcount code="ca_objects.theme" min="1"><div class="unit"><label>Theme:</label><unit relativeTo="ca_objects.theme" delimiter="<br/>">^ca_objects.theme</unit></div></ifcount>
					}}}
				
					{{{
						<ifcount code="ca_objects.keywords" min="1"><div class="unit"><label>Keywords:</label><unit relativeTo="ca_objects.keywords" delimiter="<br/>">^ca_objects.keywords</unit></div></ifcount>
						}}}
				

				{{{
					<ifdef code="ca_objects.note"><div class="unit"><label>Notes:</label>^ca_objects.note</div><HR></ifdef>
					}}}
				
				<!-- end of Content and Scope labels -->
				
				<!-- Custom labels -->

				{{{<ifdef code="ca_objects.time_period">
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

				{{{<ifdef code="ca_objects.emotion">
					<div class="unit">
						<label>Emotions</label>
						<unit relativeTo="ca_objects.emotion" delimiter="<br/>">
							^ca_objects.emotion
						</unit>
					</div>
				</ifdef>}}}

				{{{<ifdef code="ca_objects.wayofliving">
					<div class="unit">
						<label>Emotions</label>
						<unit relativeTo="ca_objects.wayofliving" delimiter="<br/>">
							^ca_objects.wayofliving
						</unit>
					</div>
					<HR>
				</ifdef>}}}

				
				
				<!-- end of Custom labels -->
				<!-- Geographical coverage -->

				{{{<ifcount code="ca_places" min="1"><div class="unit"><ifcount code="ca_places" min="1" max="1"><label>Related place</label></ifcount><ifcount code="ca_places" min="2"><label>Related places</label></ifcount><unit relativeTo="ca_places" delimiter="<br/>"><unit relativeTo="ca_places.hierarchy" delimiter=" &gt; "><l>^ca_places.preferred_labels</l></unit></unit></div></ifcount>}}}
				
				<br/>{{{map}}}<!-- map -->

				<!-- end of Geographical coverage labels -->

				<!-- Socio-cultural Context -->

				{{{
					<ifcount code="ca_objects.culturalgroup" min="1"><div class="unit">
						<label>Cultural Group</label>
						<unit relativeTo="ca_objects.culturalgroup" delimiter="<br/>">
							^ca_objects.culturalgroup
						</unit>
					</div></ifcount>
					}}}
				
					{{{
						<ifdef code="ca_objects.culturalcontext"><div class="unit"><label>Cultural Context</label>^ca_objects.culturalcontext</div></ifdef>
						}}}
					
					{{{
						<ifdef code="ca_objects.socialgroupsetting"><div class="unit"><label>Social Group</label>^ca_objects.socialgroupsetting</div></ifdef>
						}}}

				<!-- end of Socio-cultural Context -->

				<!-- Dates -->

				{{{<ifcount code="ca_objects.unitdate.date_value" min="1"><div class="unit"><label>Dates:</label><unit relativeTo="ca_objects.unitdate" delimiter="<br/>">^ca_objects.unitdate.dates_types: ^ca_objects.unitdate.date_value</unit></div></ifcount>}}}

				<!-- end of Dates labels -->

				<!-- Intellectual Property	-->

				<?php
				if ($va_entity_rels = $t_object->get('ca_objects_x_entities.relation_id', array('returnAsArray' => true))) {
					$va_entities_by_type = array();
					foreach ($va_entity_rels as $va_key => $va_entity_rel) {
						$t_rel = new ca_objects_x_entities($va_entity_rel);
						$vn_type_id = $t_rel->get('ca_relationship_types.preferred_labels');
						$va_entities_by_type[$vn_type_id][] = caNavLink($this->request, $t_rel->get('ca_entities.preferred_labels'), '', '', 'Detail', 'entities/'.$t_rel->get('ca_entities.entity_id'));
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

				<!-- Technology -->

				{{{
					<ifdef code="ca_objects.productiontechnique"><div class="unit"><label>Production Technique</label>^ca_objects.productiontechnique</div></ifcode>

				}}}

				{{{
					<ifcount code="ca_objects.equipment" min="1"><div class="unit"><label>Equipment</label><unit relativeTo="ca_objects.equipment" delimiter="<br/>">^ca_objects.equipment</unit></div></ifcount>
				}}}

				
						
			</div><!-- end col -->

			<div class='col-sm-1 col-md-2 col-lg-2'></div><!-- end col -->
			<div class='col-sm-5 col-md-4 col-lg-4'>
			<?php
								print "<div class='inquireButton'>".caNavLink($this->request, "<i class='fas fa-envelope'></i> Inquire", "btn btn-default btn-small", "", "Contact", "Form", array("table" => "ca_objects", "id" => $t_object->get("object_id")))."</div>";
				?>	
			

			<!-- Licences display. TODO: simplify this -->

			<?php 
					$right_id = $t_object->get("ca_objects.rightsstate");
					
					if($right_id){
						$rights_group = $t_object->get("ca_objects.rightsstate.related.preferred_labels");
						$rights_label = $t_object->get("ca_objects.rightsstate.preferred_labels");

						$rights = new Rights();
						$rights->rightsstatement($rights_group, $rights_label);
					}
			?>
				
				{{{
					<ifdef code="ca_objects.rightownership"><div class="unit"><label>Right Ownership:</label>
					^ca_objects.rightowership</div></ifdef>
				}}}

				{{{
					<ifdef code="ca_objects.culturalsensitivity"><div class="unit"><label>Cultural Sensitivity:</label>^ca_objects.culturalsensitivity</div></ifdef>

				}}}

				{{{
					<ifdef code="ca_objects.accessrestriction"><div class="unit"><label>Acccess Restriction:</label>^ca_objects.accessrestriction</div></ifdef>
				}}}

				{{{
					<ifdef code="ca_objects.reasonsforrestriction"><div class="unit"><label>Reasons for Restriction:</label>^ca_objects.reasonsforrestriction</div></ifdef>
				}}}
				<HR>
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
				<HR>

				<?php
				
				if ($va_entity_rels = $t_object->get('ca_objects_x_entities.relation_id', array('returnAsArray' => true))) {
					$va_entities_by_type = array();
					foreach ($va_entity_rels as $va_key => $va_entity_rel) {
						$t_rel = new ca_objects_x_entities($va_entity_rel);
						$vn_type_id = $t_rel->get('ca_relationship_types.preferred_labels');
						$va_entities_by_type[$vn_type_id][] = caNavLink($this->request, $t_rel->get('ca_entities.preferred_labels'), '', '', 'Detail', 'entities/'.$t_rel->get('ca_entities.entity_id'));
					}}

				 $contributors = '';

				// Check if there are creators in the array
				if (isset($va_entities_by_type['creator'])) {
					$creators = array_unique($va_entities_by_type['creator']);
					$contributors = implode(', ', $creators);
				} else {
					// If no creators, check for contributors and other entity types
					$contributorString = '';

					// Check if there are contributors in the array
					if (isset($va_entities_by_type['contributor'])) {
						$contributorString .= implode(', ', $va_entities_by_type['contributor']);
					}

					// Iterate through other entity types and add them to the contributorString
					foreach ($va_entities_by_type as $type => $entities) {
						if ($type !== 'contributor') {
							if (!empty($contributorString)) {
								$contributorString .= ', ';
							}
							$contributorString .= implode(', ', $entities) . " ($type)";
						}
					}

					if (!empty($contributorString)) {
						$contributors = $contributorString;
					} else {
						$contributors = 'Unknown';
					}
				}

				 
				 $yearofcreation = date("Y", $date_created);
				 $title = $t_object->get('ca_objects.preferred_labels.name');
				 $object_id = $t_object->get('ca_objects.idno');
				 $collection = $t_object->get('ca_collections.preferred_labels.name');

				 $domain = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";

				 $citation = $contributors . " (" . $yearofcreation . ") \"" . $title . ".\" " . $object_id . ". " . $collection . ". " . "Imagining Futures. " . $domain . "/Detail/objects/" . $vn_id . ". Accessed " . date("F j, Y") . ".";

				 echo "<div class='unit'><label>Use and reproduction:</label>Cite as: " . $citation . "</div>";

				?>

				<div id="detailAnnotations"></div>
				
				<?php print caObjectRepresentationThumbnails($this->request, $this->getVar("representation_id"), $t_object, array("returnAs" => "bsCols", "linkTo" => "carousel", "bsColClasses" => "smallpadding col-sm-3 col-md-3 col-xs-4", "primaryOnly" => $this->getVar('representationViewerPrimaryOnly') ? 1 : 0)); ?>
				
<?php
				# Comment and Share Tools
				if ($vn_comments_enabled | $vn_share_enabled | $vn_pdf_enabled) {
					
					print '<div id="detailTools">';
					if ($vn_comments_enabled) {
?>				
						<div class="detailTool">
							<a href='#' onclick='jQuery("#detailComments").slideToggle(); return false;'><i class="fas fa-comments"></i>Comments and Tags (<?php print sizeof($va_comments) + sizeof($va_tags); ?>)</a>
						</div><!-- end detailTool -->
						<div id='detailComments'><?php print $this->getVar("itemComments");?></div><!-- end itemComments -->
<?php				
					}
					if ($vn_share_enabled) {
						print '<div class="detailTool"><i class="fas fa-share"></i>'.$this->getVar("shareLink").'</div><!-- end detailTool -->';
					}
					if ($vn_pdf_enabled) {
						print "<div class='detailTool'><i class='fas fa-file-pdf'></i>".caDetailLink($this->request, "Download as PDF", "faDownload", "ca_objects",  $vn_id, array('view' => 'pdf', 'export_format' => '_pdf_ca_objects_summary'))."</div>";
					}
?>
					<div class='detailTool'><a href='#' onclick='caMediaPanel.showPanel("<?= caNavUrl($this->request, '', 'Lightbox', 'addItemForm', array('object_id' => $vn_id)); ?>"); return false;' title='Add to lightbox'><span class='fas fa-suitcase'></span><?= _t('Add to favorites'); ?></a></div>
<?php
					print '</div><!-- end detailTools -->';
				}				

?>

			</div><!-- end col -->

		</div><!-- end row --></div><!-- end container -->
	</div><!-- end col -->
	<div class='navLeftRight col-xs-1 col-sm-1 col-md-1 col-lg-1'>
		<div class="detailNavBgRight">
			{{{nextLink}}}
		</div><!-- end detailNavBgLeft -->
	</div><!-- end col -->
</div><!-- end row -->

<script type='text/javascript'>
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

    // Toggle panel content when the button is clicked
    $('#togglePanel').click(function() {
        $('#panelContent').slideToggle();
    });
});

</script>
