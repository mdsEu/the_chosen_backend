<?php
/*
Plugin Name: Update SiteMap
Description: Run sitemap update on new post or page.
Version: 1.0
Author: MDS
*/

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Add config page on admin
add_action( 'admin_menu', 'ppn_add_admin_menu' );

function ppn_add_admin_menu() {
    add_options_page(
        'Sitemap Update Settings',
        'Sitemap Update',
        'manage_options',
        'post_page_notifier',
        'ppn_settings_page'
    );
}

// Plugin settings register
add_action( 'admin_init', 'ppn_settings_init' );

function ppn_settings_init() {

    register_setting(
        'ppn_settings_group',
        'ppn_endpoint_url'
    );

    register_setting(
        'ppn_settings_group',
        'ppn_backend_url'
    );

    add_settings_section(
        'ppn_settings_section',
        'Settings',
        null,
        'post_page_notifier'
    );

    add_settings_field(
        'ppn_endpoint_url',
        'Endpoint URL',
        'ppn_endpoint_url_callback',
        'post_page_notifier',
        'ppn_settings_section'
    );

    add_settings_field(
        'ppn_backend_url',
        'Backend URL',
        'ppn_backend_url_callback',
        'post_page_notifier',
        'ppn_settings_section'
    );
}

function ppn_settings_page() {
    ?>
    <div class="wrap">
        <h1>Update SiteMap Settings</h1>
        <form method="post" action="options.php">
            <?php
            settings_fields( 'ppn_settings_group' );
            do_settings_sections( 'post_page_notifier' );
            submit_button();
            ?>
        </form>

        <h2>Run manual update</h2>
        <form method="post" action="">
            <?php
            wp_nonce_field( 'ppn_execute_notification', 'ppn_nonce' );
            ?>
            <input type="hidden" name="ppn_execute_action" value="execute_notification" />
            <input type="submit" class="button button-primary" value="Run sitemap update" />
        </form>
    </div>
    <?php
}

function ppn_endpoint_url_callback() {
    $endpoint_url = get_option( 'ppn_endpoint_url' );
    ?>
    <fieldset>
        <input type="text" name="ppn_endpoint_url" value="<?php echo esc_attr( $endpoint_url ); ?>" size="50" />
    </fieldset>
    <?php
}

function ppn_backend_url_callback() {
    $backend_url = get_option( 'ppn_backend_url' );
    ?>
    <fieldset>
        <input type="text" name="ppn_backend_url" value="<?php echo esc_attr( $backend_url ); ?>" size="50" />
    </fieldset>
    <?php
}

// Hook for post published
add_action( 'publish_post', 'ppn_notify_endpoint' );

// Hook for page published
add_action( 'publish_page', 'ppn_notify_endpoint' );

function ppn_notify_endpoint( $post_id ) {
    $endpoint_url = get_option( 'ppn_endpoint_url' );
    $backend_url = get_option( 'ppn_backend_url' );

    $data = array(
        'base_url' => $endpoint_url,
        'backend_url' => $backend_url
    );

    if ( empty( $endpoint_url ) ) {
        error_log( "Endpoint URL not found" );
        return;
    }

    $response = wp_remote_post( $endpoint_url.'/api/generate-sitemap', array(
        'method'    => 'POST',
        'body'      => json_encode( $data ),
        'headers'   => array(
            'Content-Type'  => 'application/json; charset=utf-8',
            'Accept'        => 'application/json',
        ),
    ));

    if ( is_wp_error( $response ) ) {
        $error_message = $response->get_error_message();
        error_log( "Error sending data to endpoint: $error_message" );
    }
}

add_action( 'admin_init', 'ppn_handle_manual_execution' );

function ppn_handle_manual_execution() {
    $endpoint_url = get_option( 'ppn_endpoint_url' );
    $backend_url = get_option( 'ppn_backend_url' );
    
    if ( isset( $_POST['ppn_execute_action'] ) && $_POST['ppn_execute_action'] === 'execute_notification' && $endpoint_url != '' && $backend_url != '') {

        if ( ! isset( $_POST['ppn_nonce'] ) || ! wp_verify_nonce( $_POST['ppn_nonce'], 'ppn_execute_notification' ) ) {
            return;
        }

        ppn_notify_endpoint( 1 );
    }
}
