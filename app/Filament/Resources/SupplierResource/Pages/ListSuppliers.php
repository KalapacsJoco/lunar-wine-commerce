<?php

namespace App\Filament\Resources\SupplierResource\Pages;

use App\Filament\Resources\SupplierResource;
use App\Filament\Widgets\SuppliersOverview;
use App\Livewire\SuppliersOverview as LivewireSuppliersOverview;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSuppliers extends ListRecords
{
    protected static string $resource = SupplierResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            LivewireSuppliersOverview::class
        ];
    }
}
