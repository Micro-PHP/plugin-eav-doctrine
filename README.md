# Micro Framework Entity Attribute Value adapter for [micro/plugin-eav-core](/#) based on [micro/plugin-doctrine](/#) library.

## Installation

Use the package manager [Composer](https://getcomposer.org/) to install.

```bash
composer require micro/plugin-eav-doctrine
```

## Basic Configure

Append plugin to ./etc/plugins.php

```php
<?php 

return [
/*...... Other plugin list...*/
        Micro\Plugin\Eav\Doctrine\EavDoctrinePlugin::class,
];

```

#### Update Database schema

```bash
 $ php bin/console orm:schema-tool:create
```

## Contributing
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

Please make sure to update tests as appropriate.

## License
[MIT](LICENSE)
