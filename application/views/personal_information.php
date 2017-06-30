<?php
$loginedUser = $this->session->userdata('loginedUser');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xml:lang="zh-CN" xmlns="http://www.w3.org/1999/xhtml" lang="zh-CN">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="Content-Language" content="zh-CN">
  <title>会员资料设置</title>
	<base href="<?php echo site_url(); ?>">
    <link rel="stylesheet" href="assets/css/space2011.css" type="text/css" media="screen">
    <link rel="stylesheet" type="text/css" href="assets/css/jquery.css" media="screen">
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
		<div id="OSC_Content">
			<div id="AdminScreen">
				<div id="AdminPath">
					<a href="welcome/index">返回我的首页</a>&nbsp;»
					<span id="AdminTitle">会员资料设置</span>
				</div>
				<?php include 'admin_menu.php'; ?>
				<div id="AdminContent">
				<ul class="tabnav">
					<li class="current"><a href="#">会员基本资料</a></li>
				</ul>

				<div class="MainForm">
				<form class="AutoCommitJSONForm" action="/action/profile/update_basic_info" method="POST">
					<table>
						<tbody>
							<tr>
								<th>登录帐号</th>
								<td><?php echo $loginedUser->email?></td>
							</tr>
							<tr>
								<th>姓名</th>
								<td>
									<input name="name" size="20" maxlength="20" class="TEXT" value="<?php echo $loginedUser->username?>" type="text">
									<span class="Info" id="name_msg">不能超过10个字</span>
								</td>
							</tr>
							<tr>
								<th>性别</th>
								<td>
									<input name="gender" value="1" checked="checked" type="radio">男
									<input name="gender" value="2" type="radio">女
								</td>
							</tr>
							<tr>
								<th>出生年月</th>
								<td>
									<select name="y">
										<option selected="selected" value="0">--</option><option value="2001">2001</option><option value="2000">2000</option><option value="1999">1999</option><option value="1998">1998</option><option value="1997">1997</option><option value="1996">1996</option><option value="1995">1995</option><option value="1994">1994</option><option value="1993">1993</option><option value="1992">1992</option><option value="1991">1991</option><option value="1990">1990</option><option value="1989">1989</option><option value="1988">1988</option><option value="1987">1987</option><option value="1986">1986</option><option value="1985">1985</option><option value="1984">1984</option><option value="1983">1983</option><option value="1982">1982</option><option value="1981">1981</option><option value="1980">1980</option><option value="1979">1979</option><option value="1978">1978</option><option value="1977">1977</option><option value="1976">1976</option><option value="1975">1975</option><option value="1974">1974</option><option value="1973">1973</option><option value="1972">1972</option><option value="1971">1971</option><option value="1970">1970</option><option value="1969">1969</option><option value="1968">1968</option><option value="1967">1967</option><option value="1966">1966</option><option value="1965">1965</option><option value="1964">1964</option><option value="1963">1963</option><option value="1962">1962</option><option value="1961">1961</option><option value="1960">1960</option><option value="1959">1959</option><option value="1958">1958</option><option value="1957">1957</option><option value="1956">1956</option><option value="1955">1955</option><option value="1954">1954</option><option value="1953">1953</option><option value="1952">1952</option><option value="1951">1951</option><option value="1950">1950</option>
									</select> 年
									<select name="m">
										<option selected="selected" value="0">--</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option><option value="11">11</option><option value="12">12</option>
									</select> 月
									<select name="d">
										<option selected="selected" value="0">--</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option><option value="11">11</option><option value="12">12</option><option value="13">13</option><option value="14">14</option><option value="15">15</option><option value="16">16</option><option value="17">17</option><option value="18">18</option><option value="19">19</option><option value="20">20</option><option value="21">21</option><option value="22">22</option><option value="23">23</option><option value="24">24</option><option value="25">25</option><option value="26">26</option><option value="27">27</option><option value="28">28</option><option value="29">29</option><option value="30">30</option><option value="31">31</option>
									</select> 日
								</td>
							</tr>
							<tr>
								<th>居住地区</th>
								<td>
									<select name="province" id="province">
										<option value="-1">请选择省份</option>
									</select>
									<select name="city" id="city">
										<option value="-1">请选择城市</option>
									</select>
									<span id="area_msg"></span>
								</td>
							</tr>
							<tr>
								<th>个性签名<br>不超过100字</th>
								<td><textarea name="signature" style="width: 300px; height: 100px;" class="TEXT"></textarea></td>
							</tr>
							<tr><th colspan="2"></th></tr>
							<tr class="submit">
								<th></th>
								<td>
								<input value="保存修改" class="BUTTON SUBMIT" type="submit">
								<span id="error_msg" style="display:none"></span>
								</td>
							</tr>
						</tbody>
					</table>
				</form>
			</div>
				<div class="clear"></div>
			</div>
			</div>
			<div class="clear"></div>
			<div id="OSC_Footer">© 唯创网讯</div>
		</div>
	</div>

	<script src="assets/js/jquery-1.11.3.min.js"></script>
	<script src="assets/js/city.js"></script>
	<script>
		$(function(){
			//初始化省市二级联动
			ganged.init({
				provinceSelector: '#province',
				citySelector: '#city'
			});});
	</script>
</body>
</html>