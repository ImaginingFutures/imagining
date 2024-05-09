<?php
/* ----------------------------------------------------------------------
 * views/Browse/browse_results_images_html.php : 
 * ----------------------------------------------------------------------
 * CollectiveAccess
 * Open-source collections management software
 * ----------------------------------------------------------------------
 *
 * Software by Whirl-i-Gig (http://www.whirl-i-gig.com)
 * Copyright 2014 Whirl-i-Gig
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
 
	$qr_res 			= $this->getVar('result');				// browse results (subclass of SearchResult)
	$va_facets 			= $this->getVar('facets');				// array of available browse facets
	$va_criteria 		= $this->getVar('criteria');			// array of browse criteria
	$vs_browse_key 		= $this->getVar('key');					// cache key for current browse
	$va_access_values 	= $this->getVar('access_values');		// list of access values for this user
	$vn_hits_per_block 	= (int)$this->getVar('hits_per_block');	// number of hits to display per block
	$vn_start		 	= (int)$this->getVar('start');			// offset to seek to before outputting results
	$vn_row_id		 	= (int)$this->getVar('row_id');			// id of last visited detail item so can load to and jump to that result - passed in back button
	$vb_row_id_loaded 	= false;
	if(!$vn_row_id){
		$vb_row_id_loaded = true;
	}
		
	$va_views			= $this->getVar('views');
	$vs_current_view	= $this->getVar('view');
	$va_view_icons		= $this->getVar('viewIcons');
	$vs_current_sort	= $this->getVar('sort');
	
	$t_instance			= $this->getVar('t_instance');
	$vs_table 			= $this->getVar('table');
	$vs_pk				= $this->getVar('primaryKey');
	$va_access_values = caGetUserAccessValues($this->request);
	$o_config = $this->getVar("config");	
	
	$va_options			= $this->getVar('options');
	$vs_extended_info_template = caGetOption('extendedInformationTemplate', $va_options, null);

	$vb_ajax			= (bool)$this->request->isAjax();
	
	require_once(__CA_THEMES_DIR__ . "/imagining/views/Details/data/mimetypes.php");

	$va_add_to_set_link_info = caGetAddToSetInfo($this->request);

	$vs_default_placeholder_tag = "<div class='bResultItemImgPlaceholder'>".caGetThemeGraphic($this->request, 'IF_logo.png') ."</div>";
	
	function getColumnSpan($isFacetAvailable) {
		if ($isFacetAvailable) {
			return [12, 6, 4]; // md, sm, xs
		}
		return [12, 6, 3]; // Default column spans
	}

	# this needs to be put outside the browse view
	function cutTitle($title) {
		if (strlen($title) <= 45) return $title;
	
		$reducedTitle = "";
		$words = explode(" ", $title);
		foreach ($words as $word) {
			if (strlen($reducedTitle) + strlen($word) + 1 > 45) break;
			$reducedTitle .= $word . " ";
		}
		return trim($reducedTitle) . '...';
	}

	function trimText($text, $maxChars = 150) {
		if (strlen($text) > $maxChars) {
			$text = substr($text, 0, $maxChars) . '...';
		}
		return $text;
	}

	if ($vn_start < $qr_res->numHits()) {
		$vn_c = 0;
		$vn_results_output = 0;
		$qr_res->seek($vn_start);
		
		if ($vs_table != 'ca_objects') {
			$va_ids = array();
			while($qr_res->nextHit() && ($vn_c < $vn_hits_per_block)) {
				$va_ids[] = $qr_res->get($vs_pk);
				$vn_c++;
			}
			$va_images = caGetDisplayImagesForAuthorityItems($vs_table, $va_ids, array('version' => 'small', 'relationshipTypes' => caGetOption('selectMediaUsingRelationshipTypes', $va_options, null), 'objectTypes' => caGetOption('selectMediaUsingTypes', $va_options, null), 'checkAccess' => $va_access_values));
		
			$vn_c = 0;	
			$qr_res->seek($vn_start);
		}
		
		$t_list_item = new ca_list_items();
		while($qr_res->nextHit()) {
			if($vn_c == $vn_hits_per_block){
				if($vb_row_id_loaded){
					break;
				}else{
					$vn_c = 0;
				}
			}
			$vn_id = $qr_res->get("{$vs_table}.{$vs_pk}");
			if($vn_id == $vn_row_id){
				$vb_row_id_loaded = true;
			}
			
			# --- check if this result has been cached
			# --- key is MD5 of table, id, list, refine(vb_refine)
			$vs_cache_key = md5($vs_table.$vn_id."images".$vb_refine);
			if(($o_config->get("cache_timeout") > 0) && ExternalCache::contains($vs_cache_key,'browse_result')){
				print ExternalCache::fetch($vs_cache_key, 'browse_result');
			}else{			
				$vs_idno_detail = $qr_res->get("{$vs_table}.idno");
				$preferred_label = cutTitle($qr_res->get("{$vs_table}.preferred_labels"));
				$vs_label_detail_link 	= caDetailLink($this->request, $preferred_label, '', $vs_table, $vn_id);
				
				$vs_thumbnail = "";
				$vs_typecode = "";
				if ($vs_table == 'ca_objects') {
					if(!($vs_thumbnail = $qr_res->get('ca_object_representations.media.medium', array("checkAccess" => $va_access_values)))){
						$t_list_item->load($qr_res->get("type_id"));
						$vs_typecode = $t_list_item->get("idno");
						$vs_thumbnail = $vs_default_placeholder_tag;
					}
					$vs_info = null;
					
					$vs_rep_detail_link 	= caDetailLink($this->request, $vs_thumbnail, '', $vs_table, $vn_id);		
				} else {
					if($va_images[$vn_id]){
						$vs_thumbnail = $va_images[$vn_id];
					}else{
						$vs_thumbnail = $vs_default_placeholder_tag;
					}
					$vs_rep_detail_link 	= caDetailLink($this->request, $vs_thumbnail, '', $vs_table, $vn_id);			
				}
				$vs_add_to_set_link = "";
				if(($vs_table == 'ca_objects') && is_array($va_add_to_set_link_info) && sizeof($va_add_to_set_link_info)){
					$vs_add_to_set_link = "<a href='#' onclick='caMediaPanel.showPanel(\"".caNavUrl($this->request, '', $va_add_to_set_link_info["controller"], 'addItemForm', array($vs_pk => $vn_id))."\"); return false;' title='".$va_add_to_set_link_info["link_text"]."'>".$va_add_to_set_link_info["icon"]."</a>";
				}

				if($vs_table == 'ca_objects') {
					$mimeType = $qr_res->get('ca_object_representations.mimetype', array("checkAccess" => $va_access_values));
					$mimeTypes = new MimeTypes();
					$mediaTypeIcon = $mimeTypes->getIconClass($mimeType);
					$wrapper_class = 'bResultItemWrapper';

					$rights = $qr_res->get('ca_objects.rights.preferred_labels');
					if(str_contains($rights, 'Creative Commons')){
						$licenseIcon = 'fab fa-creative-commons';
					} else {
						$licenseIcon = 'far fa-copyright';
					};

					$entity_ids = $qr_res->get('ca_entities.entity_id', array('returnAsArray' => true));
					$entity_labels = $qr_res->get('ca_entities.preferred_labels.displayname', array('returnAsArray' => true));

					$creators = "";
					foreach ($entity_ids as $index => $id) {
						$label = $entity_labels[$index];
						$creators .= caDetailLink($this->request, $label, 'creator-link', 'ca_entities', $id) . " ";
					}

					$collection_ids = $qr_res->get('ca_collections.collection_id', array('returnAsArray' => true));
					$collection_labels = $qr_res->get('ca_collections.preferred_labels', array('returnAsArray' => true));

					$collection_links = "";
					foreach ($collection_ids as $index => $id) {
						$label = $collection_labels[$index];
						$collection_links .= caDetailLink($this->request, $label, 'collection-link', 'ca_collections', $id);
					}

					$detailInfo = "<p class='expandable-mini'>$creators</p>
									<p class='expandable'>$collection_links</p>";


				} elseif ($vs_table == 'ca_collections') {
					$wrapper_class = 'bResultItemWrapper';

					$project_type = $qr_res->get('ca_collections.prjtype.preferred_labels');
					$project_region = $qr_res->get('ca_collections.prjregion.preferred_labels');

					$detailInfo = "<p class='expandable-mini'>$project_type</p>
									<p class='expandable-mini'>$project_region</p>";

				} elseif ($vs_table == 'ca_entities') {
					$wrapper_class = 'bResultItemWrapper';
					$collection_ids = $qr_res->get('ca_collections.collection_id', array('returnAsArray' => true));
					$collection_labels = $qr_res->get('ca_collections.preferred_labels', array('returnAsArray' => true));

					$collection_links = "";
					foreach ($collection_ids as $index => $id) {
						$label = $collection_labels[$index];
						$collection_links .= caDetailLink($this->request, $label, 'collection-link', 'ca_collections', $id);
					}

					$detailInfo = "<p class='expandable'>$collection_links</p>";
				}

				$vs_expanded_info = $qr_res->getWithTemplate($vs_extended_info_template);

				$trimmedExpandedInfo = trimText($vs_expanded_info);

				$isFacetAvailable = is_array($va_facets) && sizeof($va_facets);

				list($colSpanXs, $colSpanSm, $colSpanMd) = getColumnSpan($isFacetAvailable);

				

				$vs_result_output = "
				<div class='bResultItemCol col-xs-{$colSpanXs} col-sm-{$colSpanSm} col-md-{$colSpanMd}'>
					<div class='{$wrapper_class}'>
						<div class='bResultItem' id='row{$id}'>
							<div class='bSetsSelectMultiple'>
								<input type='checkbox' name='object_ids' value='{$vn_id}'>
							</div>
							
							<div class='bResultItemContent'>
								<div class='bResultItemImg'>{$vs_rep_detail_link}</div>
								<div class='bResultItemText'>
									<small>{$vs_idno_detail_link}</small>
									<div>{$vs_label_detail_link}</div>
								</div><!-- end bResultItemText -->
							</div><!-- end bResultItemContent -->
							
							
							
							
							<div class='bResultItemExpandedInfo' id='bResultItemExpandedInfo{$vn_id}'>
							<p class='expandable'>{$trimmedExpandedInfo}</p>
							{$detailInfo}
							</div><!-- bResultItemExpandedInfo -->
							<div class='bResultItemFooter'>
								<div class='icons-container'>
								<i class='{$mediaTypeIcon}' aria-hidden='true'></i>
								<i class='{$licenseIcon}' aria-hidden='true'></i>
								</div>
								<div class='button-container'>
									{$vs_add_to_set_link}
								</div>
							</div>
						</div><!-- end bResultItem -->
					</div><!-- end bResultItemWrapper -->
				</div><!-- end col -->
			";
				ExternalCache::save($vs_cache_key, $vs_result_output, 'browse_result', $o_config->get("cache_timeout"));
				print $vs_result_output;
			}				
			$vn_c++;
			$vn_results_output++;
		}
		
		print "<div style='clear:both'></div>".caNavLink($this->request, _t('Next %1', $vn_hits_per_block), 'jscroll-next', '*', '*', '*', array('s' => $vn_start + $vn_results_output, 'key' => $vs_browse_key, 'view' => $vs_current_view, 'sort' => $vs_current_sort, '_advanced' => $this->getVar('is_advanced') ? 1  : 0));
	}
?>
<script type="text/javascript">
	jQuery(document).ready(function() {
		if($("#bSetsSelectMultipleButton").is(":visible")){
			$(".bSetsSelectMultiple").show();
		}
	});
</script>

<!-- <script>
	$(document).ready(function() {
    $('.bResultItem').hover(
        function() {
            $(this).find('.bResultItemExpandedInfo').slideDown();
        }, function() {
            $(this).find('.bResultItemExpandedInfo').slideUp();
        }
    );
});

</script> -->