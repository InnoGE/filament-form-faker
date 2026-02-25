<?php

namespace InnoGE\FilamentFormFaker\Traits;

trait FillsFormWithFakeData
{
    protected function afterFill(): void
    {
        // Filament 4/5 uses Schema, accessed via getSchema() or the $this->form property
        $form = property_exists($this, 'form') ? $this->form : null;

        if ($form && method_exists($form, 'fake')) {
            $form->fake($this->shouldFillFormWithFakeData());
        }
    }

    protected function shouldFillFormWithFakeData(): bool
    {
        return app()->environment('local', 'testing');
    }
}
