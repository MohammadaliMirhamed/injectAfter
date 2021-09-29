<?php

use PHPUnit\Framework\TestCase;
require_once "./App/arrayInjector.php";


class injectAfterTest extends TestCase
{
    public function testResult()
    {
        $array = new arrayInjector([
            'one' => 1,
            'four' => 4,
            'six' => 6,
        ]);

        $injectAfter = ($array->injectAfter([], 'four', 'five', 5));

        $this->assertTrue($injectAfter);

        return $injectAfter;
    }
}
