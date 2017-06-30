<?php
$loginedUser = $this->session->userdata('loginedUser');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xml:lang="zh-CN" xmlns="http://www.w3.org/1999/xhtml" lang="zh-CN">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="Content-Language" content="zh-CN">
    <title>修改登录密码</title>
    <base href="<?php echo site_url(); ?>">
    <link rel="stylesheet" href="assets/css/space2011.css" type="text/css" media="screen">
    <link rel="stylesheet" type="text/css" href="assets/css/jquery.css" media="screen">
    <style type="text/css">
        body, table, input, textarea, select {
            font-family: Verdana, sans-serif, 宋体;
        }
    </style>
</head>
<body>
<!--[if IE 8]>
<style>ul.tabnav {
    padding: 3px 10px 3px 10px;
}</style>
<![endif]-->
<!--[if IE 9]>
<style>ul.tabnav {
    padding: 3px 10px 4px 10px;
}</style>
<![endif]-->
<div id="OSC_Screen"><!-- #BeginLibraryItem "/Library/OSC_Banner.lbi" -->
    <?php include 'admin_header.php'; ?>
    <div id="OSC_Content">
        <div id="AdminScreen">
            <div id="AdminPath">
                <a href="index_logined.htm">返回我的首页</a>&nbsp;»
                <span id="AdminTitle">修改登录密码</span>
            </div>
            <?php include 'admin_menu.php'; ?>
            <div id="AdminContent">
                <div class="MainForm">
                    <form class="AutoCommitJSONForm" action="welcome/update_password" method="POST">
                        <h2>修改我的登录密码</h2>
                        <table width="100%">
                            <tbody>
                            <tr>
                                <th width="110">旧的登录密码</th>
                                <td>
                                    <input name="password" size="20" class="TEXT" tabindex="1" type="password" id="old_pwd">&nbsp;&nbsp;&nbsp;&nbsp;
                                    <span id="pwd"></span>
                                    <a href="#" target="_blank">忘记登录密码</a>
                                </td>
                            </tr>
                            <tr>
                                <th>新密码</th>
                                <td><input name="new_password" size="20" class="TEXT" tabindex="2" type="password" id="new_password"></td>
                                <span id="npwd"></span>
                            </tr>
                            <tr>
                                <th>再次输入新密码</th>
                                <td><input name="new_password2" size="20" class="TEXT" tabindex="3" type="password" id="new_password2"></td>
                                <span id="npwd2"></span>
                            </tr>
                            <tr>
                                <th colspan="2"></th>
                            </tr>
                            <tr class="submit">
                                <th></th>
                                <td>
                                    <input value="修改密码" class="BUTTON SUBMIT" tabindex="4" type="submit">
                                    <span id="error_msg" style="display:none"></span>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </form>
                </div>
            </div>
            <div class="clear"></div>
        </div>
    </div>
    <div class="clear"></div>
    <div id="OSC_Footer">© 唯创网讯</div>
</div>
<script src="assets/js/jquery-1.11.3.min.js"></script>
<script>
    $(function(){
        $('#old_pwd').on('keyup', function(
            $.get('welcome/check_password', {
                password: this.value
            }, function(){
                if(data == 'success'){
                    $('#pwd').html('√');
                }else{
                    $('#pwd').html('您输入的密码不正确！');
                }
            },'text'));
        $('#new_password').on('keyup', function(){
            if(4 >= this.value.length){
                $('#npwd').html('至少四位!');
                if (this.value==<?php echo $loginedUser->password?>){
                    $('#npwd').html('密码不能与原密码一致!');
                }
            }else{
                $('#npwd').html('√');
            }
        });
        $('#new_password2').on('blur', function(){
            if(this.value != $('#password').val()){
                $('#npwd2').html('两次密码不一致!');
            }else{
                $('#npwd2').html('√');
            }
        });
    }
</script>
</body>
</html>