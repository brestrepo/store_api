# API Products

#Installation

git clone https://github.com/brestrepo/store_api.git (folder)

#Configuration

- Copy .env.example -> .env and set up Database configuration
- Install composer (sudo composer install)
- Run migrations (php artisan migrate)

#Routes

```
+--------+-----------+-------------------------+---------------------+-----------------------------------------------+------------+
| Domain | Method    | URI                     | Name                | Action                                        | Middleware |
+--------+-----------+-------------------------+---------------------+-----------------------------------------------+------------+
|        | GET|HEAD  | /                       |                     | Closure                                       | web        |
|        | GET|HEAD  | api/products            | api.products.index  | App\Http\Controllers\ProductController@index  | web        |
|        | POST      | api/products            | api.products.store  | App\Http\Controllers\ProductController@store  | web        |
|        | GET|HEAD  | api/products/{products} | api.products.show   | App\Http\Controllers\ProductController@show   | web        |
|        | PUT|PATCH | api/products/{products} | api.products.update | App\Http\Controllers\ProductController@update | web        |
+--------+-----------+-------------------------+---------------------+-----------------------------------------------+------------+
```

#Posting 

'name'=> 'Product name', [string] 
'price'=> 0, [double 10, 2]
'in_stock' => 0/1 [boolean or 0/1]

#Updating
'name'=> 'Product name', [string] 
'price'=> 0, [double 10, 2]
'in_stock' => 0/1 [boolean or 0/1],
'_method' => "PUT"
