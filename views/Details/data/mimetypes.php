<?php

# --------------------
# Mimetypes

/**
 * Class created just to retrieve the custom associative array with types and labels.
 */
class MimeTypes
{

	/**
	* @return array associative array with types and label from each group of mimetypes. Key names match with font awesome endings (aka 'file-pdf').
	*/
	function mimetypes(){
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

		return $mimetypes;
	}
}
