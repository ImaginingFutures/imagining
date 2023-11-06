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

$va_access_values = caGetUserAccessValues($this->request);

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

# --------------------
# Mimetypes

$mimetypes = [
	'image' => [
		'types' => [
			'image/jpeg',
			'image/tiff',
			'image/png',
			'image/x-dcraw',
			'image/x-psd',
			'image/x-dpx',
			'image/jp2',
			'image/x-adobe-dng',
			'image/bmp',
			'image/x-bmp'
		],
		'label' => 'image'
	],
	'video' => [
		'types' => [
			'video/x-flv',
			'video/mpeg',
			'audio/x-realaudio',
			'video/quicktime',
			'video/x-ms-asf',
			'video/x-ms-wmv',
			'application/x-shockwave-flash',
			'video/x-matroska',
			'video/mp4',
			'x-world/x-qtvr',
			'application/postscript'
		],
		'label' => 'video'
	],
	'file-pdf' => [
		'types' => ['application/pdf'],
		'label' => 'pdf'
	],
	'file-alt' => [
		'types' => [
			'application/msword',
			'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
			'application/vnd.ms-excel',
			'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
			'application/vnd.ms-powerpoint',
			'application/vnd.openxmlformats-officedocument.presentationml.presentation'
		],
		'label' => 'document'
	],
	'file-audio' => [
		'types' => [
			'audio/mpeg',
			'audio/x-aiff',
			'audio/x-wav',
			'audio/wav',
			'audio/mp4'
		],
		'label' => 'audio'
	],
	'align-left' => [
		'types' => ['text/xml'],
		'label' => 'text'
	],
	'cubes' => [
		'types' => [
			'application/stl',
			'application/surf',
			'application/ply'
		],
		'label' => '3D'
	],
	'vr-cardboard' => [
		'types' => ['application/spincar'],
		'label' => '360'
	],
	'file-archive' => [
		'types' => ['application/octet-stream'],
		'label' => 'file'
	]
];

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
		<div class="container">
			<div class="row">
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
			<div class="row">
				<div class='col-sm-12'>

					<?php
					if ($vb_show_objects_link || $vb_show_collections_link) {
					?>
						<div class='collectionBrowseItems'>

							<?php
							if ($vb_show_objects_link) {
								print caNavLink($this->request, "<button type='button' class='btn btn-default btn-sm'><i class='fas fa-search' aria-label='Search'></i> Search inside the Collection</button>", "browseRemoveFacet", "", "browse", "objects", array("facet" => "collection_facet", "id" => $t_item->get("ca_collections.collection_id")));
							}
							if ($vb_show_collections_link) {
								print caNavLink($this->request, "<button type='button' class='btn btn-default btn-sm'><i class='fas fa-search' aria-label='Search'></i> Search in all collection</button>", "browseRemoveFacet", "", "browse", "objects", array("facet" => "collection_facet", "id" => $t_item->get("ca_collections.collection_id")));
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
				</div><!-- end col -->
			</div><!-- end row -->
			<div class="row">
				<div class='col-md-6 col-lg-6'>
					<label>People</label>
				</div>
			</div>

			<?php
			$v_ents = 0;

			$qr_entities = $t_item->get('ca_entities_x_collections.entity_id', array('returnAsArray' => true));
			#var_dump($qr_entities);
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
						$ca_entity_media = caGetThemeGraphic($this->request, "people.png");
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
			if (($v_ents < 2) && ($v_ents != 0)) {
				print "</div><!-- end row -->\n";
			}



			?>
		</div>
		<div class="row">

			<div class='col-md-6 col-lg-6'>
				{{{<ifdef code="ca_collections.description"><label>About</label>^ca_collections.description<br/></ifdef>}}}
				{{{<ifcount code="ca_objects" min="1" max="1"><div class='unit'><unit relativeTo="ca_objects" delimiter=" "><l>^ca_object_representations.media.large</l><div class='caption'>Related Object: <l>^ca_objects.preferred_labels.name</l></div></unit></div></ifcount>}}}
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

			</div><!-- end col -->
			<div class='col-md-6 col-lg-6'>
				{{{<ifcount code="ca_collections.related" min="1" max="1"><label>Related collection</label></ifcount>}}}
				{{{<ifcount code="ca_collections.related" min="2"><label>Related collections</label></ifcount>}}}
				{{{<unit relativeTo="ca_collections" delimiter="<br/>"><l>^ca_collections.related.preferred_labels.name</l> ^relationship_typename</unit>}}}


				{{{<ifcount code="ca_occurrences" min="1" max="1"><label>Related occurrence</label></ifcount>}}}
				{{{<ifcount code="ca_occurrences" min="2"><label>Related occurrences</label></ifcount>}}}
				{{{<unit relativeTo="ca_occurrences" delimiter="<br/>"><l>^ca_occurrences.preferred_labels.name</l> ^relationship_typename</unit>}}}

				{{{<ifcount code="ca_places" min="1" max="1"><label>Related place</label></ifcount>}}}
				{{{<ifcount code="ca_places" min="2"><label>Related places</label></ifcount>}}}
				{{{<unit relativeTo="ca_places" delimiter="<br/>"><l>^ca_places.preferred_labels.name</l> ^relationship_typename</unit>}}}
			</div><!-- end col -->
		</div><!-- end row -->
		<?php
		// Initialize the database connection and get the collection ID
		$o_db = new Db();
		$collection_id = $t_item->get("ca_collections.collection_id");

		// Fetch object IDs associated with the collection
		$object_id_array = [];
		$object_ids = $o_db->query("SELECT object_id FROM ca_objects_x_collections WHERE collection_id = $collection_id");
		while ($object_ids->nextRow()) {
			$object_id_array[] = $object_ids->get("object_id");
		}

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
		?>

		<div class="row">
			<div class='counter'>
				<?php
				if (!$category) {
					echo "<div class='mimetypeCat  col-4 col-xs-4 col-sm-4 col-md-2'><i class='fas fa-folder-minus'></i><div class='value'>0</div><div class='mimeLabel'>No items yet,<br>but not for long! </div></div>";
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

					if($counter == 4){
						$counter = 0;
					} else {
						$counter++;
					}
				}
				?>
			</div>
		</div>

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
		</script>

	</div><!-- end container -->
</div><!-- end col -->
<div class='navLeftRight col-xs-1 col-sm-1 col-md-1 col-lg-1'>
	<div class="detailNavBgRight">
		{{{nextLink}}}
	</div><!-- end detailNavBgLeft -->
</div><!-- end col -->
</div><!-- end row -->