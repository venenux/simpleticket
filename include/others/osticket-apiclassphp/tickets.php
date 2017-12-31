<?php
/*
	osticket system wrapper
	sovgvd@gmail.com 2015-08
*/

class tickets {
	private $errors=array();
	private $api=true;
	private $ost=false;
	private $db_config=false;
	
	function tickets($_api=true,$_db_config=false) {
		$this->api=$_api;
		$this->db_config=$_db_config;
		if ($this->db_config['use_db']) {
			$this->_init_db();
		}
	}
	
	private function _init_db() {
		$this->ost = new mysqli($this->db_config['host'], $this->db_config['username'], $this->db_config['password'], $this->db_config['db']);
		if ($this->ost->connect_error) {
			$this->errors[]="db_connection";
			$this->ost=false;
			return false;
		}
		$this->ost->set_charset("utf8");
		$this->ost->query("SET NAMES 'utf8'");
		return true;
	}

	function create ($post_data,$user_data=false,$return_url=false) {
		$out=array("ok"=>"ok","d"=>false);
		if ($user_data && isset($user_data->email) && trim($post_data['subject'])!='' && trim($post_data['txt'])!='') {
			$tmp=explode("@",$user_data->email);
			if (!isset($user_data->name) || $user_data->name=='') $user_data->name=$tmp[0];
			if (!isset($user_data->surname) || $user_data->surname=='') $user_data->surname=$tmp[1];
			$data = array(
			'name'      =>      $user_data->name." ".$user_data->surname,
			'email'     =>     $user_data->email,
			'deptId'	=>	(int)$post_data['department_id'],
			'subject'   =>      htmlspecialchars(trim($post_data['subject'])),
			'message'   =>      htmlspecialchars(trim($post_data['txt'])),
			'ip'        =>      isset($_SERVER['REMOTE_ADDR'])?$_SERVER['REMOTE_ADDR']:'127.0.0.1',
			'attachments' => array(),
			);
			if ($ticket_id=$this->_api($this->db_config['api_url']['create'],$data)) {
				$out['d']=$ticket_id;
			} else {
				$out['ok']='error';
				$out['error']=array("ticket_create_error");
			}
		} else {
			$out['ok']='error';
			$out['error']=array("wrong_data");
		}
		return $this->_out($out);
	}

	private function _api($url,$data) {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_USERAGENT, 'osTicket API Client v1.7');
		curl_setopt($ch, CURLOPT_HEADER, FALSE);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array( 'Expect:', 'X-API-Key: '.$this->db_config['api']));
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, FALSE);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
		$result=curl_exec($ch);
		$code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		curl_close($ch);
		if ($code != 201) {
			return false;
		} else {
			return (int)$result;
		}
	}

	function reply ($post_data,$user_data=false,$return_url=false) {
		$out=array("ok"=>"ok","d"=>false);
		if ($user_data && $user_data->email && trim($post_data['txt'])!='') {
			$tmp=explode("@",$user_data->email);
			if (!isset($user_data->name) || $user_data->name=='') $user_data->name=$tmp[0];
			if (!isset($user_data->surname) || $user_data->surname=='') $user_data->surname=$tmp[1];
			$data = array(
			'poster'	=>      $user_data->name." ".$user_data->surname,
			'email'		=>      $user_data->email,
			'ticketID'	=>      (int)$post_data['ticket_id'],
			'message'	=>      htmlspecialchars(trim($post_data['txt'])),
			'ip'		=>      isset($_SERVER['REMOTE_ADDR'])?$_SERVER['REMOTE_ADDR']:'127.0.0.1',
			'attachments' => array(),
			);

			if ($ticket_id=$this->_api($this->db_config['api_url']['reply'],$data)) {
				$out['d']=$ticket_id;
			} else {
				$out['ok']='error';
				$out['error']=array("ticket_reply_error");
			}
		} else {
			$out['ok']='error';
			$out['error']=array("wrong_data");
		}
		return $this->_out($out);
	}

	function departments($to_show=true) {
		$out=array("ok"=>"ok","d"=>false);
		if (!$this->ost) {
			$out['ok']='error';
			$out['error']=$this->errors;
		} else {
			$sql="select dept_id as 'id',dept_name as 'title' from ost_department";
			$tmp=$this->ost->query($sql);
			while($a=$tmp->fetch_array(MYSQLI_ASSOC)) {
				if (!$out['d']) $out['d']=array();
				$out['d'][]=$a;
			}
		}
		return $this->_out($out);
	}

	function thread($ticket_id,$user_data) {
		$out=array("ok"=>"ok","d"=>false);
		if (!$this->ost) {
			$out['ok']='error';
			$out['error']=$this->errors;
		} else {
			$ticket_user_id=@$this->ost->query("SELECT `user_id` FROM `ost_user_email` WHERE `address`='".$this->ost->real_escape_string($user_data->email)."'")->fetch_object()->user_id;
			$real_ticket_id=@$this->ost->query("SELECT `ticket_id` FROM `ost_ticket` WHERE `number`=".(int)$ticket_id." AND `user_id`=".(int)$ticket_user_id."")->fetch_object()->ticket_id;
			if ((int)$real_ticket_id>0) {
				$sql="SELECT `thread_type` 'msg_type', `poster` 'name', `title`, `body`, `format`, UNIX_TIMESTAMP(`created`) 'created', UNIX_TIMESTAMP(`updated`) 'updated' FROM `ost_ticket_thread` WHERE `ticket_id`=".$real_ticket_id." ORDER BY `id`";
				$tmp=$this->ost->query($sql);
				while($a=$tmp->fetch_array(MYSQLI_ASSOC)) {
					if (!$out['d']) $out['d']=array();
					$out['d'][]=$a;
				}
			} else {
				$out['ok']='error';
				$out['error']=array("wrong_ticket");
			}
		}
		return $this->_out($out);
	}

	function items($user_data,$limit=10,$page=0) {
		$out=array("ok"=>"ok","d"=>false);
		if (!$this->ost) {
			$out['ok']='error';
			$out['error']=$this->errors;
		} else {
			$sql="SELECT SQL_CALC_FOUND_ROWS `number`, `status_id`, `dept_name`, UNIX_TIMESTAMP(if(`isanswered`>`lastresponse`,`isanswered`,`lastresponse`)) 'lastupdate', UNIX_TIMESTAMP(t.created) 'created', `title`, `isanswered` FROM `ost_ticket` t LEFT JOIN `ost_ticket_thread` tt ON tt.ticket_id=t.ticket_id LEFT JOIN `ost_department` d ON d.dept_id=t.dept_id LEFT JOIN `ost_user_email` e ON e.user_id=t.user_id WHERE e.address='".$this->ost->real_escape_string($user_data->email)."' AND `title`<>'' GROUP BY t.ticket_id ORDER BY 4 DESC, 5 LIMIT ".$page*$limit.",".$limit;
			$tmp=$this->ost->query($sql);
			$_tmp=$this->ost->query("SELECT FOUND_ROWS() as 'c'")->fetch_object()->c;
			$_sql="SELECT count(DISTINCT t.ticket_id) 'c' FROM `ost_ticket` t LEFT JOIN `ost_department` d ON d.dept_id=t.dept_id LEFT JOIN `ost_user_email` e ON e.user_id=t.user_id WHERE e.address='".$this->ost->real_escape_string($user_data->email)."' AND `status_id`=1";
			$items_opened=$this->ost->query($_sql)->fetch_object()->c;
                        $out['d']=array("pages"=>ceil($_tmp/$limit),"items"=>$_tmp, "items_opened"=>$items_opened,"page"=>$page,"tickets"=>array());
			while($a=$tmp->fetch_array(MYSQLI_ASSOC)) {
				if (!$out['d']) $out['d']=array();
				if (!$out['d']['tickets']) $out['d']['tickets']=array();
				if (!$out['d']['new_msgs']) $out['d']['new_msgs']=0;
				if ($a['isanswered']==1 && $a['status_id']==1) $out['d']['new_msgs']++;
				$out['d']['tickets'][]=$a;
			}
		}
		return $this->_out($out);
	}

	function unread_msgs($user_data) {
		$out=array("ok"=>"ok","d"=>false);
		if (!$this->ost) {
			$out['ok']='error';
			$out['error']=$this->errors;
		} else {
			$sql="SELECT count(DISTINCT t.ticket_id) 'c' FROM `ost_ticket` t LEFT JOIN `ost_ticket_thread` tt ON tt.ticket_id=t.ticket_id LEFT JOIN `ost_department` d ON d.dept_id=t.dept_id LEFT JOIN `ost_user_email` e ON e.user_id=t.user_id WHERE e.address='".$this->ost->real_escape_string($user_data->email)."' AND `title`<>'' AND status_id=1 and isanswered=1 GROUP BY t.ticket_id";
			$out['d']=$this->ost->query($sql)->fetch_object()->c;
		}
		return $this->_out($out);
		
	}

        private function _error($_error) {
                $this->errors[]=$_error;
        }
        function errors_get() {
                return $this->errors;
        }

        private function _out($out) {
                if ($this->api) {
                        return $out;
                } else {
                        if ($out['ok']=='ok') {
                                return $out['d'];
                        } else {
                                $this->_error($out['error']);
                                return false;
                        }
                }
        }
}

?>
