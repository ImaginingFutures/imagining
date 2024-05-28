<?php

# --------------------
# Mimetypes

/**
 * Class created just to retrieve the custom associative array with types and labels.
 */
class MimeTypes
{

	private $mimetypes = [
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
				'label' => 'file-pdf'
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
				'label' => 'file-alt'
			],
			'file-audio' => [
				'types' => [
					'audio/mpeg',
					'audio/x-aiff',
					'audio/x-wav',
					'audio/wav',
					'audio/mp4'
				],
				'label' => 'file-audio'
			],
			'align-left' => [
				'types' => ['text/xml'],
				'label' => 'paragraph'
			],
			'cubes' => [
				'types' => [
					'application/stl',
					'application/surf',
					'application/ply'
				],
				'label' => 'cube'
			],
			'vr-cardboard' => [
				'types' => ['application/spincar'],
				'label' => 'cube'
			],
			'file-archive' => [
				'types' => ['application/octet-stream'],
				'label' => 'file'
			]
		];

	/**
    * Returns the FontAwesome icon class based on MIME type.
    * @param string $mimeType The MIME type of the file.
    * @return string FontAwesome icon class.
    */
    public function getIconClass($mimeType) {
        foreach ($this->mimetypes as $group => $info) {
            if (in_array($mimeType, $info['types'])) {
                return 'fas fa-' . $info['label'];
            }
        }
        return 'fas fa-file'; 
    }


	public function mimetypes() {
		return $this->mimetypes;
	}
}
