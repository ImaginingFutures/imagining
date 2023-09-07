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
	
	
	require_once(__CA_THEMES_DIR__."/stolaf/lib/elevatorAPI.php");
	
	$media_url = null;
	if(($elevator_url = $t_object->get('ca_objects.url')) && preg_match("!viewAsset/([a-z0-9]{24})[/]?$!", $elevator_url, $m)) {
		$elevator_id = $m[1];
		$e = new elevatorAPI("https://elevator.stolaf.edu/archives/api/v1/", __ELEVATOR_KEY__, __ELEVATOR_SECRET__);
		$children = $e->getAssetChildren($elevator_id);
		if(is_array($children) && is_array($children['matches'])  && is_array($children['matches'][0])) {
			$media_url = $children['matches'][0]['primaryHandlerThumbnail2x'];
		}
	}
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
			<div class='col-sm-6 col-md-6'>
				{{{representationViewer}}}

				<!-- Licences display. TODO: simplify this -->

				{{{<ifdef code="ca_objects.license">
					<div class="unit">
						<label>License</label>
						<?php
							$licenses = [
								"989" => [
									"url" => "http://creativecommons.org/licenses/by/4.0/",
									"img" => "https://i.creativecommons.org/l/by/4.0/88x31.png",
									"name" => "CC BY 4.0",
								],
								"993" => [
									"url" => "http://creativecommons.org/licenses/by-nc-nd/4.0/",
									"img" => "https://i.creativecommons.org/l/by-nc-nd/4.0/88x31.png",
									"name" => "CC BY-NC-ND 4.0",
								],
								"992" => [
									"url" => "http://creativecommons.org/licenses/by-nc-sa/4.0/",
									"img" => "https://i.creativecommons.org/l/by-nc-sa/4.0/88x31.png",
									"name" => "CC BY-NC-SA 4.0",
								],
								"991" => [
									"url" => "http://creativecommons.org/licenses/by-nd/4.0/",
									"img" => "https://i.creativecommons.org/l/by-nd/4.0/88x31.png",
									"name" => "CC BY-ND 4.0",
								],
								"990" => [
									"url" => "http://creativecommons.org/licenses/by-sa/4.0/",
									"img" => "https://i.creativecommons.org/l/by-sa/4.0/88x31.png",
									"name" => "CC BY-SA 4.0",
								],
								"994" => [
									"url" => "https://creativecommons.org/publicdomain/zero/1.0/",
									"img" => "https://i.creativecommons.org/p/zero/1.0/88x31.png",
									"name" => "CC0",
								],
							];

							$licence = $t_object->get("ca_objects.license");

							if (isset($licenses[$licence])) {
								$licenseInfo = $licenses[$licence];
								echo "<a rel='license' href='{$licenseInfo['url']}' target='_blank'><img alt='Creative Commons License' style='border-width:0' src='{$licenseInfo['img']}' /></a>&nbsp;&nbsp;<a rel='license' href='{$licenseInfo['url']}' target='_blank'>{$licenseInfo['name']}</a>";
							}
							?>

					</div>
				</ifdef>}}}
				
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

				{{{
					<ifdef code="ca_objects.useandreproduction"><div class="unit"><label>Use and Reproduction:</label>^ca_objects.useandreproduction</div></ifdef>
				}}}

				<div id="detailAnnotations"></div>
				
				<?php print caObjectRepresentationThumbnails($this->request, $this->getVar("representation_id"), $t_object, array("returnAs" => "bsCols", "linkTo" => "carousel", "bsColClasses" => "smallpadding col-sm-3 col-md-3 col-xs-4", "primaryOnly" => $this->getVar('representationViewerPrimaryOnly') ? 1 : 0)); ?>
				
<?php
				# Comment and Share Tools
				if ($vn_comments_enabled | $vn_share_enabled | $vn_pdf_enabled) {
						
					if($media_url) {
						print "<p><a href='{$elevator_url}' target='_elevator'><img src='{$media_url}' style='max-width: 435px;'/></a></p>";
					}
					print '<div id="detailTools">';
					if ($vn_comments_enabled) {
?>				
						<div class="detailTool">
							<a href='#' onclick='jQuery("#detailComments").slideToggle(); return false;'><span class="glyphicon glyphicon-comment"></span>Comments and Tags (<?php print sizeof($va_comments) + sizeof($va_tags); ?>)</a>
						</div><!-- end detailTool -->
						<div id='detailComments'><?php print $this->getVar("itemComments");?></div><!-- end itemComments -->
<?php				
					}
					if ($vn_share_enabled) {
						print '<div class="detailTool"><span class="glyphicon glyphicon-share-alt"></span>'.$this->getVar("shareLink").'</div><!-- end detailTool -->';
					}
					if ($vn_pdf_enabled) {
						print "<div class='detailTool'><span class='glyphicon glyphicon-file'></span>".caDetailLink($this->request, "Download as PDF", "faDownload", "ca_objects",  $vn_id, array('view' => 'pdf', 'export_format' => '_pdf_ca_objects_summary'))."</div>";
					}
?>
					<div class='detailTool'><a href='#' onclick='caMediaPanel.showPanel("<?= caNavUrl($this->request, '', 'Lightbox', 'addItemForm', array('object_id' => $vn_id)); ?>"); return false;' title='Add to lightbox'><span class='fa fa-suitcase'></span><?= _t('Add to favorites'); ?></a></div>
<?php
					print '</div><!-- end detailTools -->';
				}				

?>
			</div><!-- end col -->
			
			<div class='col-sm-6 col-md-6'>
<?php
				print "<div class='inquireButton'>".caNavLink($this->request, "<span class='glyphicon glyphicon-envelope'></span> Inquire", "btn btn-default btn-small", "", "Contact", "Form", array("table" => "ca_objects", "id" => $t_object->get("object_id")))."</div>";
?>

				<H1>{{{ca_objects.preferred_labels.name}}}</H1>
				{{{
					<ifdef code="ca_objects.alternativetitle"><div class="unit"><label>Translated title:</label>^ca_objects.alternativetitle</div></ifdef>
					}}}
				<HR>
				{{{<unit relativeTo="ca_collections" delimiter="<br/>"><label>Is part of:</label><l>^ca_collections.preferred_labels.name</l></unit><ifcount min="1" code="ca_collections"></ifcount>}}}
				<HR>

				<!-- identification -->

				{{{
					<ifdef code="ca_objects.external_link.url_source"><div class="unit"><label>External Link:</label><a href="^ca_objects.external_link.url_entry" target="_blank" class="url"><i class="fa fa-external-link" aria-hidden="true"></i>^ca_objects.external_link.url_source</a></div></ifdef>
					}}}
				

				<!-- end of identification labels -->
				<!-- Content and Scope -->

				{{{
					<ifdef code="ca_object_representations.media_class"><div class="unit"><label>Format:</label><unit relativeTo="ca_object_representations.media_class" delimiter="<br/>">^ca_object_representations.media_class</unit></div></ifdef>
					}}}

				{{{
					<ifdef code="ca_object_representations.media_filesize"><div class="unit"><label>Extent:</label><unit relativeTo="ca_object_representations.media_filesize" delimiter="<br/>">^ca_object_representations.media_filesize</unit></div></ifdef>
					}}}

					{{{
					<ifcode code="ca_object_representations.media_dimensions"><div class="unit"><label>Media dimensions:</label><unit relativeTo="ca_object_representations.media_dimensions" delimiter="<br/>">^ca_object_representations.media_dimensions</unit></div></ifcode>
				}}}

				{{{
					<ifcode code="ca_object_representations.media_format"><div class="unit"><label>Media format:</label><unit relativeTo="ca_object_representations.media_format" delimiter="<br/>">^ca_object_representations.media_format</unit></div></ifcode>
				}}}

				<HR>

				{{{
					<ifdef code="ca_objects.description"><div class="unit"><label>Description:</label>^ca_objects.description</div></ifdef>
					}}}

				{{{<ifdef code="ca_objects.translationofdescription"><div class="unit"><label>Translated description:</label>^ca_objects.translationofdescription</div></ifdef>}}}

				{{{<ifcount code="ca_objects.langmaterial.language" min="1"><div class="unit"><label>Language:</label><unit relativeTo="ca_objects.langmaterial" delimiter="<br/>">^ca_objects.langmaterial.material: ^ca_objects.langmaterial.language</unit></div></ifcount>}}}


				{{{
					<ifcount code="ca_objects.theme" min="1"><div class="unit"><label>Theme:</label><unit relativeTo="ca_objects.theme" delimiter="<br/>">^ca_objects.theme</unit></div></ifcount>
					}}}
				
					{{{
						<ifcount code="ca_objects.keywords" min="1"><div class="unit"><label>Keywords:</label><unit relativeTo="ca_objects.keywords" delimiter="<br/>">^ca_objects.keywords</unit></div></ifcount>
						}}}
				

				{{{
					<ifdef code="ca_objects.note"><div class="unit"><label>Notes:</label>^ca_objects.note</div></ifdef>
					}}}
				
				<!-- end of Content and Scope labels -->
				
				<!-- Custom labels -->

				<HR>

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
				</ifdef>}}}

				<HR>
				
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

				<!-- From this point, this is all legacy code. Check if it's necessary to keept it or remove it -->

				

				{{{<ifdef code="ca_objects.abstract"><div class="unit"><label>Abstract</label><div class="trimText">^ca_objects.abstract%delimiter=,_</div></div></ifdef>}}}
					
				{{{<ifdef code="ca_objects.material_type"><div class="unit"><label>Material Type</label>^ca_objects.material_type%delimiter=,_</div></ifdef>}}}
				
				{{{<ifdef code="ca_objects.unitdate.dacs_date_text"><div class="unit"><label>Date</label><unit relativeTo="ca_objects.unitdate" delimiter="<br/>"><ifdef code="ca_objects.unitdate.dacs_dates_labels">^ca_objects.unitdate.dacs_dates_labels: </ifdef>^ca_objects.unitdate.dacs_date_text <ifdef code="ca_objects.unitdate.dacs_dates_types">^ca_objects.unitdate.dacs_dates_types</ifdef></unit></div></ifdef>}}}
				
				

				{{{<ifdef code="ca_objects.url"><div class="unit"><label>Url To External Media</label><a href="^ca_objects.url" target="_blank" class="url"><i class="fa fa-external-link" aria-hidden="true"></i> ^ca_objects.url</a></div></ifdef>}}}
				{{{<ifcount code="ca_storage_locations" min="1"><div class="unit"><label>Location</label>
					<unit relativeTo="ca_storage_locations" delimiter="<br/>">^ca_storage_locations.hierarchy.preferred_labels%delimiter=_➔_</unit>
				</div></ifcount>}}}
				{{{<ifdef code="ca_objects.general_notes"><div class="unit"><label>Notes</label>^ca_objects.general_notes%delimiter=<br/></div></ifdef>}}}
				{{{<ifdef code="ca_objects.accessrestrict"><div class="unit"><label>Conditions Governing Access</label>^ca_objects.accessrestrict%delimiter=<br/></div></ifdef>}}}
				{{{<ifdef code="ca_objects.physaccessrestrict"><div class="unit"><label>Physical Access</label>^ca_objects.physaccessrestrict%delimiter=<br/></div></ifdef>}}}
				
				
				<hr>
					

				{{{
					<ifcount code="ca_occurrences" min="1"><div class="unit"><label>Related events</label><unit relativeTo="ca_occurrences" delimiter="<br/>"><l>^ca_occurrences.preferred_labels.name</l></unit></div></ifcount>
					}}}
					

				

				<HR>

				
						
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
</script>
