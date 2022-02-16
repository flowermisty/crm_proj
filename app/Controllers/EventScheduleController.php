<?php
namespace App\Controllers;
use App\Controllers\BaseController;
use App\Models\ScheduleModel;


class EventScheduleController extends BaseController {



   public function index()
    {
        $ScheduleModel = new ScheduleModel();
        $event_data = $ScheduleModel->findAll();
        foreach($event_data as $row)
        {
            $data[] = array(
                'id' => $row['id'],
                'title' => $row['title'],
                'start' => $row['start_date'],
                'end' => $row['end_date']
            );
        }
        echo view('event_admin/event_schedule');

    }

    public function load()
    {
        $ScheduleModel = new ScheduleModel();
        $event_data = $ScheduleModel->findAll();
        foreach($event_data as $row)
        {
            $data[] = array(
                'id' => $row['id'],
                'title' => $row['title'],
                'start' => $row['start_date'],
                'end' => $row['end_date']
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
                'end_date' => $this->request->getVar('end')
            ];
            $scheduleModel = new ScheduleModel();
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
            $scheduleModel = new ScheduleModel();
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
            $scheduleModel = new ScheduleModel();
            $scheduleModel->where('id',"{$this->request->getVar('id')}")->delete();
        }
    }

}

?>