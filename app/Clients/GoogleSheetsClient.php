<?php

namespace App\Clients;

use Google\Client;
use Google\Service\Sheets;

class GoogleSheetsClient
{
    protected Sheets $service;

    public function __construct()
    {
        // Настройка клиента Google
        $client = new Client();
        $client->setApplicationName('Product Import');
        $client->setScopes([Sheets::SPREADSHEETS_READONLY]);
        $client->setAuthConfig(config('services.google.sheets_credentials')); // путь к credentials.json

        $this->service = new Sheets($client);
    }

    /**
     * Получить строки из Google Sheet
     *
     * @param string $sheetId - ID таблицы
     * @param string $range - диапазон, например 'Sheet1!A1:Z1000'
     * @return array
     */
    public function getRows(string $sheetId, string $range): array
    {
        $response = $this->service->spreadsheets_values->get($sheetId, $range);
        return $response->getValues() ?? [];
    }

    /**
     * Получить все строки как ассоциативные массивы
     * Первая строка считается заголовками
     */
    public function getAssocRows(string $sheetId, string $range): array
    {
        $rows = $this->getRows($sheetId, $range);
        if (empty($rows)) return [];

        $headers = array_map(fn($h) => trim($h), array_shift($rows));
        $headerCount = count($headers);

        $result = [];
        foreach ($rows as $row) {
            // Если в строке меньше значений, дополняем null
            $row = array_pad($row, $headerCount, null);

            $item = array_combine($headers, $row);

            // Если больше значений, обрезаем лишние
            if (count($row) > $headerCount) {
                $row = array_slice($row, 0, $headerCount);
            }

            $result[] = $item;
        }

        return $result;
    }
}
