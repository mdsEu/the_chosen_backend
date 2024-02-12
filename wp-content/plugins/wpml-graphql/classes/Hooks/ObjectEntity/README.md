# Defining fields and applying filters

We include fields in predefined objects (like a `language` field on posts, terms, comments...). We also define and apply a filter by language when requesting those predefined objects.

## Registering fields

We have an API for defining top-level queries:

```php
register_graphql_field( $wpGraphqlObjectName, $fieldName, [
	// If our wuery should return a single object
	'type'        => $objectType,
	// If our query should return a list of objects
	'type'        => [ 'list_of' => $objectType ],
	'description' => $description,
	'resolve'     => $callable,
]);
```

The `register_graphql_field`[^1] API function has a large number of use cases. In our case, the keyword `$wpGraphqlObjectName` for the type to register the field into will turn our field into a proper field in the referenced object type.

* `$wpGraphqlObjectName` is the name of the object type that will hold our registered field. In most cases, ir matches the `post_type` when defining objects for posts, or the `taxonomy` when defining fields for taxonomy terms. For comments, it is `comment`.
* `$fieldName` defines the name of the field. It is usually a lowercase keyword describing the field: for example, we are adding a `language` field.
* `$objectType` defines the outcome of the field. It can be a single objects (like in our `language` field) or a list of objects (like in our `translations` field).
* `$resolve` is a callback that will resolve the query given is arguments and the fields being requested.

Using that API, we basically register a new field with the following conditions:
* We register some fields for each translated post type, named `language`, `languageCode`, `translationGroupsId`, and `translations`.
* We register some fields for each translated taxonomy, named `language`, `languageCode`, `translationGroupId`, and `translations`.
* We register some fields for comments, named `language`, and `languageCode`.

## Resolving the `language` field

The `language` field returns an object of `Language` type[^2], so our resolver needs to get the language for the relevant object and then gather its data.

The mechanism to set the right langusage to return relates to the kind of object being queried: posts, taxonomy terms, comments.

Check the resolvers documentation[^3] for details.

## Defining and resolving the `translations` field

The `translations` field returns a list of object on the same type of the queried one, be it a post or a taxonomy term.

Note that **comments** have no proper translations, so this field is not available for that object type.

Check the resolvers documentation[^3] for details.

## Defining and resolving the `language` filter

The `language` filter is used to enforce a language when querying objects. Its values can be anmy of the site registered languages, or `all` to get all items regardless their language. By default, when no filter is set, queries return data in the site default language.

The API to modify queries depends on the kind of object beign queried, but always provides two main pieces of data: the query arguments, and the user defined set of filters, as a `where` arguments statement. Queries where users set a `language` filter carry an entry with that `language` key, and the proper filter value, in those `quere` arguments. We need to translate that into something that gets applied in the `query` arguments.

The hooks to modify queries that we rely upon are:
* `graphql_map_input_fields_to_wp_query` for queries that bring posts.
* `graphql_map_input_fields_to_get_terms` for queries that return taxonomy terms.
* `graphql_map_input_fields_to_wp_comment_query` when gathering comments.

In most cases, adding a flag to the query arguments will do the magic on the WPML side.

[^1]: [register_graphql_field - WP GraphQL](https://www.wpgraphql.com/functions/register_graphql_field).

[^2]: [Defining enums and types in our integration](../ObjectType/README.md).

[^3]: [Resolovers in our integration](../../Resolvers/README.md).