<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('article_model');
        $this->load->model('comment_model');
    }

    public function index()
    {
        $this->load->view('admin_index');
    }

    public function new_blog()
    {
        $loginedUser = $this->session->userdata('loginedUser');
        $types = $this->article_model->get_types_by_user($loginedUser->user_id);
        $this->load->view('new_blog', array(
            'types' => $types
        ));
    }
    public function post_blog()
    {
        $title = htmlspecialchars($this->input->post('title'));
        $content = htmlspecialchars($this->input->post('content'));
        $type_id = $this->input->post('type_id');
        $loginedUser = $this->session->userdata('loginedUser');
        $rows = $this->article_model->save_article($title, $content, $type_id, $loginedUser->user_id);
        if ($rows > 0) {
            redirect('admin/list_blogs');
        } else {
            echo 'fail';
        }
    }
    public function list_blogs()
    {
        $loginedUser = $this->session->userdata('loginedUser');
        $articles = $this->article_model->get_ariticles_by_user($loginedUser->user_id);
        $this->load->view('list_blogs', array(
            'articles' => $articles
        ));
    }
    public function delete_articles()
    {
        $ids = $this->input->get('ids');
        $rows = $this->article_model->delete_articles($ids);
        if ($rows > 0) {
            echo 'success';
        } else {
            echo 'fail';
        }
    }

    public function blog_catalogs()
    {
        $loginedUser = $this->session->userdata('loginedUser');
        $this->load->model('article_model');
        $articles = $this->article_model->get_ariticles_by_user($loginedUser->user_id);
        $types = $this->article_model->get_types_by_user($loginedUser->user_id);
        $this->load->view('blog_catalogs', array(
            'articles' => $articles,
            'types' => $types
        ));
    }
    public function add_blog_catalog()
    {
        $type_name = htmlspecialchars($this->input->post('type_name'));
        $loginedUser = $this->session->userdata('loginedUser');
        $rows = $this->article_model->add_blog_catalog($type_name, $loginedUser->user_id);
        if ($rows > 0) {
            redirect('admin/blog_catalogs');
        } else {
            echo 'fail';
        }
    }
    public function get_article_type(){
        $type_id=$this->input->get('type_id');
        $user_id = $this->session->userdata('loginedUser')->user_id;
        $row = $this->article_model->get_article_type($type_id);
        $types = $this->article_model->get_types_by_user($user_id);
        if ($row ) {
            $this->load->view('editCatalog',array(
                'row'=>$row,
                'types' => $types
            ));
        }
    }
    public function updata_type(){
        $type_id=$this->input->post('type_id');
        $type_name=$this->input->post('type_name');
        $rows = $this->article_model->updata_type($type_id,$type_name);
        if($rows){
            redirect('admin/blog_catalogs');
        }
    }
    public function delete_type(){
        $type_id=$this->input->get('type_id');
        $row = $this->article_model->delete_type($type_id);
        if($row){
            redirect('admin/blog_catalogs');
        }else{
            echo 'fail';
        }
    }

    public function get_blog_by_id(){
        $id=$this->input->get('id');
        $user_id = $this->session->userdata('loginedUser')->user_id;
        $results=$this->article_model->get_ariticles_by_user($user_id);
        $comment=$this->comment_model->get_comment_by_articleid($id);
        $prevArticle=null;
        $nextArticle=null;
        foreach ($results as $index=>$result){
          if ($id==$result->article_id){
              $row=$result;
              if($index>0){
                  $prevArticle=$results[$index-1];
              }
              if($index<count($results)-1){
                  $nextArticle=$results[$index+1];
              }
              break;
          }
        }if ($results){
                $this->load->view('viewPost',array(
                    'row'=>$row,
                    'prevArticle'=>$prevArticle,
                    'nextArticle'=>$nextArticle,
                    'comment_results'=>$comment
                ));
            }else{
                echo 'fail';
            }
        }

    public function save_comment(){
            $id=$this->input->post('id');
            $content=$this->input->post('content');
            $user_id = $this->session->userdata('loginedUser')->user_id;
            $rows=$this->comment_model->save($id,$content,$user_id);
            if($rows>0){
                redirect("admin/get_blog_by_id?id=$id");
            }else{
                echo 'fail';

            }
        }
    public function get_comment_to_me(){
        $user_id = $this->session->userdata('loginedUser') -> user_id;
        $results = $this->comment_model->get_comment($user_id);
        $this->load->library('pagination');//加载分页类
        $add = 'admin/get_comment_to_me';//调用本方法
        $count = count($results);//把评论的数量取出来
        $config = $this->page_config( $count, $add );//调用page_config方法
        $this->pagination->initialize($config);//加载分页，如果没有的话页面不能显示分页
        $data['page'] = $this->pagination->create_links();//创建连接
        $data['list'] = $this->comment_model->get_comment_limit( $config ['per_page'], $this->uri->segment(3),$user_id);
        //三个参数：每页显示几个评论；默认值，从第一个评论开始；从页面获取的user_id
//            echo $data['page'];
//            die();
        if($results){
            $this->load->view("blogComments",$data);//$data就是原来的array
            }
        }
    function page_config($count,$add){//////++++固定形式
        $config ['base_url'] = $add; //设置基地址
        $config ['total_rows'] = $count;
        $config ['per_page'] = 2; //每页显示的数据数量
        $config ['first_link'] = '首页';
        $config ['last_link'] = '末页';
        $config ['next_link'] = '下一页>';
        $config ['prev_link'] = '<上一页';
        return $config;
    }
    public function delete_comment(){
            $comment_id=$this->input->get('comment_id');
            $row=$this->comment_model->delete_comment($comment_id);
            if ($row>0){
                redirect('admin/get_comment_to_me');
            }else{
                echo 'fail';
            }

        }
    public function delete_all_comment(){
            $user_id = $this->session->userdata('loginedUser')->user_id;
            $commUser=$this->input->get('commUser');
            $row=$this->comment_model->delete_all_comment($commUser,$user_id);
            if ($row>0){
                redirect('admin/get_comment_to_me');
            }else{
                echo 'fail';
            }

        }
}