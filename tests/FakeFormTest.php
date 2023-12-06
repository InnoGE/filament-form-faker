<?php

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
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Livewire\Component;

it('fakes text inputs', function () {
    $form = (new FakeForm())->getForm('form');

    $form->schema([
        TextInput::make('text'),
        TextInput::make('numeric')->numeric(),
        TextInput::make('email')->email(),
        TextInput::make('password')->password(),
        TextInput::make('tel')->tel(),
        TextInput::make('url')->url(),
    ]);

    $form->fake();

    expect($form->getState())
        ->text->toBeString()
        ->numeric->toBeInt()
        ->email->toMatch('/^.+@.+$/')
        ->password->toBeString()
        ->tel->not()->toBeNull()
        ->url->toBeUrl();
});

it('fakes checkboxes', function () {
    $form = (new FakeForm())->getForm('form');

    $form->schema([
        Checkbox::make('checkbox'),
    ]);

    $form->fake();

    expect($form->getState())
        ->checkbox->toBeBool();
});

it('fakes toggles', function () {
    $form = (new FakeForm())->getForm('form');

    $form->schema([
        Toggle::make('toggle'),
    ]);

    $form->fake();

    expect($form->getState())
        ->toggle->toBeBool();
});

it('fakes textareas', function () {
    $form = (new FakeForm())->getForm('form');

    $form->schema([
        Textarea::make('textarea'),
    ]);

    $form->fake();

    expect($form->getState())
        ->textarea->toBeString();
});

it('fakes radios', function () {
    $form = (new FakeForm())->getForm('form');

    $form->schema([
        Radio::make('radio')
            ->options([
                'option1' => 'Option 1',
                'option2' => 'Option 2',
            ]),
    ]);

    $form->fake();

    expect($form->getState())
        ->radio->toBeIn(['option1', 'option2']);
});

it('fakes checkbox lists', function () {
    $form = (new FakeForm())->getForm('form');

    $form->schema([
        CheckboxList::make('checkbox_list')
            ->options([
                'option1' => 'Option 1',
                'option2' => 'Option 2',
            ]),
    ]);

    $form->fake();

    expect($form->getState()['checkbox_list'][0])
        ->toBeIn(['option1', 'option2']);
});

it('fakes selects', function () {
    $form = (new FakeForm())->getForm('form');

    $form->schema([
        Select::make('select')
            ->options([
                'option1' => 'Option 1',
                'option2' => 'Option 2',
            ]),
        Select::make('multi_select')
            ->multiple()
            ->options([
                'option1' => 'Option 1',
                'option2' => 'Option 2',
            ]),
    ]);

    $form->fake();

    expect($form->getState())
        ->select->toBeIn(['option1', 'option2'])
        ->multi_select->toBeArray()
        ->multi_select->toHaveCount(1);

    expect($form->getState()['multi_select'][0])
        ->toBeIn(['option1', 'option2']);
});

it('fakes repeater', function () {
    $form = (new FakeForm())->getForm('form');

    $form->schema([
        Repeater::make('repeater')
            ->schema([
                TextInput::make('text'),
                Checkbox::make('checkbox'),
            ]),
    ]);

    $form->fake();

    expect($form->getState()['repeater'])
        ->toBeArray()
        ->toHaveCount(1);

    expect($form->getState()['repeater'][0])
        ->toBeArray()
        ->toHaveCount(2)
        ->text->toBeString()
        ->checkbox->toBeBool();
});

it('fakes builders', function () {
    $form = (new FakeForm())->getForm('form');

    $form->schema([
        Builder::make('builder')
            ->blocks([
                Builder\Block::make('block_1')
                    ->schema([
                        TextInput::make('text'),
                        Checkbox::make('checkbox'),
                    ]),
                Builder\Block::make('block_2')
                    ->schema([
                        TextInput::make('text'),
                        Checkbox::make('checkbox'),
                    ]),
            ]),
    ]);

    $form->fake();

    expect($form->getState()['builder'])
        ->toBeArray()
        ->toHaveCount(2);

    expect($form->getState()['builder'][0])
        ->toBeArray()
        ->toHaveCount(2)
        ->data->text->toBeString()
        ->data->checkbox->toBeBool()
        ->type->toBe('block_1');

    expect($form->getState()['builder'][1])
        ->toBeArray()
        ->toHaveCount(2)
        ->data->text->toBeString()
        ->data->checkbox->toBeBool()
        ->type->toBe('block_2');
});

it('fakes file uploads', function () {
    $form = (new FakeForm())->getForm('form');

    $form->schema([
        FileUpload::make('file'),
    ]);

    $form->fake();

    expect($form->getState())
        ->file->toBeNull();
});

it('fakes key values', function () {
    $form = (new FakeForm())->getForm('form');

    $form->schema([
        KeyValue::make('key_value'),
    ]);

    $form->fake();

    expect($form->getState())
        ->key_value->toBeArray()
        ->key_value->toHaveCount(1);
});

class FakeForm extends Component implements HasForms
{
    use InteractsWithForms;

    public array $data = [];

    public function form(Form $form): Form
    {
        return $form
            ->statePath('data');
    }
}
