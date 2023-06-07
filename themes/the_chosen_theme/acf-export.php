<?php
/* 
 * FOR POST TYPES:
 * Add this 3 arguments inside array props on register_post_type() function .ex:
 * 
 * register_post_type( 'translation', array(
 * 	...
 * 	'show_in_graphql' => true,
 * 	'graphql_single_name' => 'Translation',
 * 	'graphql_plural_name' => 'Translations'
 * ) );
 * 
*/

add_action( 'acf/include_fields', function() {
	if ( ! function_exists( 'acf_add_local_field_group' ) ) {
		return;
	}

	acf_add_local_field_group( array(
		'key' => 'group_64809b459da9e',
		'title' => 'Translation fields',
		'fields' => array(
			array(
				'key' => 'field_64809b97b9ee7',
				'label' => 'Keyvalue',
				'name' => 'keyvalue',
				'aria-label' => '',
				'type' => 'repeater',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'acfe_save_meta' => 0,
				'show_in_graphql' => 1,
				'acfe_repeater_stylised_button' => 0,
				'layout' => 'table',
				'pagination' => 0,
				'min' => 0,
				'max' => 0,
				'collapsed' => '',
				'button_label' => 'Add Row',
				'rows_per_page' => 20,
				'sub_fields' => array(
					array(
						'key' => 'field_6480ac4d440f4',
						'label' => 'Key',
						'name' => 'key',
						'aria-label' => '',
						'type' => 'text',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'acfe_save_meta' => 0,
						'show_in_graphql' => 1,
						'default_value' => '',
						'maxlength' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'parent_repeater' => 'field_64809b97b9ee7',
					),
					array(
						'key' => 'field_6480ac59440f5',
						'label' => 'Value',
						'name' => 'value',
						'aria-label' => '',
						'type' => 'text',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'acfe_save_meta' => 0,
						'show_in_graphql' => 1,
						'default_value' => '',
						'maxlength' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'parent_repeater' => 'field_64809b97b9ee7',
					),
				),
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'translation',
				),
			),
		),
		'menu_order' => 0,
		'position' => 'normal',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => '',
		'active' => true,
		'description' => '',
		'show_in_rest' => 0,
		'acfe_display_title' => '',
		'acfe_autosync' => '',
		'acfe_form' => 0,
		'acfe_meta' => '',
		'acfe_note' => '',
		'show_in_graphql' => 1,
		'graphql_field_name' => 'translationFields',
		'map_graphql_types_from_location_rules' => 1,
		'graphql_types' => array(
			0 => 'Translation',
		),
	) );
} );

add_action( 'init', function() {
	register_post_type( 'translation', array(
		'labels' => array(
			'name' => 'Translations',
			'singular_name' => 'Translation',
			'menu_name' => 'Translations',
			'all_items' => 'All Translations',
			'edit_item' => 'Edit Translation',
			'view_item' => 'View Translation',
			'view_items' => 'View Translations',
			'add_new_item' => 'Add New Translation',
			'new_item' => 'New Translation',
			'parent_item_colon' => 'Parent Translation:',
			'search_items' => 'Search Translations',
			'not_found' => 'No translations found',
			'not_found_in_trash' => 'No translations found in Trash',
			'archives' => 'Translation Archives',
			'attributes' => 'Translation Attributes',
			'insert_into_item' => 'Insert into translation',
			'uploaded_to_this_item' => 'Uploaded to this translation',
			'filter_items_list' => 'Filter translations list',
			'filter_by_date' => 'Filter translations by date',
			'items_list_navigation' => 'Translations list navigation',
			'items_list' => 'Translations list',
			'item_published' => 'Translation published.',
			'item_published_privately' => 'Translation published privately.',
			'item_reverted_to_draft' => 'Translation reverted to draft.',
			'item_scheduled' => 'Translation scheduled.',
			'item_updated' => 'Translation updated.',
			'item_link' => 'Translation Link',
			'item_link_description' => 'A link to a translation.',
		),
		'public' => true,
		'show_in_rest' => true,
		'menu_icon' => 'dashicons-admin-site',
		'supports' => array(
			0 => 'title',
		),
		'delete_with_user' => false,
		// 
		'show_in_graphql' => true,
		'graphql_single_name' => 'Translation',
		'graphql_plural_name' => 'Translations'
	) );
} );
