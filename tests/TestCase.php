<?php

namespace InnoGE\FilamentFormFaker\Tests;

use Illuminate\Database\Eloquent\Factories\Factory;
use InnoGE\FilamentFormFaker\FilamentFormFakerServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();

        Factory::guessFactoryNamesUsing(
            fn (string $modelName) => 'InnoGE\\FilamentFormFaker\\Database\\Factories\\'.class_basename($modelName).'Factory'
        );
    }

    protected function getPackageProviders($app)
    {
        return [
            FilamentFormFakerServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        config()->set('database.default', 'testing');

        /*
        $migration = include __DIR__.'/../database/migrations/create_filament-form-faker_table.php.stub';
        $migration->up();
        */
    }
}
