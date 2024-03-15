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
	$o_config = $this->getVar("config");	
	
	$va_options			= $this->getVar('options');
	$vs_extended_info_template = caGetOption('extendedInformationTemplate', $va_options, null);

	$vb_ajax			= (bool)$this->request->isAjax();

	$o_icons_conf = caGetIconsConfig();
	$va_object_type_specific_icons = $o_icons_conf->getAssoc("placeholders");

	$vs_default_placeholder_tag = "<div class='bResultItemImgPlaceholder'>".caGetThemeGraphic($this->request, 'IF_logo.png') ."</div>";
		
	
	$va_add_to_set_link_info = caGetAddToSetInfo($this->request);
	
		$vn_col_span = 4;
		$vn_col_span_sm = 4;
		$vn_col_span_xs = 12;
		$vb_refine = false;
		if(is_array($va_facets) && sizeof($va_facets)){
			$vb_refine = true;
			$vn_col_span = 6;
			$vn_col_span_sm = 6;
			$vn_col_span_xs = 12;
		}
		if ($vn_start < $qr_res->numHits()) {
			$vn_c = 0;
			$vn_results_output = 0;
			$qr_res->seek($vn_start);
			
			if ($vs_table != 'ca_objects') {
				$va_ids = array();
				while($qr_res->nextHit() && ($vn_c < $vn_hits_per_block)) {
					$va_ids[] = $qr_res->get("{$vs_table}.{$vs_pk}");
				}
			
				$qr_res->seek($vn_start);
				$va_images = caGetDisplayImagesForAuthorityItems($vs_table, $va_ids, array('version' => 'small', 'relationshipTypes' => caGetOption('selectMediaUsingRelationshipTypes', $va_options, null), 'objectTypes' => caGetOption('selectMediaUsingTypes', $va_options, null), 'checkAccess' => $va_access_values));
			} else {
				$va_images = null;
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
				$vn_id 					= $qr_res->get("{$vs_table}.{$vs_pk}");
				if($vn_id == $vn_row_id){
					$vb_row_id_loaded = true;
				}
				# --- check if this result has been cached
				# --- key is MD5 of table, id, view, refine(vb_refine)
				$vs_cache_key = md5($vs_table.$vn_id."list".$vb_refine);
				if(($o_config->get("cache_timeout") > 0) && ExternalCache::contains($vs_cache_key,'browse_result')){
					print ExternalCache::fetch($vs_cache_key, 'browse_result');
				}else{
				
					#$vs_idno_detail_link 	= caDetailLink($this->request, $qr_res->get("{$vs_table}.idno"), '', $vs_table, $vn_id);
					if($vs_table == "ca_collections"){
						if(strToLower($this->request->getAction()) == "archival_collections"){
							$vs_label_detail_link 	= caDetailLink($this->request, $qr_res->getWithTemplate('<unit relativeTo="ca_collections.hierarchy" delimiter=" &gt; ">^ca_collections.preferred_labels.name</unit>'), '', $vs_table, $vn_id);
							$vs_label_detail_link 	.= $qr_res->getWithTemplate('<ifdef code="ca_collections.unitdate.dacs_date_text"><div class="bResultListItemTextDate"><l><ifdef code="ca_collections.unitdate.dacs_date_text"><unit relativeTo="ca_collections.unitdate" delimiter="<br/>"><ifdef code="ca_collections.unitdate.dacs_dates_labels">^ca_collections.unitdate.dacs_dates_labels: </ifdef>^ca_collections.unitdate.dacs_date_text <ifdef code="ca_collections.unitdate.dacs_dates_types">^ca_collections.unitdate.dacs_dates_types</ifdef></unit></l></div></ifdef>');
					
						}else{
							$vs_label_detail_link 	= $qr_res->getWithTemplate('<b>^ca_collections.type_id:</b> <l><unit relativeTo="ca_collections.hierarchy" delimiter=" &gt; ">^ca_collections.preferred_labels.name</unit><br/>
															<small><ifdef code="ca_collections.unitdate.dacs_date_text"><ifdef code="ca_collections.unitdate.dacs_date_text"><unit relativeTo="ca_collections.unitdate" delimiter=", "><ifdef code="ca_collections.unitdate.dacs_dates_labels">^ca_collections.unitdate.dacs_dates_labels: </ifdef>^ca_collections.unitdate.dacs_date_text<ifdef code="ca_collections.unitdate.dacs_dates_types"> ^ca_collections.unitdate.dacs_dates_types</ifdef></unit><ifdef code="ca_collections.material_type|ca_collections.extentDACS.extent_number|ca_collections.extentDACS.extent_type">, </ifdef></ifdef>
															<ifdef code="ca_collections.material_type">^ca_collections.material_type%delimiter=,_<ifdef code="ca_collections.extentDACS.extent_number|ca_collections.extentDACS.extent_type">, </ifdef></ifdef>
															<ifdef code="ca_collections.extentDACS.extent_number|ca_collections.extentDACS.extent_type">
																<unit relativeTo="ca_collections.extentDACS">
																	<ifdef code="ca_collections.extentDACS.extent_number">^ca_collections.extentDACS.extent_number </ifdef>
																	<ifdef code="ca_collections.extentDACS.extent_type">^ca_collections.extentDACS.extent_type</ifdef>
																</unit>
															</ifdef></small></l>');
						}
					}else{
						$vs_extended_info = $qr_res->getWithTemplate('<ifdef code="ca_objects.unitdate.dacs_date_text"><ifdef code="ca_objects.unitdate.dacs_date_text"><unit relativeTo="ca_objects.unitdate" delimiter=", "><ifdef code="ca_objects.unitdate.dacs_dates_labels">^ca_objects.unitdate.dacs_dates_labels: </ifdef>^ca_objects.unitdate.dacs_date_text<ifdef code="ca_objects.unitdate.dacs_dates_types"> ^ca_objects.unitdate.dacs_dates_types</ifdef></unit><ifdef code="ca_objects.material_type|ca_objects.extentDACS.extent_number|ca_objects.extentDACS.extent_type">, </ifdef></ifdef>
							<ifdef code="ca_objects.material_type">^ca_objects.material_type%delimiter=,_<ifdef code="ca_objects.extentDACS.extent_number|ca_objects.extentDACS.extent_type">, </ifdef></ifdef>
							<ifdef code="ca_objects.extentDACS.extent_number|ca_objects.extentDACS.extent_type">
								<unit relativeTo="ca_objects.extentDACS">
									<ifdef code="ca_objects.extentDACS.extent_number">^ca_objects.extentDACS.extent_number </ifdef>
									<ifdef code="ca_objects.extentDACS.extent_type">^ca_objects.extentDACS.extent_type</ifdef>
								</unit>
							</ifdef>');
				
						$vs_label_detail_link 	= caDetailLink($this->request, $qr_res->get("{$vs_table}.preferred_labels")."<br/><small>".$vs_extended_info."</small>", '', $vs_table, $vn_id);
					}
					$vs_thumbnail = "";
					$vs_type_placeholder = "";
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
					
					$vs_expanded_info = $qr_res->getWithTemplate($vs_extended_info_template);
					$vs_idno_detail = $qr_res->get("{$vs_table}.idno");
// Check if the table is 'ca_objects'
if ($vs_table == 'ca_objects') {
    // Retrieve entity information related to the current object
    if ($va_entity_rels = $qr_res->get('ca_objects_x_entities.relation_id', array('returnAsArray' => true))) {
        $va_entities_by_type = array();
        foreach ($va_entity_rels as $va_key => $va_entity_rel) {
            $t_rel = new ca_objects_x_entities($va_entity_rel);
            $vn_type_id = $t_rel->get('ca_relationship_types.preferred_labels');
            // Retrieve entity name without hyperlink
            $entity_name = $t_rel->get('ca_entities.preferred_labels');
            $va_entities_by_type[$vn_type_id][] = $entity_name;
        }
    }

    $contributors = '';
    $lastContributorEntityType = '';

    // Check if there are creators in the array
    if (isset($va_entities_by_type['had as creator'])) {
        $creators = array_unique($va_entities_by_type['had as creator']);
        $contributors = implode(', ', $creators);
        $lastContributorEntityType = 'Creator'; // Set entity type to "Creator" if creators are present
    } elseif (isset($va_entities_by_type['had as rights holder'])) {
        $rightsHolders = array_unique($va_entities_by_type['had as rights holder']);
        $contributors = implode(', ', $rightsHolders);
        $lastContributorEntityType = 'Rights Holder'; // Set entity type to "Rights Holder" if rights holders are present
    } elseif (isset($va_entities_by_type['had as contributor'])) {
        $contributors = implode(', ', $va_entities_by_type['had as contributor']);
        // Retrieve the last contributor's entity type
        $lastContributorEntities = end($va_entities_by_type['had as contributor']);
        $lastContributorEntityType = !empty($lastContributorEntities) ? key($lastContributorEntities) : 'Creator'; // Set entity type to "Creator" if the last contributor's entity type is unknown
    } else {
        // If no creators, rights holders, or contributors, check for other entity types
        $contributorString = '';

        // Iterate through other entity types and add them to the contributorString
        foreach ($va_entities_by_type as $type => $entities) {
            if ($type !== 'had as contributor') {
                if (!empty($contributorString)) {
                    $contributorString .= ', ';
                }
                $contributorString .= implode(', ', $entities);
            }
        }

        if (!empty($contributorString)) {
            $contributors = $contributorString;
        } else {
            $contributors = 'Unknown';
        }
    }
} else {
    // If the table is not 'ca_objects', set the contributors to 'Unknown'
    $contributors = 'Unknown';
}

if ($vs_table == 'ca_objects') {
    // Retrieve collection information related to the current object
    if ($va_collection_rels = $qr_res->get('ca_objects_x_collections.relation_id', array('returnAsArray' => true))) {
        $collections = array();
        foreach ($va_collection_rels as $va_key => $va_collection_rel) {
            $t_rel = new ca_objects_x_collections($va_collection_rel);
            $collection_name = $t_rel->get('ca_collections.preferred_labels.name');
            $collections[] = $collection_name;
        }
        // Join collection names into a single string
        $collection_info = implode(', ', $collections);
    } else {
        // If no related collections found, set collection_info to 'Unknown'
        $collection_info = 'Unknown';
    }
} else {
    // If the table is not 'ca_objects', set collection_info to 'Unknown'
    $collection_info = 'Unknown';
}




// Initialize $prjleader variable
$prjleader = '';

if ($vs_table == 'ca_collections') {
    if ($va_entity_rels = $qr_res->get('ca_collections_x_entities.relation_id', array('returnAsArray' => true))) {
        $entities = array();
        foreach ($va_entity_rels as $va_entity_rel) {
            $t_rel = new ca_collections_x_entities($va_entity_rel);
            $entity_name = $t_rel->get('ca_entities.preferred_labels.name');
            $entities[] = $entity_name;
        }
        $prjleader = implode(', ', $entities); // Join entity names into a single string
    } else {
        $prjleader = 'Unknown'; // If no related entities found, set prjleader to 'Unknown'
    }
}


$vs_result_output = "
    <div class='bResultListItemCol'>
        <div class='bResultListItem' id='row{$vn_id}'>
            <div class='bSetsSelectMultiple'><input type='checkbox' name='object_ids[]' value='{$vn_id}'></div>
            <div class='bResultListItemContent'>";

if ($vs_table == 'ca_objects') {
    $vs_result_output .= "<div class='listItemImgSpace'>
                            <div class='listItemImg'>{$vs_rep_detail_link}</div>
                          </div>";
}

$vs_result_output .= "<div class='bResultListItemText'>
                        <p id='cardtitle'> {$vs_label_detail_link} </p>
                        <p> ID: {$vs_idno_detail}</p>
						";

if ($vs_table == 'ca_objects') {
	$vs_result_output .= "<p> Project: {$collection_info}</p>";
    $vs_result_output .= "<p> {$lastContributorEntityType}: {$contributors} </p>";
}

// Add project leader information specifically for projects page
if ($vs_table == 'ca_collections') {
    $vs_result_output .= "<p>Project Leader:{$prjleader}</p>";
}

$vs_result_output .= "</div><!-- end bResultListItemText -->
                    <span class='listcardicon fa fa-image'></span>";

if ($vs_table == 'ca_objects') {
    // Additional icons or information specific to objects
}

$vs_result_output .= "</div><!-- end bResultListItemContent -->
                    <span class='listcardicon2 fab fa-creative-commons'></span> 
                </div><!-- end bResultListItem -->
            </div><!-- end col -->";

ExternalCache::save($vs_cache_key, $vs_result_output, 'browse_result');
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