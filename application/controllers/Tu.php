<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 13-3-22
 * Time: 上午9:58
 * To change this template use File | Settings | File Templates.
 */
class Tu extends CI_Controller{
	public function constructor(){
        $this->load->helper('url');

    }
//    public function xx(){
//        $id=$_GET['id'];
//        if($id){
//
//        }
//
//    }
//    public function test(){
//        $this->load->database();
//        $this->db->select('*');
//        $this->db->from('tucao');
//        $this->db->join('huifu', 'huifu.t_id = tucao.id','right');
//        $this->db->join('zhichi', 'zhichi.t_id = tucao.id','right');
//
//        $query = $this->db->get();
//        $query=$query->result_array();
//        echo "<pre>";
//        print_r($query);
//        echo "</pre>";
////        foreach($query as $key=>$val){
////            echo "key".$key."val".$val."<br>";
////            //echo `key=`,$key,`value`,$val,"\n";
////        }
//        // 生成:
//// SELECT * FROM blogs
//// JOIN comments ON comments.id = blogs.id
//    }
    /**
     * 显示漫画
     */

    /**
     *  关联查询回复
     */
    //$this->db->select("mhpath.id,mhpath.path,mhpath.zjid,zhangjie.id as z_id,tucao.id as t_id,tucao.left,tucao.top,tucao.tucao,tucao.img_id,tucao.zhichi");
//        $this->db->select('*');
//        $this->db->from('mhpath');
//        $this->db->join('zhangjie', 'zhangjie.id = mhpath.zjid');
    // $this->db->join('tucao', 'tucao.img_id = mhpath.id',"RIGHT");
//        $array = array('mhpath.id' => $img_id, 'mhpath.zjid' => $zhangjie_id);
//        $query = $this->db->where($array)->get();
//        $mh=$query->result_array();
    public function xxx(){



    }
    public function Index(){

	   	$this->load->database();
        $this->load->model("tucao");
        @$zhangjie_id=isset($_GET['zhangjie'])?$_GET['zhangjie']:1;
        @$first=$this->db->from("mhpath")->order_by("id","asc")->select("id")->limit("1")->where('id >',0)->where("zjid =",$zhangjie_id)->get()->row_array(); //判断上一篇
        @$img_id=isset($_GET['id'])?$_GET['id']:$first['id'];
        @$ar=$this->db->get_where("mhpath",array("zjid"=>$zhangjie_id))->result_array(); //判断该篇是否存在

        if(count($ar)==0){
            $before=$this->db->from("zhangjie")->order_by("id","desc")->select("id")->limit("1")->where('id >',0)->where("id <",$zhangjie_id)->get()->row_array();
            $zhangjie_id=$before['id'];
            @$mh=$this->tucao->mh($zhangjie_id);
            $arr['mh']=$mh;

            $this->load->view("Tu/over.php",$arr);
        }
        else{
            @$mh=$this->tucao->mh($zhangjie_id,$img_id);
            @$arr['next_id']=$this->db->from(' mhpath') ->limit(1)->order_by('id','asc')->select('id')->where('id >',$img_id)->where('zjid =',$zhangjie_id)->get()->row_array();
            @$arr['last_id']=$this->db->from(' mhpath') ->limit(1)->order_by('id','desc')->select('id')->where('id <',$img_id)->where('zjid =',$zhangjie_id)->get()->row_array();
            @$result=$this->tucao->result($img_id);
            @$huifus=$this->db->get('huifu')->result_array();
            $arr['mh']=$mh;

            $arr['mhid']=$img_id;
            $arr['tucaos']=$result;
            $arr['huifu']=$huifus;
            $arr['p_id']=$zhangjie_id;
            $arr['first']=$first;

            $this->load->view("Tu/view.php",$arr);
        }

}

	public function addtu(){

        $this->load->database();
        $this->load->model("Tucao");

        if (!$this->session->userdata('logged_in')){
            $date['ip']=$this->Tucao->Getip();  //如果没登陆使用ip，如果登陆请自行添加session[user];
        }
        $date['left']=$_POST['left'];
        $date['top']=$_POST['top'];
        $date['tucao']=$_POST['tucao'];
        $date['img_id']=$_POST['img_id'];
        $date['fontcolor_qsq']=$_POST['fontcolor_qsq'];
        $date['bgcolor_qsq']=$_POST['bgcolor_qsq'];
        $this->db->insert('tucao', $date);
        $id= mysql_insert_id();
        $msg['id']=$id;
        $msg['ip']=$date['ip'];
        echo json_encode($msg);

	}
	public function edittu(){
	$this->load->database();
	$date['left']=$_POST['left'];
	$date['top']=$_POST['top'];
	$id=$_POST['id'];
	$this->db->where("id",$id);
	if($this->db->update("tucao",$date)){

        echo "Ok";
    }
}
		/**
		*支持||赞同
		*/
    public function zhichi(){
        $id=$_POST['id'];//吐槽id
        $this->load->model("Tucao");
        $flag=$this->Tucao->agree($id); //赞同处理，返回数据
        echo json_encode($flag);






    }
    /**
     * 吐槽回复
     */
    public function reply(){
            $date['reply_val']=$_POST['re_val'];
            $date['t_id']=$_POST['t_id'];
            $this->load->database();
            $this->db->insert("huifu", $date);


    }


    public function show_stop(){


    }
}

