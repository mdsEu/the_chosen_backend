<?php
/**
 * created by: tushar Khan
 * email : tushar.khan0122@gmail.com
 * date : 7/1/2022
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly



// check if post exist in database result array
function filterArrayByKeyValueLite($array, $key, $searchValue) {
    {
        return count(array_filter($array, function($value) use ($key, $searchValue) {
            return $value[$key] == $searchValue;
        }));
    }
}

function exportDataLite(){
    global $wpdb;
    $sql = "SELECT * FROM wp_posts WHERE post_type = 'post'";
    return $wpdb->get_results($sql);
}

function getAllB2iPostsLite(){
    global $wpdb;
    $results = [];
    $posts = $wpdb->get_results("SELECT
            post_title, post_name, post_status FROM
               wp_posts
           WHERE post_type = 'post'
          AND post_status = 'publish'");
    foreach($posts as $post){
        $results[] = [
            'post_title' => $post->post_title,
            'post_name'  => $post->post_name,
        ];
    }
    return $results;
}


function checkAndInsertCategoryLite($categoryNames){
   if( file_exists( ABSPATH . '/wp-admin/includes/taxonomy.php' ) ) :
   require_once( ABSPATH . '/wp-admin/includes/taxonomy.php' );
      $ids = array();
      foreach ($categoryNames as $categoryName) {
         $category = get_cat_ID( $categoryName );
         if( empty($category) ) {
               $ids[] = wp_create_category( $categoryName );
         } else {
               $ids[] = $category;
         }
      }
      return $ids;
    endif; // File exists
}


// DUPLICATE/RENAME FUNCTIONS FOR SHORTCODE
// check if post exist in database result array
function filterArrayByKeyValueLiteShortC($array, $key, $searchValue){
    {
        return count(array_filter($array, function($value) use ($key, $searchValue) {
            return $value[$key] == $searchValue;
        }));
    }
}

function exportDataLiteShortC(){
    global $wpdb;
    $sql = "SELECT * FROM wp_posts WHERE post_type = 'post'";
    return $wpdb->get_results($sql);
}

function getAllB2iPostsLiteShortC(){
    global $wpdb;
    $results = [];
    $posts = $wpdb->get_results("SELECT
            post_title, post_name, post_status FROM
               wp_posts
           WHERE post_type = 'post'
          AND post_status = 'publish'");
    foreach($posts as $post){
        $results[] = [
            'post_title' => $post->post_title,
            'post_name'  => $post->post_name,
        ];
    }
    return $results;
}

function checkAndInsertCategoryLiteShortC($categoryNames) {
   if( file_exists( ABSPATH . '/wp-admin/includes/taxonomy.php' ) ) :
   require_once( ABSPATH . '/wp-admin/includes/taxonomy.php' );
      $ids = array();
      foreach ($categoryNames as $categoryName) {
         $category = get_cat_ID( $categoryName );
         if( empty($category) ) {
               $ids[] = wp_create_category( $categoryName );
         } else {
               $ids[] = $category;
         }
      }
      return $ids;
    endif;// File exists
}

