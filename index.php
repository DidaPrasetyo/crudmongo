<!DOCTYPE html>
<html>
<?php
require_once __DIR__ . "/vendor/autoload.php";

$connection = new MongoDB\Driver\Manager();

$collection = (new MongoDB\Client)->telkom->siswa;

$result = $collection->find();

?>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Colorlib Templates">
	<meta name="author" content="Colorlib">
	<meta name="keywords" content="Colorlib Templates">
	<link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
	<link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
	<link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i" rel="stylesheet">
	<link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
	<link href="vendor/datepicker/daterangepicker.css" rel="stylesheet" media="all">
	<link href="css/main.css" rel="stylesheet" media="all">
</head>
<body>
	<div class="page-wrapper bg-blue p-t-100 p-b-100 font-robo">
		<div class="wrapper wrapper--w680">
			<div class="card card-1">
				<div class="card-heading"></div>
				<div class="card-body">
					<h2 class="title">Edit Info</h2>
					<form method="POST">
						<div class="input-group">
							<input class="input--style-1" type="text" placeholder="Nis" name="nis">
						</div>
						<div class="input-group">
							<input class="input--style-1" type="text" placeholder="Name" name="name">
						</div>
						<div class="input-group">
							<div class="rs-select2 js-select-simple select--no-search">
								<select name="class">
									<option disabled="disabled" selected="selected">Kelas</option>
									<option value="XII RPL 1">XII RPL 1</option>
									<option value="XII RPL 2">XII RPL 2</option>
									<option value="XII RPL 3">XII RPL 3</option>
									<option value="XII RPL 4">XII RPL 4</option>
								</select>
								<div class="select-dropdown"></div>
							</div>
						</div>								
						Mapel
						<div class="input-group">
							<input class="input--style-1" type="text" placeholder="PK3" name="pk3">
						</div>
						<div class="input-group">
							<input class="input--style-1" type="text" placeholder="PK5" name="pk5">
						</div>
						<div class="input-group">
							<input class="input--style-1" type="text" placeholder="PK8" name="pk8">
						</div>
						<div class="p-t-20">
							<button class="btn btn--radius btn--green" type="submit" name="Submit">Submit</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<div class="limiter">
		<div class="container-table100">
			<div class="wrap-table100">
				<div class="table100">
					<table>
						<thead>
							<tr class="table100-head">
								<th >Nis</th>
								<th >Nama</th>
								<th >Kelas</th>
								<th >Nilai PK3</th>
								<th >Nilai PK5</th>
								<th >Nilai PK8</th>
								<th >Action</th>
							</tr>
						</thead>
						<tbody>
							<?php     
							foreach ($result as $res) { ?>
								<tr>
									<td ><?php echo $res['nis']; ?></td>
									<td ><?php echo $res['nama']; ?></td>
									<td ><?php echo $res['kelas']; ?></td>
									<td ><?php print_r($res['mapel']['PK3']); ?></td>
									<td ><?php print_r($res['mapel']['PK5']); ?></td>
									<td ><?php print_r($res['mapel']['PK8']); ?></td>
									<td ><?php echo "<a href=\"edit.php?id=$res[_id]\">Edit</a>
									<a href=\"delet.php?id=$res[_id]\" onClick=\"return confirm('Are you sure you want to delete?')\">Delete</a></td>";?>									
								</td>
							</tr>
						<?php }
						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/select2/select2.min.js"></script>
<script src="vendor/datepicker/moment.min.js"></script>
<script src="vendor/datepicker/daterangepicker.js"></script>
<script src="js/global.js"></script>
</body>
</html>

<?php
if(isset($_POST['Submit'])){
	$insertOneResult = $collection->insertOne([
		'nis' => $_POST['nis'],
		'nama' => $_POST['name'],
		'kelas' => $_POST['class'],
		'mapel' => array(
			'PK3' => $_POST['pk3'],
			'PK5' => $_POST['pk5'],
			'PK8' => $_POST['pk8']
		)
	]);
	header("Refresh:0");
}



?>