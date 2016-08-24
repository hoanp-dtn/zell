<?php
/**
* AnhProduction
*/
class Teacher_Model extends MY_Model
{
	
	function __construct()
	{
		parent::__construct();
	}

	
	function delete_files($array){
		$data = array();
		if(isset($array) && is_array($array) && count($array)){
			$data = $this->db->select('id, value')->from('utt_postmeta')->where(array('post_id'=>0,'key'=>'file_teacher'))->where_not_in('id',$array)->get()->result_array();
		}else{
			$data = $this->db->select('id, value')->from('utt_postmeta')->where(array('post_id'=>0,'key'=>'file_teacher'))->get()->result_array();
		}
		if(count($data)){
			foreach($data as $key => $val){
				$path_to_file = './uploads/files/'.$val['value'];
				$path_to_file2 = './uploads/files/thumb__'.$val['value'];
				if(file_exists($path_to_file)){
					unlink($path_to_file);
				}
				if(file_exists($path_to_file2)){
					unlink($path_to_file2);
				}
				$this->db->delete('utt_postmeta',array('id'=> $val['id']));
			}
		}
	}
	function getTeachers()
	{
		$this->db->select(PREFIX.'users.* ,'.PREFIX.'brch.name as coso,'.PREFIX.'department.name_vn as khoa');
		$this->db->from(PREFIX."users");
		$this->db->join(PREFIX.'brch',''.PREFIX.'users.br_id = '.PREFIX.'brch.id','left');
		$this->db->join(PREFIX.'department',''.PREFIX.'users.department_id = '.PREFIX.'department.id','left');
		//$this->db->where('user_type','2');
		$data = $this->db->get()->result_array();
		return $data;
	}

	function getView($user = "", $page="", $num = 6)
	{
		$begin = (int)$page <= 1 ? 0 : ($page-1) * $num;
		$this->db->select(PREFIX.'post.*,'.PREFIX.'users.fullname AS user, '.PREFIX.'cate.title AS cate_title');
		$this->db->from(PREFIX.'post');
		$this->db->where(PREFIX.'post.status','1');
		$where = PREFIX."post.user_id = ".$user." AND (".PREFIX."post.cate_id='998' OR ".PREFIX."post.cate_id='999')";
		$this->db->where($where);
		$this->db->join(PREFIX.'users',PREFIX.'users.id = '.PREFIX.'post.user_id');
		$this->db->join(PREFIX.'cate',PREFIX.'cate.id = '.PREFIX.'post.cate_id');
		$this->db->order_by('id','desc');
		$this->db->limit($num, $begin);
		return $this->db->get()->result_array();
	}

	function getKhoahoc($user = "", $page="", $num = 6)
	{
		$begin = (int)$page <= 1 ? 0 : ($page-1) * $num;
		$this->db->select(PREFIX.'post.*,'.PREFIX.'users.fullname AS user, '.PREFIX.'cate.title AS cate_title');
		$this->db->from(PREFIX.'post');
		$this->db->where('user_id',$user);
		$this->db->where(PREFIX.'post.status','1');
		$this->db->where(PREFIX.'post.cate_id','998');
		$this->db->join(PREFIX.'users',PREFIX.'users.id = '.PREFIX.'post.user_id');
		$this->db->join(PREFIX.'cate',PREFIX.'cate.id = '.PREFIX.'post.cate_id');
		$this->db->order_by('id','desc');
		$this->db->limit($num, $begin);
		return $this->db->get()->result_array();
	}

	function getTailieu($user = "", $page="", $num = 6)
	{
		$begin = (int)$page <= 1 ? 0 : ($page-1) * $num;
		$this->db->select(PREFIX.'post.*,'.PREFIX.'users.fullname AS user, '.PREFIX.'cate.title AS cate_title');
		$this->db->from(PREFIX.'post');
		$this->db->where('user_id',$user);
		$this->db->where(PREFIX.'post.status','1');
		$this->db->where(PREFIX.'post.cate_id','999');
		$this->db->join(PREFIX.'users',PREFIX.'users.id = '.PREFIX.'post.user_id');
		$this->db->join(PREFIX.'cate',PREFIX.'cate.id = '.PREFIX.'post.cate_id');
		$this->db->order_by('id','desc');
		$this->db->limit($num, $begin);
		return $this->db->get()->result_array();
	}

	function update($uid, $data)
	{
		if ((int)$uid > 0)
		{
			$this->db->where('id', $uid);
			$this->db->update(PREFIX.'users', $data);
			return true;
		} else return false;
	}

	function CountPostKH($id)
	{
		$id = (int)$id;
		$this->db->select('*');
		$this->db->from(PREFIX.'post');
		$this->db->where('user_id',$id);
		$this->db->where('cate_id','998');
		$this->db->where(PREFIX.'post.status','1');
		$data = $this->db->get()->result_array();
		return count($data);
	}

	function CountPostTL($id)
	{
		$id = (int)$id;
		$this->db->select('*');
		$this->db->from(PREFIX.'post');
		$this->db->where('user_id',$id);
		$this->db->where('cate_id','999');
		$this->db->where(PREFIX.'post.status','1');
		$data = $this->db->get()->result_array();
		return count($data);
	}

	function CountPost($id)
	{
		$id = (int)$id;
		$this->db->select('*');
		$this->db->from(PREFIX.'post');
		$this->db->where(PREFIX.'post.status','1');
		$where = PREFIX."post.user_id = ".$id." AND (".PREFIX."post.cate_id='998' OR ".PREFIX."post.cate_id='999')";
		$this->db->where($where);
		$data = $this->db->get()->result_array();
		return count($data);
	}

	function getDetail($id = '')
	{
		$id = (int)$id;
		if ($id>0)
		{
			$this->db->select(PREFIX.'post.*,'.PREFIX.'users.fullname AS user, '.PREFIX.'cate.title AS cate_title');
			$this->db->where(PREFIX.'post.id', $id);
			$this->db->from(PREFIX.'post');
			$this->db->join(PREFIX.'users',PREFIX.'users.id = '.PREFIX.'post.user_id');
			$this->db->join(PREFIX.'cate',PREFIX.'cate.id = '.PREFIX.'post.cate_id');
			$data = $this->db->get()->result_array();
			$data = (count($data)==1)?$data[0]:array();
			$data['file'] = $this->db->select(PREFIX.'postmeta.value')->from(PREFIX.'postmeta')->where(PREFIX.'postmeta.post_id',(int)$id)->get()->result_array();
			return $data;
		} return array();
	}

	function CheckIDGV($id)
	{
		$id = (int)$id;
		$this->db->select('*');
		$this->db->from(PREFIX.'users');
		$this->db->where('id',$id);
		$d = $this->db->get()->result_array();
		return !empty($d)?(true):false;
	}

	function CheckPostID($id='',$tid='',$cid='',$type='1')//2 not check cate, # check cate
	{
		$id = (int)$id;
		$tid = (int)$tid;
		$cid = (int)$cid;
		$type = (int)$type;
		$this->db->select('*');
		$this->db->from(PREFIX.'post');
		$this->db->where('id',$id);
		$this->db->where('user_id',$tid);
		if ($type != '2') $this->db->where('cate_id',$cid);
		$d = $this->db->get()->result_array();
		return !empty($d)?(true):false;
	}

	function getNextID($id='', $uid='')
	{
		$id = (int)$id;
		$uid = (int)$uid;
		$this->db->select('*');
		$this->db->from(PREFIX.'post');
		$this->db->where('user_id',$uid);
		$this->db->where('id >',$id);
		$this->db->limit(1);
		$d = $this->db->get()->result_array();
		return !empty($d)?($d[0]):null;
	}

	function getPrevID($id='', $uid='')
	{
		$id = (int)$id;
		$uid = (int)$uid;
		$this->db->select('*');
		$this->db->from(PREFIX.'post');
		$this->db->where('user_id',$uid);
		$this->db->where('id <',$id);
		$this->db->order_by('id','desc');
		$this->db->limit(1);
		$d = $this->db->get()->result_array();
		return !empty($d)?($d[0]):null;
	}

	function profile($id="")
	{
		if (isset($id) && ((int)$id > 0))
		{
			$this->db->select(PREFIX.'users.id, '.PREFIX.'users.username, '.PREFIX.'users.email, '.PREFIX.'users.avatar, '.PREFIX.'users.fullname, '.PREFIX.'users.permit, '.PREFIX.'users.city, '.PREFIX.'users.address, '.PREFIX.'users.phone, '.PREFIX.'users.about, '.PREFIX.'brch.name as brch, '.PREFIX.'department.name_vn as department');
			$this->db->from(PREFIX.'users');
			$this->db->join(PREFIX.'brch',''.PREFIX.'users.br_id = '.PREFIX.'brch.id','left');
			$this->db->join(PREFIX.'department',''.PREFIX.'users.department_id = '.PREFIX.'department.id','left');
			$this->db->where(PREFIX.'users.id', $id);

			return $data  = $this->db->get()->result_array();
		} return array();
	}

	function login($u='',$p='')
	{
		if (!empty($u)&&!empty($p))
		{
			$salt = $this->db->query("SELECT * FROM ".PREFIX."users WHERE username='".$u."' OR email='".$u."'")->row();
			if (isset($salt)&&!empty($salt))
			{
				$salt = $salt->salt;
				$pass = md5(md5(md5($p).md5($salt)));
				$where = "(password='".$pass."') AND (username='".$u."' OR email='".$u."')";
				$this->db->select('*');
				$this->db->from(PREFIX.'users');
				$this->db->where($where);
				$this->db->limit(1);
				$d = $this->db->get()->result_array();
				return !empty($d)?($d[0]):false;
			} return false;

		} else return false;
	}

	function getAvatar($id)
	{
		$name = $this->db->query("SELECT * FROM ".PREFIX."users WHERE id='".$id."'")->row();
		$avt = (isset($name)?($name->avatar):null);
		return $avt;
	}
	
	function add($uid='',$current_file=array()) {
		$date_to_int = time();
		$this->do_upload();
		$upload_data = $this->upload->data(); 
		$file_name =   $upload_data['file_name'];
		// $authentication = json_decode($this->session->userdata('authentication'),TRUE);
		// $user_id = $authentication['id'];
		$cate_id = (int)$this->input->post('cate');
		$cate_id = ($cate_id == 1)?'998':'999';
		$data = array(
			'status'=> (int)$this->input->post('status'),
			'time_create' => $date_to_int,
			'post_type' =>'teacher',
			'user_id' =>$uid,
			'cate_id' => $cate_id,
			'title' =>getSaveSqlStr(strip_tags($this->input->post('title'))),
			'description' =>getSaveSqlStr(strip_tags($this->input->post('description'))),
			'detail'=> (htmlspecialchars($this->input->post('detail'))),
			'image' => $file_name,
		);
		$result = $this->_add('utt_post',$data);
		$insert_post_id = $this->db->insert_id();
		$this->db->flush_cache();
		if(isset($current_file) && is_array($current_file) && count($current_file)){
			$data = array();
			foreach($current_file as $key => $val){
				$data[] = array(
					'id' => $val,
					'post_id' => $insert_post_id
				); 
			}
			$this->db->update_batch('utt_postmeta', $data, 'id'); 
		}
		return $result;
	}

	function deletepost($id='')
	{
		if ((int)$id > 0)
		{
			$this->db->where('id', $id);
			$res = $this->db->delete(PREFIX.'post');
			if ($res) return array('type'=>'successfuly', 'message' => 'Xóa thành công!');
			else return array('type'=>'error', 'message' => 'Xóa bài viết thất bại!');
		} else return array('type'=>'error', 'message' => 'Không thể thực hiện thao tác này.');
	}

	function edit($id='',$data = array())
	{
		if ((int)$id > 0)
		{
			$this->db->where('id', $id);
			$res = $this->db->update(PREFIX.'post', $data);
			if ($res) return array('type'=>'successfuly', 'message' => 'Sửa thành công!');
			else return array('type'=>'error', 'message' => 'Sửa bài viết thất bại!');
		} else return array('type'=>'error', 'message' => 'Không thể thực hiện thao tác này.');
	}

	function getImage($id)
	{
		$name = $this->db->query("SELECT * FROM ".PREFIX."post WHERE id='".$id."'")->row();
		$avt = (isset($name)&&!empty($name)?($name->image):null);
		return $avt;
	}
	
	function do_upload()
	{
		$config['upload_path'] = './uploads/images/news';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '10000000';
		$config['max_width']  = '10240';
		$config['max_height']  = '76800';
		$this->load->library('upload', $config);
		if ( ! $this->upload->do_upload())
		{
			$error = array('error' => $this->upload->display_errors());
		}
		else
		{
			$data = array('upload_data' => $this->upload->data());
		}
	}

	function question($data = array())
	{
		$out = $this->db->insert(PREFIX.'qa',$data);
		if ($out) return array('success'=>'Gửi câu hỏi thành công');
		else return array('error'=>'Gửi câu hỏi thất bại');
	}

	function answer($data = array())
	{
		$out = $this->db->insert(PREFIX.'qa',$data);
		if ($out) return array('success'=>'Gửi câu trả lời thành công');
		else return array('error'=>'Gửi câu trả lời thất bại');
	}

	function loadQA($uid)
	{
		$uid = (int)$uid;
		$quest = $this->loadQuestion($uid);
		$result = array();
		if (!empty($quest))
		{
			foreach ($quest as $key => $value) {
				$result['question'][$key] = $value;
				$result['answer'][$key] = $this->loadAnswer($value['id']);
			}
			return $result;
		} else return $result;
	}

	function loadAnswer($id)
	{
		$id = (int)$id;
		$this->db->select(PREFIX.'qa.*,'.PREFIX.'users.fullname as tname,'.PREFIX.'users.avatar');
		$this->db->from(PREFIX.'qa');
		$this->db->join(PREFIX.'users',PREFIX.'qa.teacher_id = '.PREFIX.'users.id');
		$this->db->where(PREFIX.'qa.parent_id',$id);
		$this->db->where(PREFIX.'qa.status','1');
		$data = $this->db->get()->result_array();
		return $data;
	}

	function loadQuestion($uid)
	{
		$uid = (int)$uid;
		$this->db->select(PREFIX.'qa.*,'.PREFIX.'users.fullname as tname');
		$this->db->from(PREFIX.'qa');
		$this->db->join(PREFIX.'users',PREFIX.'qa.teacher_id = '.PREFIX.'users.id');
		$this->db->where(PREFIX.'qa.teacher_id',$uid);
		$this->db->where(PREFIX.'qa.parent_id','0');
		$this->db->where(PREFIX.'qa.status','1');
		$data = $this->db->get()->result_array();
		return $data;
	}

	function quest($uid, $page='',$nip = '10')
	{
		$uid = (int)$uid;
		$nip = (int)$nip <= 10 ? 10 : (int)$nip;
		$begin = (int)$page <= 1 ? 0 : ((int)$page-1) * $nip;
		$this->db->select(PREFIX.'qa.*,'.PREFIX.'users.fullname as tname,'.PREFIX.'users.avatar');
		$this->db->from(PREFIX.'qa');
		$this->db->join(PREFIX.'users',PREFIX.'qa.teacher_id = '.PREFIX.'users.id');
		$this->db->where(PREFIX.'qa.teacher_id',$uid);
		$this->db->where(PREFIX.'qa.status','1');
		$this->db->limit($nip, $begin);
		$this->db->order_by('id','desc');
		$data = $this->db->get()->result_array();
		return $data;
	}

	function countcmt($uid)
	{
		$this->db->select(PREFIX.'qa.*,'.PREFIX.'users.fullname as tname');
		$this->db->from(PREFIX.'qa');
		$this->db->join(PREFIX.'users',PREFIX.'qa.teacher_id = '.PREFIX.'users.id');
		$this->db->where(PREFIX.'qa.teacher_id',$uid);
		$data = $this->db->get()->result_array();
		return count($data);
	}

	function mQuestion($uid, $page='',$nip = '10')
	{
		$uid = (int)$uid;
		$nip = (int)$nip <= 10 ? 10 : (int)$nip;
		$begin = (int)$page <= 1 ? 0 : ((int)$page-1) * $nip;
		$this->db->select(PREFIX.'qa.*,'.PREFIX.'users.fullname as tname');
		$this->db->from(PREFIX.'qa');
		$this->db->join(PREFIX.'users',PREFIX.'qa.teacher_id = '.PREFIX.'users.id');
		$this->db->where(PREFIX.'qa.teacher_id',$uid);
		$this->db->limit($nip, $begin);
		$this->db->order_by('id','desc');
		$data = $this->db->get()->result_array();
		return $data;
	}

	function checkqID($qid='',$tid='')
	{
		$qid = (int)$qid;
		$tid = (int)$tid;
		$this->db->select('*');
		$this->db->from(PREFIX.'qa');
		$this->db->where('id',$qid);
		$this->db->where('teacher_id',$tid);
		$d = $this->db->get()->result_array();
		return !empty($d)?(true):false;
	}

	function qStatus($qid='',$tid='')
	{
		$qid = (int)$qid;
		$tid = (int)$tid;
		$cid = $this->checkqID($qid,$tid);
		if (isset($qid)&&!empty($qid)&&$cid)
		{
			$res = $this->db->query("SELECT * FROM ".PREFIX."qa WHERE id='".$qid."'")->row();
			$stt = (isset($res)?($res->status):null);
			$status = ($stt==1)?'0':'1';
			$this->db->where('id',$qid);
			$this->db->update(PREFIX.'qa',array('status'=>$status));
			return true;
		} else return false;
	}

	function qDel($qid='',$tid='')
	{
		$qid = (int)$qid;
		$tid = (int)$tid;
		$cid = $this->checkqID($qid,$tid);
		if (isset($qid)&&!empty($qid)&&$cid)
		{
			$this->db->where('id', $qid);
			$this->db->delete(PREFIX.'qa'); 
			return true;
		} else return false;
	}

	function getqEdit($qid='',$tid='')
	{
		$qid = (int)$qid;
		$tid = (int)$tid;
		$cid = $this->checkqID($qid,$tid);
		if (isset($qid)&&!empty($qid)&&$cid)
		{
			
			$this->db->select('*');
			$this->db->from(PREFIX."qa");
			$this->db->where('id',$qid);
			$data = $this->db->get()->result_array();
			return isset($data)?$data[0]:array();
		} else return false;
	}

	function qupdate($qid='',$data=array(), $tid='')
	{
		$qid = (int)$qid;
		$tid = (int)$tid;
		$cid = $this->checkqID($qid,$tid);
		if (isset($qid)&&!empty($qid)&&$cid)
		{
			$this->db->where('id',$qid);
			$this->db->update(PREFIX."qa",$data);
			return true;
		} else return false;
	}

	function numQuestion($uid='')
	{
		$uid = (int)$uid;
		$this->db->select(PREFIX.'qa.*,'.PREFIX.'users.fullname as tname,'.PREFIX.'users.avatar');
		$this->db->from(PREFIX.'qa');
		$this->db->join(PREFIX.'users',PREFIX.'qa.teacher_id = '.PREFIX.'users.id');
		$this->db->where(PREFIX.'qa.teacher_id',$uid);
		$this->db->where(PREFIX.'qa.parent_id','0');
		$this->db->where(PREFIX.'qa.status','1');
		$this->db->order_by('id','desc');
		$data = $this->db->get()->result_array();
		return !empty($data)?(count($data)):null;
	}

	function getQuestion($uid='', $parent = '0', $page='',$nip = '15')
	{
		$uid = (int)$uid;
		$nip = (int)$nip <= 5 ? 5 : (int)$nip;
		$begin = (int)$page <= 1 ? 0 : ((int)$page-1) * $nip;
		$this->db->select(PREFIX.'qa.*,'.PREFIX.'users.fullname as tname,'.PREFIX.'users.avatar');
		$this->db->from(PREFIX.'qa');
		$this->db->join(PREFIX.'users',PREFIX.'qa.teacher_id = '.PREFIX.'users.id');
		$this->db->where(PREFIX.'qa.teacher_id',$uid);
		$this->db->where(PREFIX.'qa.parent_id',$parent);
		$this->db->where(PREFIX.'qa.status','1');
		$this->db->limit($nip, $begin);
		$this->db->order_by('id','desc');
		$data = $this->db->get()->result_array();
		return $data;
	}
	
	private $ListComment = array();
	function getListQuestion(&$ListCmt)
	{
		if(empty($ListCmt)){
			return;
		}
		foreach($ListCmt as $key => $val){
			$ListCmtChild = $this->getQuestion($val['teacher_id'], $val['id']);
			$this->getListQuestion($ListCmtChild);
			if(!empty($ListCmtChild)){
				$val['questionreply'] = $ListCmtChild	;
			}
			$ListCmt[$key] = $val;
			$this->ListComment = $ListCmt;
		}
		return $this->ListComment;
	}
	function getListComment($post_id){
		return $this->db->select('*')->from(PREFIX.'comment')->where(array('post_id'=>$post_id,'status'=>1))->get()->result_array();
	}
}

?>