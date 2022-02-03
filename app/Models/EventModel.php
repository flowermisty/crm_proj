<?php

namespace App\Models;

use CodeIgniter\Model;

class EventModel extends Model{
    protected $table = 'godoFreeEventMenuCalendarTemp';
    protected $primaryKey = 'idx';
    protected $allowedFields = [
        'optionCode',
        'event_code',
        'orderDate',
        'erpCode',
        'menuName',
        'ea',

    ];
    protected $beforeInsert = ['beforeInsert'];
    protected $beforeUpdate = ['beforeUpdate'];

    protected function beforeInsert(array $data){
        $data['data']['orderDate'] = date('Y-m-d');

        return $data;
    }

    protected function beforeUpdate(array $data){
        $data['data']['updated_at'] = date('Y-m-d');
        return $data;
    }
}

