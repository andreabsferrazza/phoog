# Phoog – Minimal PHP Deb(oo)ugging Toolkit

**Phoog** is a lightweight PHP library offering short-named debugging functions for quick variable inspection. Designed for speed, and zero dependencies — ideal for rapid prototyping, legacy debugging, or everyday dev workflows.

## Features

- Compact functions like `evi()`, `evid()`, `evc()`, `vip()`, etc.
- Output optimized for both HTML and CLI

## Installation

```
composer require andreabsferrazza/phoog
```

## Optional: Global Shortcuts

If you prefer to use the debug functions (`evc()`, `evi()`, etc.) without importing them in every file, you can include the helper once in your project bootstrap:

```
require_once __DIR__ . '/vendor/andreabsferrazza/phoog/helpers.php';
```
*Tip: If you want to load the global helpers conditionally, you can do so based on a flag in your env file (e.g. helpers_enabled = true).*

Congrats! Now you can use the functions like:
```
evc(array('debug' => true));
```
result
```
array (
  'debug' => true,
)
```

