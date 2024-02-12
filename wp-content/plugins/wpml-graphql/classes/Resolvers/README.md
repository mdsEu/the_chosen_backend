# GraphQL resolvers

GraphQL types consist of fields and connections. Those items need to be resolved, so a field gets a value and a conection gets a list of connected items to agther data from.

The shape and signature of each resolver depends on the item it is resolving.

## Resolving object fields

The callable that resolves an object field looks like this:

```php
public function resolveField( $object, $args, $context, $info ) {
	// Get a list of fields requested in this GraphQL tree node
	$fields = array_keys( $info->getFieldSelection() );
	// ...
	// Calculate the field value, and return it
}
```

* `$object` is usually a superseeded version of the native WordPress object owning the field being resolved, defined by the WP GraphQL models described in `/src/Model`. For example, for resolving fields on a `post` object, the `$object` will be an instance of `\WPGraphQL\Model\Post`.
* `$args` is not very well defined in the WP GraphQL docs, but we are not using it anywhere yet.
* `$context` provides an instance of `WPGraphQL\AppContext`, which we do not use anywhere.
* `$info` provides an instance of `GraphQL\Type\Definition\ResolveInfo`, and we can use it for gathering the list of fields from the current object type included in the request graph tree, so we can resolve just those.

## Resolving connections

TBD

## Resolving model fields

Sometimes we need to adjust or modify specific fields on a given native object that is resolved by native methods.

For example, some term fields are not properly resolved out-of-the-box because the mechanism to gather their values enforces the site current language, hence field values for translated items default to values on their translation in the default language.

The callback that resolves a model modification is **hooked into the `graphql_model_prepare_fields` filter**, and looks like this:

```php
public function adjustModelFields( $fields, $modelName, $data ) {
	// ...
	$fields[ $fieldToModify ] = function() use ( $data ) {
		// ...
	}

	return $fields;
}
```

* `$fields` is the list of fields in the object model as defined in the WP GraphQL models described in `/src/Model`.
* `$modelName` matches the schema `${modelName]Object`. For post fields, it is `PostObject`. Useful when aiming to modify fields only on a given object type.
* `$data` is a native WordPress object matching the relevant model. So if `$modelName` is `PostObject`, `$data` will be a `\WP_Post` object.

# Resolving top-level queries

We define two main queries, to gather all languages with their relevant information, and to gather the default language with its relevant information. Those queries need to be resolved.

The callback to resolve a `RootQuery` field looks like this:

```php
public function resolveQuery( $source, $args, $context, $info ) {
	// ...
	// Calculate the query outcome, and return it
}
```

* `$source` is not documented in the WP GraphQL docs.
* `$args` is not very well defined in the WP GraphQL docs, but we are not using it anywhere yet.
* `$context` provides an instance of `WPGraphQL\AppContext`, which we do not use anywhere.
* `$info` provides an instance of `GraphQL\Type\Definition\ResolveInfo`, and we can use it for gathering the list of fields from the queried object type included in the request graph tree, so we can resolve just those.
