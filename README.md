#LazyRestApiBundle

Generate easily and automatically a API REST whit doctrine. CRUD action are available.

##Installation

Edit your `composer.json`:

```json
"require": {
    "virhi/lazy-rest-api-bundle" : "master"
}
```

And run Composer:

    php composer.phar update virhi/lazy-rest-api-bundle

Enable your bundle in your `AppKernel.php`:

```php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...
        new Virhi\LazyRestApiBundle\VirhiLazyRestApiBundle(),
    );
}
```

Edit your config

```yaml
virhi_lazy_rest_api:
    manager: Manager
```


You can choose the expose entity and action available on the entity

```yaml
virhi_lazy_rest_api:
    manager: Manager
    expose_entities:
        your_entity: { entity_name: Namespace\YourEntity, edit_mode: false, delete_mode: true, create_mode: true }
```

[Documentation](./Documentation/index.md)