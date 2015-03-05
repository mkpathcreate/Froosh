<?php defined('BASEPATH') OR exit('No direct script access allowed');
class mail_module extends CI_Model{
      /* Check the User details and store the User Information in database
     */
    function umregister($udata)
	{
	//$query = $this->db->get_where('users',array('uemail'=>$udata['uemail']));
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
	   $this->send_mail($from,$udata_db);
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





	function send_mail($to,$udata)
	{
	
	$name=$udata['uname'];
	$email=$udata['uemail'];
	$fname=$udata['ufullname'];
	$gender=$udata['ugender'];
	$dob= $udata['ubdate'];
	$add=$udata['uprefecture'].",".$udata['ucity'];
	$rdate=$udata['ureg_date'];
  mb_language("Japanese");

  $this->load->library('myemail');
	
	$config['protocol'] = 'sendmail';
	$config['mailpath'] = '/usr/sbin/sendmail';
	
	$config['_encoding'] = '7bit';
	$config['charset'] = 'ISO-2022-JP';
	$config['wordwrap'] = FALSE;
	$this->myemail->initialize($config);

	$to  = $to;

  
  $from_name = "froosh キャンペーン運営事務局";
  $from_name = mb_encode_mimeheader($from_name, "ISO-2022-JP", "ASCII,JIS,UTF-8,EUC-JP,SJIS");

  
  $subject = "froosh キャンペーンへのご登録ありがとうございます";

	$message = "
この度は、
「frooshを飲んで北欧へ行こう」キャンペーンに
ご登録頂き、誠にありがとうございます。

本キャンペーンでは、２つのキャンペーンをご用意しています。

ご購入いただき、お飲みになる時に写真を撮影して、ご応募下さい

【北欧往復チケット賞】４種類（4枚）の投稿で応募ができます。
　抽選で５名様（５名１０名様）に北欧への航空券をペアでプレゼント
　※＜東京～フィンランド・ヘルシンキ＞往復（エコノミークラス）
　※渡航時期、航空会社（日本航空もしくはフィンエアー）は、
　　弊社指定になります。

【参加賞】１種類（１枚）投稿で応募ができます。
　抽選で５０名様にリサ･ラーソンの置物をプレゼント


一人のお客様が何回応募してもOKです。奮ってご応募下さい！
＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝
　ご　応　募　方　法
＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝
１．こちらからご登録のメールアドレスとパスワードでログインして下さい。
　　http://www.froosh-cp.jp/home/login/
２．『＋マーク』のある画像をクリックすると投稿画面が表示されます。
３．表示された画面をクリックし、撮影した画像を選んでください
４．撮影した画像のfrooshフレーバーを選択し、
　　『写真をアップロードする』ボタンをクリックしてください。

５．応募してよろしければ、『応募する』ボタンをクリックして完了です。
　
　＜ご注意事項＞
　・１回の応募で同じフレーバーを複数選択すると『参加賞』でのご応募になります。
　・応募するボタンをクリックせずに画面を閉じるとやり直しになります。
＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝

皆さまの今後のライフスタイルの中に、
ともにfrooshスムージーがあること、心より願っております。

　　　　　　　　　　　　　　　　　　　　frooshキャンペーン運営事務局

＜今後の主な販売先のご紹介＞
ナチュラルローソン他、主なコンビニ、高級スーパー、
セレクトショップ、楽天市場などで販売されます。

＋＋＋＋＋＋＋＋＋＋＋＋＋＋＋＋＋＋＋＋＋＋＋＋＋＋＋＋＋＋＋＋＋＋
【運営会社】クロスフェイスHD株式会社　info@froosh-cp.jp

キャンペーンサイト　:　http://www.froosh-cp.jp/ 
Facebookサイト　:　 https://www.facebook.com/frooshjapan
＋＋＋＋＋＋＋＋＋＋＋＋＋＋＋＋＋＋＋＋＋＋＋＋＋＋＋＋＋＋＋＋＋＋

";


//mail to admin
//$subject_admin = "froosh キャンペーン新規ユーザー登録のお知らせ";
$subject_admin = "【froosh CP】本登録がありました";

//$message_admin = "froosh キャンペーンサイトにて、新規ユーザーが登録されました。 ";
$message_admin = "
＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝
名前（ニックネーム）：　$name
メールアドレス：　$email
＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝
名前（本名）：　$fname
性別：　$gender
生年月日：　$dob
住所：　$add
＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝
Registered Date:  $rdate

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
		$x="`phase`=(select max(phase) from images where u_id=".$uid." and image_status=1)";
		$this->db->select("DATE_FORMAT(image_up_date,'%Y/%m/%d') as idate",FALSE);
		//$this->db->select("group_concat(image_fla_name) as fname");
		$this->db->select("group_concat(image_fla_name) as fname,image_fla_id");
		
	        $this->db->from('images');
		$this->db->where('u_id',$uid);
		$this->db->where('image_status',1);
		$this->db->where($x, NULL, FALSE);
		$this->db->group_by("day(image_up_date)"); 
		//$this->db->where('fstatus',0);
		
		$this->db->order_by("image_up_date desc"); 
		 //$this->db->limit(4, 0);
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
	
	function flv_list3($id,$ph){
	$this->db->select('*');
	$this->db->from('images');
	$this->db->where('u_id',$id);
	$this->db->where('image_status',1);
	$this->db->where('phase',$ph);
	$res=$this->db->get();
	
	 if($res->num_rows()>0){
	 $temp=$res->result_array();
	 return $temp;
		}
	else{
	$ph=$ph-1;
	$this->db->select('*');
	$this->db->from('images');
	$this->db->where('u_id',$id);
	$this->db->where('image_status',1);
	$this->db->where('phase',$ph);
	$res2=$this->db->get();
		if($res2->num_rows()>0 && $res2->num_rows()<4){
			 $temp2=$res2->result_array();
			 return $temp2;
		}
		else
		{
			$temp3=array("image_fla_id"=>0);
			
			return $temp3;
		}
	
	}

	
	
	}

} 

?>