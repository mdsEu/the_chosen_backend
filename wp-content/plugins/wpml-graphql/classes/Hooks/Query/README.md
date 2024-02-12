# Registering top-level queries

One of the main goals of our integration is defining two top-level queries:
* A query to get all registered languages, along with relevant data for each of them.
* A query to get the language set as default, along with its relevant data.

We have an API for defining top-level queries:

```php
register_graphql_field( 'RootQuery', $querySlug, [
	// If our wuery should return a single object
	'type'        => $objectType,
	// If our query should return a list of objects
	'type'        => [ 'list_of' => $objectType ],
	'description' => $description,
	'resolve'     => $callable,
]);
```

The `register_graphql_field`[^1] API function has a large number of use cases. In our case, the keyword `RootQuery` for the type to register the field into will turn our field into a proper top-level query.

* `$querySlug` defines the name of our query. It is usually a lowercase keyword describing the object that you want to gather. In our case, it will be `languages` and `defaultLanguage`.
* `$objectType` defines the outcome of the query. It can be a single objects (like in our `defaultLanguage` query) or a list of objects (like in our `languages` query).
* `$resolve` is a callback that will resolve the query given is arguments and the fields being requested.

The GraphQL syntax is based on the idea of **requesting only the information that you need**, so querying an object does not mean gathering all is properties. On the contrary, the fields described on the requests will sahpe the response: this is the job of the `resolve` callback[^2]: it needs to apply query filters, if any, and reduce the outcome scope to the requested fields.

[^1]: [register_graphql_field - WP GraphQL](https://www.wpgraphql.com/functions/register_graphql_field).

[^2]: [Resolvers in our WP GraphQL integration](../../Resolvers/README.md).