<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Contracts\View\View;

class ListUsers extends ListRecords
{
    protected static string $resource = UserResource::class;

    public function getHeaderActions(): array
    {
        return [
            // Akciók gomb hozzáadása
        ];
    }

    public function render(): View
    {
        return view('filament.pages.user-list', [
            'users' => \App\Models\User::all(),
        ]);
    }
}
