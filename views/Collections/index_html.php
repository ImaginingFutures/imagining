<?php

	$va_access_values = caGetUserAccessValues($this->request);

	$o_collections_config = $this->getVar("collections_config");
	$qr_collections = $this->getVar("collection_results");
?>
	<div class="row">
	<div class="col-sm-12 col-md-8 col-md-offset-2">
			<h1>Projects</h1>
			<p><?php print $o_collections_config->get("collections_intro_text"); ?></p>

<?php	
	$vn_i = 0;
	if($qr_collections && $qr_collections->numHits()) {
		while($qr_collections->nextHit()) {
			$vs_thumbnail = $qr_collections->get('ca_object_representations.media.medium');

			if ($vn_i % 4 == 0) { // Start a new row every 4 items
				if ($vn_i > 0) { 
					print "</div><!-- end row -->"; 
				} 
				print "<div class='row'>";
        	}			
			print "<div class='col-12 col-sm-6 col-md-3 col-lg-3'>";
			print "<div class='grid-item collectionTile'>";
			
			if (!$vs_thumbnail) {
				$vs_thumbnail = caGetThemeGraphic($this->request, 'IF_logo.png');
			}
			print "<div class='collectionThumbnail'>". $vs_thumbnail. "</div>";
			print caDetailLink($this->request, "<div class='title'><i class='fas fa-hand-pointer'></i></div>", "", "ca_collections",  $qr_collections->get("ca_collections.collection_id"));
			if (($o_collections_config->get("description_template")) && ($vs_scope = $qr_collections->getWithTemplate($o_collections_config->get("description_template")))) {
				print "<div>".$vs_scope."</div>";
			}
			print "</div></div>"; // Close collection item
			$vn_i++;
		}
		if ($vn_i % 4 != 0) {
			print "</div><!-- end row -->";
		}
	} else {
		print _t('No collections available');
	}
?>
		</div>
	</div>
