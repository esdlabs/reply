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

1.0.4


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
| 1  |  '0x001'  | 400   | 'Invalid username or password'  |
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
        catch (AnotherException $e)
        {
            return Reply::error('0x002', array('note 1', 'note 2');
        }
        catch (Exception $e)
        {
            return Reply::customError('Custom error description', 500, "Note description");
        }
    }
}

```


HTTP Output
----
```javascript
HTTP/1.1 400 Bad Request

{
    "error_code": "0x001",
    "description"": "Invalid username or password"
}

```

```javascript
HTTP/1.1 406 Not Acceptable

{
    "error_code": "0x002",
    "description"": "Valitation failed",
    "notes" : [
        "note 1", 
        "note 2"
    ]
}

```

```javascript
HTTP/1.1 500 Internal Server Error

{
    "error_code": "UNK-ERROR",
    "description"": "Custom error description",
    "notes": "Note description"
}

```

License
----
This package is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)