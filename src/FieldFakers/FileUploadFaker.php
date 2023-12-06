<?php

namespace InnoGE\FilamentFormFaker\FieldFakers;

use Filament\Forms\Components\Field;

class FileUploadFaker implements FakesFormFields
{
    public function handle(Field $field): mixed
    {
        return [];
    }
}
