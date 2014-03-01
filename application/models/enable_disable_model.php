<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
	Author: Billy Joel Arlo T. Zarate
	File Description : A model used to handle database transactions for activating,enabling and disabling users
*/
class Enable_disable_model extends CI_Model {

	public function generateQuery($field)
	{
		/*
			creates query according to the search parameters submitted by the user
		*/
		$sql = "SELECT * FROM user"; //string for query

		Switch($field['field'])
		{
			Case "name" : {
				if($field['fname'] != '' || $field['mname'] != '' || $field['lname'] != '')
					$sql = $sql." WHERE ";
				
				if($field['fname'] != '')
					$sql = $sql."name_first LIKE '".$field['fname']."'";

				if($field['fname'] != '' && $field['mname'] != '')
					$sql = $sql." OR ";
				
				if($field['mname'] != '')
					$sql = $sql."name_middle LIKE '".$field['mname']."'";
				
				if(($field['mname'] != '' && $field['lname'] != '') || ($field['fname'] != '' && $field['lname'] != ''))
					$sql = $sql." OR ";
				
				if($field['lname'] != '')
					$sql = $sql."name_last LIKE '".$field['lname']."'";
				break;
			}
			Case "stdno" : {
				if($field['student_no'] != '')
					$sql = $sql." WHERE student_no LIKE '".$field['student_no']."'";
				break;
			}
			Case "empno" : {
				if($field['employee_no'] != '')
					$sql = $sql." WHERE emp_no LIKE '".$field['employee_no']."'";
				break;
			}
			Case "uname" : {
				if($field['username'] != '')
					$sql = $sql." WHERE username LIKE '".$field['username']."'";
				break;
			}
			Case "email" : {
				if($field['email'] != '')
					$sql = $sql." WHERE email LIKE '".$field['email']."'";
				break;
			}
		}		

		if($field['status'] != "all")
		{
			if($sql != "SELECT * FROM user")
				$sql = $sql." AND status LIKE '".$field['status']."'";
			else
				$sql = $sql." WHERE status LIKE '".$field['status']."'";
		}

		$sql = $sql." ORDER BY usertype,sex";

		return $sql;
	}

	public function runQuery($sql)
	{
		/*
			runs the query passed as a parameter
		*/
		$array = $this->db->query($sql);

		if ($array->num_rows() > 0)
		{
			foreach($array->result() as $row)
			{
				$data[] = $row;//for integrating with ajax code
			}

			return $data;
		}
	}

	public function activate($username, $usertype, $number, $email)
	{
		/*
			this function validates and activates accounts
		*/

		if($usertype == "student")
		{
			$sql = "SELECT * FROM our WHERE student_no LIKE '".$number."'";

			$array = $this->db->query($sql);//checks the our data for a student

			if ($array->num_rows() > 0)//checks if search returned with any results
			{
				$update = "UPDATE user SET status = 'enabled' WHERE username LIKE '".$username."' AND email LIKE '".$email."'";
				$success = $this->db->query($update);//checks if the update has been implemented
			}
			else//if no student has been found, delete
			{
				$this->delete($username, $email);
				$success = false;
			}
		}
		else
		{
			$sql = "SELECT * FROM employee WHERE employee_no LIKE '".$number."'";

			$array = $this->db->query($sql);//checks the employee for a match

			if ($array->num_rows() > 0)//checks if search returned with any results
			{
				$update = "UPDATE user SET status = 'enabled' WHERE username LIKE '".$username."' AND email LIKE '".$email."'";
				$success = $this->db->query($update);//checks if the update has been implemented
			}
			else//if no employee has been found, delete
			{
				$this->delete($username, $email);
				$success = false;
			}
		}
		return $success;
	}

	public function enable($username, $email)
	{
		/*
			this function enables accounts
		*/
		$update = "UPDATE user SET status = 'enabled' WHERE username LIKE '".$username."' AND email LIKE '".$email."'";
		
		$success = $this->db->query($update);//checks if the update has been implemented

		return $success;
	}

	public function disable($username, $email)
	{
		/*
			this function disables accounts
		*/
		$update = "UPDATE user SET status = 'disabled' WHERE username LIKE '".$username."' AND email LIKE '".$email."'";
		
		$success = $this->db->query($update);//checks if the update has been implemented

		return $success;
	}

	public function delete($username, $email)
	{
		/*
			this function deletes accounts
		*/
		$delete = "DELETE FROM user WHERE username LIKE '".$username."' AND email LIKE '".$email."'";
		
		$success = $this->db->query($delete);//checks if the update has been implemented

		return $success;
	}

	public function log($admin, $username, $email, $action)
	{
		/*
			logs the changes made into the database
		*/
		$insert = "INSERT INTO account_history(username_user, username_admin, email, action) VALUES ('".$username."','".$admin."','".$email."','".$action."')";
		
		$success = $this->db->query($insert);//checks if the insert has been implemented

		return $success;
	}

	/* start edit by Carl Adrian P. Castueras */

	public function get_log($page,$page_size)
	{
		//fetch the account history where the latest updates appear first
		$start_row = ($page-1) * $page_size;
		//get results only from the given bounds [$start_row,$start_row + $page_size]
		return $this->db->query("SELECT * FROM account_history ORDER BY date DESC LIMIT {$start_row}, {$page_size}")->result();

	}

	public function count_log()
	{
		//use row() since this query is only expected to return 1 row and not a whole array
		return $this->db->query("SELECT COUNT(*) AS LOG_COUNT FROM account_history")->row();
	}

	/* end edit */
}


/* End of file enable_disable_model.php */
/* Location: ./application/models/enable_disable_model.php */