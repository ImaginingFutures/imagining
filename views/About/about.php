<?php
MetaTagManager::setWindowTitle($this->request->config->get("app_display_name") . ": About");
?>

<div class="container">
    <!-- about details div -->
    <div class="about">
        <div class="font-size-control">
            <button type="button" name="btn1" onclick="changeSizeByBtn(-2)">-A</button>
            <button type="button" name="btn2" onclick="resetSize()">A</button>
            <button type="button" name="btn3" onclick="changeSizeByBtn(2)">A+</button>
        </div>

        <header class="entry-header">
            <h1 class="entry-title" itemprop="headline">Imagining Futures Overview</h1>
        </header>
        <div class="row">
            <div class="col-sm-8 col-md-8 col-lg-8 policies-text" id="policies-text-container">
                <div class="wrapper-subtitle">
                    <h2>Who decides what gets to be remembered into the future, and to shape it?</h2>
                </div>
                <div class="wrapper-about">
                    <p>We draw on the widest meaning of archive by including documents, material remains and creations, landscapes, oral transmissions, song, bodily movements, daily customs and ancestral laws. Join us in our aim is to build methodologies of egalitarian archiving practices that allow for co-existence and recognition of multiple experiences and narratives of the past that challenge a singular ‘we’.</p>
                    <p>Our aspiration, in recognising the power of archives, is to make them sites of engagement through:</p>
                    <ul>
                        <li <?php print (strToLower($this->request->getController()) == "Browse") && ((strToLower($this->request->getAction()) == "collections")) ? 'class="active"' : ''; ?>><?php print caNavLink($this->request, _t("exploratory labs"), "", "", "Browse", "labs"); ?></li>
                        <li <?php print (strToLower($this->request->getController()) == "Browse") && ((strToLower($this->request->getAction()) == "collections")) ? 'class="active"' : ''; ?>><?php print caNavLink($this->request, _t("commissioned projects"), "", "", "Browse", "projects"); ?></li>
                        <li>creation of new archives</li>
                        <li>preservation of archives under threat</li>
                        <li>reading existing archives against the grain</li>
                        <li>and (re)thinking sites of memory.</li>
                    </ul>
                    <h5>Through these activities we seek to advocate for culture to be recognised as a human need.</h5>
                </div>

                <div class="container-sm">
                    <div class="row justify-content-center">
                        <div class="col col-md-10">
                            <div class="gallery" id="lightgallery">
                                <a href=<?php print caGetThemeGraphicURL($this->request, 'legacy/BSR.webp') ?> class="gallery-item"  data-sub-html="<h4 class='gallery-header'><a href='https://bsr.ac.uk/library-archive-collections/'>British School at Rome (BSR) archives</a> </h4><p> © Peter Campbell </p>">
                                    <?php print caGetThemeGraphic($this->request, 'legacy/BSR.webp', array('alt' => "© Peter Campbell", 'class' => 'img-responsive', 'loading' => 'lazy')); ?>
                                </a>
                                <a href=<?php print caGetThemeGraphicURL($this->request, 'legacy/Baddawi.webp') ?> class="gallery-item"  data-sub-html="<h4 class='gallery-header'>Baddawi Camp (Dec. 2016 - Jan. 2017) </h4><p> © Elena Fiddian Qasmiyeh</p>">
                                    <?php print caGetThemeGraphic($this->request, 'legacy/Baddawi.webp', array('alt' => "© Elena Fiddian Qasmiyeh", 'class' => 'img-responsive', 'loading' => 'lazy')); ?>
                                </a>
                                <a href=<?php print caGetThemeGraphicURL($this->request, 'legacy/playhub.webp') ?> class="gallery-item"  data-sub-html="<h4 class='gallery-header'> Adventure play hub message board (2020) </h4><p>© Elizabeth Wright</p>">
                                    <?php print caGetThemeGraphic($this->request, 'legacy/playhub.webp', array('alt' => "© Elizabeth Wright", 'class' => 'img-responsive', 'loading' => 'lazy')); ?>
                                </a>
                                <a href=<?php print caGetThemeGraphicURL($this->request, 'legacy/Beirut.webp') ?> class="gallery-item"  data-sub-html="<h4 class='gallery-header'>Urban re-use in Beirut, Lebanon </h4><p> © Howayda Al-Harithy</p>">
                                    <?php print caGetThemeGraphic($this->request, 'legacy/Beirut.webp', array('alt' => "© Howayda Al-Harithy", 'class' => 'img-responsive', 'loading' => 'lazy')); ?>
                                </a>
                                <a href=<?php print caGetThemeGraphicURL($this->request, 'legacy/GEDC0191.webp') ?> class="gallery-item"  data-sub-html="<h4 class='gallery-header'>History Closer to the Ngoni People </h4><p>© Nancy Rushohora </p>">
                                    <?php print caGetThemeGraphic($this->request, 'legacy/GEDC0191.webp', array('alt' => "© Nancy Rushohora", 'class' => 'img-responsive', 'loading' => 'lazy')); ?>
                                </a>
                                <a href=<?php print caGetThemeGraphicURL($this->request, 'legacy/DSC_0514.webp') ?> class="gallery-item"  data-sub-html="<h4 class='gallery-header'>Vernacular Songs as Archives and Modes of Social Redress in Jamestown, Accra</h4><p> © Kodzo Gavua </p>">
                                    <?php print caGetThemeGraphic($this->request, 'legacy/DSC_0514.webp', array('alt' => "© Kodzo Gavua", 'class' => 'img-responsive', 'loading' => 'lazy')); ?>
                                </a>
                                <a href=<?php print caGetThemeGraphicURL($this->request, 'legacy/IF_Dialogues.webp') ?> class="gallery-item"  data-sub-html="<h4 class='gallery-header'>Imagining Futures Dialogues</h4><p> Dialogue 10</p>">
                                    <?php print caGetThemeGraphic($this->request, 'legacy/IF_Dialogues.webp', array('alt' => "Imagining Futures Dialogues", 'class' => 'img-responsive', 'loading' => 'lazy')); ?>
                                </a>
                                <a href=<?php print caGetThemeGraphicURL($this->request, 'legacy/HoChiMinh.webp') ?> class="gallery-item"  data-sub-html="<h4 class='gallery-header'>Archiving COVID-19 Heritage in Ho Chi Minh City </h4><p> Covid-19 murals painted by Ho Chi Minh Communist Youth Union.</p>">
                                    <?php print caGetThemeGraphic($this->request, 'legacy/HoChiMinh.webp', array('alt' => "Archiving COVID-19 Heritage in Ho Chi Minh City", 'class' => 'img-responsive', 'loading' => 'lazy')); ?>
                                </a>
                                <a href=<?php print caGetThemeGraphicURL($this->request, 'legacy/WCFP.webp') ?> class="gallery-item"  data-sub-html="<h4 class='gallery-header'>We Come from the Past </h4><p> Paul Collis and Muda Corporation</p>">
                                    <?php print caGetThemeGraphic($this->request, 'legacy/WCFP.webp', array('alt' => "We Come from the Past", 'class' => 'img-responsive', 'loading' => 'lazy')); ?>
                                </a>
                                <a href=<?php print caGetThemeGraphicURL($this->request, 'legacy/geoglyph.webp') ?> class="gallery-item"  data-sub-html="<h4 class='gallery-header'>Creative Archiving of Socio-ecological and Socio-cultural knowledge & practices of Lateritic Landscapes of Central Konkan</h4><p> Human size geoglyph of Peacock from Lateritic plateau of village Goval with geo-hydrologist Divyanshu Pawar PC Saili Kaustubh Palande-Datar and Neha Rane </p>">
                                    <?php print caGetThemeGraphic($this->request, 'legacy/geoglyph.webp', array('alt' => "Creative Archiving of Socio-ecological and Socio-cultural knowledge & practices of Lateritic Landscapes of Central Konkan", 'class' => 'img-responsive', 'loading' => 'lazy')); ?>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

            </div><!-- end policies-text div -->
            <div class="col-sm-4 col-md-3 col-lg-3">
                <div class="about-right-card">
                    <h6>Our first pilot project, hosted in Lindi, Tanzania (2019), is introduced in this short documentary film Re-Imagining Sites of Memory, by Mark Kaplan (edited by Nancy Rushohora and Izette Mostert).</h6>
                    <h6>Link to film: <a href="https://www.youtube.com/watch?v=E1-Q8W6A3Es" target="_blank" rel="noopener"><strong>ENGLISH</strong></a><strong> / </strong><a href="https://www.youtube.com/watch?v=keTG5s7el-I" target="_blank" rel="noopener"><strong>SWAHILI</strong></a></h6>
                </div>
            </div>
        </div><!-- end grid row -->
        <!-- How row -->
        <div class="row fullrow-about">
                    <div class="col-sm-4">
                    <h4>WHAT</h4>
                    <p>Through the Imagining Futures Network we aim is to facilitate the opening-up and sensitive use of existing archives, to create new ones, and articulate methods for egalitarian archival practices that respect multiple and divergent narratives. We embrace archives as intrinsically constructed and multi-vocal. This is crucial as we seek to address legacies from difficult and contested pasts. We use the intrinsic power of the archive for its capacity to build confidence, enhance understanding and reveal connected histories, to reduce conflict within and between groups, enhancing the potential for sustainable peace. Our wider ambition, through exposing cultural practices as important sites of negotiation, is to advocate for culture to be officially recognised as a human need. We are, therefore, also building towards a co-produced policy-manifesto, in dialogue with governing bodies and supra-state organisations.</p>
                    </div>
                    <div class="col-sm-4">
                    <h4>WHY</h4>
                    <p>Our premise is that archives are sites of negotiation about visions of the future. Decisions of what is to be collected, accessed or preserved tend to privilege certain narratives over others. It is about whose story will continue to be told and how, and whose silenced, and these questions are acute in moments of post-conflict, displacement and reconstruction. Acts of archiving that draw on local knowledges and joint decision-making in what is to be remembered or forgotten, have a unique authority. They counter, stereotypes, gentrification, discrimination, and the lack of appreciation for shared histories and of community’s place in the global context.</p>
                    </div>
                    <div class="col-sm-4">
                    <h4>HOW</h4>
                    <p>Our project team invites a broad spectrum of experiences and approaches that integrate multiple forms of archival imaginings; ones that disrupt categories of national, legal, economic and securitisation frameworks. We build on engagement with locally established groups, organisations and institutions, including individuals experiencing displacement. The Network has no geographic boundary, and has already begun linking expertise from ground-work in <?php print caNavLink($this->request, _t("'labs'"), "", "", "Browse", "labs"); ?> situated across Lebanon, Tanzania, Ghana, South Africa, Syria and the UK. Here we have begun to explore and build methodologies of egalitarian archiving practice that allow for co-existence and recognition of multiple experiences of the past. These are experiences that draw on dialogues across generations, gender, class, ethnicities, status categories and multiple stakeholders.</p>
                    </div>
                
        </div><!-- end How row -->
        <div class="row fullrow-about">
            <p>We seek to engage existing archives, non-traditional archives, archives in the making and the wider discourse on archival practice. We are keen to support in-situ initiatives</p>
            <ul>
                <li>provide a platform to share ideas, experiences and debate</li>
                <li>facilitate joint projects and issues of accessibility</li>
                <li>showcase co-created knowledge</li>
                <li>help with sensitive archives and those under threat</li>
                <li>facilitate creation of open digital tools and repositories</li>
                <li>open-studio events with diverse publics</li>
            </ul>
            <p>The support is in multiple forms and also funded <?php print caNavLink($this->request, _t("Open Call Project Commissions."), "", "", "Browse", "projects"); ?> </p>
            
        </div>
        <div class="row fullrow-about">
            <div class="col-md-6">
                <div class="col-md-12 aims">
                    <div class="aboutcolumncontainer">
                        <h3>Main Aims</h3>
                        <ul>
                            <li>To support modes of archival practice that allow for co-existence and recognition of different experiences of the past through dialogues across generations, gender, class and stakeholders.</li>
                            <li>To stretch the meaning of archive by incorporating a range of tangible and intangible materials and practices.</li>
                            <li>To explore how archival practices can expose shared pasts as well as a diversity of community experiences across history and currently.</li>
                            <li>To articulate the potential power of archival practice, its impact, and modes of egalitarian practice that can feed into shaping policies and actions.</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="col-md-12 outcomes">
                <div class="aboutcolumncontainer">
                        <h3>Outcomes and Impacts</h3>
                        <ul>
                            <li>Better communication and amplification of diverse viewpoints on community histories, positive accommodation of “dissensus” (i.e., acknowledging and embracing that there may be diverse viewpoints within a community and valuing this difference) and incorporating archival practices of people who have been displaced and marginalised.</li>
                            <li>Enhanced understanding and empathy, contribute to reducing inter- and intra-community conflict among diverse social, political, religious, economic, and regional groups, and enhanced potential for sustainable peace.</li>
                            <li>Better understanding of people’s sense of belonging to their environment, whether in diaspora or in midst of displacement</li>
                            <li>Policy influence that reflects sensitive and inclusive approaches to conservation and reconstruction</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- end about div -->

    <script>
        jQuery("#lightgallery")
            .justifiedGallery({
                captions: true,
                lastRow: "nojustify",
                rowHeight: 120,
                margins: 5,
                randomize: true
            })
            .on("jg.complete", function() {
                window.lightGallery(
                    document.getElementById("lightgallery"), {
                        autoplayFirstVideo: false,
                        pager: false,
                        galleryId: "nature",
                        plugins: [lgZoom, lgThumbnail],
                        download: false,
                        fullScreen: true,
                        mobileSettings: {
                            controls: false,
                            showCloseIcon: false,
                            download: false,
                            rotate: false
                        }
                    }
                );
            });
    </script>

</div><!-- end container -->
