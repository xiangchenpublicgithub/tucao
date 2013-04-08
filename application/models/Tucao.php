<?php
class Tucao extends CI_Model{

    /**查询章节和页的数据
     * @param $zj 章节ID
     * @param $ye 页面ID
     */
    function __construct(){
        $this->load->library('session');
        $this->load->database();
        parent::__construct();


    }
    public function mh($zj,$ye){

        if($zj && $ye){
            $this->db->select("mhpath.id,mhpath.path,mhpath.zjid,zhangjie.id as z_id,zhangjie.jianjie");
            $this->db->from('mhpath');
            $this->db->join('zhangjie', 'zhangjie.id = mhpath.zjid');
        $mh = $this->db->where(array("mhpath.id"=>$ye,"zhangjie.id"=>$zj))->get()->result_array();
        return $mh;
        }
        elseif($zj){

           return  $this->db->from("zhangjie")->where(array("id"=>$zj))->get()->result_array();
        }
    }
    public function GetIP()
    {
        if(!empty($_SERVER["HTTP_CLIENT_IP"]))
            $cip = $_SERVER["HTTP_CLIENT_IP"];
        else if(!empty($_SERVER["HTTP_X_FORWARDED_FOR"]))
            $cip = $_SERVER["HTTP_X_FORWARDED_FOR"];
        else if(!empty($_SERVER["REMOTE_ADDR"]))
            $cip = $_SERVER["REMOTE_ADDR"];
        else
            $cip = "无法获取！";
        return $cip;
    }

    /**
     * @param $id 吐槽id
     * 支持数，
     */
    public function agree($id){
//        $this->db->where("id",$id);
//        if($this->db->update('tucao', $date)) $arr['flag']='1';
//        else $arr['flag']='0';

        $date['ip']=$this->GetIP(); //获取赞同IP
        $date['t_id']=$id;
        $date['encryption']=md5($date['ip'].$date['t_id']);

        $is_repeat=count($this->db->get_where('agree', array('encryption' => $date['encryption']))->result_array()); //判断这个id是否点击同一个吐槽支持


        if($is_repeat==0){

            if($this->db->insert('agree', $date))
                $zhichi['flag'] = 1;
            else
                $zhichi['flag'] = 0;

        }
        else $zhichi['flag'] = 3;//重复ID，不允许点击
        $zhichi['num']=$this->db->from('agree')->where(array('t_id'=>$id))->count_all_results();
        return $zhichi;
    }
    /**
     * 吐槽数据回显
     */
    public function result($img_id){
//        $this->db->select("tucao.id,tucao.left,tucao.top,tucao.tucao,tucao.ip,tucao.img_id,tucao.bgcolor_qsq,tucao.fontcolor_qsq
//        ,huifu.id as huifuid,huifu.reply_val,huifu.t_id as huifutid,agree.id as agreeid,agree.ip as agreeip,agree.time,agree.t_id as agreetid
//        ");
//        $this->db->from('tucao');
//        $this->db->join('agree', 'agree.t_id = tucao.id');
//        $this->db->join('huifu', 'huifu.t_id = tucao.id');
//        $mh = $this->db->where(array('img_id'=>$img_id))->get()->result_array();
        $mh = $this->db->where(array('img_id'=>$img_id))->get('tucao')->result_array();

//        $huifus=$this->db->get('huifu')->result_array();
        $id="";
        foreach($mh as $key=>$val){
            $id=$mh[$key]['id'];//tucao id

            $mh[$key]['huifu'] = $this->db->where(array('t_id'=>$id))->get('huifu')->result_array();
            $mh[$key]['zhichi']=$this->db->from('agree')->where(array('t_id'=>$id))->count_all_results();


            //$mh[$key]['huifu']=$huifu;


        }
        return  $mh;
    }

}




















