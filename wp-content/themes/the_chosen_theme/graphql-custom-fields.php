<?php
add_action('graphql_register_types', function () {

    $customposttype_graphql_single_name = "Post";

    register_graphql_field('RootQueryTo' . $customposttype_graphql_single_name . 'ConnectionWhereArgs', 'exploreFeatured', [
        'type' => 'Boolean',
        'description' => __('The status of the post object to filter by ', 'your-textdomain'),
    ]);

    register_graphql_field('RootQueryTo' . $customposttype_graphql_single_name . 'ConnectionWhereArgs', 'homeFeatured', [
        'type' => 'Boolean',
        'description' => __('The status of the post object to filter by ', 'your-textdomain'),
    ]);

});

add_filter('graphql_post_object_connection_query_args', function ($query_args, $source, $args, $context, $info) {
	$post_is_explore_featured = $args['where']['exploreFeatured'];
	$post_is_home_featured = $args['where']['homeFeatured'];

	if (isset($post_is_explore_featured)) {
		$query_args['meta_query'] = [
            'key' => 'explore_featured',
            'value' => $post_is_explore_featured,
            'compare' => '='
        ];
	}

	if (isset($post_is_home_featured)) {
		$query_args['meta_query'] = [
            'key' => 'home_featured',
            'value' => $post_is_home_featured,
            'compare' => '='
        ];
	}

	return $query_args;
}, 10, 5);