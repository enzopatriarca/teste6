<?php ?>
<html>
<head><title>Consulta</title>
</head>
<script language="javascript" src="js/alttxt.js"></script>
<script language="javascript" src='js/abre_popup.js'></script>
<script type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="css/styles.css">
</head>
<body class="bod">
<p>

<p>

<center>
<h2 class="titulo1">SITT.AA - Troubleshoting Switch Bandwidth Meter</h2>
<h2 class="titulo2">Consulta e desbloqueio de interface</h2>

@if(Auth::check())

	<?php	
	$user = Auth::user();
	?>
	<div class="alert alert-danger success-block">
	<h3 style="display: flex; font-size: 15px; font-family: fangsong;">Usuario: {{$user->name}}</h3> 
	<a style="display: flex;" href="{{ url('/logout') }}"><h3 style="font-size: 15px; font-family: fangsong;">Logout</h3></a>
@else 
	<script>window.location = "/teste6/public/login"</script>
@endif


<p>
<form name ="consulta" id="consulta" action="" method=post>
	@csrf
<table style="margin-left: 82px" cellpadding="1" cellspacing="10" border="0">
	<tr><td class="td1" bgcolor="#00bfff"><label form="consulta"> Select Device </label></td></tr>
	<tr><td>
	<select name="swadd" id="swadd" form="consulta" multiple="multiple">
  		<option class="op1" value='172.21.145.100' selected="selected">Distribui&ccedil;&atilde;o D14EDGE01</option>
  		<option class="op2" value='172.21.145.105'>Acesso D14_BANDWIDTH_METER</option>
	</select>
	</td></tr>
	<tr><th style="background-color: white;"><input class="botao" name=submit type=submit value="Consultar"></th></tr>
</table>
<input type="hidden" id="comando" name="comando" value="sh_int_status">
<input type="hidden" id="parans" name="parans" value=''>
</form>

<p style="display: flex;">Distribuição D14EDGE01: "descrição " </p>
<p style="display: flex;">Acesso D14_BANDWIDTH_METER: "descrição " </p>

</center>
<?php
	if (isset($_POST["swadd"]) && !empty($_POST["swadd"])) {
		$switch=$_POST["swadd"];
		$comando=$_POST["comando"];
		$parans=$_POST["parans"];
		echo  date (" Y-m-d H:i:s")."<br><br>";
		echo " Sw: $switch<br><br>";
		consulta($switch, $comando, $parans);
    }
	function format_mac($mac, $format='linux'){
	        $mac = preg_replace("/[^a-fA-F0-9]/",'',$mac);
	        $mac = (str_split($mac,2));
	        if(!(count($mac) == 6))
        	        return false;
	        if($format == 'linux' || $format == ':'){
        	        return $mac[0]. ":" . $mac[1] . ":" . $mac[2]. ":" . $mac[3] . ":" . $mac[4]. ":" . $mac[5];
	        }elseif($format == 'windows' || $format == '-'){
        	        return $mac[0]. "-" . $mac[1] . "-" . $mac[2]. "-" . $mac[3] . "-" . $mac[4]. "-" . $mac[5];
	        }elseif($format == 'cisco'){
        	        return $mac[0] . $mac[1] . "." . $mac[2] . $mac[3] . "." . $mac[4] . $mac[5];
	        }else{
        	        return $mac[0]. "$format" . $mac[1] . "$format" . $mac[2]. "$format" . $mac[3] . "$format" . $mac[4]. "$format" . $mac[5];
	        }
	}
	function iptoname($info) {
	$lines=file("hosts");
        if (preg_match('/^\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}$/', $info, $ip_matches)) {
                foreach ($lines as $line) {
                        if (stripos($line, $info) !== false) {
                                $names = preg_split("/[\t]/", $line);
                                $name = preg_replace('/[\r\n]+/','',$names[2]);
                        }
                }
        } else  {
                $name=$info;
        }
	return $name;
	}
	function consulta($switch, $comand, $parans) {
		$data = file_get_contents("http://localhost/cgi-bin/int_sh_int_status.cgi?roteador='$switch'&comando='$comand'&parans='$parans'",0);
		echo $data;
	}
echo "</body>";
echo "</html>";
?>
