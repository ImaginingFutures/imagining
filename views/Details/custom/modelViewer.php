<?php

if (!function_exists('glbViewer')) {

    function glbViewer($url) {
        $viewer = "<model-viewer src=$url ar ar-modes='webxr scene-viewer quick-look' camera-controls tone-mapping='neutral' shadow-intensity='1' ar camera-controls >
                    <div class='progress-bar hide' slot='progress-bar'>
                        <div class='update-bar'></div>
                    </div>
                    </model-viewer>";
        return $viewer;
    };
}