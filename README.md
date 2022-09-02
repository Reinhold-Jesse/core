## # Start Route

#### Zeigt alle Komponente aus dem package Ordner an.

http:your-url/**componente/package/view**

#### Zeigt alle Komponente aus dem App/resources Ordner an.

http:your-url/**componente/resources/view**

## # Include

### Möglicher aufruf von Komponente aus dem Package heraus

```php
<x:component::form.label value="Package" />
```

### Koppiere alle Komponente von Package zur Anwendung (app/resources/views/components)

Dann kann die Komponente ganz normal aufgerufen werden.

```php
<x-form.label value="Package" />
```

## Publish config file

```bash
php artisan vendor:publish --tag=components
```

## Einbingung

```php
 <x:component::form.label value="Package" />


<div class="flex gap-5">
    <x:component::button.show />

    <x:component::button.edit />

    <x:component::button.delete />

</div>


<x:component::icon.search class="h-16" />
```
