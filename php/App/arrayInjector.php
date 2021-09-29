<?php 
// Create a PHP function called injectAfter(array $array, string $afterKey, string $newKey,  $newValue), 
// which inserts a new key/value pair into an associative array at a specific position, i.e. after a specific key.

// Example input: injectAfter(["foo" => 3, "bar" => 1], "foo", "baz", 42)
// Expected output: ["foo" => 3, "baz" => 42, "bar" => 1]

// • If the $afterKey does not exist, the new key/value should be inserted at the end of the array
// • If the $newKey already exists in the input array it should be moved to the correct position (and, of course, set to the new values as well)

interface injextion
{
    public function injectAfter(array $array, string $afterKey, string $newKey,  $newValue): bool;
    public function exportAsJson(): string;
    public function exportAsArray(): array;
}

class arrayInjector implements injextion
{
    protected $array = [];

    public function __construct(array $array = [])
    {
        /**
         * importe array
         */
        $this->array = $array;
    }

    public function injectAfter(array $array = [], string $afterKey, string $newKey,  $newValue): bool
    {

        (count($array) > 0) ? $this->array = $array : '';

        if (!array_key_exists($afterKey, $this->array)) {

            $this->array = array_merge($this->array, array($newKey => $newValue));
        } else if (array_key_exists($newKey, $this->array)) {

            $tempArray = [];
            foreach ($this->array as $key => $value) {
                if ($key != $newKey) {
                    $tempArray[$key] = $value;
                }
                if ($key === $afterKey) {
                    $tempArray[$newKey] = $newValue;
                }
            }
            $this->array = $tempArray;
        } else {
            $tempArray = [];
            foreach ($this->array as $key => $value) {
                $tempArray[$key] = $value;
                if ($key === $afterKey) {
                    $tempArray[$newKey] = $newValue;
                }
            }

            $this->array = $tempArray;
        }

        return true;
    }
    public function exportAsJson(): string
    {
        return json_encode($this->array, true);
    }
    public function exportAsArray(): array
    {
        return $this->array;
    }
}


// $array = new arrayInjector([
//     'one' => 1,
//     'four' => 4,
//     'six' => 6,
// ]);

// $array->injectAfter([], 'four', 'five', 5);
// echo ($array->exportAsJson());
// echo '<br>';
// $array->injectAfter([], 'ten', 'nine', 9);
// echo ($array->exportAsJson());
// echo '<br>';
// $array->injectAfter([], 'six', 'four', 10);
// echo ($array->exportAsJson());
// echo '<br>';
