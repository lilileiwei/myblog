<?php
$loginedUser = $this->session->userdata('loginedUser');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="Content-Language" content="zh-CN">
  <title><?php echo $row->title?></title>
    <base href="<?php echo site_url(); ?>">
    <link rel="stylesheet" href="assets/css/space2011.css" type="text/css" media="screen">
    <link rel="stylesheet" type="text/css" href="assets/css/jquery.css" media="screen">
  <script type="text/javascript" src="assets/js/jquery-1.11.3.min.js"></script
  <style type="text/css">
    body,table,input,textarea,select {font-family:Verdana,sans-serif,宋体;}	
  </style>
</head>
<body>
<!--[if IE 8]>
<style>ul.tabnav {padding: 3px 10px 3px 10px;}</style>
<![endif]-->
<!--[if IE 9]>
<style>ul.tabnav {padding: 3px 10px 4px 10px;}</style>
<![endif]-->
<div id="OSC_Screen"><!-- #BeginLibraryItem "/Library/OSC_Banner.lbi" -->
    <?php include 'admin_header.php'; ?>
	<div id="OSC_Content"><div class="SpaceChannel">
	<div id="portrait"><a href="#"><img src="assets/images/portrait.gif" alt="Johnny" title="Johnny" class="SmallPortrait" user="154693" align="absmiddle"></a></div>
    <div id="lnks">
		<strong><?php echo $loginedUser->username?>的博客</strong>
		<div>
			<a href="#">TA的博客列表</a>&nbsp;|
			<a href="javascript:sendmsg(154693)">发送留言</a>
</span>
		</div>
	</div>
	<div class="clear"></div>
</div>
<div class="Blog">
  <div class="BlogTitle">
    <h1><?php echo $row->title;?></h1>
    <div class="BlogStat">
					    <span class="admin">
		<em id="p_attention_count">1</em>人收藏此文章，
		<span id="attention_it">
					<a href="javascript:pay_attention(24026,true)">收藏此文章</a>
				</span>
	    </span>
				发表于<?php echo $row->post_date;?>
		已有<strong>1</strong>次阅读  
		共<strong><a href="#comments">0</a></strong>个评论
		<strong>1</strong>人收藏此文章
	</div> 
  </div>
  <div class="BlogContent TextContent"><?php echo $row->content;?></div>
      <div class="BlogLinks">
	<ul>
        <?php if($prevArticle){ ?>
          <li>上篇 <span>(54分钟前)</span>：<a href="admin/get_blog_by_id?id=<?php echo $prevArticle->article_id;?>" class="prev"><?php echo $prevArticle->title;?></a></li>
        <?php } ?>
        <?php if($nextArticle){ ?>
            <li>下篇 <span>(54分钟前)</span>：<a href="admin/get_blog_by_id?id=<?php echo $nextArticle->article_id;?>" class="prev"><?php echo $nextArticle->title;?></a></li>
        <?php } ?>
    </ul>
  </div>
    <div class="BlogComments">
        <h2><a name="comments" href="#postform" class="opts">发表评论»</a>共有 <?php echo count($comment_results)?> 条网友评论</h2>
        <ul id="BlogComments">
            <?php foreach ($comment_results as $comment){?>
            <li id='cmt_24027_154693_261665734'>
                <div class='portrait'>
                    <a href="#"><img src="assets/images//portrait.gif" align="absmiddle" alt="sw0411" title="sw0411" class="SmallPortrait" user="154693"/></a>
                </div>
                <div class='body'>
                    <div class='title'>
                        <?php echo $comment->username?> 发表于 <?php echo $comment->post_date?></div>
                    <div class='post'><?php echo $comment->content?></div>
                    <div id='inline_reply_of_24027_154693_261665734' class='inline_reply'></div>
                </div>
                <div class='clear'></div>
            </li>
            <?php }?>
        </ul>
    </div>
    <div class="CommentForm">
        <a name="postform"></a>
        <form id="form_comment" action="admin/save_comment" method="POST">
            <textarea id="ta_post_content" name="content" style="width: 450px; height: 100px;"></textarea><br>
            <input value="发表评论" id="btn_comment" class="SUBMIT" type="submit">
            <input type="hidden" value="<?php echo $row->article_id?>" name="id">
            <img id="submiting" style="display: none;" src="assets/images/loading.gif" align="absmiddle">
            <span id="cmt_tip">文明上网，理性发言</span>
        </form>
        <a href="#" class="more">回到顶部</a>
        <a href="#comments" class="more">回到评论列表</a>
    </div>
</div>
<div class="BlogMenu"><div class="RecentBlogs SpaceModule">
	<strong>最新博文</strong><ul>
    		<li><a href="#">测试文章2</a></li>
				<li><a href="#">测试文章1</a></li>
			<li class="more"><a href="index.htm">查看所有博文»</a></li>
    </ul>
</div>
</div>
<div class="clear"></div>
<div id="inline_reply_editor" style="display:none;">
<div class="CommentForm">
	<form id="form_inline_comment" action="/xxx" method="POST">
	  <input id="inline_reply_id" name="reply_id" value="" type="hidden">          
      <textarea name="content" style="width: 450px; height: 60px;"></textarea><br>
	  <input value="回复" id="btn_comment" class="SUBMIT" type="submit"> 
	  <input value="关闭" class="SUBMIT" id="btn_close_inline_reply" type="button"> 文明上网，理性发言
    </form>
</div>
</div>
</div>
	<div class="clear"></div>
	<div id="OSC_Footer">© 唯创网讯</div>
</div>
</body></html>