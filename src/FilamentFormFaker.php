<?php

namespace InnoGE\FilamentFormFaker;

use Filament\Forms\Components\Builder;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use InnoGE\FilamentFormFaker\FieldFakers\BuilderFaker;
use InnoGE\FilamentFormFaker\FieldFakers\CheckboxFaker;
use InnoGE\FilamentFormFaker\FieldFakers\CheckboxListFaker;
use InnoGE\FilamentFormFaker\FieldFakers\FileUploadFaker;
use InnoGE\FilamentFormFaker\FieldFakers\KeyValueFaker;
use InnoGE\FilamentFormFaker\FieldFakers\OptionsFaker;
use InnoGE\FilamentFormFaker\FieldFakers\RepeaterFaker;
use InnoGE\FilamentFormFaker\FieldFakers\TextareaFaker;
use InnoGE\FilamentFormFaker\FieldFakers\TextInputFaker;

class FilamentFormFaker
{
    /**
     * @var array<class-string,class-string>
     */
    protected static array $fieldFakers = [
        Checkbox::class => CheckboxFaker::class,
        TextInput::class => TextInputFaker::class,
        Textarea::class => TextareaFaker::class,
        Radio::class => OptionsFaker::class,
        Select::class => OptionsFaker::class,
        CheckboxList::class => CheckboxListFaker::class,
        Repeater::class => RepeaterFaker::class,
        FileUpload::class => FileUploadFaker::class,
        Toggle::class => CheckboxFaker::class,
        KeyValue::class => KeyValueFaker::class,
        Builder::class => BuilderFaker::class,
    ];

    public static function boot(): void
    {
        // Register MultiSelect faker only if the class exists (deprecated in Filament 3, removed in later versions)
        if (class_exists(\Filament\Forms\Components\MultiSelect::class)) {
            static::$fieldFakers[\Filament\Forms\Components\MultiSelect::class] = OptionsFaker::class;
        }
    }

    /**
     * Fake form data. Accepts either Filament\Forms\Form (v3) or Filament\Schemas\Schema (v4/5).
     */
    public function fake(object $form): object
    {
        return $form->fill($this->getFakeValuesForFields($form->getFlatFields()));
    }

    /**
     * @param  array<string,object>  $fields
     */
    public function getFakeValuesForFields(array $fields): array
    {
        return collect($fields)
            ->mapWithKeys(function (object $field) {
                if (array_key_exists($field::class, self::$fieldFakers)) {
                    return [$field->getName() => app(self::$fieldFakers[$field::class])->handle($field)];
                }

                return [$field->getName() => null];
            })
            ->toArray();
    }

    public function registerFieldFaker(string $field, string $fieldFaker): void
    {
        self::$fieldFakers[$field] = $fieldFaker;
    }
}
