
<head>
<style type="text/css">
.style1 {
	text-align: center;
}
.style2 {
	text-decoration: none;
}
.style3 {
	font-family: Verdana;
	font-size: small;
}
</style>
</head>

<body background="../../images/scan0005.jpg">

<table width="400" border="0" align="center" background="../../images/scan0005.jpg" cellpadding="3" cellspacing="0">

<form id="form1" name="form1" method="post" onsubmit="return checkForm(this);" action="captchahandle.php">
<td>
<table border="0" cellpadding="3" cellspacing="1" background="../../images/scan0005.jpg" style="width: 514px">
<tr>
<td style="width: 63px">Name</td>
<td width="14">:</td>
<td width="357"><input name="name" type="text" id="name" size="40" /></td>
</tr>
<tr>
<td valign="top" style="width: 63px">Comment</td>
<td valign="top">:</td>
<td><textarea name="comment" cols="40" rows="3" id="comment"></textarea></td>
</tr>
<tr>
<td valign="top" style="width: 63px">&nbsp;</td>
<td valign="top">&nbsp;</td>
<td>
<p><img id="captcha" src="captcha.php" width="120" height="30" border="1" alt="CAPTCHA">
<small><a href="#" onclick="
  document.getElementById('captcha').src = '/captcha.php?' + Math.random();
  document.getElementById('captcha_code').value = '';
  return false;
"></a></small></p>
<p>
<input id="captcha_code" type="text" name="captcha" size="6" maxlength="5" onkeyup="this.value = this.value.replace(/[^\d]+/g, '');" class="style3"> 
<span class="style3">Copy the digits from the image into this box.</span></p>
</td>
</tr>
<tr>
<td style="width: 63px">&nbsp;</td>
<td>&nbsp;</td>
<td><input type="submit" name="Submit" value="Submit" /> <input type="reset" name="Submit2" value="Reset" /></td>
</tr>
</table>
</td>
</form>


</tr>
</table>

<p class="style1">
&nbsp;</p>


