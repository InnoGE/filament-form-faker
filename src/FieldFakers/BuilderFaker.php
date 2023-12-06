<?php

namespace InnoGE\FilamentFormFaker\FieldFakers;

use Filament\Forms\Components\Builder;
use Filament\Forms\Components\Field;
use InnoGE\FilamentFormFaker\FilamentFormFaker;

class BuilderFaker implements FakesFormFields
{
    /**
     * @param  Builder  $field
     */
    public function handle(Field $field): mixed
    {
        $result = [];

        /** @var Builder\Block $block */
        foreach ($field->getChildComponents() as $block) {
            $result[] = [
                'data' => app(FilamentFormFaker::class)->getFakeValuesForFields($block->getChildComponents()),
                'type' => $block->getName(),
            ];
        }

        return $result;
    }
}
