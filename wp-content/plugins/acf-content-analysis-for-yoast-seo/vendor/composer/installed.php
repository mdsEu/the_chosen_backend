<?php return array(
    'root' => array(
        'name' => 'yoast/yoast-acf-analysis',
        'pretty_version' => 'dev-main',
        'version' => 'dev-main',
        'reference' => '026e4bfc55f6b769d85f9db39678ff1692af083b',
        'type' => 'wordpress-plugin',
        'install_path' => __DIR__ . '/../../',
        'aliases' => array(),
        'dev' => false,
    ),
    'versions' => array(
        'composer/installers' => array(
            'pretty_version' => 'v1.12.0',
            'version' => '1.12.0.0',
            'reference' => 'd20a64ed3c94748397ff5973488761b22f6d3f19',
            'type' => 'composer-plugin',
            'install_path' => __DIR__ . '/./installers',
            'aliases' => array(),
            'dev_requirement' => false,
        ),
        'roundcube/plugin-installer' => array(
            'dev_requirement' => false,
            'replaced' => array(
                0 => '*',
            ),
        ),
        'shama/baton' => array(
            'dev_requirement' => false,
            'replaced' => array(
                0 => '*',
            ),
        ),
        'yoast/yoast-acf-analysis' => array(
            'pretty_version' => 'dev-main',
            'version' => 'dev-main',
            'reference' => '026e4bfc55f6b769d85f9db39678ff1692af083b',
            'type' => 'wordpress-plugin',
            'install_path' => __DIR__ . '/../../',
            'aliases' => array(),
            'dev_requirement' => false,
        ),
    ),
);
