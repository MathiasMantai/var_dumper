## Example

```php
use Mmantai\VarDumper\VarDumper;

$test = [
    "This",
    "is",
    "an",
    "array"
]

VarDumper::dump($test);

/*
    output:

    array(4) {
        [0]=>
        string(4) "This"
        [1]=>
        string(2) "is"
        [2]=>
        string(2) "an"
        [3]=>
        string(5) "array"
    }
*/

```

