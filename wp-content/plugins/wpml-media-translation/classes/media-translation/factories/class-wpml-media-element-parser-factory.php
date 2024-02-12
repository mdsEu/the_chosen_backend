<?php

namespace WPML\Media\Factories;

use WPML\Media\Classes\WPML_Media_Classic_Audio_Parser;
use WPML\Media\Classes\WPML_Media_Classic_Video_Parser;
use WPML\Media\Classes\WPML_Media_File_Parser;
use WPML\Media\Classes\WPML_Media_Href_Parser;
use WPML\Media\Classes\WPML_Media_Image_Parser;
use WPML\Media\Classes\WPML_Non_Embedded_Pdf_Parser;

class WPML_Media_Element_Parser_Factory {

	/**
	 * @var array[]
	 */
	private $availableMediaParsers = [
		'img-block'        => [ 'class-name' => WPML_Media_Image_Parser::class ],
		'audio-block'      => [ 'class-name' => WPML_Media_Image_Parser::class ],
		'video-block'      => [ 'class-name' => WPML_Media_Image_Parser::class ],
		'file-block'       => [ 'class-name' => WPML_Media_File_Parser::class ],
		'non-embedded-pdf' => [ 'class-name' => WPML_Non_Embedded_Pdf_Parser::class ],
		'classic-audio'    => [ 'class-name' => WPML_Media_Classic_Audio_Parser::class ],
		'classic-Video'    => [ 'class-name' => WPML_Media_Classic_Video_Parser::class ],
		'href'             => [ 'class-name' => WPML_Media_Href_Parser::class ],
	];

	/**
	 * Returns array of media parsers according to post content.
	 *
	 * @param string $post_content
	 *
	 * @return array
	 */
	public function create( $post_content ) {
		$parsers = [];

		foreach ( $this->availableMediaParsers as $mediaParser ) {
			$parserInstance = new $mediaParser['class-name']( $post_content );
			if ( $parserInstance->validate() ) {
				$parsers [ $mediaParser['class-name'] ] = $parserInstance;
			}
		}

		return $parsers;
	}
}
