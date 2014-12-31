<?PHP
/** View SD Home
 * UR = user request , SD = Staff Dev , NNR = Notification New Request , CNR = Check New Request, DWR = Data Waiting Respond , SDH = 
 * VE = validation / warning error form
 *
 *
 *
 */
?>

<div class="row-fluid">
	<div class="span12">
		<h2>Cancel Request</h2>
	</div>
</div>

<div class="row-fluid">
	<div class="span12">
		<table class="table table-striped table-bordered font-12" id="example">
			<thead>
				<tr>
					<th style="text-align:center" width=14%>Request No #</th>
					<th style="text-align:center">Request Name</th>
					<th style="text-align:center" width=9%>Request Type</th>
					<th style="text-align:center" width=9%>Request Category</th>
					<th style="text-align:center" width=9%>Request Ref No #</th>
					<th style="text-align:center">Request PIC</th>
					<th style="text-align:center">Request Est. Time</th>
					<th style="text-align:center">Request Status Reason</th>
				</tr>
			</thead>
			<tbody>
				<?php
				foreach ($data_table as $d)
				{
					if (!empty($recent_update))
					{				
						foreach ($recent_update as $ru)
						{
							if ($d['REQ_NO']==$ru['REQ_NO'])
							{
								?><tr class="info"><?php
							}
						}
					}
					else
					{
						?><tr><?php
					}
					?>
						<td style="text-align:center"><?php echo $d['REQ_NO']; ?></td>
						<td><?php echo $d['REQ_NAME']; ?></td>
						<td style="text-align:center"><?php echo $d['TYPE_NAME']; ?></td>
						<td style="text-align:center"><?php echo $d['CATEGORY_NAME']; ?></td>
						<td><?php echo $d['REF_NO']; ?></td>
						<td style="text-align:center"><?php echo $d['PIC_FNAME']; ?></td>
						<td style="text-align:center"><?php echo $d['REQ_EST_TIME']; ?></td>
						<td><?php echo $d['STATUS_REASON']; ?></td>
					</tr>
					<?php
				}
				?>
			</tbody>
		</table>
	</div>
</div>