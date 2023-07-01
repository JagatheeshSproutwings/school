<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Routestop_model extends CI_Model
{	
	
	function __construct()
	{
		parent::__construct();
	}
	
	// SCHOOL DETAILS
	public function stop_details($route_id)
	{
		$client_id = $this->session->userdata ['client_id'];

		$query = $this->db->query("select * from sch_routestoptbl where route_id='".$route_id."' AND client_id='".$client_id."' ORDER BY STR_TO_DATE(stop_arrival_time, '%l:%i %p') ASC");

		if($query->num_rows()>0)
		{
			return $query->result();
		}
		else
		{
			false;
		}
	}

	public function saveroutestops($data,$stop_id)
	{
		if($stop_id == '')
		{
			$query = $this->db->insert('sch_routestoptbl',$data);
		}
		else
		{
			$this->db->where('stop_id',$stop_id);
			$query = $this->db->update('sch_routestoptbl',$data);
		}
	}

		public function editroutestopdata($stop_id)
	{
		$client_id = $this->session->userdata ['client_id'];

		$query = $this->db->query("select rs.*,gl.Location_short_name as location_name from sch_routestoptbl rs INNER JOIN sch_location_list gl ON gl.Location_Id=rs.stop_geo_id where rs.stop_id='".$stop_id."' AND rs.client_id='".$client_id."'");

		if($query->num_rows()>0)
		{
			return $query->row();
		}
		else
		{
			false;
		}
	}



	public function all_location_data($route_id) 
	{		
		$client_id = $this->session->userdata['client_id'];	
		$user_id = $this->session->userdata['userid'];
		$query_geo = $this->db->query("select * from sch_routestbl where route_id='".$route_id."' AND client_id='".$client_id."'");

		$gro_f = $query_geo->row();

		$query = $this->db->query("SELECT * FROM sch_location_list ll WHERE  ll.Location_Id!='".$gro_f->route_geo_start_id."' AND ll.Location_Id!='".$gro_f->route_geo_end_id."' AND ll.CreatedBy=".$user_id." AND NOT EXISTS (SELECT * FROM sch_routestoptbl rs WHERE rs.client_id='".$client_id."' AND rs.route_id='".$route_id."' AND rs.stop_geo_id=ll.Location_Id )");

		
		if ($query->num_rows() > 0) 
		{
			return $query->result();
		}
		else 
		{
			return false;
		}
	}

	public function all_location_edit_data($route_id,$edit_id) 
	{		
		$client_id = $this->session->userdata['client_id'];	

		$query_geo = $this->db->query("select * from routes where route_id='".$route_id."' AND client_id='".$client_id."'");

		$gro_f = $query_geo->row();

		$query = $this->db->query("SELECT * FROM location_list ll WHERE ll.client_id='".$client_id."' AND ll.Location_Id!='".$gro_f->route_geo_start_id."' AND ll.Location_Id!='".$gro_f->route_geo_end_id."' AND NOT EXISTS (SELECT * FROM route_stops rs WHERE rs.client_id='".$client_id."' AND rs.route_id='".$route_id."' AND rs.stop_id!='".$edit_id."' AND rs.stop_geo_id=ll.Location_Id )");
		
		if ($query->num_rows() > 0) 
		{
			return $query->result();
		}
		else 
		{
			return false;
		}
	}

	public function routes()
	{
		$client_id = $this->session->userdata ['client_id'];
		$query = $this->db->query("select route_id,route_name from routes where client_id='".$client_id."'");

		if($query)
		{
			return $query->result();
		}
		else
		{
			return false;
		}
	}

	
	// EDIT DATA
	public function edit_route_data($route_id,$stop_id)
	{
		$query = $this->db->query("select * from route_stops where route_id='".$route_id."' AND stop_id = '".$stop_id."' ");

		if($query->num_rows()>0)
		{
			return $query->row();
		}
		else
		{
			return false;
		}
	}

	
}
