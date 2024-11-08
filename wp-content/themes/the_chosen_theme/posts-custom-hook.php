<?php
function formatDate($dateString) {
    return DateTime::createFromFormat('Ymd', $dateString)->format('Y-m-d');
}

function validatePermissions($post_id) {
    // Skip autosave or on revision state
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (wp_is_post_revision($post_id)) return;

    // Check permissions
    if (!current_user_can('edit_post', $post_id)) return;

    // Only for posts
    if (get_post_type($post_id) !== 'post') return;
}

function isDateAfter($date) {
    $currentDate = date('Y-m-d');
    return strtotime($date) > strtotime($currentDate);
}

function getExplorePage($post_id) {
    $post_language_code = apply_filters('wpml_post_language_details', null, $post_id)['language_code'];
    $explore_page = get_page_by_path('explore', OBJECT, 'page');
    return apply_filters('wpml_object_id', $explore_page->ID, 'page', true, $post_language_code);
}

function modifyPostsSquare($add, $explore_page_id, $post_id) {
    if (!$explore_page_id) return;

    $current_ids = get_field('posts_square', $explore_page_id, false) ?: [];
    if ($add) {
        if (!in_array($post_id, $current_ids)) {
            array_unshift($current_ids, $post_id);
            update_field('posts_square', $current_ids, $explore_page_id);
        }
    } else {
        // Remove the post ID if it exists in the array
        if (($key = array_search($post_id, $current_ids)) !== false) {
            unset($current_ids[$key]);
            // Re-index the array and update the posts_square field
            update_field('posts_square', array_values($current_ids), $explore_page_id);
        }
    }
}

function set_priority_posts_after_save($post_id) {
    validatePermissions($post_id);
    $prioritized = get_post_meta($post_id, 'prioritized', true);
    $explore_page_id = getExplorePage($post_id);

    if ($prioritized) {
        $prioritizedUntil = formatDate(get_post_meta($post_id, 'prioritized_until', true));
        // Check the post language and get the corresponding "Explore" page in the same language

        if (isDateAfter($prioritizedUntil)) {
            // If we have the Explore page in the same language, update the "posts_square" field
            modifyPostsSquare(true, $explore_page_id, $post_id);
        } else {
            update_post_meta($post_id, 'prioritized', 0);
            update_post_meta($post_id, 'prioritized_until', '');

            modifyPostsSquare(false, $explore_page_id, $post_id);
        }
    } else {
        modifyPostsSquare(false, $explore_page_id, $post_id);
    }

    return;
}

add_action('save_post', 'set_priority_posts_after_save');
