<div class="panel panel-default">
    <div class="panel-heading">
    	<h1 class="panel-title">A PHP Error Was Encountered</h1>
    </div>
    <div class="table-responsive">
		<table class="table table-hover table-condensed">
			<tbody>
				<tr>
					<th>Severity</th>
					<td><?php echo $severity; ?></td>
				</tr>
				<tr>
					<th>Message</th>
					<td><?php echo $message; ?></td>
				</tr>
				<tr>
					<th>Filename</th>
					<td><?php echo $filepath; ?></td>
				</tr>
				<tr>
					<th>Line Number</th>
					<td><?php echo $line; ?></td>
				</tr>
			</tbody>
		</table>
    </div>
</div>