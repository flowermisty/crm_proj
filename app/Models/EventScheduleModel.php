<?php

namespace App\Models;

use CodeIgniter\Model;

class EventScheduleModel extends Model
{
    protected $table = 'events_schedule';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'title',
        'start_date',
        'end_date',
    ];
}

?>
