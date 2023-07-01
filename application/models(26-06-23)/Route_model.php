<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Route_model extends CI_Model
{	
	
	function __construct()
	{
		parent::__construct();
	}
	
	// SCHOOL DETAILS
	public function route_details()
	{


		$client_id = $this->session->userdata ['client_id'];
		$role_id = $this->session->userdata['roleid'];
		$user_id = $this->session->userdata['userid'];
		$query = $this->db->query("select * from sch_routestbl where client_id=".$client_id." AND createdby = '".$user_id."'");

	if($query->num_rows()>0)
		{
			return $query->result();
		}
		else
		{
			return false;
		}

}


	public function saveroute($data,$route_id)
	{
		if($route_id == '')
		{
			$query = $this->db->insert('sch_routestbl',$data);
		}
		else
		{
			$this->db->where('route_id',$route_id);
			$query = $this->db->update('sch_routestbl',$data);
		}
	}

	// EDIT DATA
	public function editroutedata($route_id)
	{
		$query = $this->db->query("select * from sch_routestbl where route_id = '".$route_id."' ");

		if($query->num_rows()>0)
		{
			return $query->row();
		}
		else
		{
			return false;
		}
	}


public function vehicle_list() 
	{		
		
		$client_id = $this->session->userdata('client_id');
      	  $user_id = $this->session->userdata('userid');
      	 $role = $this->session->userdata('roleid');
//          	 	  $query = $this->db->query("SELECT vehicleid,vehiclename FROM  assign_owner ao INNER JOIN vehicletbl v ON v.vehicleid = ao.vehicle_id WHERE ao.owner_id='".$user_id."' AND v.client_id='".$client_id."' ");
      	 	// $query = $this->db->query("SELECT v.vehicleid,v.vehiclename,v.deviceimei from vehicletbl v WHERE NOT EXISTS (SELECT vehicle_id FROM sch_routeassigntbl rs WHERE rs.vehicle_id =v.vehicleid) and v.client_id='".$client_id."'");
			$query = $this->db->query("SELECT v.vehicleid,v.vehiclename,v.deviceimei from vehicletbl v WHERE v.client_id='".$client_id."'");
       
		if ($query->num_rows() > 0) 
		{
			return $query->result();
		}
		else 
		{
			return false;
		}
	} 

	public function route_list() 
	{		
		
		$client_id = $this->session->userdata['client_id'];	
		$user_id = $this->session->userdata['userid'];	
//		if($client_id == '7' || $client_id == '198')
//		{
//
//         $query = $this->db->query("SELECT * FROM polygon_routelist  WHERE client_id='".$client_id."'");
//		}
//		else
//		{
			$query = $this->db->query("SELECT * FROM sch_routestbl  WHERE client_id='".$client_id."' AND createdby='".$user_id."'");
//		}

		
		
		if ($query->num_rows() > 0) 
		{
			return $query->result();
		}
		else 
		{
			return false;
		}
	}

	public function route_assigndetails()
	{
		$client_id = $this->session->userdata ['client_id'];
		$role_id = $this->session->userdata['roleid'];
		$user_id = $this->session->userdata['userid'];

		

//		if ($role_id =='6') {
//			$query = $this->db->query("select ra.*,r.route_name,v.deviceimei,v.vehiclename from sch_routeassigntbl ra LEFT JOIN sch_routestbl r on r.route_id=ra.route_id LEFT JOIN vehicletbl v on v.vehicleid=ra.vehicle_id INNER JOIN assign_owner ao ON ao.vehicle_id = v.vehicleid WHERE ra.createdby='".$user_id."' ORDER BY ra.travel_startdate ASC");
//		}
//		else
//		{
			
			$query = $this->db->query("select ra.*,r.route_name,v.vehiclename 
                        from sch_routeassigntbl ra 
                        LEFT JOIN sch_routestbl r on r.route_id=ra.route_id 
                        LEFT JOIN vehicletbl v on v.vehicleid=ra.vehicle_id 
                        where ra.client_id=$client_id AND ra.createdby =$user_id ORDER BY ra.travel_startdate ASC");

//		}


		if ($query) 
		{
			if($query->num_rows()>0)
		{
			return $query->result();
		}
		else
		{
			return false;
		}
		}
		else
		{
			return false;
		}
		
	}

	public function polyroute_assigndetails()
	{
		$client_id = $this->session->userdata ['client_id'];
		$role_id = $this->session->userdata['roleid'];
		$user_id = $this->session->userdata['userid'];

		$query = $this->db->query("select ra.*,r.route_name,v.vehiclename 
                        from sch_routeassigntbl ra 
                        LEFT JOIN sch_routestbl r on r.route_id=ra.route_id 
                        LEFT JOIN vehicletbl v on v.vehicleid=ra.vehicle_id 
                        where ra.client_id=$client_id AND ra.createdby =$user_id ORDER BY ra.travel_startdate ASC");
//		$query = $this->db->query("select ra.*,r.route_name,v.vehiclename from sch_routeassigntbl ra LEFT JOIN polygon_routelist r on r.route_id=ra.route_id LEFT JOIN vehicletbl v on v.vehicleid=ra.vehicle_id where ra.client_id=".$client_id." ORDER BY ra.travel_startdate ASC");
		
		if ($query) 
		{
			if($query->num_rows()>0)
		{
			return $query->result();
		}
		else
		{
			return false;
		}
		}
		else
		{
			return false;
		}
		
	}



	public function saverouteassign($data,$id)
	{
		if($id == '')
		{
			$query = $this->db->insert('sch_routeassigntbl',$data);
		}
		else
		{
			$this->db->where('id',$id);
			$query = $this->db->update('sch_routeassigntbl',$data);
		}
	}


	public function editrouteassigndata($id)
	{
		$query = $this->db->query("select ra.*,r.route_name,v.vehiclename,v.vehicleid from sch_routeassigntbl ra LEFT JOIN sch_routestbl r on r.route_id=ra.route_id LEFT JOIN vehicletbl v on v.vehicleid=ra.vehicle_id where ra.id = '".$id."' ");

		if($query->num_rows()>0)
		{
			return $query->row();
		}
		else
		{
			return false;
		}
	}
	public function all_location_data() 
	{		
		$user_id = $this->session->userdata['userid'];
		$client_id = $this->session->userdata['client_id'];	
		
		$query = $this->db->query("SELECT * FROM sch_location_list WHERE CreatedBy=".$user_id."");
		
		
		if ($query->num_rows() > 0) 
		{
			return $query->result();
		}
		else 
		{
			return false;
		}
	}


	

public function route_latlng($route_id) 
{		
	$query = $this->db->query("SELECT l.Location_short_name as startroute_name,l.Lat as routestartlat,l.Lng as routestartlng,
	l.radius as sradius,l2.radius as eradius,r.route_id,
	l2.Location_short_name as endroute_name,l2.Lat as routeendtlat,l2.Lng as routeendtlng FROM sch_routestbl r 
	INNER JOIN sch_location_list l ON l.Location_Id = r.route_geo_start_id 
	INNER JOIN sch_location_list l2 ON l2.Location_Id = r.route_geo_end_id WHERE r.route_id=$route_id");

	
	if ($query->num_rows() > 0) 
	{
		return $query->row();
	}
	else 
	{
		return false;
	}
}

public function stop_latlng($route_id) 
{		
	$query = $this->db->query("SELECT l.Location_short_name as stop_name,l.Lat as stoplat,l.Lng as stoplng,l.radius as stopradius,
	ss.stop_geo_id,ss.stop_id
	 FROM sch_routestoptbl ss INNER JOIN sch_location_list l ON l.Location_Id = ss.stop_geo_id 
	 WHERE ss.route_id=$route_id");
	
	if ($query->num_rows() > 0) 
	{
		return $query->result();
	}
	else 
	{
		return false;
	}
}

public function student_stop_count($route_id,$stop_id) 
{	
	
	$query = $this->db->query("SELECT count(*) as student_count FROM sch_student WHERE route_id=$route_id AND stop_id = $stop_id");
	if ($query->num_rows() > 0) 
	{
		$data =  $query->row();
		return $data->student_count;
	}
	else 
	{
		return false;
	}
}
public function student_stop_data($route_id,$stop_id) 
{	
	
	$query = $this->db->query("SELECT ut.mobilenumber,ut.alter_mobile,stu.student_name,sr.route_name,sll.Location_short_name,sll.Lat,sll.Lng,sll.area,stu.student_rollno,sc.class_name,srt.stop_arrival_time,ss.section_name,CONCAT(firstname,'-' ,lastname) AS parent_name 
	FROM sch_student stu 
	INNER JOIN sch_class sc ON sc.class_id = stu.class_id 
	INNER JOIN sch_section ss ON ss.section_id = stu.section_id 
	INNER JOIN usertbl ut ON  ut.userid = stu.parent_id
	INNER JOIN sch_routestbl sr ON sr.route_id = stu.route_id
	INNER JOIN sch_routestoptbl srt ON srt.stop_id=stu.stop_id  
	INNER JOIN sch_location_list sll ON sll.Location_Id=srt.stop_geo_id
	WHERE 
	stu.route_id=$route_id AND stu.stop_id=$stop_id");

	if ($query->num_rows() > 0) 
	{
		return $query->result();
	}
	else 
	{
		return false;
	}
}

public function stop_students($route_id,$stop_id) 
{		
	$query = $this->db->query("SELECT stu.*,stu.student_name,stu.student_rollno,sc.class_name,ss.section_name
	FROM sch_student stu 
	INNER JOIN sch_class sc ON sc.class_id = stu.class_id 
	INNER JOIN sch_section ss ON ss.section_id = stu.section_id WHERE 
	stu.route_id=$route_id AND stu.stop_id=$stop_id");
	
	if ($query->num_rows() > 0) 
	{
		return $query->result();
	}
	else 
	{
		return false;
	}
}

public function stopdetails_excel($id)
{
	// echo("SELECT CONCAT(firstname,'-' ,lastname) AS parent_name,stu.stop_id,sll.Location_short_name,sll.Lat,sll.Lng,sr.route_name,sc.class_name,stu.* FROM sch_student stu 
	// INNER JOIN sch_routestbl sr ON sr.route_id = stu.route_id
	// INNER JOIN sch_routestoptbl srt ON srt.stop_id=stu.stop_id  
	// INNER JOIN sch_location_list sll ON sll.Location_Id=srt.stop_geo_id
	// INNER JOIN usertbl ut ON  ut.userid = stu.parent_id
	// INNER JOIN sch_class sc ON sc.class_id=stu.class_id
	// Where stu.route_id=$id ORDER BY srt.stop_arrival_time ASC");die;
	$query = $this->db->query("SELECT CONCAT(firstname,'-' ,lastname) AS parent_name,stu.stop_id,sll.Location_short_name,sll.Lat,sll.Lng,sr.route_name,srt.stop_arrival_time,sc.class_name,stu.*
	FROM sch_student stu 
	INNER JOIN sch_routestbl sr ON sr.route_id = stu.route_id
	INNER JOIN sch_routestoptbl srt ON srt.stop_id=stu.stop_id  
	INNER JOIN sch_location_list sll ON sll.Location_Id=srt.stop_geo_id
	INNER JOIN usertbl ut ON  ut.userid = stu.parent_id
	INNER JOIN sch_class sc ON sc.class_id=stu.class_id
	Where stu.route_id='$id' ORDER BY srt.stop_arrival_time ASC,stu.stop_id ASC");

	if ($query->num_rows() > 0) 
	{
		return $query->result();
	}
	else 
	{
		return false;
	}
}

}
