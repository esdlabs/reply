esdlabs/reply
=========

Package that makes RESTful error handling easier than ever.

Features
----

  - Pre-defined errors and response codes
  - Run time errors response
  - Errors defined at database



Version
----

1.0.3


Installation
--------------

**Preparation**

Open your composer.json file and add the following to the require array: 

```js
"esdlabs/reply": "1.*"
```

**Install dependencies**
```batch
php composer install
```

Or

```batch
php composer update
```

Integration
--------------

After installing the package, open your Laravel config file app/config/app.php and add the following lines.

In the $providers array add the following service provider for this package.

```batch
'Esdlabs\Reply\ReplyServiceProvider',
```

In the $aliases array add the following facade for this package.

```batch
'Reply' => 'Esdlabs\Reply\Facades\Reply',
```

**Migrations**
```batch
php artisan migrate --package=esdlabs/reply
```

Database definition
----
reply_errors
- id
- error_code
- response_code
- description

Define your errors at the errors table as follow:

|  id | error_code  | response_code  | description  |
|---|---|---|---|---|
| 1  |  '0x001'  | 401   | 'Invalid username or password'  |
| 2  |  '0x002' | 406  | ' Valitation failed  |


Usage
----
```php
class LoginController extends Controller {

    public function store()
    {
        try
        {
            ...
        }
        catch (CustomException $e)
        {
            return Reply::error('0x001');
        }
        catch (Exception $e)
        {
            return Reply::customError('Custom error description', 500);
        }
    }
}

```


License
----
This package is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)
