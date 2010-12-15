<?php if (basename(__FILE__) == basename($_SERVER['PHP_SELF'])) exit(0); ?>
<!doctype html>
<html dir="ltr">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>PHProxy</title>
	<script type="text/javascript" src="<?php echo $GLOBALS['_script_base'] ?>pjs.js"></script>

<style type="text/css"> 
#error, #auth 
	{background: #eeeeee;
	border: 1px solid red;
	border-left: 5px solid red;
	margin: 5px;}
  
#address_bar 
	{background-color: #F2F3F7;
	text-align: center;
	padding: 5px;} 

#container
	{border-bottom: 2px solid #ACABC4;
	border-top: 2px solid #ACABC4;
	background-color: white;
	margin: 0 auto 0 auto;
	width: 70%;}
	
body, form, div, label 
	{padding: 0;margin: 0;} 
	
body, input
	{font-family: Tahoma, sans-serif;
	color: #333333;}

#error p, #auth p 
	{margin: 5px;}

input 
	{margin: 0;}

body 
	{font-size: 100%;}

div 
	{overflow: hidden;} 

a
	{text-decoration: none;}	
</style>
</head>

<body bgcolor="#293E71" onload="document.getElementById(10).focus()">
<br>
	<a href="http://phpr0xi.sourceforge.net/" style="color: white;margin: 0;padding: 0 0 0 15%;" title="<?php echo 'PHProxy v' . $GLOBALS['_version'] ?>"><big>PHProxy</big></a>

<div id="container">
<?php
switch ($data['category'])
{
case 'auth':
?>
<div id="auth"><p>
<b>Enter your username and password for "<?php echo htmlspecialchars($data['realm']) ?>" on <?php echo $GLOBALS['_url_parts']['host'] ?></b>
<form method="post" action="">
<input type="hidden" name="<?php echo $GLOBALS['_config']['basic_auth_var_name'] ?>" value="<?php echo base64_encode($data['realm']) ?>" />
<label>Username <input type="text" name="username" value="" /></label> <label>Password <input type="password" name="password" value="" /></label> <input type="submit" value="Login" />
</form></p></div>
<?php
        break;
    case 'error':
        echo '<div id="error"><p>';
        
        switch ($data['group'])
        {
            case 'url':
                echo '<b>URL Error (' . $data['error'] . ')</b>: ';
                switch ($data['type'])
                {
                    case 'internal':
                        $message = 'Failed to connect to the specified host. '
                                 . 'Possible problems are that the server was not found, the connection timed out, or the connection refused by the host. '
                                 . 'Try connecting again and check if the address is correct.';
                        break;
                    case 'external':
                        switch ($data['error'])
                        {
                            case 1:
                                $message = 'The URL you\'re attempting to access is blacklisted by this server. Please select another URL.';
                                break;
                            case 2:
                                $message = 'The URL you entered is malformed. Please check whether you entered the correct URL or not.';
                                break;
                        }
                        break;
                }
                break;
            case 'resource':
                echo '<b>Resource Error:</b> ';
                switch ($data['type'])
                {
                    case 'file_size':
                        $message = 'The file your are attempting to download is too large.<br />'
                                 . 'Maxiumum permissible file size is <b>' . number_format($GLOBALS['_config']['max_file_size']/1048576, 2) . ' MB</b><br />'
                                 . 'Requested file size is <b>' . number_format($GLOBALS['_content_length']/1048576, 2) . ' MB</b>';
                        break;
                    case 'hotlinking':
                        $message = 'It appears that you are trying to access a resource through this proxy from a remote Website.<br />'
                                 . 'For security reasons, please use the form below to do so.';
                        break;
                }
                break;
        }
        echo 'An error has occured while trying to browse through the proxy. <br />' . $message . '</p></div>';
        break;
}
?>

<form method="POST" action="<?php echo $GLOBALS['_script_url'] ?>" name="PHProxy" onsubmit="return PR0XY_G0();" target="_blank"><br>
 <div id="address_bar">
  <label>
	Web Address: <input type="text" style="width: 66%;" dir="ltr" name="<?php echo $GLOBALS['_config']['url_var_name'] ?>" id="10" value="<?php echo isset($GLOBALS['_url']) ? htmlspecialchars($GLOBALS['_url']) : '' ?>" onfocus="this.select()">
	<noscript><input type="submit" value="Go" name="go" onclick="PR0XY_G0();"></noscript>
	<script>document.writeln('<input type="button" value="Go" name="go" onclick="PR0XY_G0();">');</script>
	<script>document.writeln('<input type="button" value="Google" name="B1" onclick="G00GLE()">');</script>
  </label>
 </div>
</form>

<script>
	document.writeln('<label>');
	document.writeln('&nbsp;<input type="checkbox" onclick="New_Wind0w();" id="20">');
	document.writeln('<small>Open URL in a new window</small>');
	document.writeln('</label>');
	document.PHProxy.method = 'GET';
	if(!document.PHProxy.elements[0].value){document.getElementById(20).checked = true;} else {New_Wind0w();}
</script>

<noscript>
	<br>
</noscript>
</div>
</body>
</html>
<!-- PHProxy v0.6 2010 - http://phpr0xi.sourceforge.net -->