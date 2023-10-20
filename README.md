## Example

```php
use Mmantai\VarDumper\VarDumper;

class Calc
{

    public function __construct(public int|float $a, public int|float $b)
    {

    }
    
    public function add()
    {
        return $this->a + $this->b;
    }
}

$calc = new Calc(5, 10);

VarDumper::dump($calc);
```

### Output

![Example](./screenshots/screenshot_01.png)
