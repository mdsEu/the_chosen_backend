<?php
add_action('graphql_register_types', function () {

    $customposttype_graphql_single_name = "Post";

    register_graphql_field('RootQueryTo' . $customposttype_graphql_single_name . 'ConnectionWhereArgs', 'hide', [
        'type' => 'Boolean',
        'description' => __('The status of the post object to filter by ', 'your-textdomain'),
    ]);

});

add_filter('graphql_post_object_connection_query_args', function ($query_args, $source, $args, $context, $info) {
	$post_hide = $args['where']['hide'];

	if (isset($post_hide)) {
		$query_args['meta_query'] = [
            'key' => 'hide',
            'value' => $post_hide,
            'compare' => '='
        ];
	}

	return $query_args;
}, 10, 5);
