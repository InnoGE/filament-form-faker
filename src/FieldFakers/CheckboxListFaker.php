<?php

namespace InnoGE\FilamentFormFaker\FieldFakers;

use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\Field;

class CheckboxListFaker implements FakesFormFields
{
    /**
     * @param  CheckboxList  $field
     */
    public function handle(Field $field): mixed
    {
        return [fake()->randomElement(array_keys($field->getOptions()))];
    }
}
