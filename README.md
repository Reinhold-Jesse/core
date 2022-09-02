## # Start Route

http:your-url/**componente/view**

## # Include

### Möglicher aufruf einer Komponente aus dem Package heraus

```php
<x:component::form.label value="Package" />
```

### Koppiere alle Komponente von Package zu Anwendung (app/resources/views/components)

Dann kann die Komponente ganz normal aufgerufen werden.

```php
<x-form.label value="Package" />
```

## Publish config file

```bash
php artisan vendor:publish --tag=components
```
