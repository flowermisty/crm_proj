<?php

namespace App\Models;

use CodeIgniter\Model;

class EventListModel extends Model{
    protected $table = 'eventList';
    protected $primaryKey = 'idx';
    protected $allowedFields = [
        'event_name',
        'event_code',
        'regist_date',
        'updated_at'

    ];
    protected $beforeInsert = ['beforeInsert'];

    protected function beforeInsert(array $data){
        $data['data']['regist_date'] = date('Y-m-d');

        return $data;
    }


}

