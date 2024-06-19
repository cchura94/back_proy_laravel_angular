## Comandos Laravel 11
### Comandos para migraciónes en laravel
```
php artisan migrate
```
- verifica la conexion la la BD
- verificar si existe la BD
- Si no existe (crear la BD)
- buscar la tabla llamada (migrations) en BD
- Migrar la tabla (migrations)
- Migrar las demas migraciones
- Generará 9 tablas 
#### Revertir migraciones
```
php artisan migrate:rollback
```
#### Forzar la eliminación de tablas y luego volver a migrar
````
php artisan migrate:fresh
```

### Para generar una migracion
```
php artisan make:migration create_personas_table
```
### Para generar un modelo Persona

```
php artisan make:model Persona
````

### Para ver el estado de migraciones

```
php artisan migrate:status
````

### genarar modelo + migracion
```
php artisan make:model Role -m
```
```
php artisn make:migration create_role_user_table
```

## Manejo de SEEDERS

````
php artisan make:seeder UserSeeder
```
````
php artisan migrate --seed
```