<?php

namespace WPML\ST\MO\Hooks;

use WPML\FP\Lst;
use WPML\ST\MO\File\Manager;
use WPML\ST\MO\JustInTime\MO;
use WPML\ST\MO\LoadedMODictionary;
use WPML\ST\Storage\StoragePerLanguageInterface;
use WPML\ST\TranslationFile\Domains;
use function WPML\FP\pipe;
use function WPML\FP\spreadArgs;
use WPML_Locale;

class CustomTextDomains implements \IWPML_Action {
	const CACHE_ID  = 'wpml-st-custom-mo-files';

	/** @var Manager $manager */
	private $manager;

	/** @var Domains $domains */
	private $domains;

	/** @var LoadedMODictionary $loadedDictionary */
	private $loadedDictionary;

	/** @var StoragePerLanguageInterface */
	private $cache;

	/** @var WPML_Locale */
	private $locale;

	/** @var callable */
	private $syncMissingFile;

	/** @var string[] $loaded_custom_domains */
	private $loaded_custom_domains = [];

	public function __construct(
		Manager $file_manager,
		Domains $domains,
		LoadedMODictionary $loadedDictionary,
		StoragePerLanguageInterface $cache,
		WPML_Locale $locale,
		callable $syncMissingFile = null
	) {
		$this->manager          = $file_manager;
		$this->domains          = $domains;
		$this->loadedDictionary = $loadedDictionary;
		$this->cache            = $cache;
		$this->locale           = $locale;
		$this->syncMissingFile  = $syncMissingFile ?: function () {};

		// Flush cache when a custom MO file is written, removed or updated.
		add_action( 'wpml_st_translation_file_written', [ $this, 'clear_cache' ], 10, 3 );
		add_action( 'wpml_st_translation_file_removed', [ $this, 'clear_cache' ], 10, 3 );
		// The filename could be changed on update, that's why we need to clear the cache.
		add_action( 'wpml_st_translation_file_updated', [ $this, 'clear_cache' ], 10, 3 );
	}

	public function clear_cache( $filepath, $domain, $locale ) {
		$this->cache->delete( StoragePerLanguageInterface::GLOBAL_GROUP );
		$this->cache->delete( $locale );
	}

	public function add_hooks() {
		$this->init_custom_text_domains();
	}


	public function init_custom_text_domains( $locale = null ) {
		$locale = $locale ?: get_locale();

		$addJitMoToL10nGlobal = pipe( Lst::nth( 0 ), function ( $domain ) use ( $locale ) {
			// Following unset is important because WordPress is setting their
			// static $noop_translation variable by reference. Without unset it
			// would become our JustInTime/MO and is used for other domains.
			// @see wpmldev-2508
			unset( $GLOBALS['l10n'][ $domain ] );

			$this->loaded_custom_domains[] = $domain;
			$GLOBALS['l10n'][ $domain ] = new MO( $this->loadedDictionary, $locale, $domain );
		} );

		$getDomainPathTuple = function ( $domain ) use ( $locale ) {
			return [ $domain, $this->manager->getFilepath( $domain, $locale ) ];
		};

		// Get domains.
		$domains = $this->cache->get( StoragePerLanguageInterface::GLOBAL_GROUP );
		if ( StoragePerLanguageInterface::NOTHING !== $domains ) {
			// Cache hit.
			$domains = \wpml_collect( $domains );
		} else {
			// No cache for site domains.
			$domains = \wpml_collect( $this->domains->getCustomMODomains() );
			$this->cache->save( StoragePerLanguageInterface::GLOBAL_GROUP, $domains->toArray() );
		}

		$files = $domains->map( $getDomainPathTuple )
			->each( spreadArgs( $this->syncMissingFile ) )
			->each( spreadArgs( [ $this->loadedDictionary, 'addFile' ] ) );

		// Load local files.
		$localeFiles = $this->cache->get( $locale );
		if ( StoragePerLanguageInterface::NOTHING !== $localeFiles ) {
			$localeFiles = \wpml_collect( $localeFiles );
		} else {
			// No cache for this locale readable custom .mo files.
			$isReadableFile = function ( $domainAndFilePath ) {
				return is_readable( $domainAndFilePath[1] );
			};
			$localeFiles = $files->filter( $isReadableFile );
			$this->cache->save(
				$locale,
				$localeFiles->toArray()
			);
		}

		$localeFiles->each( $addJitMoToL10nGlobal );
	}
}
