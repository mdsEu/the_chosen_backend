<?php

namespace WPML\GraphQL\Resolvers;

use WPML\GraphQL\Resolvers\Interfaces\ModelFields;

class UserFields extends BaseFields implements ModelFields {

	const MODEL_OBJECT = 'UserObject';
	const WPML_CONTEXT = 'Authors';

	const FIELDS_MAP = [
		'firstName'   => 'first_name',
		'lastName'    => 'last_name',
		'nickname'    => 'nickname',
		'description' => 'description',
	];

	/**
	 * @param string $field
	 * @param int    $userId
	 *
	 * @return string
	 */
	private function getStringName( $field, $userId ) {
		return $field . '_' . $userId;
	}

	/**
	 * @param mixed[]              $fields
	 * @param string               $modelName
	 * @param mixed[]|object|mixed $data
	 *
	 * @return mixed[]
	 */
	public function adjustModelFields( $fields, $modelName, $data ) {
		if ( self::MODEL_OBJECT !== $modelName ) {
			return $fields;
		}

		foreach ( self::FIELDS_MAP as $grphQLField => $userField ) {
			if ( ! $this->helpers->getArr( $userField, $data ) ) {
				continue;
			}

			$fieldName              = $this->getStringName( $userField, $data->ID );
			$fieldValue             = $this->helpers->getArr( $userField, $data );
			$fields[ $grphQLField ] = function() use ( $fieldValue, $fieldName ) {
				return apply_filters(
					'wpml_translate_single_string',
					$fieldValue,
					self::WPML_CONTEXT,
					$fieldName 
				);
			};
		}

		return $fields;
	}
}
