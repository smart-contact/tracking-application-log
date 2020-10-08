<?php

namespace SmartContact\TrackingApplicationLog\app\Exports;

use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use SmartContact\TrackingApplicationLog\app\Models\ApplicationLog;

class ApplicationLogsExport implements FromCollection, WithHeadings, ShouldQueue
{    
    use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return ApplicationLog::all();
    }

    public function headings(): array
    {
        return [
            'Id',
            'Risorsa',
            'Link Risorsa',
            'Descrizione',
            'Log',
            'Cambiamenti',
            'Livello',
            'User Agent',
            'Browser',
            'Versione Browser',
            'Piattaforma',
            'Versione Piattaforma',
            'Ip',
            'Creato Il',
            'Aggiornato Il',
            'Email'
        ];
    }   
}
