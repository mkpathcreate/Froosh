<?php
 
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
 

class Image_module extends CI_Model {
 
    //table name
    private $file = 'files';   // files    
     
    function save_files_info($files) {
        //start db traction
        $this->db->trans_start();
        //file data
        $file_data = array();
        foreach ($files as $file) {
            $file_data[] = array(
                'file_name' => $file['file_name'],
                'file_orig_name' => $file['orig_name'],
                'file_path' => $file['full_path'],
                'upload_date' => date('Y-m-d H:i:s')
            );
        }
        
        $this->db->insert_batch($this->file, $file_data);
       
        $this->db->trans_complete();
       
        if ($this->db->trans_status() === FALSE) {
            foreach ($files as $file) {
                $file_path = $file['full_path'];
               
                if (file_exists($file_path)) {
                    unlink($file_path);
                }
            }
          
            $this->db->trans_rollback();
            return FALSE;
        } else {
           
            $this->db->trans_commit();
            return TRUE;
        }
    }
	function image_store($imdata){
	
	 $this->db->insert('images',$imdata);
	 return $this->db->insert_id();
	
	
	
	}

	function imgstatusup($imid){
	$data=array('image_status'=>0);
	if($this->db->update('images', $data, array('id' => $imid)))
	{
		$this->db->select('image_sequence,u_id,phase');
		$this->db->from('images');
		$this->db->where('id',$imid);
		$tempres=$this->db->get();
		$res=$tempres->result_array();
		if(isset($res[0]))
		{
		
		 return($res);
		}
		else
		{
			$res=array();
			$res[0]['phase']=1;
			$res[0]['image_sequence']=1;
           
			
			return $res;
		}
		
		//return $res;
	}
	else
	false;
	
	}
	
	/*function getphaimgsec($uid){
	
$this->db->select_max('phase');

$this->db->from('images');
$this->db->where('u_id',$uid);
$this->db->where('image_status',1);
$tempres=$this->db->get();
$res_phase=$tempres->result_array();

$this->db->select_max('phase');
$this->db->select_max('image_sequence');
$this->db->from('images');
$this->db->where('u_id',$uid);
$this->db->where('phase',$res_phase[0]['phase']);
$tempres2=$this->db->get();
$res=$tempres2->result_array();


if(isset($res[0]))
{
$tf=$this->config->item('totflv');
	if($res[0]['image_sequence']>=$tf)
	{
			
	
				if($res[0]['phase']=='')
				$res[0]['phase']=1;
		$res[0]['phase']=$res[0]['phase']+1;
		$res[0]['image_sequence']=1;
	}
	else
	{
				if($res[0]['phase']=='')
				$res[0]['phase']=1;
		$res[0]['image_sequence']=$res[0]['image_sequence']+1;
		
			
	}

return($res);
}
else{
$res=array();
$res[0]['phase']=1;
$res[0]['image_sequence']=1;

return $res;
	}
 
}*/

function getphaimgsec($uid,$phase){
	$sql="SELECT count(if(image_status=0,1,Null)) as 'deleted',count(if(image_status=1,1,Null)) as 'active' FROM images WHERE u_id=$uid and phase=$phase";
$query = $this->db->query($sql);
$res_phase=$query->result_array();
	log_message('error',json_encode($res_phase)); 
$result['active']=$res_phase[0]['active'];
$result['deleted']=$res_phase[0]['deleted'];

	if($result['deleted']==0)
	{
		$tf=$this->config->item('totflv');
			if($result['active']>=$tf)
			{
			$result['active']=1;
			$result['phase']=++$phase;
			}
			else
			{
			$result['active']=$result['active']+1;
			$result['phase']=$phase;
				
			
			}
	}
	else
	{
	   if($result['deleted']==1)
		{
		$sqlsel="select * FROM images WHERE u_id=$uid and phase=$phase and image_status=0";
		$resulsel=$this->db->query($sqlsel);
		$res2=$resulsel->result_array();
		$result['active']=$res2[0]['image_sequence'];
		$result['phase']=$res2[0]['phase'];
		$sqldel="delete FROM images WHERE u_id=$uid and phase=$phase and image_status=0";
		$this->db->query($sqldel);
		}
		else
		{
		$sqlsel2="select min(image_sequence) as active,id,phase FROM images WHERE u_id=$uid and phase=$phase and image_status=0";
		$resulsel2=$this->db->query($sqlsel2);
		$res3=$resulsel2->result_array();
		$result['active']=$res3[0]['active'];
		$result['phase']=$res3[0]['phase'];
		$sqldel2="delete FROM images WHERE u_id=$uid and phase=$phase and image_status=0 and id=".$res3[0]['id'];
		$this->db->query($sqldel2);
		
		}

	}

	return $result;

}

/************** Mail sending functions  ********/
/* send mail to user at Every First Image Upload  */

function user_smail($uid)
	{
	  	$this->load->library('myemail');
		$this->db->select('uemail,uname,ureg_date,ufullname');
		$this->db->from('users');
		$this->db->where('uid',$uid);
		$tempres=$this->db->get();
		$res=$tempres->result_array();
		if(isset($res[0]))
			{
				$to=$res[0]['uemail'];
				$apdate=date('Y-m-d H:i:s');
				$dt=explode(" ",$apdate);
				$ydate=$dt[0];
				$ytime=$dt[1];
				$ymd=explode("-",$ydate);
				
				$apdate2=$ymd[0]."年".$ymd[1]."月".$ymd[2]."日"."   ".$ytime;
				
				$niname=$res[0]['ufullname'];
				mb_language("Japanese");
				$this->load->library('myemail');
				
				$config['mailpath'] = '/usr/sbin/sendmail';
				
				$config['_encoding'] = '7bit';
				$config['charset'] = 'ISO-2022-JP';
				$config['wordwrap'] = FALSE;
				$this->myemail->initialize($config);

				$from_name = "froosh キャンペーン運営事務局";
			  	$from_name = mb_encode_mimeheader($from_name, "ISO-2022-JP", "ASCII,JIS,UTF-8,EUC-JP,SJIS");

				  //mail subject to user
				  $subject = "froosh キャンペーンへのご応募ありがとうございます";

				$message = " 「frooshを飲んで北欧へ行こう」キャンペーンに
ご応募頂き、誠にありがとうございます。

【名前（ニックネーム）】$niname
【メールアドレス】$to
【応募日時】$apdate2
【応募キャンペーン】参加賞

このキャンペーンは何度でもご応募できます。
またのご応募お待ちしております！
http://test.froosh-cp.jp/home/login/

皆さまの今後のライフスタイルの中に、
ともにfrooshスムージーがあること、心より願っております。

　　　　　　　　　　　　　　　　　　　　frooshキャンペーン運営事務局

＋＋＋＋＋＋＋＋＋＋＋＋＋＋＋＋＋＋＋＋＋＋＋＋＋＋＋＋＋＋＋＋＋＋
【運営会社】クロスフェイスHD株式会社　info@froosh-cp.jp

キャンペーンサイト　:　http://www.froosh-cp.jp/
Facebookサイト　:　 https://www.facebook.com/frooshjapan
＋＋＋＋＋＋＋＋＋＋＋＋＋＋＋＋＋＋＋＋＋＋＋＋＋＋＋＋＋＋＋＋＋＋";

				$admin_mail = $this->config->item('emailfrom');
				$message = mb_convert_encoding($message, "ISO-2022-JP", "ASCII,JIS,UTF-8,EUC-JP,SJIS");
				$this->myemail->from($admin_mail, $from_name);
				$this->myemail->cc($admin_mail);
				$this->myemail->to($to);	
				$this->myemail->subject(mb_encode_mimeheader($subject, "ISO-2022-JP", "ASCII,JIS,UTF-8,EUC-JP,SJIS"));
				$this->myemail->message($message);
				if($this->myemail->send())		
				{
				$mdata['mail_from']=$admin_mail;
				$mdata['mail_to']=$to;
				$mdata['mail_date']=date('Y-m-d H:i:s');
				$mdata['mail_uname']=$res[0]['uname'];
				$this->db->insert('mails',$mdata);
				}


			}




	}

/* send mail to user at Every Final Image Upload  */

function user_fmail($uid)
	{

		$this->load->library('myemail');
		$this->db->select('uemail,uname,ureg_date,ufullname');
		$this->db->from('users');
		$this->db->where('uid',$uid);
		$tempres=$this->db->get();
		$res=$tempres->result_array();
		if(isset($res[0]))
			{
				$to=$res[0]['uemail'];
				$apdate=date('Y-m-d H:i:s');
				$dt=explode(" ",$apdate);
				$ydate=$dt[0];
				$ytime=$dt[1];
				$ymd=explode("-",$ydate);
				
				$apdate2=$ymd[0]."年".$ymd[1]."月".$ymd[2]."日"."   ".$ytime;
				
				$niname=$res[0]['ufullname'];
				mb_language("Japanese");
				$this->load->library('myemail');
				
				$config['mailpath'] = '/usr/sbin/sendmail';
				
				$config['_encoding'] = '7bit';
				$config['charset'] = 'ISO-2022-JP';
				$config['wordwrap'] = FALSE;
				$this->myemail->initialize($config);

				$from_name = "froosh キャンペーン運営事務局";
			  	$from_name = mb_encode_mimeheader($from_name, "ISO-2022-JP", "ASCII,JIS,UTF-8,EUC-JP,SJIS");

				  //mail subject to user
				  $subject = "froosh キャンペーンへのご応募ありがとうございます";

				$message = " 「frooshを飲んで北欧へ行こう」キャンペーンに
ご応募頂き、誠にありがとうございます。

【名前（ニックネーム）】$niname
【メールアドレス】$to
【応募日時】$apdate2
【応募キャンペーン】北欧往復チケット賞

このキャンペーンは何度でもご応募できます。
またのご応募お待ちしております！
http://test.froosh-cp.jp/home/login/

皆さまの今後のライフスタイルの中に、
ともにfrooshスムージーがあること、心より願っております。

　　　　　　　　　　　　　　　　　　　　frooshキャンペーン運営事務局

＋＋＋＋＋＋＋＋＋＋＋＋＋＋＋＋＋＋＋＋＋＋＋＋＋＋＋＋＋＋＋＋＋＋
【運営会社】クロスフェイスHD株式会社　info@froosh-cp.jp

キャンペーンサイト　:　http://www.froosh-cp.jp/
Facebookサイト　:　 https://www.facebook.com/frooshjapan
＋＋＋＋＋＋＋＋＋＋＋＋＋＋＋＋＋＋＋＋＋＋＋＋＋＋＋＋＋＋＋＋＋＋";
				$admin_mail = $this->config->item('emailfrom');
				$message = mb_convert_encoding($message, "ISO-2022-JP", "ASCII,JIS,UTF-8,EUC-JP,SJIS");
				$this->myemail->from($admin_mail, $from_name);
				$this->myemail->cc($admin_mail);
				$this->myemail->to($to);	
				$this->myemail->subject(mb_encode_mimeheader($subject, "ISO-2022-JP", "ASCII,JIS,UTF-8,EUC-JP,SJIS"));
				$this->myemail->message($message);
				if($this->myemail->send())		
				{
				$mdata['mail_from']=$admin_mail;
				$mdata['mail_to']=$to;
				$mdata['mail_date']=date('Y-m-d H:i:s');
				$mdata['mail_uname']=$res[0]['uname'];
				$this->db->insert('mails',$mdata);
				}



			}


	}
/* send mail to admin at Every Final Image Upload  */

function admin_fmail($uid)
	{
		$this->load->library('myemail');
		$this->db->select('uemail,uname');
		$this->db->select_max('phase');
		$this->db->from('users');
		$this->db->join('images','users.uid=images.u_id');
		$this->db->where('uid',$uid);
		$tempres=$this->db->get();
		$res=$tempres->result_array();
		if(isset($res[0]))
			{
				$to=$res[0]['uemail'];
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
				$subject_admin = "froosh ";
	
				$message_admin = "froosh   User Details Name:".$res[0]['uname']."   Email:".$res[0]['uemail'] ." phase: ".$res[0]['phase'];
				$admin_mail = $this->config->item('emailfrom');
				$message = mb_convert_encoding($message_admin, "ISO-2022-JP", "ASCII,JIS,UTF-8,EUC-JP,SJIS");
				$this->myemail->from($admin_mail, $from_name);
				$this->myemail->to($admin_mail);	
				$this->myemail->subject(mb_encode_mimeheader($subject_admin, "ISO-2022-JP", "ASCII,JIS,UTF-8,EUC-JP,SJIS"));
				$this->myemail->message($message);
				if($this->myemail->send())		
				{
				$mdata['mail_from']=$admin_mail;
				$mdata['mail_to']=$admin_mail;
				$mdata['mail_date']=date('Y-m-d H:i:s');
				$mdata['mail_uname']=$res[0]['uname'];
				$this->db->insert('mails',$mdata);
				}


			}
			


	}

 function cimage_details($uid)
	{
$query = $this->db->query("SELECT max(image_sequence) FROM images WHERE phase=(select max(phase) from images where u_id=$uid)");

	}
function deleteimage($id,$phase,$uid)
	{
	$data = array(
               'image_status' => 0,
     
            );
		$this->db->where('id', $id);
		if($this->db->update('images', $data))
			{
			
		$query = $this->db->query("SELECT group_concat(image_fla_id) as flid FROM images WHERE phase=$phase and u_id=$uid and image_status=0");
		
				if($query->num_rows()>0)
				{
					$result=$query->result_array();
					$fresult="true,".$result[0]['flid'];
					
				return $fresult;
				}
				else
				return true;
			
			}
		else
		{
		return false;
		}
	
	
	}
function flv_det($uid,$ph)
	{
		$this->db->select("group_concat(image_fla_id) as flv");
		$this->db->from('images');
		$this->db->where('u_id',$uid);
		$this->db->where('phase',$ph);
		$this->db->where('image_status',1);
		$tempres2=$this->db->get();
		$res=$tempres2->result_array();
		if(isset($res[0]))
		{
		return $res;
		}
		else
		{
		return false;
		}
	
	}
function flv_det2($uid,$imid)
	{
	$this->db->select("phase");
	$this->db->from('images');
	$this->db->where('u_id',$uid);
	$this->db->where('id',$imid);
	$tempres2=$this->db->get();
		$res=$tempres2->result_array();
		if(isset($res[0]))
		{

			$this->db->select("group_concat(image_fla_id) as flv");
			$this->db->from('images');
			$this->db->where('u_id',$uid);
			$this->db->where('phase',$res[0]['phase']);
			$this->db->where('image_status',1);
			$tempres3=$this->db->get();
			$res2=$tempres3->result_array();
			if(isset($res2[0]))
			{
				return $res2;
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
/*                                      */
function flv_det3($uid)
	{
	$this->db->select_max('phase');
	$this->db->from('images');
	$this->db->where('u_id',$uid);

	$tempres2=$this->db->get();
		$res=$tempres2->result_array();
		if(isset($res[0]))
		{

			$this->db->select("group_concat(image_fla_id) as flv");
			$this->db->from('images');
			$this->db->where('u_id',$uid);
			$this->db->where('phase',$res[0]['phase']);
			$this->db->where('image_status',1);
			$tempres3=$this->db->get();
			$res2=$tempres3->result_array();
			if(isset($res2[0]))
			{
				return $res2;
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

	function img_all($uid){
	$data3=array('fstatus'=>1);
	$this->db->where('u_id',$uid); 
	$this->db->update('images',$data3);
	}
}