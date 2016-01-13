# Activities tracking for Laravel


Tracks activities fired when specific types happened. 

----------

[![Build Status](https://travis-ci.org/thanosalexander/activities.svg?branch=master)](http://travis-ci.org/thanosalexander/activities)
[![Latest Stable Version](https://poser.pugx.org/thanosalexander/activity/v/stable)](https://packagist.org/packages/thanosalexander/activity)
[![Total Downloads](https://poser.pugx.org/thanosalexander/activity/downloads)](https://packagist.org/packages/thanosalexander/activity)
[![Latest Unstable Version](https://poser.pugx.org/thanosalexander/activity/v/unstable)](https://packagist.org/packages/thanosalexander/activity)
[![License](https://poser.pugx.org/thanosalexander/activity/license)](https://packagist.org/packages/thanosalexander/activity)


## Installation

To get the latest version of Activities simply require it in your `composer.json` file.

~~~
"thanosalexander/activity":"~1.0"
~~~

You'll then need to run `composer install` to download it and have the autoloader updated.

Once Activities is installed you need to register the service provider with the application. Open up `config/app.php` and find the `providers` key.

~~~php
'providers' => array(
    ...
    ...
    \Thanosalexander\Activity\ActivityServiceProvider::class,

)
~~~

Activities also ships with two facades which provides the static syntax for creating activities. You can register the facade in the `aliases` key of your `config/app.php` file.

~~~php
'aliases' => array(

    ...
    ..

    'Activity' => \Thanosalexander\Activity\Facades\Activity::class,
    'Type' => \Thanosalexander\Activity\Facades\Type::class

)
~~~

### Publish the configurations

Run this on the command line from the root of your project:

~~~
$ php artisan vendor:publish
~~~

A configuration file will be publish to `config/activities.php`
Also the migrations will be published into migrations folder!

### Run the migrations

Activities package comes with two tables, `activities_types` and `activities`.
Just go to terminal and run 

~~~
$ php artisan migrate
~~~

Now the tables are created!


## Usage

Create a new Type

```php
$type= \Type::create([
            'name'=>'login',
            'description'=>'login action',
            'label'=>'Login'
        ]);
```

> All the fields are required in order to create an activity type!
Also the `name` is unique!

Create a new Activity

```php
$activity = \Activity::create([
            'user_id'=>0,
            'type_id'=>3,
            'content'=>'The content of this action',
            'ip'=> \Illuminate\Support\Facades\Request::getClientIp()
        ]);
```

> The `user_id` field is not required in order to create an Activity! However for guest users actions the field will be `nullable`

## Controllers
The package comes with two controllers `TypeController` and `ActivityController`.
They are almost resource controller with very simple syntax.

#### Activities Routes

~~~
 /**
     * Activities Routes
     */
    Route::get('activities',array(
        'uses'=>'thanosalexander\activity\Http\Controllers\ActivityController@index',
        'as'=>'activities.index'
    ));
    Route::post('activities/create',array(
        'uses'=>'thanosalexander\activity\Http\Controllers\ActivityController@store',
        'as'=>'activities.store'
    ));
    Route::put('activities/update/{id}',array(
        'uses'=>'thanosalexander\activity\Http\Controllers\ActivityController@update',
        'as'=>'activities.update'
    ));
    Route::get('activities/show/{id}',array(
        'uses'=>'thanosalexander\activity\Http\Controllers\ActivityController@show',
        'as'=>'activities.show'
    ));
    Route::delete('activities/delete/{id}',array(
        'uses'=>'thanosalexander\activity\Http\Controllers\ActivityController@delete',
        'as'=>'activities.delete'
    ));
~~~

#### Types Routes

~~~
/**
     * Types Routes
     */
    Route::get('types',array(
        'uses'=>'thanosalexander\activity\Http\Controllers\TypeController@index',
        'as'=>'types.index'
    ));
    Route::post('types/create',array(
        'uses'=>'thanosalexander\activity\Http\Controllers\TypeController@store',
        'as'=>'types.store'
    ));
    Route::put('types/update/{id}',array(
        'uses'=>'thanosalexander\activity\Http\Controllers\TypeController@update',
        'as'=>'types.update'
    ));
    Route::get('types/show/{id}',array(
        'uses'=>'thanosalexander\activity\Http\Controllers\TypeController@show',
        'as'=>'types.show'
    ));
    Route::delete('types/delete/{id}',array(
        'uses'=>'thanosalexander\activity\Http\Controllers\TypeController@delete',
        'as'=>'types.delete'
    ));
~~~




