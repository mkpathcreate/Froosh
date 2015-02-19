<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Home extends CI_Controller {
	 public function __construct()
	 {
	 parent::__construct();
	

        $this->load->library('session');

	$this->load->library('user_agent','recaptcha');
	$this->load->helper(array('form', 'url','captcha','string'));
	$this->load->library('form_validation');
	$this->load->database();
       

	 }
	 
	public function index()
	{
		
		$this->mail();
	
		
	}
	public function mail()
	{
		$vals = array(
	        'img_path' => 'assets/captcha',
	        'img_url' => base_url().'assets/captcha',
		'word'          => random_string('numeric', 6),
		'img_width' => '250',
        	'img_height' => '30',
	        'expiration' => '7200'
        	);
		
		$captcha = create_captcha($vals);
		$this->load->library('recaptcha');
		 $data['recaptcha_html'] = $this->recaptcha->recaptcha_get_html();
		 
		 
		 
		 $data['lib_recaptcha']="f1234";
	

                    $data['page'] = 'home/mail';
      
      		/* Store the captcha value (or 'word') in a session to retrieve later */
		$this->session->set_userdata('captchaWord', $captcha['word']);
	        $data['image']=$captcha['image'];

	if ($this->agent->is_mobile())
	{
	
	$data['umedia']="Mobile";
	$this->load->view('mail_register_mobile',$data);
	}
	elseif ($this->agent->is_browser())
	{
	$data['umedia']="PC";	
	$this->load->view('mail_register',$data);
	}
		
	}
	
	//Mail user Registration
	public function register()
	{
	
	$this->load->library('recaptcha');
	 $data['recaptcha_html'] = $this->recaptcha->recaptcha_get_html();
		
	  $this->recaptcha->recaptcha_check_answer();

	 
			 if($this->recaptcha->getIsValid())
		{
	
     		
	
			$data = $this->input->post();
			$this->load->model('mail_module');
			 
			$x=$this->mail_module->umregister($data);
			
			$r=$this->mail_module->user_infoid($x);
			$this->session->set_userdata('logged_in', $r);
				if($x=='')
				{

					$vals = array(
						'img_path' => 'assets/captcha',
						'img_url' => base_url().'assets/captcha',
						'word'    => random_string('numeric', 6),
						'img_width' => '250',
						'img_height' => '30',
						'expiration' => '7200'
						);
		
						$captcha = create_captcha($vals);
		
						/* Store the captcha value (or 'word') in a session to retrieve later */
						$this->session->set_userdata('captchaWord', $captcha['word']);
						$data['image']=$captcha['image'];

					if ($this->agent->is_mobile())
					{
	
						$data['umedia']="Mobile";
					$this->load->view('mail_register_mobile',$data);

					}
					elseif ($this->agent->is_browser())
					{
						$data['umedia']="PC";	
						$this->load->view('mail_register',$data);

 					 }
						

				}
				else
				{
					
					if ($this->agent->is_mobile())
					{
					
						$data['uid']=$x;
						
						
						$this->load->view('fupload_view_mobile',$data);
					}
					elseif ($this->agent->is_browser())
					{
					
						$data['uid']=$x;
						$this->load->view('fupload_view',$data);
					}
					
	
				}
		}
		else 
		{
      
			/** Validation was not successful - Generate a captcha **/
      
			/* Setup vals to pass into the create_captcha function */
			$vals = array(
				'img_path' => 'assets/captcha',
				'img_url' => base_url().'assets/captcha',
				'word'          => random_string('numeric', 6),
				'img_width' => '250',
				'img_height' => '100',
				'expiration' => '7200'
				);
		
			$captcha = create_captcha($vals);
		 if(!$this->recaptcha->getIsValid()) {
                            $this->session->set_flashdata('error','incorrect captcha');
			 $data['recaptcha_html'] = $this->recaptcha->recaptcha_get_html();
		}
      
			/* Store the captcha value (or 'word') in a session to retrieve later */
			$this->session->set_userdata('captchaWord', $captcha['word']);
			$user=array();
			$data['user']['username']=$this->input->post('uname');
			$data['user']['email']=$this->input->post('uemail');
			$data['user']['ugender']=$this->input->post('ugender');
			$data['user']['ubdate']=$this->input->post('ubdate');
			$data['user']['uprefecture']=$this->input->post('uprefecture');
			$data['user']['ucity']=$this->input->post('ucity');	
			$data['user']['mode']=$this->input->post('umode');
			$data['umedia'] = $this->input->post('umedia');
			if($this->input->post('umode')!='mail')
			$data['user']['rusername']=1;
			else
			$data['user']['rusername']=0;
			$data['image']=$captcha['image'];
					if ($this->agent->is_mobile())
					{
					$this->load->view('mail_register_mobile',$data);
					}
					elseif ($this->agent->is_browser())
					{
				$this->load->view('mail_register',$data);	
					}
			
		
		}
	}
	
	public function mview()
	{
		if ($this->agent->is_mobile())
		{
			$this->load->view('aregister_mobile');
		}
		elseif ($this->agent->is_browser())
		{
			$this->load->view('aregister');
		}
	}

	public function login()
	{
	    $this->load->library('rememberme');  
	    $this->load->model('mail_module');
            $cookie_user = $this->rememberme->verifyCookie();
	    $uid=$this->mail_module->getuid($cookie_user);
		
	
		 if ($cookie_user) 
	            {
			if(isset($uid))
			$data['uid']=$uid;
			else
			$data['uid']=0;
			 $img_res=$this->mail_module->userimages($uid);

				if($img_res)
				{
					if ($this->agent->is_mobile())
					{
			    		
					$img_res['uid']=$uid;
					$this->load->view('fupload_view_mobile',$img_res);
					}
					elseif ($this->agent->is_browser())
					{
					$img_res['uid']=$uid;
					$this->load->view('fupload_view',$img_res);
				   	}
			       }
			      else
				{

					if ($this->agent->is_mobile())
					{
			    		
					$this->load->view('fupload_view_mobile',$data);
					}
					elseif ($this->agent->is_browser())
					{
					$this->load->view('fupload_view',$data);
				   	}

				}
		    }
		else
		    {
			
					if ($this->agent->is_mobile())
					{
			    		$this->load->view('login_mobile');
					}
					elseif ($this->agent->is_browser())
					{
					$this->load->view('login');
				   	}

		    }

	}

	public function login_user()
	{
		$k=$this->input->post();
		$this->load->model('mail_module');
		$this->load->library('rememberme');
		$r=$this->mail_module->user_verify($k);
	        $checked = (isset($_POST['remember']))?true:false;  
		$r=$this->mail_module->user_verify($k);
		if($r)
		{
		  $this->load->library('session');
		  
		 $this->session->set_userdata('logged_in', $r);
		   if(isset($k['remember']))
			{
			  $this->session->set_userdata('remember_me', TRUE);
	 
	  		}
		  $img_res=$this->mail_module->userimages($r['uid']);

		       if($checked== true)
		        {
			     $this->rememberme->setCookie($this->input->post('uname'));
		    	}
	 	        if ($this->agent->is_mobile())
			{
	    		
			if($img_res)
			{			
			$this->load->view('fupload_view_mobile',$img_res);
		   	}
			else
			{
			$data['uid']=$r['uid'];
			$this->load->view('fupload_view_mobile',$data);
			}
			}
			elseif ($this->agent->is_browser())
			{
			
			if($img_res)
			{			
			$this->load->view('fupload_view',$img_res);
		   	}
			else
			{
			$data['uid']=$r['uid'];
			$this->load->view('fupload_view',$data);
			}
		   	} 
			
		   
			
		}
		else
		{
			if($this->session->userdata('logged_in'))
			{
				$session_data = $this->session->userdata('logged_in');
				$img_res=$this->mail_module->userimages($session_data['uid']);
				$this->load->view('fupload_view',$img_res);
			}
			else
			{
				if ($this->agent->is_mobile())
				{
				$data['error']="無効なユーザー名とパスワード";
	    			$this->load->view('login_mobile',$data);
				}
				elseif ($this->agent->is_browser())
				{
				$data['error']="無効なユーザー名とパスワード";
				$this->load->view('login',$data);
		   		}
			}
		}
	}
	public function logout()
	{
	 //remove all session data
         $this->session->unset_userdata('logged_in');
	 $this->session->unset_userdata('image_det');
         $this->session->sess_destroy();
		 if ($this->agent->is_mobile())
		{
         $this->load->view('logout_mobile');
		 }
		 elseif ($this->agent->is_browser())
		{
			$this->load->view('logout');	
		}
	}
	function check_usermail(){
	$this->load->model('mail_module');
	$return_value =$this->mail_module->uemail_verify();
	if(!$return_value)
   
	echo "use";
    else
    
	echo "available";
	}

	
	function check_username(){
	$this->load->model('mail_module');
	$return_value =$this->mail_module->uname_verify();
	if(!$return_value)
    
	echo "use";
    else
   
	echo "available";
	}

	function fupload(){
		if($this->session->userdata('logged_in'))
		{
			$session_data = $this->session->userdata('logged_in');
			$this->load->model('mail_module');
	   		$img_res=$this->mail_module->userimages($session_data['uid']);
			if($img_res)
							{	
									
								$this->load->view('fupload_view',$img_res);
						   	}
							else
							{
								$data['uid']= $session_data['uid'];
								
								$this->load->view('fupload_view',$data);
							}
		}
		else
		{
		      echo "<script>alert('Please Register With Your Information');</script>";
			$this->index();

		}
	}
		
	function reload_captcha1()
		{
			$vals = array(
				'img_path' => 'assets/captcha',
				'img_url' => base_url().'assets/captcha',
				'word'          => random_string('numeric', 6),
				'img_width' => '250',
				'img_height' => '70',
				'expiration' => '7200'
				);
		
			$captcha = create_captcha($vals);
			$this->session->set_userdata('captchaWord', $captcha['word']);
			return $captcha['image'];
			

		}
       function check_captcha()
	{
		$word = $this->session->userdata('captchaWord');
		$userCaptcha =$this->input->post('captcha');
		if (strcmp(strtoupper($userCaptcha),strtoupper($word)) == 0)
		{

			echo "use";
		}
		else
		{
			$x=$this->reload_captcha1();
			echo $x;

		}
	}
	function success()
	{
	$tf=$this->config->item('totflv');
		$session_data = $this->session->userdata('logged_in');
		$im=$this->session->userdata('image_det');
		$this->load->model('image_module');
		$this->image_module->img_all($session_data['uid']);
		if($im==1)
		{
		
		$wel=0;
		
		}
		elseif($im==$tf)
		{
		$this->image_module->user_fmail($session_data['uid']);
		$this->image_module->admin_fmail($session_data['uid']);
		}
	
		$this->session->unset_userdata('image_det');
		$this->load->model('mail_module');
		$image=$this->mail_module->image_list($session_data['uid']);
		if($image){
		$data['image']=$image;
			if ($this->agent->is_mobile())
			     $this->load->view('img_up_success_mobile',$data);
			elseif ($this->agent->is_browser())
			     $this->load->view('img_up_success',$data);
		}
		else
			if ($this->agent->is_mobile())
			     $this->load->view('img_up_success_mobile');
			elseif ($this->agent->is_browser())
			     $this->load->view('img_up_success');
	
	}

	function success2(){
		$session_data = $this->session->userdata('logged_in');
		$this->load->model('mail_module');
		$image=$this->mail_module->image_list($session_data['uid']);
		
		echo json_encode($image);
	}
   
	 public function deleteimage() {
	 
	 $this->load->model('image_module');
	 $x=$this->input->post( 'imid' );
	 if($this->image_module->deleteimage($x))
		echo "true";
		else
		echo "false";
	 }

	public function profile_edit() {
	 
	if($this->session->userdata('logged_in'))
		{
		$session_data = $this->session->userdata('logged_in');
		 $this->load->model('mail_module');
		 $tdata=$this->mail_module->get_profile($session_data['uid']);
			$data['user']=$tdata[0];
		 	if ($this->agent->is_mobile())
			     $this->load->view('profile_editv_mobile',$data);
			elseif ($this->agent->is_browser())
			     $this->load->view('profile_editv',$data);
		}
	else
		{
				if ($this->agent->is_mobile())
				{
				$data['error']="無効なユーザー名とパスワード";
	    			$this->load->view('login_mobile',$data);
				}
				elseif ($this->agent->is_browser())
				{
				$data['error']="無効なユーザー名とパスワード";
				$this->load->view('login',$data);
		   		}

		}
	 }
		public function profile_modify() {
		$udata=$this->input->post();
		 $this->load->model('mail_module');
		
		$umres= $this->mail_module->profile_modify($udata);
		if($umres)
		echo "success";
		else
		echo "fail";


		}

	function goback()
	{
	$session_data = $this->session->userdata('logged_in');
	 $this->load->model('mail_module');
	$img_res=$this->mail_module->userimages($session_data['uid']);
		if ($this->agent->is_mobile())
			{
			$img_res['uid']=$session_data['uid'];
			$this->load->view('fupload_view_mobile',$img_res);
			}
		elseif ($this->agent->is_browser())
			{
			$img_res['uid']=$session_data['uid'];
			$this->load->view('fupload_view',$img_res);
			}
	}
	function forgot(){
	$uemail=$this->input->post("uemail");
	$this->load->model('mail_module');
	$res=$this->mail_module->forgot_pass($uemail);	
		if($res>1)
		echo "success";
		if($res==1)
		echo "mail";
		if($res==0)
		echo "not";
		}

	



}
?>