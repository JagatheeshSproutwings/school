<?php
error_reporting(0);
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Timezone extends MY_Controller
{
  public function __construct()

  {
    parent::__construct();
    if($this->session->userdata['userid'] == '')
    {
      $this->index1();
    }
    $this->load->model ('Timezone_model');
}

public function index1()
{
  redirect('login/');
}

public function index()
{
  $this->timezone_details();   
}

public function timezone_details()
{

   $data['timezone_data'] = $this->Timezone_model->timezone_data();

    $this->load->view('components/header/headerscript');
    $this->load->view('components/header/headernavbar',$data);
    $this->load->view('components/mainmenu',$data);
    $this->load->view('schooladmin/timezone/timezone',$data);
    $this->load->view('components/footer/footerscript');
    $this->load->view('components/footer/footer');
}

public function timezone_save()
{
  $id = $this->input->post('timezone_id');
    if($id=='')
    {
       $timezone_data = array(
        "created_date" => date('Y-m-d H:i:s'),            
        "created_by"=> $this->session->userdata('userid'),
        "timezone_name" => $this->input->post('timezone_name'),
        "timezone_mins" => $this->input->post('timezone_mins')
       );

       $result = $this->Timezone_model->add_timezone($timezone_data);
       echo json_encode(1);

    }else{
        $timezone_data = array(
            "updated_date" => date('Y-m-d H:i:s'),            
            "updated_by"=> $this->session->userdata('userid'),
            "timezone_name" => $this->input->post('timezone_name'),
            "timezone_mins" => $this->input->post('timezone_mins')
           );

        $result = $this->Timezone_model->add_timezone($timezone_data,$id);
        echo json_encode(2);
    }
}

public function edittimezone()
{
  $id = $this->input->post('thisid');
  $data = $this->Timezone_model->edit_timezone($id);
  echo json_encode($data);
}

public function deletetimezone()
{               
    $id=$this->input->post('thisid');    
    $this->db->where('timezone_id',$id);
    $query = $this->db->delete('time_zone');
    if ($query) 
    { return TRUE; }
    else 
    { return FALSE; }
}


}
?>