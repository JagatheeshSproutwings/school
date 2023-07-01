<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function index()
	{

		$this->load->view('login');
	}


	public function sendMail() {


		$mail_config['smtp_host'] = 'smtp.gmail.com';
		$mail_config['smtp_port'] = '587';
		$mail_config['smtp_user'] = 'sproutwings123@gmail.com';
		$mail_config['_smtp_auth'] = TRUE;
		$mail_config['smtp_pass'] = 'qspmooojklzhwrbe';
		$mail_config['smtp_crypto'] = 'tls';
		$mail_config['protocol'] = 'smtp';
		$mail_config['mailtype'] = 'text';
		$mail_config['send_multipart'] = FALSE;
		$mail_config['charset'] = 'utf-8';
		$mail_config['wordwrap'] = TRUE;
		$this->email->initialize($mail_config);
		$this->email->set_newline("\r\n");

		$this->email->from('sproutwings123@gmail.com', 'Sproutwings');
		$this->email->to('chitraprakash346@gmail.com'); 
		$this->email->cc('prakash.p@sproutwings.in,nelson.a@sproutwings.in');
		   $message = "Hii This is For sample";

	   //  $this->email->to('karthik@sproutwings.in'); 
	 // $this->email->cc('prabhakaran.p@sproutwings.in');
		$this->email->subject('Smart Report');
	    $this->email->message($message);  

		//Send mail
		if($this->email->send())
		   echo "mail sent";
		else
		  show_error($this->email->print_debugger());
		  exit;
		  
		$emailid = "chitraprakash346@gmail.com";
		$message ="This is sample Email";

        try {
            $config = Array(
                'protocol' => 'smtp',
                // 'smtp_host' => 'smtpout.secureserver.net',
                'smtp_host' => 'ssl://smtp.gmail.com',
                //  'smtp_port' => 25,
                'smtp_port' => '587',
                'SMTPDebug' => 1,
//                'smtp_user' => 'info@srim.co.in', // change it to yours
                'smtp_user' => 'nelson.a@knowillence.com', // change it to yours
//                'smtp_pass' => 'M@pple!123', // change it to yours
                'smtp_pass' => 'Albert@528', // change it to yours
                'mailtype' => 'html',
                'charset' => 'iso-8859-1',
                'wordwrap' => TRUE
            );

            $this->load->library('email', $config);
            $this->email->set_newline("\r\n");
//            $this->email->from('info@srim.co.in'); // change it to yours
            $this->email->from('nelson.a@knowillence.com'); // change it to yours
            $this->email->to($emailid); // change it to yours
            $this->email->subject('Task mail');
            $this->email->message($message);
            if ($this->email->send()) {
                //echo 'Email sent.'; die;
            } else {
                show_error($this->email->print_debugger());
            }
        } catch (Exception $e) {
            
        }
    }


}
?>
