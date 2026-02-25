<?php

namespace InnoGE\FilamentFormFaker;

use Closure;
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
        FilamentFormFaker::boot();

        $fakeMacro = function (Closure|bool $condition = true) {
            if (is_callable($condition) && ! $condition()) {
                return $this;
            }

            if ($condition === false) {
                return $this;
            }

            return app(FilamentFormFaker::class)->fake($this);
        };

        // Filament 4/5: Form was replaced by Schema
        if (class_exists(\Filament\Schemas\Schema::class)) {
            \Filament\Schemas\Schema::macro('fake', $fakeMacro);
        }

        // Filament 3: Form class exists in forms package
        if (class_exists(\Filament\Forms\Form::class)) {
            \Filament\Forms\Form::macro('fake', $fakeMacro);
        }
    }
}
