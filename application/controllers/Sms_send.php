<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Sms_send extends CI_Controller
{
  public function __construct()

  {
    parent::__construct();
    if($this->session->userdata['userid'] == '')
    {
      $this->index1();
    }
    $this->load->model('Smssend_model');
    $this->load->model('Dashboardmodel');
   
  }

  public function index1()
  {
    redirect('login/');
  }

  public function index()
  {
    $this->smsnotification();   
    
  }

  public function smsnotification()
  { 
    $data['title']="SMS Notification";
    $data['menu']="Management";
    $data['menuItem']='sms notification model';
    
    $customercomplaint= $this->Dashboardmodel->customer_complaint();
    $headerdata['customercomplaint'] = $customercomplaint;
    
    $data['user_list'] = $this->Smssend_model->userlist_dd(); 
    $data['webnotification'] = $this->Smssend_model->webnotification(); 
    $accessmenu['access_menu'] = $this->Dashboardmodel->access_menu();
    
    $this->load->view('components/header/headerscript');
    $this->load->view('components/header/headernavbar',$headerdata);
    $this->load->view('components/mainmenu',$accessmenu);
    $this->load->view('sms_notification/sms_notification', $data);
    $this->load->view('components/footer/footerscript');
  }

  public function notification_add() {
      $userid=$this->input->post('userid');
      $singlesms=$this->input->post('singlesms');
      if($userid && $singlesms){
          $data = array(
            'userid' => $userid, 
            'message' => $singlesms,
          );
//          echo json_encode($data); die;
          $this->db->insert("smswebnotification",$data);
          redirect(site_url('Sms_send'));
      }else{
          redirect(site_url('Sms_send'));
      }
      
  }
  public function notification_delete() {
      $smsid=$this->input->post('get_sms');
          $data = array(
            'status' => 4
          );
          $this->db->where('id', $smsid);
         $smsdel = $this->db->update('smswebnotification', $data);
      echo json_encode($smsdel);
      
  }
}