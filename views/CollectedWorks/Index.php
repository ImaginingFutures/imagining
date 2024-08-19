<?php
/* ----------------------------------------------------------------------
 * themes/imagining/views/CollectedWorks/index_html.php : 
 * ----------------------------------------------------------------------
 *
 * ----------------------------------------------------------------------
 */


 MetaTagManager::setWindowTitle($this->request->config->get("app_display_name").": Collected Works");
?>

<div class="container collected-container">
    <div class="row">
        <div class="col-md-12">
            <h1>Imagining Futures Collected Works</h1>
            <p>This multivolume collection reflects the diversity of work across the Imagining Futures network. Through these volumes, the voices, experiences, knowledge, and conversations are manifested in interconnected ways, participating in and activating the creation of egalitarian archives.</p>
        </div>
    </div>
    <div class="row volumes-row">
        <a href="#commingSoon" class="col-xs-12 col-sm-6 col-md-4" data-toggle="modal" data-target="#commingSoon">
            <div class="collected-card">
                <div class="collected-thumbnail">
                    <?php print caGetThemeGraphic($this->request, 'manifesto_scaled.webp', array('alt' => "Ilustration for Conocimientos indígenas y tradicionales gathering by Miguel Pech © 2023", 'class' => 'img-thumbnail')); ?>
                    <div class="card-text">
                        <h2>Imagining Futures through Un/Archived Pasts: The power of Archival Practices</h2>
                        <hr>
                        <p>This volume explores archival practices as negotiations of future visions, particularly in post-conflict and reconstruction contexts. It highlights interdisciplinary research and diverse case studies from international projects, emphasizing egalitarian archival practices that challenge traditional notions and engage with community-driven, innovative approaches.</p>
                    </div>
                </div>
            </div>
        </a>
        <a href="https://ifrepo.world/VolumeB/" class="col-xs-12 col-sm-6 col-md-4">
            <div class="collected-card">
                <div class="collected-thumbnail">
                    <?php print caGetThemeGraphic($this->request, 'vB.webp', array('alt' => "Fashion of Resistance, Manu Luksch © 2023", 'class' => 'img-thumbnail')); ?>
                    <div class="card-text">
                        <h2>Un/Archival Conversations and Practices</h2>
                        <hr>
                        <p>This volume draws from the Imagining Futures projects, encapsulating the cases, knots, themes, and challenges. It leverages the expertise and experiences of the IF Network, sharing valuable insights with all those involved or interested in building egalitarian archives.</p>
                    </div>
                </div>
            </div>
        </a>
    </div>

<!-- Modal -->

<div class="modal fade" id="commingSoon" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="modalLabel">Coming Soon</h4>
            </div>
            <div class="modal-body">
                <p>Thank you for your interest! <strong>Imagining Futures through Un/Archived Pasts: The Power of Archival Practices</strong> is currently in the final stages of production. We are working diligently to bring you a compelling collection that highlights transformative archival practices from around the world.</p>
                <p>Please stay tuned for updates, and we look forward to sharing this exciting volume with you soon!</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

</div>
