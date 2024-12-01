<?php

return [
/*
|---------------------------------------------------------------------------
| Authentication Defaults
|---------------------------------------------------------------------------
|
| This option controls the default authentication "guard" and password
| reset options for your application. You may change these defaults
| as required, but they're a perfect start for most applications.
|
*/

'defaults' => [
'guard' => 'web',
'passwords' => 'users',
],

/*
|---------------------------------------------------------------------------
| Authentication Guards
|---------------------------------------------------------------------------
|
| Define every authentication guard for your application.
| The default configuration uses session storage and the Eloquent user provider.
|
| Supported: "session"
|
*/

'guards' => [
'web' => [
'driver' => 'session',
'provider' => 'users',
],

'admin' => [
'driver' => 'session',
'provider' => 'admins',
],
],


/*
|---------------------------------------------------------------------------
| User Providers
|---------------------------------------------------------------------------
|
| Defines how users are retrieved from your database.
|
| Supported: "database", "eloquent"
|
*/

'providers' => [
'users' => [
'driver' => 'eloquent',
'model' => App\Models\User::class,
],

'admins' => [
'driver' => 'eloquent',
'model' => App\Models\Admin::class,
],
],

/*
|---------------------------------------------------------------------------
| Resetting Passwords
|---------------------------------------------------------------------------
|
| Configuration for password resets for your users.
|
*/

'passwords' => [
'users' => [
'provider' => 'users',
'table' => 'password_reset_tokens',
'expire' => 60,
'throttle' => 60,
],
],

/*
|---------------------------------------------------------------------------
| Password Confirmation Timeout
|---------------------------------------------------------------------------
|
| Define the timeout for password confirmation.
|
*/

'password_timeout' => 10800,
];
