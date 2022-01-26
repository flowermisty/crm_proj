<?php

namespace App\Models;

use CodeIgniter\Model;

class EventListModel extends Model{
    protected $table = 'eventList';
    protected $primaryKey = 'idx';
    protected $allowedFields = [
        'event_name',
        'item_code',
        'regist_date',

    ];
    protected $beforeInsert = ['beforeInsert'];
    protected $beforeUpdate = ['beforeUpdate'];

    protected function beforeInsert(array $data){
        $data['data']['regist_date'] = date('Y-m-d');

        return $data;
    }

    protected function beforeUpdate(array $data){
        $data['data']['updated_at'] = date('Y-m-d');
        return $data;
    }
}

