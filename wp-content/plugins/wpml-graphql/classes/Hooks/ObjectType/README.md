# Registering types

GraphQL is a query language with a strongly typed schema[^1]. Types are the heart of the schema, as they define objects and define what kind of data you can expect from them.

## Defining enums

Enums[^2] are a special kind of types. They define a constrained list that, when binded to a field, restricts its possible values.

We have an API for registering enums[^3] in the WP GraphQL schema:

```php
register_graphql_enum_type( $enumName, [
	'description' => $enumDescription,
	'values'      => {
		$valueKey => $value,
		// ...
	},
]);
```

Although the official documentation states that a `$value` can be an array with a `'value'` key, it is a stadard that `$value` is theactual string value itself.

In our implementation, we define two enums:
* `LanguageEnum` defines a list of languages registered on the site. This will limit the scope of values that the `languageCode` field of a given object can return, for example.
* `LanguageFilterEnum` defines the same list as `LanguageEnum`, plus an extra `'all'` value, so we can use it to scope the options when **filtering** objects by a given language, or get objects in all languages at once.

## Defining main types

This glue plugin has two goals: providing information about the language of queried objects, and support filtering such objects by language.

The first of those purposes requires a new type, to define the shape of how language information for objects will look like.

We have an API for registering types[^4] in the GraphQL schema:

```php
register_graphql_object_type( $typeName, [
	'description' => $typeDescription,
	'fields'      => [
		$fieldName => [
			'type'        => $fieldType,
			'description' => $fieldDescription,
		],
		// Extended syntax for mandatory, non null fields
		$fieldName => [
			'type'        => [
				'non_null' => $fieldType,
			],
			'description' => $fieldDescription,
		],
		// ...
	],
]);
```

Fields can have a number of types[^5], and we can even use our own defined types and enums as valid field types. In fact, when we define our `Language` type, we define a field for it named `code` which type is our own `LanguageEnum`.

## A field to filter them all

Once we have defined our enums and main types, we need to tell WP GraphQL that we have a field that we want to filter object by: `language`.

We have an API for registering fields as query arguments:

```php
register_graphql_field(
	'RootQueryToContentNodeConnectionWhereArgs',
	$filterKeyword,
	[
		'type'        => $filterType,
		'description' => $filterDescription,
	],
);
```

Note that the `register_graphql_field`[^6] API function has a large number of use cases. In our case, the keyword `RootQueryToContentNodeConnectionWhereArgs` for the type to register the field into will turn our field into a proper query filter. 

* The `$filterKeyword` defines the keyword that will be used in `where` query arguments, that we will need to read and apply later. In our case, `language`.
* The `$filterType` defines the kind of values that oiur keyword can take. In our case, `LanguageFilterEnum` as we want to be able to filter by any language, or by no language at all when using the `all` enum value.

[^1]: [Defining types in your GraphQL APi - LogRocket](https://blog.logrocket.com/defining-types-for-your-graphql-api/).

[^2]: [Enumeration types - GraphQL](https://graphql.org/learn/schema/#enumeration-types).

[^3]: [register_graphql_enum_type - WP GraphQL](https://www.wpgraphql.com/functions/register_graphql_enum_type).

[^4]: [register_graphql_object_type WP GraphQL](https://www.wpgraphql.com/functions/register_graphql_object_type).

[^5]: [Default types and fields - WP GraphQL](https://www.wpgraphql.com/docs/default-types-and-fields).

[^6]: [register_graphql_field - WP GraphQL](https://www.wpgraphql.com/functions/register_graphql_field).