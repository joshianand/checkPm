<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Welcome extends CI_Controller {

    public function index() {
        $this->load->view('welcome_message');
    }

    public function Sendemail() {
        $protocol = $this->input->post('protocol', TRUE);
        $smtpserver = $this->input->post('smtpserver', TRUE);
        $smtpuser = $this->input->post('smtpuser', TRUE);
        $smtppass = $this->input->post('smtppass', TRUE);
        $smtpport = $this->input->post('smtpport', TRUE);
        $source = $this->input->post('source', TRUE);
        $destination = $this->input->post('destination', TRUE);
        $subject = $this->input->post('subject', TRUE);
        $message = $this->input->post('message', TRUE);

        $this->load->library('email');
        if ($protocol == 'mail') {
            $config['protocol'] = 'mail';
            $config['mailpath'] = '/usr/sbin/sendmail';
            $config['charset'] = 'iso-8859-1';
            $config['mailtype'] = 'html';
            $config['wordwrap'] = TRUE;
        } else if ($protocol == 'sendmail') {
            $config['protocol'] = 'sendmail';
            $config['mailpath'] = '/usr/sbin/sendmail';
            $config['charset'] = 'iso-8859-1';
            $config['mailtype'] = 'html';
            $config['wordwrap'] = TRUE;
        } else if ($protocol == 'smtp') {
            $config['protocol'] = 'smtp';
            $config['smtp_host'] = $smtpserver;
            $config['smtp_user'] = $smtpuser;
            $config['smtp_pass'] = $smtppass;
            $config['smtp_port'] = $smtpport;
            $config['charset'] = 'iso-8859-1';
            $config['mailtype'] = 'text';
            $config['wordwrap'] = TRUE;
        }
        
        $this->email->initialize($config);
        $this->email->from($source, 'Software Developer Pro');
        $this->email->to($destination);
        $this->email->subject($subject);
        $this->email->message($message);
        
        if ($this->email->send()) {
            echo "Mail send at $destination successfully";
        } else {
            echo $this->email->print_debugger();
        }
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */