<?php

namespace irfnrdh\Tests\laper;

use GrahamCampbell\TestBench\AbstractPackageTestCase;
use LaravelParse\Parse\ParseServiceProvider;

/**
 * This is the abstract test case class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
abstract class AbstractTestCase extends AbstractPackageTestCase
{
    /**
     * Get the service provider class.
     *
     * @param \Illuminate\Contracts\Foundation\Application $app
     *
     * @return string
     */
    protected function getServiceProviderClass($app)
    {
        return ParseServiceProvider::class;
    }
}
