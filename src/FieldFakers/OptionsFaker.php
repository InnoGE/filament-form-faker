<?php

namespace InnoGE\FilamentFormFaker\FieldFakers;

use Filament\Forms\Components\Field;

class OptionsFaker implements FakesFormFields
{
    public function handle(Field $field): mixed
    {
        $option = fake()->randomElement(array_keys($field->getOptions()));

        if (method_exists($field, 'isMultiple')) {
            return $field->isMultiple() ? [$option] : $option;
        }

        return $option;
    }
}
