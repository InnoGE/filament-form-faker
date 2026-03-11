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
        $providers = [
            FilamentFormFakerServiceProvider::class,
        ];

        // Filament 4/5 requires Livewire and Filament service providers
        if (class_exists(\Livewire\LivewireServiceProvider::class)) {
            $providers[] = \Livewire\LivewireServiceProvider::class;
        }

        if (class_exists(\Filament\Support\SupportServiceProvider::class)) {
            $providers[] = \Filament\Support\SupportServiceProvider::class;
        }

        if (class_exists(\Filament\Forms\FormsServiceProvider::class)) {
            $providers[] = \Filament\Forms\FormsServiceProvider::class;
        }

        if (class_exists(\Filament\Schemas\SchemasServiceProvider::class)) {
            $providers[] = \Filament\Schemas\SchemasServiceProvider::class;
        }

        return $providers;
    }

    public function getEnvironmentSetUp($app)
    {
        config()->set('database.default', 'testing');
    }
}
