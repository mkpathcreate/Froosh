<?php defined('BASEPATH') OR exit('No direct script access allowed');
class mail_module extends CI_Model{
      /* Check the User details and store the User Information in database
     */
    function umregister($udata)
	{

	$query = $this->db->get_where('users',array('uname'=>$udata['uname']));
	
	if($query->num_rows()==0){
	$this->load->helper('date');
	$sex="";
	$n=date("Y/m/d h:i:s");
	if($udata['ugender']==1)
	{
	$sex="男性";
	}
	elseif($udata['ugender']==2)
	{

	$sex="女性";
	}
	 $ubdate=$udata['ubyear']."-".$udata['ubmonth']."-".$udata['ubday'];
	$udata_db = array(
	   'uname' => $udata['uname'] ,
	   'ufullname' => $udata['ufullname'] ,
	   'uemail' => $udata['uemail'] ,
	   'upassword' => md5($udata['upassword']),
	   'ugender'=>$sex,
	   'ubdate'=>$ubdate,
	   'uprefecture'=>$udata['uprefecture'],
	   'ucity'=>$udata['ucity'],
	   'ureg_date'=>$n,
	   'ulogin_mode'=>$udata['umode'],
	   'user_ip'=> $this->input->ip_address(),
	   'umedia'=> $udata['umedia']
		);

	if($udata['uname']!='')   
	{
	 $this->db->insert('users',$udata_db);
	 $insert_id = $this->db->insert_id();
	  $from=trim($udata['uemail']);
	  if($this->db->affected_rows()>=1)
	   $this->send_mail($from);
	 return $insert_id;
	}
	else
		 return 1;
	 
	}
	else
	{
	
	return '';
	}
	}

	/* verify the user   */
	function user_verify($user)
	{
	
		$uemail=$user['uemail'];
		$pass=md5($user['upass']);
		$this->db->select('*');
		 $this->db->from('users');
		$cond="uname=$uemail AND upassword=$pass";
		$this->db->where('uemail',$uemail);
		$this->db->where('upassword',$pass);
		$query=$this->db->get();
	
		
		 if($query->num_rows()>0)
		{
	 
			 $results=$query->result_array();
			 $sess_array = array('uid' => $results[0]['uid'],
			                 'uname' => $results[0]['uname'],
					 'uemail'=>$results[0]['uemail']);
			
	  
	  		
	  
		 return $sess_array;
		 }
		 else
		 {
		 
		  return false;
		  }
	 
	
	}

	function user_infoid($uid)
	{
	
		
		$this->db->select('*');
		 $this->db->from('users');
		
		$this->db->where('uid',$uid);
		$query=$this->db->get();
	

		 if($query->num_rows()>0)
		{
	 
			 $results=$query->result_array();
			 $sess_array = array('uid' => $results[0]['uid'],
			                 'uname' => $results[0]['uname'],
					 'uemail'=>$results[0]['uemail']);
		
	  
	  		
	  
		 return $sess_array;
		 }
		 else
		 {
		 
		  return false;
		  }
	 
	
	}


	
/* Check Email Id Exist or Not */

	function uemail_verify()
	{
	  $uemail = trim($this->input->post('uemail'));
	  $query = $this->db->get_where('users',array('uemail'=>$uemail));
	  if($query->num_rows() > 0)
    return false;
    else
    return true;
	  
	}

/* Check Username Exist or Not */

	function uname_verify()
	{
	  $uname = trim($this->input->post('uname'));
	  $query = $this->db->get_where('users',array('uname'=>$uname));
	  if($query->num_rows() > 0)
    return false;
    else
    return true;
	  
	}


	function uname_verify1($uname)
	{
	  $this->db->select('*');
 	  $this->db->from('users');
	  $this->db->where('uname',$uname);
	  $query=$this->db->get();
	
     

	  if($query->num_rows() > 0)
		{
		 $results=$query->result_array();
			
			 $sess_array = array('uid' => $results[0]['uid'],
			                 'uname' => $results[0]['uname'],
					 'uemail'=>$results[0]['uemail']);
		    return $sess_array;

		}
	    else{

	    return '';
}

	}





	function send_mail($to)
	{
  mb_language("Japanese");

  $this->load->library('myemail');
	
	$config['protocol'] = 'sendmail';
	$config['mailpath'] = '/usr/sbin/sendmail';
	
	$config['_encoding'] = '7bit';
	$config['charset'] = 'ISO-2022-JP';
	$config['wordwrap'] = FALSE;
	$this->myemail->initialize($config);

	$to  = $to;

  //mail from name
  $from_name = "froosh キャンペーン運営事務局";
  $from_name = mb_encode_mimeheader($from_name, "ISO-2022-JP", "ASCII,JIS,UTF-8,EUC-JP,SJIS");

  //mail subject to user
  $subject = "froosh キャンペーン 事前登録のお知らせ";

	$message = "
この度は、「frooshを飲んで北欧へ行こう」キャンペーンに
事前登録して頂き、誠にありがとうございます。

事前登録された方に抽選で50名に当社が選んだ
リサラーソンのマグカップをプレゼントいたします。
厳正な抽選の結果、当選者の方には、ご登録頂いたメールアドレス宛に
メールをお送り致します（2015年1月末を予定）。

また、「frooshを飲んで北欧へ行こう」キャンペーンは、
11月中旬以降の開始を予定しております。

キャンペーンを開始しましたら、ご登録頂きましたメールアドレスに
ご案内をお送り致します。

皆さまの今後のライフスタイルの中に、
ともにfrooshスムージーがあること、心より願っております。

frooshキャンペーン運営事務局


＜今後の主な販売先のご紹介＞
ナチュラルローソン他、主なコンビニ、高級スーパー、
セレクトショップ、楽天市場などで販売されます。

運営会社　:　クロスフェイスHD株式会社
キャンペーンサイト　:　http://www.froosh-cp.jp/
Facebookサイト　:　 https://www.facebook.com/frooshjapan
問合せ先（メールアドレス）　:　info@froosh-cp.jp";


//mail to admin
$subject_admin = "froosh キャンペーン新規ユーザー登録のお知らせ";

$message_admin = "
froosh キャンペーンサイトにて、新規ユーザーが登録されました。
";


  //mail sending
	$admin_mail = $this->config->item('emailfrom');
  $message = mb_convert_encoding($message, "ISO-2022-JP", "ASCII,JIS,UTF-8,EUC-JP,SJIS");
	$this->myemail->from($admin_mail, $from_name);
  $this->myemail->to($to);
	$this->myemail->subject(mb_encode_mimeheader($subject, "ISO-2022-JP", "ASCII,JIS,UTF-8,EUC-JP,SJIS"));
	$this->myemail->message($message);
	$this->myemail->send();

  //mail sending to admin
  $admin_mail = $this->config->item('emailfrom');
  $message_admin = mb_convert_encoding($message_admin, "ISO-2022-JP", "ASCII,JIS,UTF-8,EUC-JP,SJIS");
  $this->myemail->from($admin_mail, $from_name);
  $this->myemail->to($admin_mail);
  $this->myemail->subject(mb_encode_mimeheader($subject_admin, "ISO-2022-JP", "ASCII,JIS,UTF-8,EUC-JP,SJIS"));
  $this->myemail->message($message_admin);
  $this->myemail->send();
  }

function userimages($uid)
	{
	$this->db->select('id,image_name,image_sequence,phase,image_fla_id,fstatus');
	 $this->db->from('images');
	 $this->db->where('u_id',$uid);
	$this->db->where('image_status',1);
	 
	$this->db->order_by("phase asc,image_sequence asc");  
	$result=$this->db->get();
	if($result->num_rows()>0)
	{
	$totrow=0;
	foreach($result->result_array() as $key=> $val){
                    $ima_det['images'][$key] = $val;
					$totrow++;
                }
	$x=count($ima_det);
	$ima_det['total']=$totrow;
	$ima_det['uid']=$uid;
	
	return $ima_det;
	}
	else
	{
	
	return false;
	
	}
	
	
	
	}

function getuid($uname)
	{
	$this->db->select('uid');
	$this->db->from('users');
	$this->db->where('uname',$uname);
	$res=$this->db->get();
	if($res->num_rows()>0)
	{
	$tempuid=$res->result_array();
	
	
	$uid=$tempuid[0]['uid'];
	return $uid;
	
	}
	else
	return false;
	
	
	
	}
	function image_list($uid)
	{
		$this->db->select("DATE_FORMAT(image_up_date,'%Y/%m/%d') as idate",FALSE);
		$this->db->select("image_fla_name as fname");
		
	        $this->db->from('images');
		$this->db->where('u_id',$uid);
		$this->db->where('image_status',1);

		$this->db->order_by("image_up_date desc"); 
		$res=$this->db->get();
		if($res->num_rows()>0)
		{
			$tempuid=$res->result_array();
			
			return $tempuid;
	
		}
		else
		return false;
     
	}
	function get_profile($uid)
	{
	$this->db->select('*');
	$this->db->from('users');
	$this->db->where('uid',$uid);
	$tempres=$this->db->get();
	if($tempres->num_rows()>0)
	{
		$res=$tempres->result_array();
		return $res;
	}
	else
	return false;
	}
	function profile_modify($data)
	{
		$data2=array();
		
		$pass=$data['upassword'];
		 $this->db->select('*');
		  $this->db->from('users');
	    $this->db->where('uid', $data['uid']);
	    $this->db->where('upassword',$pass);
	  $tempres0=$this->db->get();	
	  $ubdate=$data['ubyear']."-".$data['ubmonth']."-".$data['ubday'];
		if($tempres0->num_rows()==0)
		{
		 $data2=array( 'upassword'=>md5($data['upassword']),
			'ugender'=>$data['ugender'],
			'ufullname'=>$data['ufullname'],
		     'ubdate'=>$ubdate,
		     'uprefecture'=>$data['uprefecture'],
		     'ucity'=>$data['ucity']
		);
		}
		else
		{
		 $data2=array('ugender'=>$data['ugender'],
		     'ubdate'=>$ubdate,
			 'ufullname'=>$data['ufullname'],
		     'uprefecture'=>$data['uprefecture'],
		     'ucity'=>$data['ucity']
		);
		}
		$this->db->where('uid', $data['uid']);
		if($this->db->update('users',$data2))
		return true;
		else
		return false;
	}

	function forgot_pass($uemail)
	{
	$this->db->select('*');
	$this->db->from('users');
	$this->db->where('uemail',$uemail);
	$tempres=$this->db->get();
	if($tempres->num_rows()==1)
	{
	$this->load->helper('string');
	$x=random_string('numeric',6);
	$data3=array('upassword'=>md5($x));
	$this->db->where('uemail',$uemail); 
		if($this->db->update('users',$data3))
		{
			$to=$uemail;
			mb_language("Japanese");
			$this->load->library('myemail');
			$config['mailpath'] = '/usr/sbin/sendmail';
			$config['_encoding'] = '7bit';
			$config['charset'] = 'ISO-2022-JP';
			$config['wordwrap'] = FALSE;
			$this->myemail->initialize($config);
			$from_name = "froosh";
			  	$from_name = mb_encode_mimeheader($from_name, "ISO-2022-JP", "ASCII,JIS,UTF-8,EUC-JP,SJIS");

				  //mail subject to user
				  $subject = "Forgot Password";
			$message = " Your New password Is ".$x;
			$admin_mail = $this->config->item('emailfrom');
			$message = mb_convert_encoding($message, "ISO-2022-JP", "ASCII,JIS,UTF-8,EUC-JP,SJIS");
			$this->myemail->from($admin_mail, $from_name);
				$this->myemail->to($to);	
				$this->myemail->subject(mb_encode_mimeheader($subject, "ISO-2022-JP", "ASCII,JIS,UTF-8,EUC-JP,SJIS"));
				$this->myemail->message($message);
				if($this->myemail->send())	
				{		
				return $x;				
				}
				else
				{
				return 1;
				}
		}
	}
	else
	{
	return 0;
	}
	}

} 

?>