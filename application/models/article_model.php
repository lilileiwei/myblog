<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Article_model extends CI_Model
{

    public function get_ariticles_by_user($user_id)
    {
        $this->db->select('a.*, t.type_name');
        $this->db->from('t_article a');
        $this->db->join('t_article_type t', 'a.type_id=t.type_id');
        $this->db->where('a.user_id', $user_id);
        $this->db->order_by('a.post_date', 'desc');

        return $this->db->get()->result();
    }

    public function get_types_by_user($user_id)
    {
        $sql = "select t.*, (select count(*) from t_article a where a.type_id=t.type_id) num from  t_article_type t where t.user_id=$user_id";
        return $this->db->query($sql)->result();
    }

    public function save_article($title, $content, $type_id, $user_id){
        $this->db->insert('t_article', array(
            'content' => $content,
            'title' => $title,
            'type_id' => $type_id,
            'user_id' => $user_id
        ));
        return $this->db->affected_rows();
    }

    public function delete_articles($ids){
        $sql = "delete from t_article where article_id in($ids)";
        $this->db->query($sql);
        return $this->db->affected_rows();
    }

    public function add_blog_catalog($type_name, $user_id){
        $this->db->insert('t_article_type', array(
            'type_name' => $type_name,
            'user_id' => $user_id
        ));
        return $this->db->affected_rows();
    }
    public function get_article_type($type_id){
        $sql="select * from t_article_type where type_id=$type_id";
        return $this->db->query($sql)->row();
    }
    public function updata_type($type_id,$type_name){
        $this->db->set('type_name',$type_name);
        $this->db->where('type_id',$type_id);
        $this->db->update('t_article_type');
        return $this->db->affected_rows();
    }
    public function delete_type($type_id){
        $this->db->delete('t_article_type',array(
            'type_id'=>$type_id
        ));
        return $this->db->affected_rows();
    }

}