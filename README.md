# Como usar

Clonar, ejecutar `composer install`, crear archivo `.env`, ejecutar `php artisan key:generate`.

Luego, ejecutar: 

```
php artisan migrate:fresh && \
php artisan db:seed && \
php artisan test 
```