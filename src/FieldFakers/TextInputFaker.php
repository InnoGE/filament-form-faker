<?php

namespace InnoGE\FilamentFormFaker\FieldFakers;

use Filament\Forms\Components\Field;
use Filament\Forms\Components\TextInput;

class TextInputFaker implements FakesFormFields
{
    /**
     * @param  TextInput  $field
     */
    public function handle(Field $field): mixed
    {
        return match ($field->getType()) {
            'email' => fake()->email(),
            'number' => fake()->randomNumber(2),
            'password' => fake()->password(),
            'tel' => fake()->randomNumber(),
            'url' => fake()->url(),
            default => fake()->word(),
        };
    }
}
