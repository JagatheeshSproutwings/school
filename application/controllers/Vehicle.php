
<?php
error_reporting(0);
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Vehicle extends MY_Controller
{
  public function __construct()

  {
    parent::__construct();
    if($this->session->userdata['userid'] == '')
    {
      $this->index1();
    }
    $this->load->model('Vehicle_model');
    $this->load->model('Smssend_model');
     $this->load->model('Dashboardmodel');
     date_default_timezone_set("Asia/Kolkata"); 
  }

  public function index1()
  {
    redirect('login/');
  }

  public function index()
  {
    $this->vehicledetails();   
    
  }

  public function vehicledetails()
  { 
 
      $customercomplaint= $this->Dashboardmodel->customer_complaint();
      $data['webnotification'] = $this->Smssend_model->webnotification();
      $data['customercomplaint'] = $customercomplaint;
     $vehicletype = $this->Vehicle_model->vehicletype();
     $vehicledetails = $this->Vehicle_model->all_vehicle_data();
     $client_name = $this->Vehicle_model->client_name();
     $deviceimei = $this->Vehicle_model->deviceimei();
      $simnumber = $this->Vehicle_model->simnumber(); 
      // print_r($this->db->last_query());die;
  //  $simnumber = '';
     $device_types = $this->Vehicle_model->device_types();
    // print_r($vehicledetails);exit;
    if($vehicledetails)
    {
       $data['vehiclelist']=$vehicledetails;
       $data['vehicletype']=$vehicletype;
       $data['client_name']=$client_name;
       $data['deviceimei']=$deviceimei;
       $data['simnumber']=$simnumber;
        $data['device_types']=$device_types;
        $data['access_menu'] = $this->Dashboardmodel->access_menu();
        
      $this->load->view('components/header/headerscript');
      $this->load->view('components/header/headernavbar',$data);
      $this->load->view('components/mainmenu',$data);
      $this->load->view('vehicle/vehicle',$data);
       $this->load->view('components/footer/footerscript');
       $this->load->view('components/footer/footer');
    //    print_r($data);
    // exit;

     
    }else
    { $data['vehicletype']=$vehicletype;
     $data['client_name']=$client_name;
     $data['deviceimei']=$deviceimei;
      $data['simnumber']=$simnumber;
       $data['device_types']=$device_types;
       $data['access_menu'] = $this->Dashboardmodel->access_menu();
//       $headerdata['webnotification'] = $this->Smssend_model->webnotification();
      $this->session->set_flashdata('msg-vehicle','<span class="alert-msg msg-danger">No Data..!</span>');
      $this->load->view('components/header/headerscript');
      $this->load->view('components/header/headernavbar',$data);
      $this->load->view('components/mainmenu',$data);
      $this->load->view('vehicle/vehicle',$data);
       $this->load->view('components/footer/footerscript');
       $this->load->view('components/footer/footer');
    }
  }
   public function get_vehicle_data(){
    
    $vehicledetails = $this->Vehicle_model->all_vehicle_data();
    $role =$this->session->userdata['roleid'];
    $count = 1;
    foreach ($vehicledetails as $list) {
          $edit = '<a href="javascript:editdata('.$list->vehicleid.')" class="edit"  id="'.$list->vehicleid.'"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>';
          if($role == 14 || $role == 17){
            $delete = '<a href="javascript:deletedata('.$list->vehicleid.')" id="'.$list->vehicleid.'" class="delete"><i class="fa fa-trash " aria-hidden="true"></i></a>';
          }
          $device_query = $this->db->query("SELECT device_model FROM devicetbl WHERE deviceimei = '".$list->deviceimei."'");
          $device_data = $device_query->row();
          $sim_query = $this->db->query("SELECT networkprovider FROM simtbl WHERE simnumber = '".$list->simnumber."'");
          $sim_data = $sim_query->row();

          if($list->device_type==2){
            $status = 'Fuel';
            if($list->fuel_model==1){
              $status = 'Ultasonic';
            }
            elseif($list->fuel_model==2){
              $status = 'Jointech';
            }
            elseif($list->fuel_model==3){
              $status = 'Italon';
            }
            elseif($list->fuel_model==4){
              $status = 'Escort-Fuel';
            }
            else{
              $status = 'Normal';
            }
          }
          elseif($list->device_type==3){
            $status = 'Normal + iButton';
          }
          elseif($list->device_type==4){
            $status = 'Fuel + iButton';
            if($list->fuel_model==1){
              $status = 'Ultasonic';
            }
            elseif($list->fuel_model==2){
              $status = 'Jointech';
            }
            elseif($list->fuel_model==3){
              $status = 'Italon';
            }
            elseif($list->fuel_model==4){
              $status = 'Escort-Fuel';
            }
            else{
              $status = 'Normal';
            }
          }
          elseif($list->device_type==5){
            $status = 'Normal + MDVR';
          }
          elseif($list->device_type==6){
            $status = 'Fuel + MDVR';
            if($list->fuel_model==1){
              $status = 'Ultasonic';
            }
            elseif($list->fuel_model==2){
              $status = 'Jointech';
            }
            elseif($list->fuel_model==3){
              $status = 'Italon';
            }
            elseif($list->fuel_model==4){
              $status = 'Escort-Fuel';
            }
            else{
              $status = 'Normal';
            }
          }
          elseif($list->device_type==7){
            $status = 'Fuel + iButton + MDVR';
            if($list->fuel_model==1){
              $status = 'Ultasonic';
            }
            elseif($list->fuel_model==2){
              $status = 'Jointech';
            }
            elseif($list->fuel_model==3){
              $status = 'Italon';
            }
            elseif($list->fuel_model==4){
              $status = 'Escort-Fuel';
            }
            else{
              $status = 'Normal';
            }
          }
          elseif($list->device_type==14){
            $status = 'Fuel + Escort_BLE';
          }
          else{
            $status = 'Normal';
          }
          $data[] = array('S No' =>$count++ ,
                        'client_name' =>$list->client_name ,
                        'mobile' =>$list->mobile ,
                        'vehiclename' =>$list->vehiclename,
                        'vtype' =>$list->vtype,
                        'deviceimei' =>$list->deviceimei ,
                        'device_model' =>$device_data->device_model ,
                        'simnumber' =>$list->simnumber ,
                        'networkprovider' =>$sim_data->networkprovider,
                        'installationdate' =>$list->installationdate,
                        'expiredate' =>$list->expiredate,
                        'status' =>$status,
                        'Action' =>$edit.' '.$delete);
    }      
    $results = array(
      "sEcho" => 1,
    "iTotalRecords" => count($data),
    "iTotalDisplayRecords" => count($data),
      "aaData"=>$data);
    
    echo json_encode($results);
   }
   public function addvehicle()
   {   
      $data=$this->input->post();
      $data['installationdate'] = date('Y-m-d');
      $data['expiredate'] = date("Y-m-d", strtotime("+1 year"));
      unset($data['vehiclename1']);
      $data['userid']=$this->session->userdata('userid');
      $data['dealer_id']=$this->session->userdata('dealer_id');
      // $data['subdealer_id']=$this->session->userdata('subdealer_id'); 
      $data['createdon']=date('Y-m-d H:i:s');            
      $data['createdby']=$this->session->userdata('userid');
      $data['ipaddress'] = $this->input->ip_address();
      $lastid = $this->Vehicle_model->addvehicle($data);
      echo json_encode($lastid);
   }

   public function editvehicle()
   {
        $id=$this->input->post('thisid');
        $editdata= $this->Vehicle_model->editvehicledata($id);
        echo json_encode($editdata);
   }

    public function updatevehicle()
    {
                         $data=$this->input->post();
                         if($data['vehiclename']==$data['vehiclename1'])
                         {
                           $data['updatedon']=date('Y-m-d H:i:s');
                           $data['updatedby']=$this->session->userdata('userid');
                          $data['ipaddress'] = $this->input->ip_address();   
                          unset($data['vehiclename1']);
                          unset($data['createdon']);
                          
                         }
                         else{
                             
                           $data1 = array('deviceimei' =>$data['deviceimei'] ,
                                          'vehiclename' =>$data['vehiclename1'] , 
                                          'client_id' =>$this->session->userdata('client_id') ,
                                          'work_startdate' =>$data['createdon'] ,
                                          'work_enddate' =>date('Y-m-d H:i:s'),
                                          'createdon' =>date('Y-m-d H:i:s'),
                                          'createdby' =>$this->session->userdata('userid'));
                                    

                        $vehicle_exlist =  $this->db->insert('vehicle_expirelist',$data1);  

                        unset($data['vehiclename1']);
                        unset($data['createdon']);
                         
                        $data['createdon'] = date('Y-m-d H:i:s');
                        $data['updatedon']=date('Y-m-d H:i:s');
                        $data['updatedby']=$this->session->userdata('userid');
                       $data['ipaddress'] = $this->input->ip_address();  
                         }

                       $update= $this->Vehicle_model->updatevehicle($data,$data['vehicleid']); 
                                                               
                    echo json_encode($update);
 
    }

   public function deletevehicle()
    {       
        $id=$this->input->post('thisid');    
        // $userdata = array('status' =>'0');
        $this -> db -> where('vehicleid',$id);
        $tables = array('vehicletbl', 'vehicletbl_2');
        $query = $this -> db -> delete($tables);
        // $query = $this -> db -> delete('vehicletbl_2');

        if ($query) 
        {
            return TRUE;
        }
        else 
        {
            return FALSE;
        }
    }
     public function deviceimeidata()
   {
        $id=$this->input->post('device_id');
        $deviceimeidata= $this->Vehicle_model->deviceimeidata($id);
        echo json_encode($deviceimeidata);
   }




  
}
 