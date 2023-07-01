<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Device extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('device_model');
        $this->load->model('Dashboardmodel');		
    $this->load->model('Smssend_model');

    }

    public function index()
    {
    	
       $this->devicedetails();
    }

    public function devicedetails()
    {

        $devicelist = $this->device_model->devicelist();
        $devicemodels = $this->device_model->devicemodels();
        $customercomplaint= $this->Dashboardmodel->customer_complaint();
          $data['customercomplaint'] = $customercomplaint;
          $accessmenu['access_menu'] = $this->Dashboardmodel->access_menu();
       if ($devicelist) {

         $data['devicelist'] = $devicelist;
         $data['devicemodels'] = $devicemodels;
        $this->load->view('components/header/headerscript');
        $this->load->view('components/header/headernavbar',$data);
        $this->load->view('components/mainmenu',$accessmenu);
        $this->load->view('Device/devices',$data);
          $this->load->view('components/footer/footerscript');
        $this->load->view('components/footer/footer');
       }
       else
       {
          $data['devicemodels'] = $devicemodels;
        $this->load->view('components/header/headerscript');
        $this->load->view('components/header/headernavbar',$data);
        $this->load->view('components/mainmenu',$accessmenu);
        $this->load->view('Device/devices',$data);
         $this->load->view('components/footer/footerscript');
        $this->load->view('components/footer/footer');
       }

    }
    public function get_devicelist(){
        $devicelist = $this->device_model->devicelist();
        $count = 1;
        foreach ($devicelist as $list) {
             
            // $edit = echo "ggfhfghgf";
          $edit = '<a href="javascript:editdata('.$list->device_id.')" class="edit"  id="'.$list->device_id.'"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>';
          // echo $edit;exit;
          $delete = '<a href="javascript:deletedata('.$list->device_id.')" id="'.$list->device_id.'" class="delete"><i class="fa fa-trash " aria-hidden="true"></i></a>';
        if($list->device_categary=='1'){
            $deviceType = 'Normal';
        }
        elseif($list->device_categary == '4'){
            $deviceType = 'AS140';
        }
        elseif($list->device_categary == '2'){
            $deviceType = 'FUEL - '.$list->sensor_name;
        }
        else{
            $deviceType = "IBUTTON";
        }
          $data[] = array('S No' =>$count++ ,
  
                        'device_name' =>$list->device_name ,
                        'deviceimei' =>$list->deviceimei ,
                        'device_categary' =>$deviceType,     
                        'Action' =>$edit.' '.$delete);
        }
              
        $results = array(
          "sEcho" => 1,
        "iTotalRecords" => count($data),
        "iTotalDisplayRecords" => count($data),
          "aaData"=>$data);
        
        echo json_encode($results);
    }

    public function savedevice()
    {
        $device_id=$this->input->post('device_id');

        if ($device_id=='') 
        {
                     $data= $this->input->post();
                    //  $data['ccid'] = $this->input->post('ccid');
                    //  $data['start_date'] = $this->input->post('start_date');
                    //  $data['end_date'] = $this->input->post('end_date');
                     $data['dealer_id'] = $this->session->userdata('dealer_id');
                     $data['subdealer_id'] = $this->session->userdata('subdealer_id');
                     $data['userid']=$this->session->userdata('userid');
                     $data['createdon']=date('Y-m-d H:i:s');            
                     $data['createdby']=$this->session->userdata('userid');
                     $data['ipaddress'] = $this->input->ip_address();
              
                $savedevice= $this->device_model->savedevice($data,$device_id=null);

                echo json_encode($savedevice);

        }
        else
        {
                          $data=$this->input->post();
                          $data['updatedon']=date('Y-m-d H:i:s');
                         $data['updatedby']=$this->session->userdata('userid'); 
                          $data['ipaddress'] = $this->input->ip_address();  
                         $updatedevice= $this->device_model->savedevice($data,$device_id);
                       
                      echo  json_encode(2);

        }
        
    }



    public function editdevicedata()
    {
      $id=$this->input->post('thisid');
         $editdevicedata= $this->device_model->editdevicedata($id);


        echo json_encode($editdevicedata);
    }


public function deletedevice()
    {       
       

         $id=$this->input->post('thisid');    
         $this->db->where('device_id',$id);
        $query = $this->db->delete('devicetbl');
        
        if ($query) 
        {
            return TRUE;
        }
        else 
        {
            return FALSE;
        }
    }


 public function deviceassign() {
                

        $dealerdevicedetails = $this->device_model->dealer_device_data();

                $dealerlist= $this->device_model->dealerlist();
                $assigndevicelist= $this->device_model->assigndevicelist();
                $customercomplaint= $this->Dashboardmodel->customer_complaint();
          $data['customercomplaint'] = $customercomplaint;
                //print_r($assigndevicelist);exit;
        if($dealerdevicedetails)
        {
            $data['dealerdevicedetails']=$dealerdevicedetails;
            $data['assigndevicelist']=$assigndevicelist;
            $data['dealerlist']=$dealerlist;
            $this->load->view('components/header/headerscript');
            $this->load->view('components/header/headernavbar',$data);
            $this->load->view('components/mainmenu');
            $this->load->view('Device/assigndevice',$data);
            $this->load->view('components/footer/footerscript');
            $this->load->view('components/footer/footer');

        }else
        {   $data['assigndevicelist']=$assigndevicelist;
            $data['dealerlist']=$dealerlist;
            $this->session->set_flashdata('msg-sim','<span class="alert-msg msg-danger">No Data..!</span>');
            $this->load->view('components/header/headerscript');
            $this->load->view('components/header/headernavbar',$data);
            $this->load->view('components/mainmenu');
            $this->load->view('Device/assigndevice',$data);
            $this->load->view('components/footer/footerscript');
            $this->load->view('components/footer/footer');
        }
        }

         public function get_device_data(){
            $dealerdevicedetails = $this->device_model->dealer_device_data();
            $count = 1;
            foreach ($dealerdevicedetails as $list) {
                 
                // $edit = echo "ggfhfghgf";
              $edit = '<a href="javascript:editdata('.$list->device_id.')" class="edit"  id="'.$list->device_id.'"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>';
              // echo $edit;exit;
              $delete = '<a href="javascript:deletedata('.$list->device_id.')" id="'.$list->device_id.'" class="delete"><i class="fa fa-trash " aria-hidden="true"></i></a>';
      
              $data[] = array('S No' =>$count++ ,
      
                            'dealer_name' =>$list->dealer_company .'-'. $list->dealer_name ,
                            'device_name' =>$list->device_name ,
                            'deviceimei' =>$list->deviceimei,
                            'Action' =>$delete);
            }
                  
            $results = array(
              "sEcho" => 1,
            "iTotalRecords" => count($data),
            "iTotalDisplayRecords" => count($data),
              "aaData"=>$data);
            
            echo json_encode($results);
         }
 public function save_assigndevice()
            {   
                      
                      
                        $role = $this->session->userdata['roleid'];
                    
                       $device_id=$this->input->post('device_id');
                         if ($role=='1' || $role=='2') {
                            
                                        $data = array(
                            'dealer_id' => $this->input->post('dealer_id'),
                            'updatedon' => date('Y-m-d H:i:s'),
                            'updatedby' => $this->session->userdata('userid'),
                            'ipaddress' => $this->input->ip_address(),
                        );

                        }

                        if ($role=='3') {

                                        $data = array(
                            'subdealer_id' => $this->input->post('dealer_id'),
                            'updatedon' => date('Y-m-d H:i:s'),
                            'updatedby' => $this->session->userdata('userid'),
                            'ipaddress' => $this->input->ip_address(),
                        );

                        }

            $this->db->where('device_id', $device_id);
            $update = $this->db->update('devicetbl', $data);
                        echo json_encode($update);
               }


   public function deleteassigndevice()
   {
        $id=$this->input->post('thisid');

         $role = $this->session->userdata['roleid'];

         if ($role=='1' || $role=='2') {

             $data = array( 'dealer_id'=>'',    
                            'subdealer_id' =>'',
                            'updatedon' => date('Y-m-d H:i:s'),
                            'updatedby' => $this->session->userdata('userid'),
                            'ipaddress' => $this->input->ip_address());
                

            }   

            if ($role=='3') {

             $data = array(     'subdealer_id' =>'',
                            'updatedon' => date('Y-m-d H:i:s'),
                            'updatedby' => $this->session->userdata('userid'),
                            'ipaddress' => $this->input->ip_address());
            }
        
            $this->db->where('device_id', $id);
            $update = $this->db->update('devicetbl', $data);
                        echo json_encode($update);
   }
   public function imei_validate(){
    $imei = $this->input->post('imei');
    $result = $this->device_model->get_imei_number($imei);
    echo json_encode($result);
 }

}

