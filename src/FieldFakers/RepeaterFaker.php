<?php

namespace InnoGE\FilamentFormFaker\FieldFakers;

use Filament\Forms\Components\Field;
use Filament\Forms\Components\Repeater;
use InnoGE\FilamentFormFaker\FilamentFormFaker;

class RepeaterFaker implements FakesFormFields
{
    /**
     * @param  Repeater  $field
     */
    public function handle(Field $field): mixed
    {
        return [app(FilamentFormFaker::class)->getFakeValuesForFields($field->getChildComponents())];
    }
}
