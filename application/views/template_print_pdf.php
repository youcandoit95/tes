<?php
$user_agent = $_SERVER['HTTP_USER_AGENT']; 
if (preg_match('/Chrome/i', $user_agent))
{ } 
else 
{ echo"Tolong gunakan web browser Google Chrome<br>Terima Kasih";
 exit;
}
?>
<html>
	<head>
		<title><?php echo $title_page; ?> - IT Development System</title>
		<link rel="shortcut icon" href="<?php echo base_url().'images/favicon.ico';?>">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url().'css/print_request_pdf.css'; ?>" >
	</head>
	<body>
		<center>
			<div class="main_container">
				
				<div class="width-100">
					<table width="100.2%" align="center" style="text-align:center" cellspacing=0 cellpadding=0>
						<tr>
							<td class="width-30 border2" rowspan=6 align="center"><img valign="middle" src="<?php echo base_url().'images/jne_pure.png';?>" width=200 height=100></td>
						</tr>
						<tr>
							<td class="border"><b>REFERENSI TEMPAT KERJA</b></td>
						</tr>
						<tr>
							<td class="border"><b>PT TIKI JALUR NUGRAHA EKAKURIR</b></td>
						</tr>
						<tr>
							<td class="border"><b>FORM REQUEST PROJECT AND MAINTENANCE</b></td>
						</tr>
						<tr>
							<td class="border"><b>APPLICATIONS MYORION SYSTEM</b></td>
						</tr>
						<tr>
							<td class="border"><b>IT DEVELOPMENT SYSTEM</b></td>
						</tr>
					</table>
					<?php
					/*
					<div class="width-30">
						<img src="<?php echo base_url().'images/jne.jpg';?>">
					</div>
					<div class="width-70">
						<div class="width-100">
							<div class="width-98">REFERENSI TEMPAT KERJA</div>
							<div class="width-98">PT TIKI JALUR NUGRAHA EKAKURIR</div>
							<div class="width-98">FORM REQUEST PROJECT AND MAINTENANCE</div>
							<div class="width-98">APPLICATIONS MYORION SYSTEM</div>
							<div class="width-98">IT DEVELOPMENT SYSTEM</div>
						</div>
					</div>
					*/
					?>
				</div>
				
				<div class="width-100 border">
					<?php echo $this->load->view($content); ?>
				</div>
				
				<div class="width-100 MB-10px PL-15px text-10px">
					<div class="width-45 text-left"><i>Print by <?php echo $login_fname; ?></i></div>
					<div class="width-50 text-right"><i><?php echo date('d-m-Y H:i:s'); ?></i></div>
				</div>
				
				<div class="clear"></div>
			</div>
		</center>
	<?php
	/*$content = ob_get_clean();

	// convert to PDF
	require_once(dirname(__FILE__).'/PDF/html2pdf.class.php');
	try
	{
	$html2pdf = new HTML2PDF($pdf_type, $pdf_size, 'fr');
	$html2pdf->pdf->SetDisplayMode('fullpage');
	$html2pdf->writeHTML($content, isset($_GET['vuehtml']));
	$html2pdf->Output($pdf_name);
	}
	catch(HTML2PDF_exception $e) {
	echo $e;
	exit;
	}*/
	?>
	</body>
</html>