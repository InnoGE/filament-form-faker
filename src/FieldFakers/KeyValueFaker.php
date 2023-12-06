<?php

namespace InnoGE\FilamentFormFaker\FieldFakers;

use Filament\Forms\Components\Field;

class KeyValueFaker implements FakesFormFields
{
    public function handle(Field $field): mixed
    {
        return [fake()->word => fake()->word];
    }
}
