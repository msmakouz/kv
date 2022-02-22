# RoadRunner KV Plugin Bridge

[![Latest Stable Version](https://poser.pugx.org/spiral/roadrunner-kv/version)](https://packagist.org/packages/spiral/roadrunner-kv)
[![Build Status](https://github.com/spiral/roadrunner-kv/workflows/build/badge.svg)](https://github.com/spiral/roadrunner-kv/actions)
[![Codecov](https://codecov.io/gh/spiral/roadrunner-kv/branch/master/graph/badge.svg)](https://codecov.io/gh/spiral/roadrunner-kv/)

This repository contains the codebase PSR-16 PHP cache bridge using kv RoadRunner plugin.

## Installation

To install application server and KV codebase

```bash
$ composer require spiral/roadrunner-kv
```

You can use the convenient installer to download the latest available compatible
version of RoadRunner assembly:

```bash
$ composer require spiral/roadrunner-cli --dev
$ vendor/bin/rr get
```

## Usage

First you need to add at least one kv adapter to your roadrunner configuration. 
For example, such a configuration would be quite feasible to run:

```yaml
version: '2.7'

rpc:
  listen: tcp://127.0.0.1:6001

kv:
  test:
    driver: memory
    config:
        interval: 10
```

> Read more about all available drivers on the 
> [documentation](https://roadrunner.dev/docs) page.

After starting the server with this configuration, one driver named "`test`" 
will be available to you.

The following code will allow writing and reading an arbitrary value from the 
RoadRunner server.

```php
<?php

use Spiral\Goridge\RPC\RPC;
use Spiral\RoadRunner\KeyValue\Factory;

require __DIR__ . '/vendor/autoload.php';

$factory = new Factory(RPC::create('tcp://127.0.0.1:6001'));

if (!$factory->isAvailable()) {
    throw new \LogicException('The [kv] plugin not available');
}

$cache = $factory->select('test');

// After that you can write and read arbitrary values:

$cache->set('key', 'value');

echo $cache->get('key'); // string(5) "value"
```

## License

The MIT License (MIT). Please see [`LICENSE`](./LICENSE) for more information. Maintained
by [Spiral Scout](https://spiralscout.com).
