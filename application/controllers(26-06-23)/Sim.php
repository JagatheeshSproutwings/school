<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Sim extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if($this->session->userdata['userid'] == '')
		{
			$this->index1();
		}
		$this->load->model('sim_model');
		$this->load->model('Dashboardmodel');		
        $this->load->model('Smssend_model');
		
	}
	public function index1()
	{
		redirect('login/');
	}

	public function index()
	{
		$this->simdetails();		
	}

	public function simdetails()
	{	
		$accessmenu['access_menu'] = $this->Dashboardmodel->access_menu();
		$simdetails = $this->sim_model->all_sim_data();
                $customercomplaint= $this->Dashboardmodel->customer_complaint();
          $headerdata['customercomplaint'] = $customercomplaint;
		if($simdetails)
		{
			$data['simlist']=$simdetails;
			$this->load->view('components/header/headerscript');
			$this->load->view('components/header/headernavbar',$headerdata);
			$this->load->view('components/mainmenu',$accessmenu);
			$this->load->view('sim/sim',$data);
			 $this->load->view('components/footer/footerscript');
			$this->load->view('components/footer/footer');

		}else
		{	
			$this->session->set_flashdata('msg-sim','<span class="alert-msg msg-danger">No Data..!</span>');
			$this->load->view('components/header/headerscript');
			$this->load->view('components/header/headernavbar');
			$this->load->view('components/mainmenu',$accessmenu);
			$this->load->view('sim/sim');
			 $this->load->view('components/footer/footerscript');
			$this->load->view('components/footer/footer');
		}
	}
    public function get_simlist(){
		$simdetails = $this->sim_model->all_sim_data();
		$count = 1;
		foreach ($simdetails as $list) {
			 
			// $edit = echo "ggfhfghgf";
		  $edit = '<a href="javascript:editdata('.$list->simid.')" class="edit"  id="'.$list->simid.'"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>';
		  // echo $edit;exit;
		  $delete = '<a href="javascript:deletedata('.$list->simid.')" id="'.$list->simid.'" class="delete"><i class="fa fa-trash " aria-hidden="true"></i></a>';
  
		  $data[] = array('S No' =>$count++ ,
  
						'networkprovider' =>$list->networkprovider ,
						'imeinumber' =>$list->imeinumber ,
						'simnumber' =>$list->simnumber,
						'Action' =>$edit.' '.$delete);
		}
			  
		$results = array(
		  "sEcho" => 1,
		"iTotalRecords" => count($data),
		"iTotalDisplayRecords" => count($data),
		  "aaData"=>$data);
		
		echo json_encode($results);
	}
   public function savesim()
   {   
   	$simid = $this->input->post('simid');
   

   if ($simid=='') 
		   {
					 $data=$this->input->post();
				     $data['dealer_id'] = $this->session->userdata('dealer_id');
				     $data['subdealer_id'] = $this->session->userdata('subdealer_id');
				     $data['userid']=$this->session->userdata('userid');
				     $data['createdon']=date('Y-m-d H:i:s');            
				     $data['createdby']=$this->session->userdata('userid');
				     $data['ipaddress'] = $this->input->ip_address();
				     $lastid = $this->sim_model->savesim($data);
				     echo json_encode($lastid);

		   }
		   else
		   {
		   		         $data=$this->input->post();
                         $data['updatedon']=date('Y-m-d H:i:s');
                         $data['updatedby']=$this->session->userdata('userid'); 
                          $data['ipaddress'] = $this->input->ip_address();  
                         $update= $this->sim_model->savesim($data,$simid);                                         
                         echo json_encode(2);

		   }
   
   }

   public function editsim()
   {
        $id=$this->input->post('thisid');
        $editdata= $this->sim_model->editsimdata($id);
        echo json_encode($editdata);
   }

    
	public function deletesim()
    {       
        
         $id=$this->input->post('thisid');    
         $this->db->where('simid',$id);
        $query = $this->db->delete('simtbl');

        if ($query) 
        {
            return TRUE;
        }
        else 
        {
            return FALSE;
        }
    }



        public function simassign() {
                $accessmenu['access_menu'] = $this->Dashboardmodel->access_menu();
		$dealersimdetails = $this->sim_model->dealer_sim_data();

                $dealerlist= $this->sim_model->dealerlist_dd();
                $simlist= $this->sim_model->simlist_dd();
                $customercomplaint= $this->Dashboardmodel->customer_complaint();
          $headerdata['customercomplaint'] = $customercomplaint;
               //print_r($simlist);exit;
		if($dealersimdetails)
		{
			$data['dealersimdetails']=$dealersimdetails;
			$data['dealerlist']=$dealerlist;
			$data['simlist']=$simlist;
			$this->load->view('components/header/headerscript');
			$this->load->view('components/header/headernavbar',$headerdata);
			$this->load->view('components/mainmenu',$accessmenu);
			$this->load->view('sim/assignsim',$data);
			$this->load->view('components/footer/footerscript');
			$this->load->view('components/footer/footer');

		}else
		{	$data['dealerlist']=$dealerlist;
			$data['simlist']=$simlist;
			$this->session->set_flashdata('msg-sim','<span class="alert-msg msg-danger">No Data..!</span>');
			$this->load->view('components/header/headerscript');
			$this->load->view('components/header/headernavbar',$headerdata);
			$this->load->view('components/mainmenu',$accessmenu);
			$this->load->view('sim/assignsim',$data);
			 $this->load->view('components/footer/footerscript');
			$this->load->view('components/footer/footer');
		}
        }
        public function get_simdata(){
			$dealersimdetails = $this->sim_model->dealer_sim_data();
              
      $count = 1;
      foreach ($dealersimdetails as $list) {
           
          // $edit = echo "ggfhfghgf";
        $edit = '<a href="javascript:editdata('.$list->simid.')" class="edit"  id="'.$list->simid.'"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>';
        // echo $edit;exit;
        $delete = '<a href="javascript:deletedata('.$list->simid.')" id="'.$list->simid.'" class="delete"><i class="fa fa-trash " aria-hidden="true"></i></a>';

        $data[] = array('S No' =>$count++ ,

                      'dealer_name' =>$list->dealer_company .'-'. $list->dealer_name ,
                      'networkprovider' =>$list->networkprovider ,
                      'imeinumber' =>$list->imeinumber,
                      'simnumber' =>$list->simnumber,
                      'validfrom' =>$list->validfrom ,
                      'validto' =>$list->validto ,
                      'Action' =>$delete);
      }
            
      $results = array(
        "sEcho" => 1,
      "iTotalRecords" => count($data),
      "iTotalDisplayRecords" => count($data),
        "aaData"=>$data);
      
      echo json_encode($results);
		}
        public function save_assignsim()
            {   
				      
				  	$role = $this->session->userdata['roleid'];
                    
                        $simid=$this->input->post('simid');
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
                        
			$this->db->where('simid', $simid);
			$update = $this->db->update('simtbl', $data);
                        echo json_encode($update);
               }
//	editassignsim


      public function editassignsim()
   {
        $id=$this->input->post('thisid');
        $editassignsim= $this->sim_model->editassignsim($id);
        echo json_encode($editassignsim);
   }

   public function deleteassignsim()
    {       
        
         $id=$this->input->post('thisid'); 
         $role = $this->session->userdata['roleid'];

         if ($role=='1' || $role=='2') {

         	 $data = array(	'dealer_id'=>'',	
         	 	            'subdealer_id' =>'',
							'updatedon' => date('Y-m-d H:i:s'),
                            'updatedby' => $this->session->userdata('userid'),
                            'ipaddress' => $this->input->ip_address());
            	

            }   

            if ($role=='3') {

             $data = array(		'subdealer_id' =>'',
							'updatedon' => date('Y-m-d H:i:s'),
                            'updatedby' => $this->session->userdata('userid'),
                            'ipaddress' => $this->input->ip_address());
            }
        
         $this->db->where('simid', $id);
       	$update = $this->db->update('simtbl', $data);
                        echo json_encode($update);
    }

     public function imei_validate(){
        $imei = $this->input->post('imei');
		$result = $this->sim_model->get_imei_number($imei);
		echo json_encode($result);
	 }
	 public function sim_validate(){
        $sim = $this->input->post('sim');
		$result = $this->sim_model->get_sim_number($sim);
		echo json_encode($result);
	 }
}
