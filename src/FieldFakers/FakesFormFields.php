<?php

namespace InnoGE\FilamentFormFaker\FieldFakers;

use Filament\Forms\Components\Field;

interface FakesFormFields
{
    public function handle(Field $field): mixed;
}
