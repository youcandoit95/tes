
	<div class="width-100 MT-10px ">
		<table class="text-12px width-30" border=1 cellpadding=4>
			<tr>
				<td>Date Period</td>
				<td><?php echo $p_date_from." s/d ".$p_date_thru; ?></td>
			</tr>
			<tr>
				<td>Request Type</td>
				<td><?php echo empty($p_req_type) ? "ALL" : $p_req_type; ?></td>
			</tr>
			<tr>
				<td>Request Category</td>
				<td><?php echo empty($p_req_category) ? "ALL" : $p_req_category; ?></td>
			</tr>
		</table>
	</div>

	<div class="width-100 MT-10px ">
		<table class="text-12px width-100" border=1 cellpadding=4>
			<thead>
				<tr>
					<th style="text-align:center" width=14%>Request No #</th>
					<th style="text-align:center">Request Name</th>
					<th style="text-align:center" width=9%>Request Type</th>
					<th style="text-align:center" width=9%>Request Category</th>
					<th style="text-align:center" width=5%>Ref No #</th>
					<th style="text-align:center">PIC</th>
					<th style="text-align:center">Priority</th>
					<th style="text-align:center">Status</th>
					<th style="text-align:center">Date Created</th>
				</tr>
			</thead>
			<tbody>
				<?php
				foreach ($result_generate as $d)
				{
					?>
					<tr>
						<td style="text-align:center"><?php echo $d['REQ_NO']; ?></td>
						<td><?php echo $d['REQ_NAME']; ?></td>
						<td style="text-align:center"><?php echo $d['REQ_TYPE']; ?></td>
						<td style="text-align:center"><?php echo $d['REQ_CATEGORY']; ?></td>
						<td style="text-align:center"><?php echo $d['REF_NO']; ?></td>
						<td style="text-align:center"><?php echo $d['REQ_PIC']; ?></td>
						<td style="text-align:center"><?php echo $d['REQ_PRIORITY']; ?></td>
						<td style="text-align:center"><?php echo $d['REQ_LSTATUS']; ?></td>
						<td style="text-align:center"><?php echo $d['REQ_CREATED']; ?></td>
					</tr>
					<?php
				}
				?>
			</tbody>
		</table>
	</div>