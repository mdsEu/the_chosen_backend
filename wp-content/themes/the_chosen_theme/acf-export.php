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
				'label' => 'Translation rows',
				'name' => 'translation_rows',
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
				'wpml_cf_preferences' => 3,
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
						'wpml_cf_preferences' => 2,
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
						'wpml_cf_preferences' => 2,
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
				array(
					'param' => 'post',
					'operator' => '!=',
					'value' => '269',
				),
				array(
					'param' => 'post',
					'operator' => '!=',
					'value' => '8',
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
		'acfe_autosync' => array(
			0 => 'php',
		),
		'acfml_field_group_mode' => 'localization',
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

  register_post_type( 'vanity-url', array(
		'labels' => array(
			'name' => 'Vanity URLs',
			'singular_name' => 'Vanity URL',
			'menu_name' => 'Vanity URLs',
			'all_items' => 'All Vanity URLs',
			'edit_item' => 'Edit Vanity URL',
			'view_item' => 'View Vanity URL',
			'view_items' => 'View Vanity URLs',
			'add_new_item' => 'Add New Vanity URL',
			'new_item' => 'New Vanity URL',
			'parent_item_colon' => 'Parent Vanity URL:',
			'search_items' => 'Search Vanity URLs',
			'not_found' => 'No vanity urls found',
			'not_found_in_trash' => 'No vanity urls found in Trash',
			'archives' => 'Vanity URL Archives',
			'attributes' => 'Vanity URL Attributes',
			'insert_into_item' => 'Insert into vanity url',
			'uploaded_to_this_item' => 'Uploaded to this vanity url',
			'filter_items_list' => 'Filter vanity urls list',
			'filter_by_date' => 'Filter vanity urls by date',
			'items_list_navigation' => 'Vanity URLs list navigation',
			'items_list' => 'Vanity URLs list',
			'item_published' => 'Vanity URL published.',
			'item_published_privately' => 'Vanity URL published privately.',
			'item_reverted_to_draft' => 'Vanity URL reverted to draft.',
			'item_scheduled' => 'Vanity URL scheduled.',
			'item_updated' => 'Vanity URL updated.',
			'item_link' => 'Vanity URL Link',
			'item_link_description' => 'A link to a vanity url.',
		),
		'public' => true,
		'show_in_rest' => true,
		'menu_icon' => 'dashicons-admin-links',
		'supports' => array(
			0 => 'title',
		),
		'delete_with_user' => false,
    //
		'show_in_graphql' => true,
		'graphql_single_name' => 'VanityURL',
		'graphql_plural_name' => 'VanityURLs'
	) );
} );

add_action( 'init', function() {
	register_post_type( 'press-release', array(
		'labels' => array(
			'name' => 'Press Releases',
			'singular_name' => 'Press Release',
			'menu_name' => 'Press Releases',
			'all_items' => 'All Press Releases',
			'edit_item' => 'Edit Press Release',
			'view_item' => 'View Press Release',
			'view_items' => 'View Press Releases',
			'add_new_item' => 'Add New Press Release',
			'new_item' => 'New Press Release',
			'parent_item_colon' => 'Parent Press Release:',
			'search_items' => 'Search Press Releases',
			'not_found' => 'No press releases found',
			'not_found_in_trash' => 'No press releases found in Trash',
			'archives' => 'Press Release Archives',
			'attributes' => 'Press Release Attributes',
			'insert_into_item' => 'Insert into press release',
			'uploaded_to_this_item' => 'Uploaded to this press release',
			'filter_items_list' => 'Filter press releases list',
			'filter_by_date' => 'Filter press releases by date',
			'items_list_navigation' => 'Press Releases list navigation',
			'items_list' => 'Press Releases list',
			'item_published' => 'Press Release published.',
			'item_published_privately' => 'Press Release published privately.',
			'item_reverted_to_draft' => 'Press Release reverted to draft.',
			'item_scheduled' => 'Press Release scheduled.',
			'item_updated' => 'Press Release updated.',
			'item_link' => 'Press Release Link',
			'item_link_description' => 'A link to a press release.',
		),
		'public' => true,
		'show_in_rest' => true,
		'supports' => array(
			0 => 'title',
			1 => 'editor',
			2 => 'thumbnail',
		),
		'delete_with_user' => false,
		 //
		 'show_in_graphql' => true,
		 'graphql_single_name' => 'PressRelease',
		 'graphql_plural_name' => 'PressReleases'
	) );
} );


