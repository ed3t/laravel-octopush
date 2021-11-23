<?php

namespace Tests;

use Orchestra\Testbench\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    /**
     * Setup the test environment.
     */
    protected function setUp()
    {
        parent::setUp();
        $this->app['config']->set('octopush.login', SMS_API_LOGIN);
        $this->app['config']->set('octopush.api_key', SMS_API_KEY);
        $this->app['config']->set('octopush.sender', SMS_SENDER);
    }
    
    /**
     * Get package providers.
     *
     * @param  \Illuminate\Foundation\Application  $app
     * @return array|null
     */
    protected function getPackageProviders($app)
    {
        return ['OctopushSms\OctopushServiceProvider'];
    }

    /**
     * Get application timezone.
     *
     * @param  \Illuminate\Foundation\Application  $app
     * @return string|null
     */
    protected function getApplicationTimezone($app)
    {
        return 'Africa/Lagos';
    }
}
