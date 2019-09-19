<table class="table table-striped table-bordered" border="1" cellpadding="8" id="myTable">
  <thead>
    <tr>
		<th width="400">Kd Bangsal</th>
		<th width="700">Nm Bangsal</th>
		<th width="400">Status</th>
		<th width="400">Actions</th>
    </tr>
    </thead>
    <tbody>
	<?php foreach($bangsal as $b){ ?>
    <tr>
		<td><?php echo $b['kd_bangsal']; ?></td>
		<td><?php echo $b['nm_bangsal']; ?></td>
		<td><?php echo $b['status']; ?></td>
		<td>
            <a href="<?php echo site_url('bangsal/edit/'.$b['kd_bangsal']); ?>" class="btn btn-info btn-xs">Edit</a> 
            <a href="<?php echo site_url('bangsal/remove/'.$b['kd_bangsal']); ?>" class="btn btn-danger btn-xs">Delete</a>
        </td>
    </tr>
	<?php } ?>
  </tbody>
</table>