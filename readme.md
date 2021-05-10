### Requirements

```
Ubuntu 16+
Php 7.2+
Php pacjkage : 
  - php7.2-gd
  - php7.2-intl
  - php7.2-xsl
  - php7.2-xml
  - php7.2-mbstring
  - php7.2-mysql
  - php7.2-curl

Nginx
```

### Installation

1. Checkout latest version

	pull source code

	checkout `develop` -> default branch

2. Install composer

	```
	cd verve-service-api/
	cp .env.example .env
	composer install
	php artisan migrate
	```

3. Create account admin & init aboutus data

	Init About Us data

	```
	php artisan db:seed --class=AboutUsSeeder
	```

	Create Admin account

	```
	php artisan tinker
	```

	-> in tinker console run

	```
	factory(\App\Models\Admin::class)->create()
	```

	
