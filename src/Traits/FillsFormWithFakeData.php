<?php

namespace InnoGE\FilamentFormFaker\Traits;

trait FillsFormWithFakeData
{
    protected function afterFill(): void
    {
        $this->form->fake($this->fillFormWithFakeData());
    }

    protected function fillFormWithFakeData(): bool
    {
        return app()->environment('local', 'testing');
    }
}
