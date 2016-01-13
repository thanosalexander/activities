<?php

use Orchestra\Testbench\TestCase;
use Thanosalexander\Activity\models\Activity as ActivityModel;

class TestsBase extends \Orchestra\Testbench\TestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->artisan('migrate:refresh', [
            '--database' => 'testing',
            '--realpath' => realpath(__DIR__.'/migrations'),
        ]);dd(3444);
    }

    public function testRunningMigration()
    {
        $activity = ActivityModel::find(1);
        $this->assertEquals('1', $activity->type_id);
    }

    protected function getPackageProviders($app)
    {
        return ['Thanosalexander\Activity\ActivityServiceProvider'];
    }

    /**
     * Define environment setup.
     *
     * @param  \Illuminate\Foundation\Application  $app
     *
     * @return void
     */
    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('database.default', 'testing');
    }


}
