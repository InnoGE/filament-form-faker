<?php

namespace InnoGE\FilamentFormFaker\Traits;

trait FillsFormWithFakeData
{
    protected function afterFill(): void
    {
        $this->form->fake($this->shouldFillFormWithFakeData());
    }

    protected function shouldFillFormWithFakeData(): bool
    {
        return app()->environment('local', 'testing');
    }
}
