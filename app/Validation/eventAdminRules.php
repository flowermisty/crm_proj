<?php

namespace App\Validation;
use App\Models\EventListModel;

class eventAdminRules
{
    public function validateEvent(string $str, string $fields, array $data){
        $model = new EventListModel();
        $event = $model->where('item_code', $data['item_code'])
                       ->first();
        if(!$event){
            return false;
        }
    }
}