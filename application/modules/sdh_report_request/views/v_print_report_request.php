
	<div class="width-100 MT-10px ">
		<table class="text-12px width-30" border=1 cellpadding=4>
			<tr>
				<td style="padding:6px; width:45%">Date Period</td>
				<td style="padding:6px;"><?php echo $p_date_from==""&&$p_date_thru=="" ? "ALL" : $p_date_from." s/d ".$p_date_thru; ?></td>
			</tr>
			<tr>
				<td style="padding:6px; width:45%">Request Type</td>
				<td style="padding:6px;"><?php echo empty($p_req_type) ? "ALL" : $p_req_type; ?></td>
			</tr>
			<tr>
				<td style="padding:6px; width:45%">Request Category</td>
				<td style="padding:6px;"><?php echo empty($p_req_category) ? "ALL" : $p_req_category; ?></td>
			</tr>
			<tr>
				<td style="padding:6px; width:45%">Request By</td>
				<td style="padding:6px;"><?php echo $p_req_by_translate; ?></td>
			</tr>
			<tr>
				<td style="padding:6px; width:45%">Request PIC</td>
				<td style="padding:6px;"><?php echo $p_req_pic; ?></td>
			</tr>
		</table>
	</div>

	<div class="width-100 MT-10px ">
		<table class="text-12px width-100" border=1 cellspacing=4>
			<thead>
				<tr>
					<th style="text-align:center">No.</th>
					<th style="text-align:center; width:180px; padding:10px;">Request No #</th>
					<th style="text-align:center" width=20%>Request Name</th>
					<th style="text-align:center" width=9%>Request Type</th>
					<th style="text-align:center" width=9%>Request Category</th>
					<th style="text-align:center">Ref No #</th>
					<th style="text-align:center">PIC</th>
					<th style="text-align:center">Status</th>
					<th style="text-align:center">Date Created</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$n=1;
				foreach ($result_generate as $d)
				{
					?>
					<tr>
						<td style="text-align:center"><?php echo $n; ?></td>
						<td style="text-align:center; padding:10px;"><?php echo $d['REQ_NO']; ?></td>
						<td style="padding-left:5px;"><?php echo $d['REQ_NAME']; ?></td>
						<td style="text-align:center"><?php echo $d['REQ_TYPE']; ?></td>
						<td style="text-align:center"><?php echo $d['REQ_CATEGORY']; ?></td>
						<td style="text-align:center"><?php echo $d['REF_NO']; ?></td>
						<td style="text-align:center"><?php echo $d['REQ_PIC']; ?></td>
						<td style="text-align:center"><?php echo $d['REQ_LSTATUS']; ?></td>
						<td style="text-align:center"><?php echo $d['REQ_CREATED']; ?></td>
					</tr>
					<?php
					$n++;
				}
				?>
			</tbody>
		</table>
	</div>