# REST API 

## Installasi

#### clone repository
```git clone https://github.com/RandyWiratamaa/api-marketplace.git```

#### install composer
```composer install```

#### install Lumen Generator
```composer require flipbox/lumen-generator```

#### enable Lumen Generator pada bootstrap/app.php
```$app->register(Flipbox\LumenGenerator\LumenGeneratorServiceProvider::class);```

### Authentikasi menggunakan JWT

#### Tambahkan pada folder config/auth.php, buat baru jika belum ada
```
<?php

return [
    'defaults' => [
        'guard' => 'api',
        'passwords' => 'users',
    ],

    'guards' => [
        'api' => [
            'driver' => 'jwt',
            'provider' => 'users',
        ],
    ],

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => \App\Models\User::class
        ]
    ]
];
```

#### Install JWT-auth via composer
```composer require tymon/jwt-auth```

#### edit file bootstrap/app.php
```
// Uncomment baris ini

$app->withFacades();

$app->withEloquent();

// uncomment auth middleware 

$app->routeMiddleware([
    'auth' => App\Http\Middleware\Authenticate::class,
]);

// uncomment authserviceprovider
$app->register(App\Providers\AuthServiceProvider::class);

// tambahkan baris ini

$app->register(Tymon\JWTAuth\Providers\LumenServiceProvider::class);
```

#### Generate secret key
```php artisan jwt:secret```

#### Buat Table User
```php artisan make:migration create_users_table```

#### isikan dengan file berikut
```
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('fullname');
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
}
```

#### Migrasi Database
```php artisan migrate```
