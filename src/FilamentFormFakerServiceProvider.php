<?php

namespace InnoGE\FilamentFormFaker;

use Closure;
use Filament\Forms\Form;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class FilamentFormFakerServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('filament-form-faker');
    }

    public function bootingPackage(): void
    {
        Form::macro('fake', function (Closure|bool $condition = true) {
            if (is_callable($condition) && ! $condition()) {
                return $this;
            }

            if ($condition === false) {
                return $this;
            }

            return app(FilamentFormFaker::class)->fake($this);
        });
    }
}
