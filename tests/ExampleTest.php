<?php

namespace Stonkeep\Clicksign\Tests;

use Orchestra\Testbench\TestCase;
use Stonkeep\Clicksign\ClicksignServiceProvider;

class ExampleTest extends TestCase
{

    protected function getPackageProviders($app)
    {
        return [ClicksignServiceProvider::class];
    }
    
    /** @test */
    public function true_is_true()
    {
        $this->assertTrue(true);
    }
}
