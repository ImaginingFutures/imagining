<?php
/* ----------------------------------------------------------------------
 * views/Browse/browse_refine_subview_html.php : 
 * ----------------------------------------------------------------------
 * CollectiveAccess
 * Open-source collections management software
 * ----------------------------------------------------------------------
 *
 * Software by Whirl-i-Gig (http://www.whirl-i-gig.com)
 * Copyright 2014-2015 Whirl-i-Gig
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
 
	$va_facets 			= $this->getVar('facets');				// array of available browse facets
	$va_criteria 		= $this->getVar('criteria');			// array of browse criteria
	$vs_key 			= $this->getVar('key');					// cache key for current browse
	$va_access_values 	= $this->getVar('access_values');		// list of access values for this user
	$vs_view			= $this->getVar('view');
	$vs_browse_type		= $this->getVar('browse_type');
	$o_browse			= $this->getVar('browse');
	$vs_browse_key 		= $this->getVar('key');					// cache key for current browse
	$vs_current_view	= $this->getVar('view');
	$qr_res 			= $this->getVar('result');				// browse results (subclass of SearchResult)
	
	$vn_facet_display_length_initial = 10;
	$vn_facet_display_length_maximum = 60;
	$vs_criteria = "";
	if (sizeof($va_criteria) > 0) {
		$i = 0;
		$vb_start_over = false;
		foreach($va_criteria as $va_criterion) {
			$vs_criteria .= caNavLink($this->request, '<button type="button" class="btn btn-default btn-sm">'.$va_criterion['value'].' <i class="far fa-times-circle" aria-label="Remove filter" role="button"></i></button>', 'browseRemoveFacet', '*', '*', '*', array('removeCriterion' => $va_criterion['facet_name'], 'removeID' => urlencode($va_criterion['id']), 'view' => $vs_current_view, 'key' => $vs_browse_key));
			$vb_start_over = true;
			$i++;
		}
		if($vb_start_over){
			$vs_criteria .= caNavLink($this->request, '<button type="button" class="btn btn-default btn-sm">'._t("Start Over").'</button>', 'browseRemoveFacet', '', 'Browse', '*', array('view' => $vs_current_view, 'key' => $vs_browse_key, 'clear' => 1, '_advanced' => $vn_is_advanced ? 1 : 0));
		}
	}
	
	if((is_array($va_facets) && sizeof($va_facets)) || ($vs_criteria) || ($qr_res->numHits() > 1)){
		print "<div id='bMorePanel'><!-- long lists of facets are loaded here --></div>";
		print "<div id='bRefine'>";
		if($qr_res->numHits() > 1){
?>
			<div class="bSearchWithinContainer">
				<form role="search" id="searchWithin" action="<?php print caNavUrl($this->request, '*', 'Search', '*'); ?>">
					<input type="text" class="form-control bSearchWithin" placeholder="Search within..." name="search_refine" id="searchWithinSearchRefine" aria-label="Search Within"><button type="submit" class="btn-search-refine"><i class="fas fa-search" aria-label="submit search"></i></button>
					<input type="hidden" name="key" value="<?php print $vs_browse_key; ?>">
					<input type="hidden" name="view" value="<?php print $vs_current_view; ?>">
				</form>
				<div style="clear:both"></div>
			</div>	
<?php
		}
		if((is_array($va_facets) && sizeof($va_facets)) || ($vs_criteria)){
			print "<a href='#' class='pull-right' id='bRefineClose' onclick='document.getElementById(\"bRefine\").classList.remove(\"visible\"); document.getElementById(\"bRefine\").classList.add(\"collapsed\"); return false;'><i class='far fa-times-circle'></i></a>"; 
			print "<H2>"._t("Filters")."</H2>";
			if($vs_criteria){
				print "<div class='bCriteria'>".$vs_criteria."</div>";
			}
			
			foreach($va_facets as $vs_facet_name => $va_facet_info) {
			
				if ((caGetOption('deferred_load', $va_facet_info, false) || ($va_facet_info["group_mode"] == 'hierarchical')) && ($o_browse->getFacet($vs_facet_name))) {
					print "<H3>".$va_facet_info['label_singular']."</H3>";
					print "<p>".$va_facet_info['description']."</p>";
					echo "<select class='filter-dropdown-hierarchical' id='select_{$vs_facet_name}' style='width: 100%;'></select>"; 

	?>
						<script type="text/javascript">
							jQuery(document).ready(function () {
								var selectElement = jQuery('#select_<?php echo $vs_facet_name; ?>').select2({
									data: [{id: 0, text: 'Select an option'}]
								});

								jQuery.ajax({
									url: "<?php print caNavUrl($this->request, '*', '*', 'getFacetHierarchyLevel', array('facet' => $vs_facet_name, 'browseType' => $vs_browse_type, 'key' => $vs_key, 'linkTo' => 'morePanel')); ?>",
									success: function(htmlResponse) {
										var data = [];
										jQuery(htmlResponse).find('a').each(function() {
											var link = jQuery(this);
											var id = link.attr('href').match(/id\/(\d+)/)[1];
											var text = link.text();
											data.push({id:id, text:text})
										});

										selectElement.select2({
											data: data
										});
									},
									error: function(xhr, status, error) {
										console.log("Error fetching data: ", status, error)
									}
								});
							});
							</script>
						<!-- Busy indicator not required for Select2 -->
						<!-- <div id='bHierarchyList_<?php print $vs_facet_name; ?>'><?php print caBusyIndicatorIcon($this->request).' '.addslashes(_t('Loading...')); ?></div> -->
	<?php
				} else {				
					if (!is_array($va_facet_info['content']) || !sizeof($va_facet_info['content'])) { continue; }
					print "<h3>".$va_facet_info['label_singular']."</h3>"; 
					switch($va_facet_info["group_mode"]){
						case "alphabetical":
						case "list":
						default:
							$vn_facet_size = sizeof($va_facet_info['content']);
							$vn_c = 0;
							echo "<select class='filter-dropdown' name='filter' style='width: 100%;'>";
							foreach($va_facet_info['content'] as $va_item) {
								$vs_content_count = (isset($va_item['content_count']) && ($va_item['content_count'] > 0)) ? " (".$va_item['content_count'].")" : "";
								
								$facet_link = caNavUrl($this->request, '', '*', '*', array('key' => $vs_key, 'facet' => $vs_facet_name, 'id' => $va_item['id'], 'view' => $vs_view));
								
								echo "<option value='{$facet_link}'>" . htmlspecialchars($va_item['label'].$vs_content_count) . "</option>";
								/* commented just for referencing legacy code */
								/* print "<div>".caNavLink($this->request, $va_item['label'].$vs_content_count, '', '*', '*','*', array('key' => $vs_key, 'facet' => $vs_facet_name, 'id' => $va_item['id'], 'view' => $vs_view))."</div>"; */
								
								/* TODO: review the functionality of Select2 with large lists of filters. */
								$vn_c++;
						
								if (($vn_c == $vn_facet_display_length_initial) && ($vn_facet_size > $vn_facet_display_length_initial) && ($vn_facet_size <= $vn_facet_display_length_maximum)) {
									print "<span id='{$vs_facet_name}_more' style='display: none;'>";
								} else {
									if(($vn_c == $vn_facet_display_length_initial) && ($vn_facet_size > $vn_facet_display_length_maximum))  {
										break;
									}
								}
							} echo "</select>";

							/* TODO: test if vn_facet_display_length_maximum is required with Select2 */
							if (($vn_facet_size > $vn_facet_display_length_initial) && ($vn_facet_size <= $vn_facet_display_length_maximum)) {
								print "</span>\n";
						
								$vs_link_open_text = _t("and %1 more", $vn_facet_size - $vn_facet_display_length_initial);
								$vs_link_close_text = _t("close", $vn_facet_size - $vn_facet_display_length_initial);
								print "<div><a href='#' class='more' id='{$vs_facet_name}_more_link' onclick='jQuery(\"#{$vs_facet_name}_more\").slideToggle(250, function() { jQuery(this).is(\":visible\") ? jQuery(\"#{$vs_facet_name}_more_link\").text(\"".addslashes($vs_link_close_text)."\") : jQuery(\"#{$vs_facet_name}_more_link\").text(\"".addslashes($vs_link_open_text)."\")}); return false;'><em>{$vs_link_open_text}</em></a></div>";
							} elseif (($vn_facet_size > $vn_facet_display_length_initial) && ($vn_facet_size > $vn_facet_display_length_maximum)) {
								print "<div><a href='#' class='more' onclick='jQuery(\"#bMorePanel\").load(\"".caNavUrl($this->request, '*', '*', '*', array('getFacet' => 1, 'facet' => $vs_facet_name, 'view' => $vs_view, 'key' => $vs_key))."\", function(){jQuery(\"#bMorePanel\").show(); jQuery(\"#bMorePanel\").mouseleave(function(){jQuery(\"#bMorePanel\").hide();});}); return false;'><em>"._t("and %1 more", $vn_facet_size - $vn_facet_display_length_initial)."</em></a></div>";
							}
						break;
						# ---------------------------------------------
					}
				}
			}
		}
		print "</div><!-- end bRefine -->\n";
?>
	<script type="text/javascript">
		jQuery(document).ready(function() {
            if(jQuery('#browseResultsContainer').height() > jQuery(window).height()){
				var offset = jQuery('#bRefine').height(jQuery(window).height() - 30).offset();   // 0px top + (2 * 15px padding) = 30px
				var panelWidth = jQuery('#bRefine').width();
				jQuery(window).scroll(function () {
					var scrollTop = $(window).scrollTop();
					// check the visible top of the browser
					if (offset.top<scrollTop && ((offset.top + jQuery('#pageArea').height() - jQuery('#bRefine').height()) > scrollTop)) {
						jQuery('#bRefine').addClass('fixed');
						jQuery('#bRefine').width(panelWidth);
					} else {
						jQuery('#bRefine').removeClass('fixed');
					}
				});
            }
		});
	</script>

<script>
	$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
</script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    function updateRefineVisibility() {
        var bRefine = document.getElementById('bRefine');
        if (window.innerWidth < 767) {
            bRefine.classList.add('collapsed');
            bRefine.classList.remove('visible');
        } else {
            bRefine.classList.remove('collapsed');
            bRefine.classList.add('visible');
        }
    }

    updateRefineVisibility();
    window.addEventListener('resize', updateRefineVisibility);

    document.getElementById('sidebarCollapse').addEventListener('click', function () {
        var bRefine = document.getElementById('bRefine');
        if (bRefine.classList.contains('visible')) {
            bRefine.classList.remove('visible');
            bRefine.classList.add('collapsed');
        } else {
            bRefine.classList.add('visible');
            bRefine.classList.remove('collapsed');
        }
    });
});
</script>

<!-- Script to handle the dropdown selection -->
<script>
	$(document).ready(function() {
    $('.filter-dropdown').select2({
        placeholder: "Select a filter",
        allowClear: true
    }).on('change', function() {
        var selectedUrl = $(this).val(); // This will be the URL from the option's value
        if(selectedUrl) { // Check if something is selected
            window.location.href = selectedUrl; // Redirect to the selected URL
        }
    });
});

</script>

<?php	
	}
?>
