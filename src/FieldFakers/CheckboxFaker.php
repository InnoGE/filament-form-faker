<?php

namespace InnoGE\FilamentFormFaker\FieldFakers;

use Filament\Forms\Components\Field;

class CheckboxFaker implements FakesFormFields
{
    public function handle(Field $field): mixed
    {
        return fake()->boolean;
    }
}
