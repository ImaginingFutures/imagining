<?php
/* ----------------------------------------------------------------------
 * themes/imagining/views/CollectedWorks/index_html.php : 
 * ----------------------------------------------------------------------
 *
 * ----------------------------------------------------------------------
 */


	$va_access_values = caGetUserAccessValues($this->request);

	$o_collections_config = $this->getVar("collectedworks_config");
	$qr_collections = $this->getVar("collection_results");
    while($qr_collections->nextHit()) {
        echo $qr_collections->get("ca_collections");
    }

    ?>