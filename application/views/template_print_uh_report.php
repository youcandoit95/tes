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
		<title>Print Report Request - IT Development System</title>
		<link rel="shortcut icon" href="<?php echo base_url().'images/favicon.ico';?>">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url().'css/print_request_pdf.css'; ?>" >
		<link href="<?php echo base_url().'bootstrap/css/bootstrap.css';?>" rel="stylesheet" media="screen">
	</head>
	<body>
		<center>
			<div class="main_container">
				
				<div class="width-100 border-bottom-double">
					<div class="width-30 text-left"><img valign="middle" src="<?php echo base_url().'images/jne_pure.png';?>" width=150 height=75></div>
					<div class="width-68 text-24px text-right PT-25px height-50 ">REPORT REQUEST - IT DEVELOPMENT SYSTEM</div>
				</div>
				
				<div class="width-100">
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