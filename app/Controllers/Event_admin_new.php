<?php

namespace App\Controllers;


namespace App\Controllers;

use App\Models\EventListModel;
use App\Models\EventModel;

if (defined('BASEPATH')) exit('No direct script access allowed');

class Event_admin_new extends BaseController
{
    public function index()
    {
        $eventListModel = new EventListModel();
        $queryList = $eventListModel->orderBy('idx', "desc")->findAll();
        $data['eventList'] = $queryList;


        echo view('event_admin/templates_new/header');
        echo view('event_admin/event_list_new', $data);
        echo view('event_admin/templates_new/footer');
    }

    public function init($event_code)
    {
        $data = [];
        $dataResult = [];
        helper(['form', 'alert']);

        $eventModel = new EventModel();
        $query = $eventModel->groupBy('menuName')->findAll();
        $data['eventModel'] = $query;


        if ($this->request->getMethod() == 'post') {
            //let's do the validation here
            $rules = [
                'itemCode' => 'required|min_length[5]|max_length[20]|is_unique[godoFreeEventMenuCalendarTemp.optionCode]',
                'event_code' => 'required|min_length[5]|max_length[20]|',
                'menuName' => 'required',
                'step' => 'required'
            ];
            $errors = [

                'itemCode' => [
                    'required' => 'ItemCode는 필수입력 필드입니다.',
                    'min_length' => 'ItemCode는 최소 5자 이상 이어야 합니다.',
                    'max_length' => 'ItemCode는 최대 20자를 넘을수 없습니다.',
                    'is_unique' => '동일한 코드가 이미 존재합니다.'
                ],
                'menuName' => [
                    'required' => '메뉴를 적어도 하나 이상 선택 하셔야 합니다.'
                ],
                'step' => [
                    'required' => '단계는 필수 입력 필드 입니다.'
                ],

            ];


            if (!$this->validate($rules, $errors)) {
                $data['validation'] = $this->validator;
            } else {
                $model = new EventModel();
                $modelList = new EventListModel();

                $arr_lenth = $this->request->getVar('menuName');
                for ($i = 0; $i < count($arr_lenth); $i++) {

                    $newData = [
                        'optionCode' => $this->request->getVar('itemCode'),
                        'event_code' => $this->request->getVar('event_code'),
                        'step' => $this->request->getVar('step'),
                        'menuName' => $this->request->getVar('menuName')[$i],
                        'erpCode' => $this->request->getVar('erpCode')[$i],
                        'ea' => $this->request->getVar('ea')[$i],
                    ];

                    $dataResult = $model->save($newData);
                }


                if ($dataResult) {
                    $session = session();
                    $session->setFlashdata('success', 'Successful Registration');
                    alert_move("등록 되었습니다.", "http://godo.event.admin/init/$event_code");

                } else {
                    alert_move("등록에 실패하였습니다. 데이터에 오류가 있습니다.", "http://godo.event.admin/init");

                }


            }
        }
        $eventListModel = new EventListModel();
        $eventModel->where('event_code', "$event_code");
        $eventModel->groupBy('optionCode');
        $queryList = $eventModel->findAll();
        $data['eventList'] = $queryList;
        $data['event_code'] = $event_code;
        $data['event_name'] = $eventListModel->select('event_name')->where('event_code', "$event_code")->find();

        echo view('event_admin/templates_new/header', $data);
        echo view('event_admin/event_init_new');
        echo view('event_admin/templates_new/footer');
    }



}