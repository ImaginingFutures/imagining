<?php
	MetaTagManager::setWindowTitle($this->request->config->get("app_display_name").": Credits");
?>

<div class="container">
        <!-- about details div -->
        <div class="about">

	<div class="row">
		<div class="col-sm-12">
			<H1><?php print _t("Credits"); ?></H1>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-8">
        <div class="about-card mb-3">
            <div class="row no-gutters">
            <div class="col-md-4 about-thumbnail">
            <?php print caGetThemeGraphic($this->request, 'hero_1.webp', array('alt' => "Fashion of Resistance, Manu Luksch © 2023", 'class' => 'img-thumbnail')); ?>
            </div>
            <div class="col-md-8">
            <div class="about-card-body">
			<h5 class="card-title">Main banner</h2>
            <p class="about-card-text"><i>Fashion of Resistance</i>, Manu Luksch © 2023. </p>
            <p class="about-card-text" xmlns:cc="http://creativecommons.org/ns#" >This work is openly licensed under <a href="http://creativecommons.org/licenses/by/4.0/?ref=chooser-v1" target="_blank" rel="license noopener noreferrer" style="display:inline-block;">CC BY 4.0<img style="height:22px!important;margin-left:3px;vertical-align:text-bottom;" src="https://mirrors.creativecommons.org/presskit/icons/cc.svg?ref=chooser-v1"><img style="height:22px!important;margin-left:3px;vertical-align:text-bottom;" src="https://mirrors.creativecommons.org/presskit/icons/by.svg?ref=chooser-v1"></a></p>
            <p class="about-card-text">Concept costume, digital video, 2023</p>
            <p class="about-card-text">Conceived by Manu Luksch as part of Artefacts of Resistance: Creating Archives of Transnational Protest Movements - a collaboration with Srilata Sircar (India Institute, King’s College London), Ufaque Paikar (Ashoka University), Mukul Patel (Royal College of Art), and Raktim Ray (University College London)</p>
            <p class="about-card-text">Photo document ‘Shaheen Bagh’: Apeksha Priyadarshini</p>
            <p class="about-card-text">Hand-balance performance: Natalie Reckert</p>
            <p class="about-card-text">From the project <strong>Archiving Resistance: Artefacts of Transnational Occupation</strong></p>
            </div>
            </div>
            </div>
        </div>


        <div class="about-card mb-3">
            <div class="row no-gutters">
            <div class="col-md-4 about-thumbnail">
            <?php print caGetThemeGraphic($this->request, 'projects_thumbnail.webp', array('alt' => "Projects thumbnail", 'class' => 'img-thumbnail')); ?>
            </div>
            <div class="col-md-8">
            <div class="about-card-body">
			<h5 class="about-card-text">Projects Thumbnail</h2>
            <p class="about-card-text">A man captures an image of the photographic exhibit “The Towns of the Volcano” by Mary Lee and Sidney Nolan</p>
            <p class="about-card-text">Gabriela Zamorano © 2024. </p>
            
            <p class="about-card-text">From the project <strong>Restoring Territory and Memory: Displays of Visual Archives in Michoacán</strong></p>
            
            </div>
            </div>
            </div>
        </div>

        <div class="about-card mb-3">
            <div class="row no-gutters">
            <div class="col-md-4 about-thumbnail">
            <?php print caGetThemeGraphic($this->request, 'people_thumbnail.webp', array('alt' => "People thumbnail", 'class' => 'img-thumbnail')); ?>
            </div>
            <div class="col-md-8">
            <div class="about-card-body">
			<h5 class="about-card-text">People Thumbnail</h2>
            <p class="about-card-text">From left to right: Assistant PI (Valence Silayo), PI (Nicholaus Kavishe) and participants from MMEKU Arts Group (Peter Mushi and Zuhura Ali) during a recent group discussion in Rombo district</p>
            <p class="about-card-text">From the project <strong>Chagga Traditional Songs as Archives of African Traditional Knowledge</strong></p>
            
            </div>
            </div>
            </div>
        </div>

        <div class="about-card mb-3">
            <div class="row no-gutters">
            <div class="col-md-4 about-thumbnail">
            <?php print caGetThemeGraphic($this->request, 'resources_thumbnail.webp', array('alt' => "Resources thumbnail", 'class' => 'img-thumbnail')); ?>
            </div>
            <div class="col-md-8">
            <div class="about-card-body">
			<h5 class="about-card-text">Resources Thumbnail</h2>
            <p class="about-card-text">Hanadi Samhan, Dina Mneimneh, Hoda Mekkaoui, and Camillo Boano © 2020</p>
            <p class="about-card-text">From the project <strong>Lebanese Yawmiyat (diaries): Archiving unfinished stories of spatial violence</strong></p>
            
            </div>
            </div>
            </div>
        </div>

		</div>
	</div>
        </div><!-- end of div class about -->
</div><!-- end of container -->

