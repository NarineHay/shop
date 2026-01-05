<?php

namespace App\Filament\Resources\ProductResource\Pages;

use App\Filament\Resources\ProductResource;
use App\Services\Products\ProductImportService;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Facades\Log;

class ListProducts extends ListRecords
{
    protected static string $resource = ProductResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),

            Actions\Action::make('import_from_google')
                ->label('Импорт из Google Sheets')
                ->button()
                ->color('primary')
                ->icon('heroicon-o-arrow-down')
                ->action(function (ProductImportService $importService) {
                    try {
                        // ID таблицы и диапазон данных
                        $sheetId = config('services.google.sheet_id'); // добавь в services.php
                        $range = 'Sheet1!A1:AZ1000';

                        // Запускаем импорт
                        $importService->importFromSheet($sheetId, $range);

                        // $this->notify('success', 'Импорт завершён успешно!');
                        \Filament\Notifications\Notification::make()
                            ->title('Импорт завершён')
                            ->success()
                            ->send();
                    } catch (\Exception $e) {
                        Log::error('Ошибка импорта: ' . $e->getMessage());
                        // $this->notify('danger', 'Ошибка импорта: ' . $e->getMessage());
                        \Filament\Notifications\Notification::make()
                            ->title( $e->getMessage())
                            ->success()
                            ->send();
                    }
                })
        ];
    }
}
