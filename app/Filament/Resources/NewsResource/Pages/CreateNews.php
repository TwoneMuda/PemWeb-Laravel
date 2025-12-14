<?php

namespace App\Filament\Resources\NewsResource\Pages;

use App\Filament\Resources\NewsResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateNews extends CreateRecord
{
    protected static string $resource = NewsResource::class;

    // Override (Timpa) tombol bawaan
    // 1. Kita buat variabel sementara untuk menampung pilihan tombol user
    protected $tempStatus = 'draft'; 

    // 2. Fungsi ini jalan OTOMATIS sesaat sebelum data masuk database
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Masukkan status sesuai tombol yang diklik (dari variabel tempStatus)
        $data['status'] = $this->tempStatus;
        
        // Isi author otomatis
        $data['author_id'] = auth()->id();

        return $data;
    }

    // 3. Tombol Custom
    protected function getFormActions(): array
    {
        return [
            // TOMBOL SIMPAN DRAFT
            Actions\Action::make('save_draft')
                ->label('Simpan sebagai Draft')
                ->icon('heroicon-o-document')
                ->color('gray')
                ->action(function () {
                    // Set variabel sementara jadi 'draft'
                    $this->tempStatus = 'draft';
                    // Jalankan proses simpan bawaan Filament
                    $this->create(); 
                }),

            // TOMBOL KIRIM REVIEW
            Actions\Action::make('submit_review')
                ->label('Kirim untuk Review')
                ->icon('heroicon-o-paper-airplane')
                ->color('primary')
                ->action(function () {
                    // Set variabel sementara jadi 'review'
                    $this->tempStatus = 'review';
                    // Jalankan proses simpan bawaan Filament
                    $this->create();
                }),
        ];
    }
}
