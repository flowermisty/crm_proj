<?php
namespace App\Controllers;
use App\Controllers\BaseController;
use App\Models\EventListModel;
use App\Models\EventScheduleModel;


class EventScheduleController extends BaseController {



   public function index()
    {
        helper(['form', 'alert']);
        if( session()->has('aIdx') == "") {
            alert_move("로그인 후 들어와 주세요 ", "http://godo.event.admin/login");
        }
        $ScheduleModel = new EventScheduleModel();
        $eventListModel = new EventListModel();
        $event_data = $ScheduleModel->findAll();
        $event_list = $eventListModel->select('event_name')->findAll();
        foreach($event_data as $row)
        {
            $data[] = array(
                'id' => $row['id'],
                'title' => $row['title'],
                'start' => $row['start_date'],
                'end' => $row['end_date'],
                'color'=>$row['event_color'],
            );
        }
        $data['eventList'] = $event_list;
        echo view('event_admin/event_schedule',$data);

    }


    public function load()
    {
        $ScheduleModel = new EventScheduleModel();
        $event_data = $ScheduleModel->findAll();
        foreach($event_data as $row)
        {
            $data[] = array(
                'id' => $row['id'],
                'title' => $row['title'],
                'start' => $row['start_date'],
                'end' => $row['end_date'],
                'color'=>$row['event_color'],
            );
        }
        return $this->response->setJSON($data);
    }

    function insert()
    {
        if($this->request->getMethod() == 'post')
        {
            $data = [
                'title'  => $this->request->getVar('title'),
                'start_date'=> $this->request->getVar('start'),
                'end_date' => $this->request->getVar('end'),
                'event_color'=>$this->request->getVar('color'),
            ];
            $scheduleModel = new EventScheduleModel();
            $scheduleModel->save($data);
        }
    }

    function update()
    {
        if($this->request->getMethod() == 'post')
        {
            $data = [
                'title' => $this->request->getVar('title'),
                'start_date' => $this->request->getVar('start'),
                'end_date'  => $this->request->getVar('end'),
            ];
            $scheduleModel = new EventScheduleModel();
            $id = $this->request->getVar('id');
            $scheduleModel->where('id', $id)
                          ->set($data)
                          ->update();
        }
    }

    function delete()
    {
        if($this->request->getMethod() == 'post')
        {
            $scheduleModel = new EventScheduleModel();
            $scheduleModel->where('id',"{$this->request->getVar('id')}")->delete();
        }
    }

}

?>