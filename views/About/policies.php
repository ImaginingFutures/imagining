<?php
	MetaTagManager::setWindowTitle($this->request->config->get("app_display_name").": Policies");
?>

    <div class="container">
        <!-- about details div -->
        <div class="about">
        <div class="font-size-control">
            <button type="button" name="btn1" onclick="changeSizeByBtn(-2)">-A</button>
            <button type="button" name="btn2" onclick="resetSize()">A</button>
            <button type="button" name="btn3" onclick="changeSizeByBtn(2)">A+</button>
		</div>
        <div class="policies-version">
            [2024-05-17]
        </div>
        <div class="policies-text" id="policies-text-container">
        <h1 class="text-center">Imagining Futures Repository Policies</h1>
        
        <p>These policies outline who can use the services, what type of content is held, and the terms and conditions regarding access and preservation actions. </p>

        <ol>
            <li><strong>Access policy: Who can access our repository. </strong></li>
            <ol>
                <li>The Imagining Futures Through Un/Archived Pasts (IF) Repository is accessible worldwide, welcoming any person to explore, download, and share the materials, subject to the conditions of fair and legal use.</li>
                
                <li>Users of the IF Repository are categorized into distinct roles, each with specific access rights and responsibilities: </li>
                <ol>
                    <li><strong>Public Users:</strong>  Any individual accessing the repository online, enjoying unrestricted access to all publicly available materials. This role does not require registration or login. </li>
                    <li><strong>Registered Users:</strong>  Individuals who have registered on the IF Repository platform, gaining additional privileges beyond those of public users. These include the ability to leave comments, share and export materials. Registration is free and facilitated through self-service tools on our platform.   </li>
                    <li><strong>Depositors:</strong>  A specialized role designated by administrators for individuals, groups, or communities requiring advanced access for project-specific work. Depositors can upload, edit, delete, and publish content within certain collections, subject to administrative approval.  </li>
                    <li><strong>Administrators:</strong>  Tasked with the comprehensive management of the repository, administrators have unrestricted access to all levels of content. They oversee user activities, content management, and policy enforcement. Administrators are also responsible for ensuring that the use of materials aligns with the rights of the owners and the repository's ethical guidelines.  </li>
                </ol>
                <li>All users are expected to engage with the repository's materials in a manner that respects copyright laws, privacy rights, and the ethical considerations associated with archived content. </li>
            </ol>
            
            <li><strong> Content policy: what is held in our repository. </strong></li>
            <ol>
                <li>The Imagining Futures Through Un/Archived Pasts (IF) Repository stores files, metadata, and associated information obtained from individuals, groups, or communities involved in the various Imagining Futures initiatives and from those who have voluntarily requested to use the repository to store their data, information, and files.<sup><a href="#fn1" id="ref1">1</a></sup> </li>
                <li>The IF Repository categorizes information into three main access modes: </li>
                <ol>
                    <li><strong> Public Access:</strong> Media and metadata accessible to all users, with or without registration on the IF Repository platform. These can be viewed, downloaded, and exported in structured formats. </li>
                    <li><strong> Non-Public Access:</strong> Media and metadata accessible only to specific users with the role of "collector." This content is not available for public viewing on the repository, even with registration.</li>
                    <li><strong> Long-term embargo:</strong> Media and metadata that are not accessible to the public or "depositor" and can only be accessed with specific permissions granted by the administrators and repository owners. </li>
                </ol>
                <li>The IF Repository supports a diverse range of file types for hosting, including but not limited to images (e.g., JPEG, PNG), audio (e.g., MP3, WAV), video (e.g., MPEG-4, QuickTime), documents (e.g., PDF, DOCX), and 3D models (e.g., STL, OBJ). However, to ensure compatibility and accessibility, the platform prioritizes processing and visualizing files in widely used and open media file formats.<sup><a href="#fn2" id="ref2">2</a></sup> </li>
            </ol>
            <li><strong>Submission policy: who can deposit items. </strong></li>
            <ol>
                <li><strong> Eligibility for Deposit:</strong> Individuals involved in the Imagining Futures (IF) initiatives are welcome to request the deposit of their materials into the repository, selecting from the three modes of access previously described in section 2.2. Additionally, external individuals or projects may deposit materials if these align with the IF project's ethos, which emphasizes the development of archives through egalitarian practices and encourages the co-creation and active participation of communities in the design, collection, and description of archival materials. </li>
                <li><strong> Deposit Requirements:</strong> Depositors must either be the original creators of the materials or have obtained consent from the producers, creators,<sup><a href="#fn3" id="ref3">3</a></sup> and any other rights holders, unless the materials are in the public domain.<sup><a href="#fn4" id="ref4">4</a></sup>  </li>
                <li><strong> Responsibility for Content:</strong> The depositor is solely responsible for the validity and authenticity of the media, metadata, and any associated information. </li>
                <li><strong> Deposit Timing and Visibility:</strong> Materials may be submitted at any time but will become publicly visible only after any restrictions on publication or embargo periods have lapsed. </li>
                <li><strong> Copyright Compliance:</strong> Responsibility for any copyright violations lies with the creators or depositors. Should the administrators be provided with evidence of a copyright violation, the implicated material will be promptly removed in accordance with the Notice and Take-Down policy. </li>
            </ol>
            <li><strong>Data policy: what you can do with our content. </strong></li>
            <ol>
                <li>Full items are accessible to anyone free of charge. </li>
                <li>Copies of full items can generally be: </li>
                <ul>
                    <li>Reproduced, displayed, or performed, and shared with third parties in any format or medium. </li>
                    <li>Utilized for personal research, study, educational purposes, or other not-for-profit endeavors without the need for prior permission or incurring any charge. This is conditional on the content remaining unaltered. </li>
                </ul>
                <li>Certain items may carry specific rights permissions and conditions, which are individually tagged to each item. </li>
                <li>The IF Repository administrators reserve the right to monitor use, enforce these policies, and take appropriate action in the event of violations. Users found misusing the repository's resources may face restrictions or revocation of access privileges. </li>
            </ol>
            <li><strong>Metadata policy: what you can do with our metadata. </strong></li>
            <ol>
                <li>The metadata is accessible to anyone free of charge, aligning with the repository's commitment to open access. </li>
                <li>Conditions for Re-use: </li>
                <ol>
                    <li><strong> For Non-Commercial Purposes:</strong> Metadata may be re-used in any medium without prior permission for not-for-profit purposes, provided that a link or persistent URL to the original metadata record is included.  </li>
                    <li><strong> For Commercial Purposes:</strong> Unless explicitly allowed by a license, label, or other permissions, metadata must not be re-used for commercial purposes without obtaining formal permission from the rights holders, as indicated in each corresponding material.  </li>
                </ol>
            </ol>
            <li><strong>Preservation policy: how we will try to make content remain accessible. </strong></li>
            <ol>
                <li>Items will be retained indefinitely in the repository, with the provision for creators or depositors to request the deletion of their materials if deemed necessary. </li>
                <li>The repository's infrastructure is designed to safeguard against malicious attacks that could compromise the content, metadata, or overall structure, ensuring the readability and accessibility of materials. </li>
                <li>To reduce the risk associated with relying on a single system, backups, files, and the repository's web system are distributed across multiple points. </li>
                <li>The IF infrastructure supports seamless migration between systems and providers, ensuring that our dependence on any single provider is minimized and that transfers can occur without loss of data at any time. </li>
                <li>The history of files and metadata is preserved, with version controls implemented for both active and long-term archival elements within the repository's workflow. </li>
                <li>Items are assigned an MD5 signature to facilitate the detection of any alterations, bolstering the integrity and trustworthiness of the repository's holdings. </li>
                <li>While the removal of data, files, and records at the request of the creator or copyright holder is possible, such actions are strongly discouraged to maintain the integrity and comprehensiveness of the repository. </li>
            </ol>
        </ol>
        </div>
        <div class="footnotes">
            <hr>
            <sup id="fn1">1. In the context of the IF Repository, the term "data" refers to any raw fact or figure devoid of context. "Information" is understood as data that has been processed and organized in a manner that is meaningful. "Files" are the digital representations or containers for data and information, facilitating their storage and organization in a digital environment.<a href="#ref1">↩</a></sup>
            <br /><sup id="fn2">2. A comprehensive list of formats allowed in the platform can be found here: <a href="https://manual.collectiveaccess.org/providence/user/media/SupportedMedia.html" target="_blank"> https://manual.collectiveaccess.org/providence/user/media/SupportedMedia.html</a>. <a href="#ref2">↩</a></sup>
            <br /><sup id="fn3">3. “Examples of a Creator include a person, an organization, or a service. Typically, the name of a Creator should be used to indicate the entity.” Dublin Core Metadata Initiative. <a href="http://purl.org/dc/elements/1.1/creator" target="_blank">	http://purl.org/dc/elements/1.1/creator</a>. <a href="#ref3">↩</a></sup>
            <br /><sup id="fn4">4.  Since copyright legislation varies globally, there are four common ways that works enter the public domain: expiration of copyright, failure by the copyright owner to follow copyright renewal rules, voluntary placement of their work into the public domain by the copyright owner (dedication), or because the type of work is not protected by copyright. Stim, Rich. "Welcome to the Public Domain." <i>Stanford Copyright and Fair Use Center</i>, Stanford University, <a href="https://fairuse.stanford.edu/overview/public-domain/welcome/" target="_blank"> https://fairuse.stanford.edu/overview/public-domain/welcome/</a>. Accessed [02/02/2024]. <a href="#ref4">↩</a></sup>
        </div>
        </div><!-- End of about div -->
    </div> <!-- End of container -->

    <script>
	// Control the size of the font in policies-text

	let cont = document.getElementById("policies-text-container");

	function changeSizeByBtn(increment) {
		let currentSize = window.getComputedStyle(cont, null).getPropertyValue('font-size');
		let newSize = parseFloat(currentSize) + increment;
		cont.style.fontSize = newSize + 'px';
	}

	function resetSize() {
		cont.style.fontSize = ''; // Resets to the original CSS value
	}
</script>
