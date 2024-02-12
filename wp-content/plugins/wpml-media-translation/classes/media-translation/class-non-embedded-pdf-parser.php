<?php

namespace WPML\Media\Classes;

use WPML\FP\Obj;
use WPML\FP\Str;

/**
 * Media file block parser
 */
class WPML_Non_Embedded_Pdf_Parser extends WPML_Media_Element_Parser {

	/**
	 * @var string
	 */
	private static $non_embedded_pdf_expression = '/wp:file.*class="wp-block-file".*(href=".*\.pdf")>.*\/wp:file/s';

	public function getMediaElements() {
		return $this->getFromTags();
	}

	public function getMediaSrcFromAttributes( $attrs ) {
		return Obj::propOr( '', 'href', $attrs );
	}

	protected function getFromTags() {
		// phpcs:disable WordPress.NamingConventions.ValidVariableName.NotSnakeCaseMemberVar
		return preg_match_all( self::$non_embedded_pdf_expression, $this->blockText, $matches ) ?
			$this->getAttachments( $matches ) : [];
	}

	/**
	 * Checks if media element is File Block and has pdf.
	 *
	 * @return bool
	 */
	public function validate() {
		return Str::includes( '<!-- wp:file', $this->blockText )
			|| Str::includes( 'pdf', $this->blockText );
	}
}
