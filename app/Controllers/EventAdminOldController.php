<?php

namespace App\Controllers;

use App\Models\EventListModel;
use App\Models\EventComponentsModel;

if (defined('BASEPATH')) exit('No direct script access allowed');

class EventAdminOldController extends BaseController
{
    public function index()
    {
        $eventListModel = new EventListModel();
        $queryList = $eventListModel->orderBy('idx', "desc")->findAll();
        $data['eventList'] = $queryList;


        echo view('event_admin/templates/header');
        echo view('event_admin/event_list_old', $data);
        echo view('event_admin/templates/footer');
    }

    public function getEventList()
    {
        $eventListModel = new EventListModel();
        $data['eventList'] = $eventListModel->findAll();
        return $this->response->setJSON($data);
    }

    public function eventRegist()
    {
        $data = [];
        helper(['form', 'alert']);
        if ($this->request->getMethod() == 'post') {
            $rules = [

                'event_name' => 'required|min_length[5]|max_length[20]|',
                'event_code' => 'required|min_length[10]|max_length[20]|'
            ];

            $errors = [
                'event_name' => [
                    'required' => '세트이름은 필수입력 필드입니다.',
                    'min_length' => '세트이름은 최소 5자 이상 이어야 합니다.',
                    'max_length' => '세트이름은 최대 20자를 넘을수 없습니다.',
                    'is_unique' => '동일한 이벤트명이 이미 존재합니다.'
                ],

                'event_code' => [
                    'required' => '이벤트 코드는 필수입력 필드입니다.',
                    'min_length' => '이벤트 코드는 최소 5자 이상 이어야 합니다.',
                    'max_length' => '이벤트 코드는 최대 20자를 넘을수 없습니다.',
                    'is_unique' => '동일한 이벤트 코드가 이미 존재합니다.'
                ],


            ];

            if (!$this->validate($rules, $errors)) {
                $data['validation'] = $this->validator;
            } else {
                $eventListModel = new EventListModel();

                $eventData = [
                    'event_name' => $this->request->getVar('event_name'),
                    'event_code' => $this->request->getVar('event_code'),
                ];
                $eventListModel->where('event_code', "{$eventData['event_code']}");
                $count_event_code = $eventListModel->countAllResults();
                $eventListModel->where('event_name', "{$eventData['event_name']}");
                $count_event_name = $eventListModel->countAllResults();
                if ($count_event_code != 0 || $count_event_name != 0) {
                    $duplicate = ['status' => 'fail'];
                    return $this->response->setJSON($duplicate);
                    /*alert_move("동일한 이벤트 코드 또는 이벤트명이 이미 존재합니다.", "http://godo.event.admin");*/
                } else {
                    $eventListModel->save($eventData);
                    return $this->response->setJSON($eventData);


                    /*if ($dataResult) {
                        $session = session();
                        $session->setFlashdata('success', 'Successful Registration');
                        alert_move("등록 되었습니다.", "http://godo.event.admin");
                    }*/
                }


            }


        }

    }

    public function init($event_code)
    {
        $data = [];
        $dataResult = [];
        helper(['form', 'alert']);

        $eventModel = new EventComponentsModel();
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
                $model = new EventComponentsModel();
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

        echo view('event_admin/templates/header', $data);
        echo view('event_admin/event_init_old');
        echo view('event_admin/templates/footer');
    }

    public function update($item_code, $event_code)
    {
        $data = [];
        $dataResult = [];

        helper(['form', 'alert']);

        $data['item_code'] = $item_code;
        $data['event_code'] = $event_code;

        $eventModel = new EventComponentsModel();
        $eventListModel = new EventListModel();

        $data['event_name'] = $eventListModel->select('event_name')->where('event_code', "$event_code")->find();

        $query = $eventModel->groupBy('menuName')->findAll();
        $data['eventModel'] = $query;

        if (!$item_code == "" && $this->request->getMethod() == 'get') {
            $eventListModel = new EventListModel();
            //$data['eventList'] = $eventListModel->where("event_code", "$event_code")->first();
            //$eventListModel -> join('godoFreeEventMenuCalendarTemp','godoFreeEventMenuCalendarTemp.optionCode=eventList.item_code');
            $data['joinData'] = $eventModel->where('optionCode', "$item_code")->findAll();
            return $this->response->setJSON($data);
            //$eventModel->where('event_code', "$event_code");
            //$eventModel->groupBy('optionCode');
            //$queryList = $eventModel->findAll();
            //$data['setList']=$queryList;
            //$data['step']=$eventModel->select("step")->where("optionCode","$item_code")->groupBy('optionCode')->find();

        }

        if ($this->request->getMethod() == 'post') {
            //let's do the validation here
            $rules = [
                'itemCode' => 'required|min_length[5]|max_length[20]|',
                'event_code' => 'required|min_length[5]|max_length[20]|',
                'menuName' => 'required',
                'step' => 'required'
            ];
            $errors = [

                'itemCode' => [
                    'required' => 'ItemCode는 필수입력 필드입니다.',
                    'min_length' => 'ItemCode는 최소 5자 이상 이어야 합니다.',
                    'max_length' => 'ItemCode는 최대 20자를 넘을수 없습니다.',
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
                $modelList = new EventListModel();
                $modelList->select("idx")->where("event_code", "{$this->request->getVar('event_code')}");
                $id = $modelList->first();
                $today = date('Y-m-d');
                $updated_at = [
                    'idx' => $id,
                    'updated_at' => $today
                ];


                $model = new EventComponentsModel();
                $arr_lenth = $this->request->getVar('menuName');
                $flag = false;
                for ($i = 0; $i < count($arr_lenth); $i++) {

                    $newData = [
                        'optionCode' => $this->request->getVar('itemCode'),
                        'event_code' => $this->request->getVar('event_code'),
                        'step' => $this->request->getVar('step'),
                        'menuName' => $this->request->getVar('menuName')[$i],
                        'erpCode' => $this->request->getVar('erpCode')[$i],
                        'ea' => $this->request->getVar('ea')[$i],
                    ];
                    if ($flag == false) {
                        $model->where("optionCode", "$item_code")->delete();
                        $flag = true;
                    }
                    $dataResult = $model->save($newData);
                    $modelList->save($updated_at);
                    $session = session();
                    $s_item_code = [
                        'item_code' => $this->request->getVar('itemCode')
                    ];
                    $session->set($s_item_code);
                }

                if ($dataResult) {
                    $session = session();
                    $session->setFlashdata('success', 'Successful Registration');

                    alert_move("수정 되었습니다. \\n \\n※직전 수정 항목은 초록색으로 표기 됩니다.", "http://godo.event.admin/init/{$event_code}");

                } else {
                    alert_move("수정에 실패하였습니다. 데이터에 오류가 있습니다.", "http://godo.event.admin/update/{$item_code}/{$event_code}");

                }


            }
        }


        $queryList = $eventModel->where('event_code',"{$event_code}")->groupBy('optionCode')->findAll();
        $data['eventList'] = $queryList;


        echo view('event_admin/templates/header', $data);
        echo view('event_admin/event_init_old');
        echo view('event_admin/templates/footer');
    }

    public function delete()
    {
        helper(['form', 'alert']);
        $deletePack = $this->request->getVar('item_code');
        if ($this->request->getMethod() == 'post' && $deletePack) {
            $model = new EventComponentsModel();
            $deleteData = [
                'item_code' => $this->request->getVar('item_code'),
            ];
            $model->where('optionCode', "{$this->request->getVar('item_code')}")->delete();
            alert_move("삭제 되었습니다.", "http://godo.event.admin/init/{$this->request->getVar('event_delete')}");
            return;
        }


        $arr_lenth = $this->request->getVar('event_code');

        $modelList = new EventListModel();

        for ($i = 0; $i < count($arr_lenth); $i++) {
            $modelList->where('event_code', "{$this->request->getVar('event_code')[$i]}")->delete();
        }
        $deleteSuccess = ['status' => 'success'];
        return $this->response->setJSON($deleteSuccess);


    }


}