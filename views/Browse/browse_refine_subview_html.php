<?php
$va_facets = $this->getVar('facets');
$va_criteria = $this->getVar('criteria');
$vs_key = $this->getVar('key');
$va_views = $this->getVar('views');
$vs_current_view = $this->getVar('view');
$va_view_icons = $this->getVar('viewIcons');
$vs_browse_type = $this->getVar('browse_type');
$o_browse = $this->getVar('browse');
$vs_browse_key = $this->getVar('key');
$qr_res = $this->getVar('result');
$vn_facet_display_length_initial = 10;
$vn_facet_display_length_maximum = 60;
$vs_criteria = "";

if (sizeof($va_criteria) > 0) {
    $vb_start_over = false;
    foreach ($va_criteria as $va_criterion) {
        $vs_criteria .= caNavLink($this->request, '<button type="button" class="btn btn-default btn-sm">' . $va_criterion['value'] . ' <i class="far fa-times-circle" aria-label="Remove filter" role="button"></i></button>', 'browseRemoveFacet', '*', '*', '*', array('removeCriterion' => $va_criterion['facet_name'], 'removeID' => urlencode($va_criterion['id']), 'view' => $vs_current_view, 'key' => $vs_browse_key));
        $vb_start_over = true;
    }
    if ($vb_start_over) {
        $vs_criteria .= caNavLink($this->request, '<button type="button" class="btn btn-default btn-sm">' . _t("Start Over") . '</button>', 'browseRemoveFacet', '', 'Browse', '*', array('view' => $vs_current_view, 'key' => $vs_browse_key, 'clear' => 1, '_advanced' => $vn_is_advanced ? 1 : 0));
    }
}

if ((is_array($va_facets) && sizeof($va_facets)) || ($vs_criteria) || ($qr_res->numHits() > 1)) {
    print "<div id='bMorePanel'><!-- long lists of facets are loaded here --></div>";
    print "<div id='mySidebar' class='sidebar'>
            <button class='openbtn' onclick='toggleNav()'>☰</button>
            <span class='searchicon fa fa-search'></span>
                <div id='bViewButtons'>";

    if (is_array($va_views) && (sizeof($va_views) > 1)) {
        foreach ($va_views as $vs_view => $va_view_info) {
            if ($vs_current_view === $vs_view) {
                print '<a href="#" class="active"><span class="glyphicon  ' . $va_view_icons[$vs_view]['icon'] . '" aria-label="' . $vs_view . '" role="button"></span></a> ';
            } else {
                print caNavLink($this->request, '<span class="glyphicon ' . $va_view_icons[$vs_view]['icon'] . '" aria-label="' . $vs_view . '" role="button"></span>', 'disabled', '*', '*', '*', array('view' => $vs_view, 'key' => $vs_browse_key)) . ' ';
            }
        }
    }
    print "</div>
          <div class='sidebar-content'>";

    if ($qr_res->numHits() > 1) {
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

    if ((is_array($va_facets) && sizeof($va_facets)) || ($vs_criteria)) {
        print "<a href='#' class='pull-right' id='bRefineClose' onclick='jQuery(\"#bRefine\").toggle(); return false;'><i class='far fa-times-circle'></i></a>";
        print "<h2>" . _t("Filter by") . "</h2>";
        if ($vs_criteria) {
            print "<div class='bCriteria'>" . $vs_criteria . "</div>";
        }

        foreach ($va_facets as $vs_facet_name => $va_facet_info) {
            print "<h3 class='facet-toggle'>" . $va_facet_info['label_singular'] . "</h3>";
            print "<div class='facet-info' style='display: none;'>";

            if ((caGetOption('deferred_load', $va_facet_info, false) || ($va_facet_info["group_mode"] == 'hierarchical')) && ($o_browse->getFacet($vs_facet_name))) {
                print "<p>" . $va_facet_info['description'] . "</p>";
                ?>
                <script type="text/javascript">
                    jQuery(document).ready(function() {
                        jQuery("#bHierarchyList_<?php print $vs_facet_name; ?>").load("<?php print caNavUrl($this->request, '*', '*', 'getFacetHierarchyLevel', array('facet' => $vs_facet_name, 'browseType' => $vs_browse_type, 'key' => $vs_key, 'linkTo' => 'morePanel', 'view' => $vs_current_view)); ?>");
                    });
                </script>
                <div id='bHierarchyList_<?php print $vs_facet_name; ?>' class="facet-content"><?php print caBusyIndicatorIcon($this->request) . ' ' . addslashes(_t('Loading...')); ?></div>
                <?php
            } else {
                if (!is_array($va_facet_info['content']) || !sizeof($va_facet_info['content'])) {
                    continue;
                }
                foreach ($va_facet_info['content'] as $va_item) {
                    $vs_content_count = (isset($va_item['content_count']) && ($va_item['content_count'] > 0)) ? " (" . $va_item['content_count'] . ")" : "";
                    print "<div>" . caNavLink($this->request, $va_item['label'] . $vs_content_count, '', '*', '*', '*', array('key' => $vs_key, 'facet' => $vs_facet_name, 'id' => $va_item['id'], 'view' => $vs_current_view)) . "</div>";
                }
            }
            print "</div>"; // Close the facet info div
        }
    }
    print "</div></div><!-- end bRefine -->\n";
}
?>

<script type="text/javascript">
    jQuery(document).ready(function() {
        // Toggle visibility for facet info when clicking on facet name
        jQuery(".facet-toggle").click(function() {
            jQuery(this).next(".facet-info").slideToggle();
        });

        if (jQuery('#browseResultsContainer').height() > jQuery(window).height()) {
            var offset = jQuery('#bRefine').height(jQuery(window).height() - 30).offset(); // 0px top + (2 * 15px padding) = 30px
            var panelWidth = jQuery('#bRefine').width();
            jQuery(window).scroll(function() {
                var scrollTop = $(window).scrollTop();
                // check the visible top of the browser
                if (offset.top < scrollTop && ((offset.top + jQuery('#pageArea').height() - jQuery('#bRefine').height()) > scrollTop)) {
                    jQuery('#bRefine').addClass('fixed');
                    jQuery('#bRefine').width(panelWidth);
                } else {
                    jQuery('#bRefine').removeClass('fixed');
                }
            });
        }
    });
</script>
