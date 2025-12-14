<?php

namespace App\Filament\Resources\NewsResource\Pages;

use App\Filament\Resources\NewsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditNews extends EditRecord
{
    protected static string $resource = NewsResource::class;

    // Override tombol Save bawaan di bawah form
    // 1. Variabel sementara
    protected $tempStatus = null;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    // 2. Manipulasi data sesaat sebelum disimpan ke Database
    protected function mutateFormDataBeforeSave(array $data): array
    {
        // Jika ada perubahan status dari tombol, gunakan itu
        if ($this->tempStatus) {
            $data['status'] = $this->tempStatus;
        }

        // Jika statusnya berubah jadi 'review' (dikirim ulang), 
        // kita hapus catatan penolakan sebelumnya agar bersih.
        if ($this->tempStatus === 'review') {
            $data['rejection_note'] = null;
        }

        return $data;
    }

    // 3. Tombol Custom di bawah form
    protected function getFormActions(): array
    {
        return [
            // TOMBOL 1: Simpan Draft (Tarik kembali atau simpan perubahan sementara)
            Actions\Action::make('save_draft')
                ->label('Simpan sebagai Draft')
                ->icon('heroicon-o-document')
                ->color('gray')
                ->action(function () {
                    $this->tempStatus = 'draft';
                    $this->save(); 
                }),

            // TOMBOL 2: Kirim Ulang untuk Review
            Actions\Action::make('submit_review')
                ->label('Kirim untuk Review')
                ->icon('heroicon-o-paper-airplane')
                ->color('primary')
                ->action(function () {
                    $this->tempStatus = 'review';
                    $this->save();
                }),
        ];
    }
}
