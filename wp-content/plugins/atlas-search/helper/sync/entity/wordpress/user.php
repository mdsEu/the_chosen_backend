<?php

namespace Wpe_Content_Engine\Helper\Sync\Entity\Wordpress;

use ErrorException;
use WP_User;
use Wpe_Content_Engine\Helper\Asset_Type;
use Wpe_Content_Engine\Helper\Logging\Server_Log_Info;
use Wpe_Content_Engine\WPSettings;

class User extends WP_Entity {

	/**
	 * @param int $user_id User ID.
	 * @throws ErrorException Exception.
	 */
	public function upsert( int $user_id ) {
		/** @var WP_User $user */
		$user = get_userdata( $user_id );

		$query = <<<'GRAPHQL'
				mutation syncUser(
					$wpId: Int!
					$niceName: String!
					$description: String!
					$login: String!
					$email: String!
					$displayName: String!
					$registeredAt: DateTime!
					$websiteUrl: String!
					$urlPath: String!
					$avatarUrl: String!
					$avatarMimeType: String
					$avatarAssetType: String!
					$avatarIsFound: Boolean
					$avatarHeight: Int!
					$avatarWidth: Int!
				) {
					syncUser(
						wpId: $wpId
						data: {
							niceName: $niceName
							description: $description
							login: $login
							email: $email
							displayName: $displayName
							registeredAt: $registeredAt
							websiteUrl: $websiteUrl
							urlPath: $urlPath
							avatar:{
								url: $avatarUrl
								mimeType: $avatarMimeType
								assetType: $avatarAssetType
								metadata:{
									found_avatar: $avatarIsFound
									height: $avatarHeight
									width: $avatarWidth
								}
							}
						}     
					) {
								status
								message
					}
				}
				GRAPHQL;

		$avatar = get_avatar_data( $user_id );

		$graphql_vars = array(
			'wpId'            => $user_id,
			'niceName'        => $user->user_nicename,
			'email'           => $user->user_email,
			'websiteUrl'      => $user->user_url,
			'displayName'     => $user->display_name,
			'description'     => $user->user_description,
			'login'           => $user->user_login,
			'registeredAt'    => $user->user_registered,
			'urlPath'         => $this->calculate_url_path( $user_id ),
			'avatarId'        => 1,
			'avatarUrl'       => $avatar['url'],
			'avatarHeight'    => $avatar['height'],
			'avatarIsFound'   => $avatar['found_avatar'],
			'avatarWidth'     => $avatar['width'],
			'avatarMimeType'  => null,
			'avatarAssetType' => Asset_Type::AVATAR,
		);

		$wpe_content_engine_options = $this->settings->get( WPSettings::WPE_CONTENT_ENGINE_OPTION_NAME ); // Array of All Options.
		$this->client->query(
			$wpe_content_engine_options['url'],
			$query,
			$graphql_vars,
			$wpe_content_engine_options['access_token'],
			( new Server_Log_Info() )->get_data()
		);
	}

	/**
	 * @param int $user_id User ID.
	 * @throws ErrorException Exception.
	 */
	public function delete( int $user_id ) {
		$query = <<<'GRAPHQL'
			mutation UserDelete($wpId: Int!) {
				userDelete(wpId: $wpId) {
					status
					message
				}
			}
		GRAPHQL;

		$wpe_content_engine_options = $this->settings->get( WPSettings::WPE_CONTENT_ENGINE_OPTION_NAME ); // Array of All Options.
		$url                        = $wpe_content_engine_options['url']; // Url.
		$access_token               = $wpe_content_engine_options['access_token']; // Access Token.

		$this->client->query( $url, $query, array( 'wpId' => $user_id ), $access_token );
	}

	/**
	 * @param int $user_id User ID.
	 * @return string|null
	 */
	public function calculate_url_path( int $user_id ): ?string {
		$user_profile_url = get_author_posts_url( $user_id );

		return ! empty( $user_profile_url ) ? str_ireplace( home_url(), '', untrailingslashit( $user_profile_url ) ) : '';
	}
}
