<?php

namespace ACFML\TranslationEditor;

use ACFML\Strings\Config;
use ACFML\Strings\Factory as StringsFactory;
use ACFML\Strings\Package;
use ACFML\Strings\TranslationJobFilter;
use WPML\FP\Fns;
use WPML\FP\Str;
use WPML\FP\Obj;

use function WPML\FP\pipe;

class JobFilter implements \IWPML_Backend_Action, \IWPML_Frontend_Action {

	const ACF_TOP_LEVEL_GROUP_ID    = 'acf';
	const ACF_TOP_LEVEL_GROUP_TITLE = 'Advanced Custom Fields (ACF)';

	const SPECIAL_LABELS = [
		'cpt'          => 'Post Type',
		'taxonomy'     => 'Taxonomy',
		'options-page' => 'Options Page',
	];

	/** @var array */
	private $jobToGroupId = [];

	public function add_hooks() {
		add_filter( 'wpml_tm_adjust_translation_fields', [ $this, 'addTitleAndGroupInfo' ], 10, 2 );
		add_filter( 'wpml_tm_adjust_translation_job', [ $this, 'reorderFields' ], 10, 2 );
	}

	/**
	 * @param array[]   $fields
	 * @param \stdClass $job
	 *
	 * @return array[]
	 */
	public function addTitleAndGroupInfo( $fields, $job ) {
		foreach ( $fields as &$field ) {
			$field = $this->processField( $field, $job );
		}

		return $fields;
	}

	/**
	 * @param array     $field
	 * @param \stdClass $job
	 *
	 * @return array
	 */
	private function processField( $field, $job ) {
		$fieldTitle                          = (string) Obj::prop( 'title', $field );
		$groupIdFromJob                      = $this->getGroupIdFromJob( $job );
		list( $groupId, , $namespace, $key ) = TranslationJobFilter::parseFieldName( $fieldTitle, $groupIdFromJob );
		$isSimpleLabel                       = $groupId && $namespace && $key;
		$getRepeaterParts                    = Str::match( '/field-(\w+)_(\d+)_(\w+)-\d+/' );

		$matchSpecialLabels = function( $string ) {
			return wpml_collect( self::SPECIAL_LABELS )
				->keys()
				->first( Str::startsWith( Fns::__, $string ) );
		};

		if ( $isSimpleLabel ) {
			$label = Obj::prop( 'title', Config::get( $namespace, $key ) );
			$field = $this->handleFieldLabels( $field, $label, $fieldTitle, $groupId );
		} elseif ( $matchSpecialLabels( $fieldTitle ) ) {
			$prefix = $matchSpecialLabels( $fieldTitle );
			$field  = $this->handleSpecialLabels( $field, $prefix );
		} elseif ( $getRepeaterParts( $field['field_type'] ) ) {
			list( , $group, $groupId, $title ) = $getRepeaterParts( $field['field_type'] );

			$fieldGroup = get_field_object( $group, $job->original_doc_id );
			if ( false !== $fieldGroup ) {
				$field = $this->handleRepeaters( $field, $group . '_' . $groupId, $title, $fieldGroup['label'] );
			}
		} else {
			$field = $this->handleContent( $field, $job );
		}

		return $field;
	}

	/**
	 * @param array  $field
	 * @param string $label
	 * @param string $title
	 * @param int    $groupId
	 *
	 * @return array
	 */
	private function handleFieldLabels( $field, $label, $title, $groupId ) {
		$field['title'] = $label ?: $title;
		$field['group'] = [
			self::ACF_TOP_LEVEL_GROUP_ID => self::ACF_TOP_LEVEL_GROUP_TITLE,
		];

		$fieldGroup = acf_get_field_group( $groupId );

		$field['group'][ 'acf_labels_' . $groupId ] = sprintf( '%s Labels', $fieldGroup['title'] );

		return $field;
	}

	/**
	 * @param array  $field
	 * @param string $prefix
	 *
	 * @return array
	 */
	public function handleSpecialLabels( $field, $prefix ) {
		$field['group'] = [
			self::ACF_TOP_LEVEL_GROUP_ID => self::ACF_TOP_LEVEL_GROUP_TITLE,
			$prefix . '-labels'          => self::SPECIAL_LABELS[ $prefix ] . ' Labels',
		];
		$field['title'] = substr( $field['title'], strlen( $prefix ) );
		$field['title'] = preg_replace( '/-[0-9a-f]+$/', '', $field['title'] );
		$field['title'] = str_replace( [ '-', '_' ], [ ' ', ' ' ], $field['title'] );
		$field['title'] = ucwords( trim( $field['title'] ) );

		return $field;
	}

	/**
	 * @param array  $field
	 * @param string $groupId
	 * @param string $title
	 * @param string $group
	 *
	 * @return array
	 */
	private function handleRepeaters( $field, $groupId, $title, $group ) {
		$field['title'] = ucwords( str_replace( [ '-', '_' ], [ ' ', ' ' ], $title ) );
		$field['group'] = [
			self::ACF_TOP_LEVEL_GROUP_ID => self::ACF_TOP_LEVEL_GROUP_TITLE,
			$groupId                     => $group,
		];

		return $field;
	}

	/**
	 * @param array     $field
	 * @param \stdClass $job
	 *
	 * @return array
	 */
	private function handleContent( $field, $job ) {
		$fieldName   = Str::match( '/^field-(.*?)-\d+$/', $field['field_type'] );
		$fieldName   = $fieldName ? $fieldName[1] : $field['field_type'];
		$fieldObject = get_field_object( $fieldName, $job->original_doc_id );
		if ( false !== $fieldObject ) {
			$field['title'] = $fieldObject['label'];
			$field['group'] = [
				self::ACF_TOP_LEVEL_GROUP_ID => self::ACF_TOP_LEVEL_GROUP_TITLE,
			];

			$parentId   = $fieldObject['parent'];
			$fieldGroup = acf_get_field_group( $parentId );

			if ( $fieldGroup ) {
				$field['group'][ $fieldGroup['key'] ] = $fieldGroup['title'];
			}
		}

		return $field;
	}

	/**
	 * @param \stdClass $job
	 *
	 * @return int|null
	 */
	private function getGroupIdFromJob( $job ) {
		if ( ! array_key_exists( $job->original_doc_id, $this->jobToGroupId ) ) {
			if ( 'package_' . Package::KIND_SLUG === $job->original_post_type ) {
				$this->jobToGroupId[ $job->original_doc_id ] = (int) StringsFactory::createWpmlPackage( $job->original_doc_id )->name;
			} else {
				$this->jobToGroupId[ $job->original_doc_id ] = null;
			}
		}

		return $this->jobToGroupId[ $job->original_doc_id ];
	}

	/**
	 * @param array     $jobFields
	 * @param \stdClass $job
	 *
	 * @return array
	 */
	public function reorderFields( $jobFields, $job ) {
		$postType = Obj::prop( 'original_post_type', $job );
		if ( Str::startsWith( 'package', $postType ) ) {
			return $jobFields;
		}

		$postId   = Obj::prop( 'original_doc_id', $job );
		$metaKeys = get_field_objects( $postId, false );
		if ( ! $metaKeys ) {
			return $jobFields;
		}

		$orderedFields = $this->getOrderedFields( $postId, $metaKeys );
		$orderMap      = array_flip( $orderedFields );

		return wpml_collect( $jobFields )
			->sort( function( $a, $b ) use ( $orderMap ) {
				$keyA = $this->getKey( $a );
				$keyB = $this->getKey( $b );

				// Leave non ACF fields intact.
				if ( ! isset( $orderMap[ $keyA ] ) || ! isset( $orderMap[ $keyB ] ) ) {
					return 0;
				}

				return $orderMap[ $keyA ] - $orderMap[ $keyB ];
			} )
			->values()
			->all();
	}

	/**
	 * @param array $field
	 *
	 * @return string
	 */
	private function getKey( $field ) {
		$element = Obj::path( [ 'attributes', 'id' ], $field );

		return Str::pregReplace( [ '/^field-/', '/-0$/' ], '', $element );
	}

	/**
	 * @param string $postId
	 * @param array  $metaKeys
	 *
	 * @return string[]
	 */
	private function getOrderedFields( $postId, $metaKeys ) {
		$orderedFields = [];

		$iterate = function( $key, $value, $prefix = '' ) use ( &$orderedFields, &$iterate, $postId ) {
			if ( is_array( $value ) ) {
				foreach ( $value as $subKey => $subValue ) {
					$newPrefix = $prefix;
					if ( is_numeric( $subKey ) ) {
						$newPrefix .= '_' . $subKey;
					} elseif ( 'acf_fc_layout' !== $subKey ) {
						$field_object = get_field_object( $subKey, $postId, false, false );
						if ( $field_object ) {
								$newPrefix .= '_' . $field_object['name'];
						}
					}

					$iterate( $subKey, $subValue, $newPrefix );
				}
			} elseif ( 'acf_fc_layout' !== $key ) {
				$orderedFields[] = $prefix;
			}
		};

		foreach ( $metaKeys as $metaKey => $metaValue ) {
			$iterate( $metaKey, $metaValue['value'], $metaValue['name'] );
		}

		return $orderedFields;
	}

}
