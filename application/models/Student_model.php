<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Student_model extends CI_Model
{	
	
	function __construct()
	{
		parent::__construct();
	}
	
	// student DETAILS
	public function student_details()
	{
	$client_id = $this->session->userdata ['client_id'];
		$query = $this->db->query("SELECT stu.*,s.client_name,c.class_name,sec.section_name,r.route_name,sl.Location_short_name as stop_name,CONCAT(firstname,'-' ,lastname) AS parent_name from sch_student stu inner join clienttbl s on s.client_id = stu.client_id  inner join sch_class c on c.class_id = stu.class_id inner join sch_section sec on sec.section_id = stu.section_id inner join usertbl p on p.userid=stu.parent_id inner join sch_routestbl r  on r.route_id=stu.route_id inner join sch_routestoptbl rs on rs.stop_id=stu.stop_id inner join sch_location_list sl ON sl.Location_Id=rs.stop_geo_id where stu.client_id='".$client_id."'");
	

		if($query->num_rows()>0)
		{
			return $query->result();
		}
		else
		{
			false;
		}
	}

	// EDIT DATA
	public function edit_student_data($student_id)
	{
		$client_id = $this->session->userdata ['client_id'];

		$query = $this->db->query("select * from sch_student where student_id = '".$student_id."' and client_id='".$client_id."' ");

		if($query->num_rows()>0)
		{
			return $query->row();
		}
		else
		{
			false;
		}
	}

	// SAVE student
	public function save_student_data($student_data,$student_id = null)
	{

			if($student_id==null)
			{
				$query = $this->db->insert('sch_student',$student_data);
				return 1;

			}
			else
			{
				    $this->db->where('student_id',$student_id);
					$query = $this->db->update('sch_student',$student_data);
					return 2;

			}
			
			
		
	}

	// public function last_id()
	// {
 //    	$query = $this->db->query("SELECT student_id from student order by student_id desc limit 1");
		
 //    	if($query)
 //    	{
	// 		return $last_id = $query->row();
 //    	}
 //    	else
 //    	{
 //    		return false;
 //    	}
	// }

	// public function check_user($data)
	// {
	// 	$query = $this->db->query('SELECT username,email FROM user WHERE username LIKE "'.$data.'%" OR email LIKE "'.$data.'%"');

	// 	if($query)
	// 	{
	// 		return $query->row();
	// 	}
	// 	else
	// 	{
	// 		return false;
	// 	}
	// }

	public function delete_studente_data($student_id)
	{
		$client_id = $this->session->userdata ['client_id'];
    	$query = $this->db->query("DELETE from sch_student where student_id =$student_id");
		
    	if($query)
    	{
			return '1';
    	}
    	else
    	{
    		return false;
    	}
	}

	public function section_list()
	{
		$client_id = $this->session->userdata ['client_id'];
		$query = $this->db->query("SELECT section_name,section_id from sch_section where client_id='".$client_id."' ");
		if($query)
		{
			return $query->result();
		}
		else
		{
			return false;
		}
	}

	public function class_list()
	{
		$client_id = $this->session->userdata ['client_id'];
		$query = $this->db->query("SELECT class_name,class_id from sch_class where client_id='".$client_id."' ");
		if($query)
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
		$client_id = $this->session->userdata ['client_id'];
		$query = $this->db->query("SELECT route_name,route_id from sch_routestbl where client_id='".$client_id."' ");

		if($query)
		{
			return $query->result();
		}
		else
		{
			return false;
		}
	}

	public function parent_list()
	{
		$client_id = $this->session->userdata ['client_id'];
		$query = $this->db->query("select * from usertbl where client_id=$client_id AND roleid=16");
		if($query)
		{return $query->result();}
		else
		{ return false;}
	}

	public function school_list()
	{
		$client_id = $this->session->userdata['client_id'];
		$query = $this->db->query("SELECT client_name,client_id from clienttbl where client_id='".$client_id."'");
		if($query)
                    { return $query->result(); }
		else
                    {return false;}
	}

	public function section_name($class_id)
	{
		$client_id = $this->session->userdata ['client_id'];
			$query = $this->db->query("SELECT section_id,section_name,class_id from sch_section where class_id='".$class_id."' and client_id='".$client_id."'");
		if($query)
		{
			return $query->result();
		}
		else
		{
			return false;
		}

	}
	public function stop_name($route_id)
	{
		$client_id = $this->session->userdata ['client_id'];
		$query = $this->db->query("SELECT  s.stop_id,l.Location_short_name as stop_name,l.Lat,l.Lng  from sch_routestoptbl s INNER JOIN sch_location_list l ON l.Location_Id =  s.stop_geo_id where s.route_id='".$route_id."'");
		if($query)
		{
			return $query->result();
		}
		else
		{
			return false;
		}

	}

	public function Stop_student($stop_id)
	{

$client_id = $this->session->userdata ['client_id'];
				$query = $this->db->query("SELECT stu.*,s.client_name,c.class_name,sec.section_name,r.route_name,rs.stop_name,CONCAT(parent_father_name,'-' ,parent_mother_name) AS parent_name from sch_student stu inner join clienttbl s on s.client_id = stu.client_id  inner join sch_class c on c.class_id = stu.class_id inner join sch_section sec on sec.section_id = stu.section_id inner join sch_parent p on p.parent_id=stu.parent_id inner join routestbl r  on r.route_id=stu.route_id inner join sch_route_stops rs on rs.stop_id=stu.stop_id where stu.stop_id = '".$stop_id."' and stu.client_id='".$client_id."'");
					


			if($query)
		{
			return $query->result();
		}
		else
		{
			return false;
		}

    }

    public function parent_details()
	{
		

				$client_id = $this->session->userdata ['client_id'];
				$parent_id = $this->session->userdata ['parent_id'];
				$query = $this->db->query("SELECT stu.*,s.client_name,c.class_name,sec.section_name,r.route_name,rs.stop_name,CONCAT(parent_father_name,'-' ,parent_mother_name) AS parent_name from sch_student stu inner join clienttbl s on s.client_id = stu.client_id  inner join sch_class c on c.class_id = stu.class_id inner join sch_section sec on sec.section_id = stu.section_id inner join sch_parent p on p.parent_id=stu.parent_id inner join routestbl r  on r.route_id=stu.route_id inner join sch_route_stops rs on rs.stop_id=stu.stop_id where stu.client_id='".$client_id."' and p.parent_id='".$parent_id."'");
				echo "";
			

		

		if($query->num_rows()>0)
		{
			return $query->result();
		}
		else
		{
			false;
		}
	}
}
