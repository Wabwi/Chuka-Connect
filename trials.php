<?php
// $date = new DateTime();
// echo $date -> getTimestamp();
require_once 'includes/header.php';

//echo "<script>alert($total);</script>";
?>

<div class="content">
	<div class="p-4 p-md-5 pt-5">
		<div class="container well">

			<?php
			pagination('counties');

			// $result_counties = queryMysql("SELECT * FROM counties LIMIT $start, $limit");
			// $rows_counties = $result_counties -> fetch_all(MYSQLI_ASSOC);
			?>
			<div>
				<table class="table table-striped">
					<tr>
						<th>County Code</th>
						<th>County Name</th>
						
					</tr>

					<tbody>
						<?php foreach(ROWS_TABLE as $row_county): ?>
								<tr>
									<td><?php echo $row_county['county_id'] ?></td>
									<td><?php echo $row_county['county_name'] ?></td>
								</tr>
					<?php endforeach ?>
					</tbody>
				</table>
			</div>
		</div>
		
	</div>
</div>
<?php
require_once 'includes/footer.php';
?>

