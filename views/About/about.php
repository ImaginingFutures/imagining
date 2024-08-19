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

                <div class="gallery">
                    <ul class="image_grid_ul" style="position: relative; height: 450.984px;">
                        <li class="isotope-item" style="position: absolute; left: 0px; top: 0px;">
                            <a href="http://hdl.handle.net/20.500.14542/inj5kusqa" class="prettyphoto" data-rel="prettyPhoto[rel-1010-4170907486]" data-slb-active="1" data-slb-asset="617292493" data-slb-internal="0" data-slb-group="1010">
                                <img decoding="async" width="150" height="150" src="https://imaginingfutures.world/wp-content/uploads/2021/02/BSR-PHOTO-2019-11-27-21-15-24-COPYRIGHT-Peter-Campbell-150x150.jpg" class="attachment-thumbnail" alt="© Copyright Peter Campbell">
                            </a>
                            </li>
                        <li class="isotope-item" style="position: absolute; left: 151px; top: 0px;">
                            <a href="https://imaginingfutures.world/wp-content/uploads/2021/02/Baddawi-Dec2016-Jan2017-167-COPYRIGHT-Elena-Fiddian-Qasmiyeh.jpg" class="prettyphoto" data-rel="prettyPhoto[rel-1010-4170907486]" data-slb-active="1" data-slb-asset="623243519" data-slb-internal="0" data-slb-group="1010">
                            <img decoding="async" width="150" height="150" src="https://imaginingfutures.world/wp-content/uploads/2021/02/Baddawi-Dec2016-Jan2017-167-COPYRIGHT-Elena-Fiddian-Qasmiyeh-150x150.jpg" class="attachment-thumbnail" alt="© Elena Fiddian Qasmiyeh">
                        </a>
                        </li>
                        <li class="isotope-item" style="position: absolute; left: 302px; top: 0px;">
                            <a href="https://imaginingfutures.world/wp-content/uploads/2021/02/Adventure-Play-Hub-Message-Board-2020-Elizabeth-Wright-2020-e1613569453528.jpg" class="prettyphoto" data-rel="prettyPhoto[rel-1010-4170907486]" data-slb-active="1" data-slb-asset="21366595" data-slb-internal="0" data-slb-group="1010">
                                <img decoding="async" width="150" height="150" src="https://imaginingfutures.world/wp-content/uploads/2021/02/Adventure-Play-Hub-Message-Board-2020-Elizabeth-Wright-2020-e1613569453528-150x150.jpg" class="attachment-thumbnail" alt="© Elizabeth Wright">
                            </a>
                            </li>
                        <li class="isotope-item" style="position: absolute; left: 453px; top: 0px;">
                            <a href="https://imaginingfutures.world/wp-content/uploads/2021/02/Urban-re-use-in-Beirut-Lebanon-by-COPYRIGHT-Howayda-Al-Harithy-768x1024.jpg" class="prettyphoto" data-rel="prettyPhoto[rel-1010-4170907486]" data-slb-active="1" data-slb-asset="486837014" data-slb-internal="0" data-slb-group="1010">
                                <img loading="lazy" decoding="async" width="150" height="150" src="https://imaginingfutures.world/wp-content/uploads/2021/02/Urban-re-use-in-Beirut-Lebanon-by-COPYRIGHT-Howayda-Al-Harithy-150x150.jpg" class="attachment-thumbnail" alt="© Howayda Al-Harithy">
                            </a>
                        </li>
                        <li class="isotope-item" style="position: absolute; left: 0px; top: 151px;">
                            <a href="https://imaginingfutures.world/wp-content/uploads/2021/02/GEDC0191-3-COPYRIGHT-Nancy-Rushohora.jpeg" class="prettyphoto" data-rel="prettyPhoto[rel-1010-4170907486]" data-slb-active="1" data-slb-asset="904237338" data-slb-internal="0" data-slb-group="1010">
                                <img loading="lazy" decoding="async" width="150" height="150" src="https://imaginingfutures.world/wp-content/uploads/2021/02/GEDC0191-3-COPYRIGHT-Nancy-Rushohora-150x150.jpeg" class="attachment-thumbnail" alt="© Nancy Rushohora">
                            </a>
                        </li>
                        <li class="isotope-item" style="position: absolute; left: 1px; top: 151px;">
                            <a href="https://imaginingfutures.world/wp-content/uploads/2021/02/DSC_0514.jpg" class="prettyphoto" data-rel="prettyPhoto[rel-1010-4170907486]" data-slb-active="1" data-slb-asset="2007779891" data-slb-internal="0" data-slb-group="1010">
                                <img loading="lazy" decoding="async" width="150" height="150" src="https://imaginingfutures.world/wp-content/uploads/2021/02/DSC_0514-150x150.jpg" class="attachment-thumbnail" alt="© Kodzo Gavua">
                            </a>
                        </li>
                        <li class="isotope-item" style="position: absolute; left: 152px; top: 151px;">
                            <a href="https://imaginingfutures.world/wp-content/uploads/2022/06/IF_Dialogues_n10_links-1-591x1024.png" class="prettyphoto" data-rel="prettyPhoto[rel-1010-4170907486]" data-slb-active="1" data-slb-asset="1826249106" data-slb-internal="0" data-slb-group="1010">
                                <img loading="lazy" decoding="async" width="150" height="150" src="https://imaginingfutures.world/wp-content/uploads/2022/06/IF_Dialogues_n10_links-1-150x150.png" class="attachment-thumbnail" alt="">
                            </a>
                        </li>
                        <li class="isotope-item" style="position: absolute; left: 303px; top: 151px;">
                            <a href="https://imaginingfutures.world/wp-content/uploads/2022/09/COVID-19-murals-painted-by-Ho-Chi-Minh-Communist-Youth-Union.jpg" class="prettyphoto" data-rel="prettyPhoto[rel-1010-4170907486]" data-slb-active="1" data-slb-asset="1858386357" data-slb-internal="0" data-slb-group="1010">
                                <img loading="lazy" decoding="async" width="150" height="150" src="https://imaginingfutures.world/wp-content/uploads/2022/09/COVID-19-murals-painted-by-Ho-Chi-Minh-Communist-Youth-Union-150x150.jpg" class="attachment-thumbnail" alt="">
                            </a>
                        </li>
                        <li class="isotope-item" style="position: absolute; left: 0px; top: 302px;">
                            <a href="https://imaginingfutures.world/wp-content/uploads/2022/10/WCFP_Paul-C-and-Muda-Corporation-1024x576.jpg" class="prettyphoto" data-rel="prettyPhoto[rel-1010-4170907486]" data-slb-active="1" data-slb-asset="1899953514" data-slb-internal="0" data-slb-group="1010">
                                <img loading="lazy" decoding="async" width="150" height="150" src="https://imaginingfutures.world/wp-content/uploads/2022/10/WCFP_Paul-C-and-Muda-Corporation-150x150.jpg" class="attachment-thumbnail" alt="">
                            </a>
                        </li>
                        <li class="isotope-item" style="position: absolute; left: 148px; top: 302px;">
                            <a href="https://imaginingfutures.world/wp-content/uploads/2022/10/5.Human-size-geoglyph-of-Peacock-from-Lateritic-plateau-of-village-Goval-with-geo-hydrologist-Divyanshu-Pawar-PC-Saili-Palande-Datar-Neha-934x1024.jpg" class="prettyphoto" data-rel="prettyPhoto[rel-1010-4170907486]" data-slb-active="1" data-slb-asset="2078211444" data-slb-internal="0" data-slb-group="1010">
                                <img loading="lazy" decoding="async" width="150" height="150" src="https://imaginingfutures.world/wp-content/uploads/2022/10/5.Human-size-geoglyph-of-Peacock-from-Lateritic-plateau-of-village-Goval-with-geo-hydrologist-Divyanshu-Pawar-PC-Saili-Palande-Datar-Neha-150x150.jpg" class="attachment-thumbnail" alt="">
                            </a>
                        </li>
                    </ul>
                </div>
            

    </div><!-- end policies-text div -->
    <div class="col-sm-4 col-md-3 col-lg-3">
        <div class="about-right-card">
            <h6>Our first pilot project, hosted in Lindi, Tanzania (2019), is introduced in this short documentary film Re-Imagining Sites of Memory, by Mark Kaplan (edited by Nancy Rushohora and Izette Mostert).</h6>
            <h6>Link to film: <a href="https://www.youtube.com/watch?v=E1-Q8W6A3Es" target="_blank" rel="noopener"><strong>ENGLISH</strong></a><strong> / </strong><a href="https://www.youtube.com/watch?v=keTG5s7el-I" target="_blank" rel="noopener"><strong>SWAHILI</strong></a></h6>
        </div>
    </div>
</div><!-- end grid row -->
</div><!-- end about div -->
</div><!-- end container -->
