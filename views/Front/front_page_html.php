<?php
/** ---------------------------------------------------------------------
 * themes/default/Front/front_page_html : Front page of site 
 * ----------------------------------------------------------------------
 * CollectiveAccess
 * Open-source collections management software
 * ----------------------------------------------------------------------
 *
 * Software by Whirl-i-Gig (http://www.whirl-i-gig.com)
 * Copyright 2013 Whirl-i-Gig
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
 * @package CollectiveAccess
 * @subpackage Core
 * @license http://www.gnu.org/copyleft/gpl.html GNU Public License version 3
 *
 * ----------------------------------------------------------------------
 */
$t_object = 			$this->getVar("item");
    $va_access_values = $this->getVar("access_values");
    $vs_hero = $this->request->getParameter("hero", pString);
    if(!$vs_hero){
        $vs_hero = rand(1, 1);
    }
?>

<div class="parallax hero<?php print $vs_hero; ?>">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-8 col-md-offset-2 col-lg-6 col-lg-offset-3">
                
                <div class="heroSearch">
                    <H1>
                        <div class="line1">Welcome to</div>
                        <div class="line2">Imagining Futures<br/> Repository (Pilot)</div>
                    </H1>
                    <form role="search" action="<?php print caNavUrl($this->request, '', 'MultiSearch', 'Index'); ?>">
                        <div class="formOutline">
                            <div class="form-group">
                                <input type="text" class="form-control" id="heroSearchInput" placeholder="<?php print _t("Search"); ?>" name="search" autocomplete="off" aria-label="<?php print _t("Search"); ?>" />
                            </div>
                            <button type="submit" class="btn-search" id="heroSearchButton"><span class="glyphicon glyphicon-search" aria-label="<?php print _t("Submit Search"); ?>"></span></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<section name="IF Overview">
    <div class="row" style="height: auto;">
        <div class="container">
            <h1>Imagining Futures Overview</h1>
            <div class="col-sm-6 col-md-6">
                <div style="width: fit-content;">
                    <h2>Who decides what gets to be remembered into the future, and to shape it?</h2>
                    <p>We draw on the widest meaning of archive by including documents, material remains and creations, landscapes, oral transmissions, song, bodily movements, daily customs and ancestral laws. Join us in our aim is to build methodologies of egalitarian archiving practices that allow for co-existence and recognition of multiple experiences and narratives of the past that challenge a singular ‘we’.
                        <br> Our aspiration, in recognizing the power of archives, is to make them sites of engagement through:
                        <br>
                        <ul>
                            <li>exploratory labs</li>
                            <li>commissioned projects</li>
                            <li>creation of new archives</li>
                            <li>preservation of archives under threat</li>
                            <li>reading existing archives against the grain</li>
                            <li>and (re)thinking sites of memory.</li>
                        </ul>
                    </p>
                </div>
            </div>
            <div class="col-sm-6 col-md-6">
                <div class="container">
				<button class="prj_desc_button" onclick="showContent('what')" data-type="what">What</button>
				<button class="prj_desc_button" onclick="showContent('why')" data-type="why">Why</button>
				<button class="prj_desc_button" onclick="showContent('how')" data-type="how">How</button>
                </div>
                <div class="prj_desc_block" id="content">
                    <!-- Content will be displayed here based on the selected button -->
                </div>
            </div>
        </div>
    </div>
</section>


<section name="explore">
    <div class="row" style="height: auto;">
        <h1>Explore the Repository</h1>
            <div class="col-sm-6 col-lg-4 col-mb-4">  
				<div class="homecard">
					<div>
						<img class="" src="/ifrepo/themes/imagining/assets/pawtucket/graphics/projects2.jpg" alt="sda">
					</div>
					<div class="homecardcontent">
						<h3>Projects</h3>
						<p>Explore our projects</p>
                        <p>There are xx projects from different regions of the world. And xxx prj types.</p>
                        <button class="butexplore">Explore</button>
					</div>
				</div>
			</div>
            <div class="col-sm-6 col-lg-4 col-mb-4">  
				<div class="homecard">
					<div>
						<img class="" src="/ifrepo/themes/imagining/assets/pawtucket/graphics/people.jpg" alt="sda">
					</div>
					<div class="homecardcontent">
						<h3>People</h3>
						<p>Explore our people</p>
                        <button class="butexplore">Explore</button>
					</div>
				</div>
			</div>
            <div class="col-sm-6 col-lg-4 col-mb-4">  
				<div class="homecard">
					<div>
						<img class="" src="/ifrepo/themes/imagining/assets/pawtucket/graphics/resource.jpg" alt="sda">
					</div>
					<div class="homecardcontent">
						<h3>Resources</h3>
						<p>Explore our resources</p>
                        <button class="butexplore">Explore</button>
					</div>
				</div>
			</div>
        </div>
</section>

<section name="Just Testing">
<div class="row" style="height: auto;">
<div class="col-sm-4 testcolor1">
</div>
<div class="col-sm-4 testcolor2">
</div>
<div class="col-sm-4 testcolor3">
</div>
<div class="col-sm-4 testcolor4">
</div>
<div class="col-sm-4 testcolor5">
</div>
</div>
</section>



    <div class="row">
        <div class="col-sm-8 col-sm-offset-2">
            <div class="hpCallout">{{{FrontWelcome}}}</div>
        </div><!--end col-sm-8-->
    </div>
    <div class="row">
        <div class="col-sm-8 col-sm-offset-2">
            {{{FrontAbout}}}
        </div><!--end col-sm-8-->
    </div>
        </div>
    <div id="hpScrollBar"><div class="row"><div class="col-sm-12"><i class="fa fa-chevron-down" aria-hidden="true" title="Scroll down for more"></i></div></div></div>

 <script type="text/javascript">
        $(document).ready(function(){
            $(window).scroll(function(){
                $("#hpScrollBar").fadeOut();
            });
        });
</script>


<script>
    function showContent(type, button) {
        var content = '';

        // Remove the 'active' class from all buttons
        var buttons = document.getElementsByClassName('prj_desc_button');
        for (var i = 0; i < buttons.length; i++) {
            buttons[i].classList.remove('active');
        }

        // Add the 'active' class to the clicked button
        button.classList.add('active');

        switch (type) {
            case 'what':
                content = '<h1>What</h1><p>Through the Imagining Futures Network we aim is to facilitate the opening-up and sensitive use of existing archives, to create new ones, and articulate methods for egalitarian archival practices that respect multiple and divergent narratives. We embrace archives as intrinsically constructed and multi-vocal. This is crucial as we seek to address legacies from difficult and contested pasts. We use the intrinsic power of the archive for its capacity to build confidence, enhance understanding and reveal connected histories, to reduce conflict within and between groups, enhancing the potential for sustainable peace. Our wider ambition, through exposing cultural practices as important sites of negotiation, is to advocate for culture to be officially recognised as a human need. We are, therefore, also building towards a co-produced policy-manifesto, in dialogue with governing bodies and supra-state organisations.</p>';
                break;

            case 'why':
                content = '<h1>Why</h1><p>Our premise is that archives are sites of negotiation about visions of the future. Decisions of what is to be collected, accessed or preserved tend to privilege certain narratives over others. It is about whose story will continue to be told and how, and whose silenced, and these questions are acute in moments of post-conflict, displacement and reconstruction. Acts of archiving that draw on local knowledges and joint decision-making in what is to be remembered or forgotten, have a unique authority. They counter, stereotypes, gentrification, discrimination, and the lack of appreciation for shared histories and of community’s place in the global context.</p>';
                break;
			case 'how':
            content = '<h1>How</h1><p>Our project team invites a broad spectrum of experiences and approaches that integrate multiple forms of archival imaginings; ones that disrupt categories of national, legal, economic and securitisation frameworks. We build on engagement with locally established groups, organisations and institutions, including individuals experiencing displacement. The Network has no geographic boundary, and has already begun linking expertise from ground-work in ‘Labs’ situated across Lebanon, Tanzania, Ghana, South Africa, Syria and the UK. Here we have begun to explore and build methodologies of egalitarian archiving practice that allow for co-existence and recognition of multiple experiences of the past. These are experiences that draw on dialogues across generations, gender, class, ethnicities, status categories and multiple stakeholders.</p>';
            break;
        }

        // Display the content in the content block
        document.getElementById('content').innerHTML = content;
    }

	window.onload = function () {
    // Set the default content and highlight the default button
    var defaultButton = document.querySelector('.container .prj_desc_button[data-type="what"]');
    showContent('what', defaultButton);

    // Attach click event listeners to all buttons within the container
    var buttons = document.querySelectorAll('.container .prj_desc_button');
    for (var i = 0; i < buttons.length; i++) {
        buttons[i].addEventListener('click', function (event) {
            var buttonType = event.target.getAttribute('data-type');
            showContent(buttonType, event.target);
        });
    }
};

</script>

