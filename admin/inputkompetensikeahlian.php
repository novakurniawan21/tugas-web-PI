<?php require_once('../Connections/siswa.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO kompetensi_keahlian (kompetensi_kode, bidang_kode, kompetensi_nama) VALUES (%s, %s, %s)",
                       GetSQLValueString($_POST['kompetensi_kode'], "text"),
                       GetSQLValueString($_POST['bidang_kode'], "text"),
                       GetSQLValueString($_POST['kompetensi_nama'], "text"));

  mysql_select_db($database_siswa, $siswa);
  $Result1 = mysql_query($insertSQL, $siswa) or die(mysql_error());

  $insertGoTo = "tampilkompetensikeahlian.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form2")) {
  $insertSQL = sprintf("INSERT INTO kompetensi_keahlian (kompetensi_kode, bidang_kode, kompetensi_nama) VALUES (%s, %s, %s)",
                       GetSQLValueString($_POST['kompetensi_kode'], "text"),
                       GetSQLValueString($_POST['bidang_kode'], "text"),
                       GetSQLValueString($_POST['kompetensi_nama'], "text"));

  mysql_select_db($database_siswa, $siswa);
  $Result1 = mysql_query($insertSQL, $siswa) or die(mysql_error());

  $insertGoTo = "tampilkompetensikeahlian.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

$colname_KK = "-1";
if (isset($_GET['kompetensi_kode'])) {
  $colname_KK = $_GET['kompetensi_kode'];
}
mysql_select_db($database_siswa, $siswa);
$query_KK = sprintf("SELECT * FROM kompetensi_keahlian WHERE kompetensi_kode = %s ORDER BY kompetensi_kode ASC", GetSQLValueString($colname_KK, "text"));
$KK = mysql_query($query_KK, $siswa) or die(mysql_error());
$row_KK = mysql_fetch_assoc($KK);
$totalRows_KK = mysql_num_rows($KK);

mysql_select_db($database_siswa, $siswa);
$query_BS = "SELECT * FROM bidang_studi ORDER BY bidang_kode ASC";
$BS = mysql_query($query_BS, $siswa) or die(mysql_error());
$row_BS = mysql_fetch_assoc($BS);
$totalRows_BS = mysql_num_rows($BS);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<!--
Design by Free CSS Templates
http://www.freecsstemplates.org
Released for free under a Creative Commons Attribution 2.5 License

Name       : Rock CastleDescription: A two-column, fixed-width design with dark color scheme.
Version    : 1.0
Released   : 20111127

-->
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>Ratih Radiyanti</title>
<link href="../style.css" rel="stylesheet" type="text/css" media="screen" />
<link href="http://fonts.googleapis.com/css?family=Arvo" rel="stylesheet" type="text/css" />
<link href='http://fonts.googleapis.com/css?family=Cookie' rel='stylesheet' type='text/css'>
<style type="text/css">
<!--
.style1 {
	font-family: Georgia, "Times New Roman", Times, serif;
	font-size: x-large;
}
.style2 {
	font-family: Arial, Helvetica, sans-serif
}
-->
</style>
</head>
<body>
<div id="header" class="container">
	<div id="logo"><br />
		<h1><a href="#">
		<span class="style2">SMK Negeri 2 Salatiga</span>
		</a></h1>
  </div>
	<div id="menu">
		<ul>
			<li class="current_page_item"><a href="../index.html">Home</a></li>
			<li><a href="../sejarah.html">Profil</a></li>
			<li><a href="../siswa.html">Siswa</a></li>
			<li><a href="../artikel.php">artikel</a></li>
			<li><a href="../agenda.html">agenda kelas xii</a></li>
            <li><a href=""><a href="tampil.php"><blink><em><strong>LIHAT DATA</strong></em></a></blink></a></li>
      </ul>
	</div>
</div>
<div id="splash-wrapper">
	<div id="splash">
		<h4 class="style1 style2"><marquee><blink>PREPARE FAITHFUL GRADUATES WHO CAN COMPETE IN THE GLOBAL WORLD</blink></marquee></h4>
  </div>
</div>
<!-- end #header -->
<div id="wrapper">
	<div id="wrapper2">
		<div id="wrapper-bgtop">
			<div id="page">
				<div id="content">
				  <div class="post">
                        <center>
						    <h3>KOMPETENSI KEAHLIAN</h3>
				        </center>
					  <hr />
					  <form action="<?php echo $editFormAction; ?>" method="post" id="form2">
                        <table>
                          <tr valign="baseline">
                            <td align="right">Kode Kompetensi:</td>
                            <td><input type="text" name="kompetensi_kode" value="<?php echo $row_KK['kompetensi_kode']; ?>" size="32" /></td>
                          </tr>
                          <tr valign="baseline">
                            <td align="right">Kode Bidang:</td>
                            <td><select name="bidang_kode">
                                <?php 
do {  
?>
                                <option value="<?php echo $row_BS['bidang_kode']?>" <?php if (!(strcmp($row_BS['bidang_kode'], $row_BS['bidang_kode']))) {echo "SELECTED";} ?>><?php echo $row_BS['bidang_kode']?></option>
                                <?php
} while ($row_BS = mysql_fetch_assoc($BS));
?>
                              </select>
                            </td>
                          </tr>
                          <tr> </tr>
                          <tr valign="baseline">
                            <td align="right">Nama Kompetensi:</td>
                            <td><input type="text" name="kompetensi_nama" value="<?php echo $row_KK['kompetensi_nama']; ?>" size="32" /></td>
                          </tr>
                          <tr valign="baseline">
                            <td align="right">&nbsp;</td>
                            <td><input type="submit" value="Masukan" /></td>
                          </tr>
                        </table>
                        <input type="hidden" name="MM_insert" value="form2" />
                      </form>
                      <p>&nbsp;</p>
				  </div>
			  </div>
				<!-- end #content -->
				<div id="sidebar">
					<div id="sidebar-bgtop">
						<div id="sidebar-bgbtm">
							<ul>
								<li>
									<div id="search" >
										<form method="get" action="#">
											<div>
												<input type="text" name="s" id="search-text" value="" />
												<input type="submit" id="search-submit" value="GO" />
											</div>
										</form>
									</div>
									<div style="clear: both;">&nbsp;</div>
								</li>
								<li>
									<h2 align="justify">Menu</h2>
									<p><a href="inputbidngstudi.php">1. Bidang Studi</a><a href=""><br />
									</a><a href="inputkompetensikeahlian.php">2.Kompetensi Keahlian</a><a href=""><br />
		                            </a><a href="inputstandarkompetensi.php">3. Standart Kompetensi</a><a href=""><br />
		                            </a><a href="inputsiswa.php">4. Siswa</a><a href=""><br />
		                            </a><a href="inputguru.php">5. Guru</a><a href=""><br />
                                    </a><a href="inputnilai.php">5. Nilai</a><a href=""><br />
		                            </a><a href="inputwalimurid.php">6. Wali Murid</a><a href=""></a>	
								</li>
	                      </ul>
					  </div>
				  </div>
				</div>
				<!-- end #sidebar -->
				<div style="clear: both;">&nbsp;</div>
			</div>
			<!-- end #page -->
		</div>
	</div>
</div>
<div id="footer">
	<div class="content">
		<p>Copyright (c) 2013 Sitename.com. All rights reserved. Design by Ratih</p>
  </div>
</div>
<!-- end #footer -->
<form action="<?php echo $editFormAction; ?>" method="post" id="form1">
  <input type="hidden" name="MM_insert" value="form1" />
</form>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($KK);

mysql_free_result($BS);
?>
