<?php

# This condition is required to avoid the error Cannot redeclare get_embed_html() (previously declared in
if (!function_exists('get_embed_html')) {

    /**
     * Fetches the embed HTML code for Sketchfab or YouTube URLs.
     * This could be expanded in the future to include additional services.
     *
     * @param string $url The URL of the Sketchfab or YouTube video/model to be embedded.
     * @return string|bool The HTML embed code if the URL is recognized and the embed data is successfully fetched, 
     *                     an error message if there is an issue fetching or parsing the embed data, 
     *                     or False if the URL does not belong to Sketchfab or YouTube.
     */

	function get_embed_html($url)
	{
		// Check if the URL is for Sketchfab
		if (preg_match('/https:\/\/sketchfab\.com\/3d-models\/.*-([a-f0-9]{32})/', $url)) {
			$oembed_url = 'https://sketchfab.com/oembed?url=' . urlencode($url);
			$response = @file_get_contents($oembed_url);
			if ($response !== FALSE) {
				$embed_data = json_decode($response, true);
				if (json_last_error() === JSON_ERROR_NONE && isset($embed_data['html'])) {
					return $embed_data['html'];
				} else {
					return 'Error parsing Sketchfab embed data: ' . json_last_error_msg();
				}
			} else {
				return 'Error fetching Sketchfab embed data';
			}
		}

		// Check if the URL is for YouTube
		if (preg_match('/https:\/\/(www\.)?youtube\.com\/watch\?v=([a-zA-Z0-9_-]+)/', $url, $matches) || preg_match('/https:\/\/youtu\.be\/([a-zA-Z0-9_-]+)/', $url, $matches)) {
			$video_id = end($matches);
			return '<iframe width="560" height="315" src="https://www.youtube.com/embed/' . $video_id . '" frameborder="0" allowfullscreen></iframe>';
		}

		# If not Sketchfab or Youtube, returns False
		return False;
	}
}