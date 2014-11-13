Architecture
================

## Model

A `Model` is an object that represents a data entry.
It allows you to access to your data, to save it or delete it.
It could be fetched via a `Query`.

Example: UserModel, ProductModel, etc.


## Query

A `Query` knows the queries that you will use to retrieve a specific `Model` class.
It could be connected to any storage system via a `Provider`.

Example: UserQuery, ProductQuery, etc.


## Provider

A `Provider` knows how to query a specific storage system.
It uses one or several `Request` to retrieve the data corresponding to a query.

Example: FileProvider, PDOProvider, etc.
 
 
## Request

A `Request` knows how to access to the storage system.
It also knows how to encode or decode the data.
If a storage system supports several format, it could have several `Request` classes.

Example: JSONFileRequest, MarkdownFileRequest, PDORequest, etc.