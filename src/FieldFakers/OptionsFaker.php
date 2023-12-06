<?php

namespace InnoGE\FilamentFormFaker\FieldFakers;

use Filament\Forms\Components\Field;
use Filament\Forms\Components\MultiSelect;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Select;

class OptionsFaker implements FakesFormFields
{
    /**
     * @param  Select|Radio|MultiSelect  $field
     */
    public function handle(Field $field): mixed
    {
        $option = fake()->randomElement(array_keys($field->getOptions()));

        if (method_exists($field, 'isMultiple')) {
            return $field->isMultiple() ? [$option] : $option;
        }

        return $option;
    }
}
