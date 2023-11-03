<?php

$t_item = $this->getVar("item");
$va_comments = $this->getVar("comments");
$vn_comments_enabled = 	$this->getVar("commentsEnabled");
$vn_share_enabled = 	$this->getVar("shareEnabled");
$vn_pdf_enabled = 		$this->getVar("pdfEnabled");


?>

<div class="row">
	<h6>{{{Theme Name: ^ca_list_items.preferred_labels.name_plural}}}</h6>

	<h6>{{{Theme Rank: ^ca_list_items.rank}}}</h6>
	<HR>

					{{{<ifcount code="ca_collections" min="1" max="1"><label>Related collection</label></ifcount>}}}
					{{{<ifcount code="ca_collections" min="2"><label>Related collections</label></ifcount>}}}
					{{{<unit relativeTo="ca_collections" delimiter="<br/>"><l>^ca_collections.preferred_labels.name</l></unit>}}}	

					{{{<ifcount code="ca_objects" min="1" max="1"><label>Related objects</label></ifcount>}}}
					{{{<ifcount code="ca_objects" min="2"><label>Related objects</label></ifcount>}}}
					{{{<unit relativeTo="ca_objects" delimiter="<br/>"><l>^ca_objects.preferred_labels</l></unit>}}}	

					{{{<ifcount code="ca_entities" min="1" max="1"><label>Related person</label></ifcount>}}}
					{{{<ifcount code="ca_entities" min="2"><label>Related people</label></ifcount>}}}
					{{{<unit relativeTo="ca_entities" delimiter="<br/>"><l>^ca_entities.preferred_labels.displayname</l> ^relationship_typename</unit>}}}
					
	<HR>

</div><!-- end row -->