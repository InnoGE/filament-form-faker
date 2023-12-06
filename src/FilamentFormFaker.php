<?php

namespace InnoGE\FilamentFormFaker;

use Filament\Forms\Components\Builder;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\Component;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\MultiSelect;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
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
        MultiSelect::class => OptionsFaker::class,
        Builder::class => BuilderFaker::class,
    ];

    public function fake(Form $form): Form
    {
        return $form->fill($this->getFakeValuesForFields($form->getFlatFields()));
    }

    /**
     * @param  array<string,Component>  $fields
     */
    public function getFakeValuesForFields(array $fields): array
    {
        return collect($fields)
            ->mapWithKeys(function (Component $field) {
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
