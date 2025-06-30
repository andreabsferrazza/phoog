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

If you prefer to use the debug functions (`evc()`, `evi()`, etc.) without importing them in every file, you can include the helper once in your project bootstrap.
To enable them, define PHOOG_ENABLE_HELPERS = true before loading Composer’s autoload.
```
// Before autoload
define("PHOOG_ENABLE_HELPERS", true);
require_once __DIR__ . '/vendor/autoload.php';
```

## Usage

**⚠️ Phoog provides tools for quick diagnostics and prototyping. It is not designed for secure or high-availability production use. Global function exposure and file logging should be used with discretion.**

### vet($var); - var export true
```
return var_export($var,true);
```
Example:
```
try{
    ...
}catch(Exception $e){
    ...
    echo "Var x = ".vet($x);
}
```

### vip($var); - var info pre
Wraps VET between pre tags and returns it.

### evi($var); - echo var info pre
```echo vip($var);```
**The main function to print variables in HTML.**
Example:
```
$x = 0;
$y = array( 0,1,2,3 );
evi($x);
evi($y);
```
result:
```
0
array (
  0 => 0,
  1 => 1,
  2 => 2,
  3 => 3,
)
```

### evid($var); - evi and die
Dies after echoing VIP.
Example:
```
foreach($array as $k=>$v){
    ...
    if($condition) evid($v);
    ...
}
```
Prints the variable $v and dies if $condition == true

### sip($str); - string in pre
Expects a String.
Returns EVI with some HTML formatting.
Usually for printing out queries or text with \n.

### esp($str); - echo string in pre
Expects a String.
```echo sip($var);```
Example:
```
$query = "SELECT * 
            FROM whatever";
esp($query);
```
Prints the query with newlines.

### espd($str); - esp and die
Expects a String.
Dies after echoing ESP.
Example:
```
$query = "SELECT * 
            FROM whatever";
espd($query);
echo $smth;
```
Prints the query with newlines and then dies, so $smth won't be echoed.

### vit($var); - var info td
Wraps VET between td tags and returns it.
This is for debugging in table tags, which often is a bit hefty.

### evt($var); - echo var info td
```echo vit($var);```

### evc($var); - echo var CLI
```echo vet($var).PHP_EOL;```
**The main function to print variables in CLI**

### evcd($var); - evc and die
Dies after evc($var);
Example:
```
$array = array(0,1,2,3,4);
evcd($array);
arsort($array);
```
Will print the array before it is sorted.
Result:
```
sm@smw:~/$ php your_program.php
array (
  0 => 0,
  1 => 1,
  2 => 2,
  3 => 3,
)
sm@smw:~/$
```
### dof($var, $filename = "debug_log.json", $incremental = true) - debug on file
Writes the contents of a variable to a JSON file. Useful when outputting to screen isn’t possible (e.g. in reports, cron jobs, or background processes).

$incremental: If true, appends each call as a new entry (default). If false, overwrites the file on each call.

Each log entry is saved as a timestamped object inside a debug array, making the file easy to parse or view in tools like Firefox.

Example
```
$data = ['user' => 'Monkey', 'role' => 'admin'];
dof($data); // Writes to debug_log.json

// Custom filename and overwrite
dof($_POST, '/tmp/my-debug.json', false);
```
#### ⚠️ Caution when using dof()
dof() writes to disk — make sure the target path ($filename) is writable and not publicly accessible via web, especially if it contains sensitive data. *Use dof() only in development environments, not in production.* Avoid dumping user data to predictable paths like /tmp/debug_log.json without proper permissions. If $incremental is true, the log file may grow indefinitely — monitor its size in long-running systems.
