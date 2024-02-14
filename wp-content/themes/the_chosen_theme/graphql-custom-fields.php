<?php
add_action('graphql_register_types', function () {

  $customposttype_graphql_single_name = "Post";

  register_graphql_field('RootQueryTo' . $customposttype_graphql_single_name . 'ConnectionWhereArgs', 'isHideContent', [
    'type' => 'Boolean',
    'description' => __('The status of the post object to filter by ', 'your-textdomain'),
  ]);

});

add_filter('graphql_post_object_connection_query_args', function ($query_args, $source, $args, $context, $info) {
	$post_hide = $args['where']['isHideContent'];

	if (isset($post_hide)) {
		$query_args['meta_query'] = [
      'relation' => 'OR',
      [
        'key' => 'is_hide_content',
        'value' => 1,
        'type' => 'BOOLEAN'
      ],
      [
        'key' => 'is_hide_content',
        'compare' => 'EXISTS',
        'value' => 'EXISTS'
      ]
    ];
	}

	return $query_args;
}, 10, 5);
