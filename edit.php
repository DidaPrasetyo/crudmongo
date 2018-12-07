<?php
use \MongoDB\BSON\ObjectID as MongoId;
// including the database connection file
require_once __DIR__ . "/vendor/autoload.php";

$connection = new MongoDB\Driver\Manager();

$collection = (new MongoDB\Client)->telkom->siswa;



//getting id from url
$id = $_GET['id'];

//selecting data associated with this particular id
$result = $collection->findOne(array('_id' => new MongoId($id)));

$nis = $result['nis'];
$nama = $result['nama'];
$kelas = $result['kelas'];
$pk3 = $result['mapel']['PK3'];
$pk5 = $result['mapel']['PK5'];
$pk8 = $result['mapel']['PK8'];
?>
<html>
<head>    
	<title>Edit Data</title>
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
	<a href="index.php">Home</a>
	<br/><br/>

	<div class="page-wrapper bg-blue p-t-100 p-b-100 font-robo">
		<div class="wrapper wrapper--w680">
			<div class="card card-1">
				<div class="card-heading"></div>
				<div class="card-body">
					<h2 class="title">Edit Info</h2>
					<form method="POST">
						<div class="input-group">
							<input class="input--style-1" type="text" placeholder="Nis" name="nis" value="<?php echo $nis; ?>">
						</div>
						<div class="input-group">
							<input class="input--style-1" type="text" placeholder="Name" name="name" value="<?php echo $nama; ?>">
						</div>
						<div class="input-group">
							<div class="rs-select2 js-select-simple select--no-search">
								<?php 
								if($kelas == 'XII RPL 1'){?>
									<select name="class">
										<option value="XII RPL 1" selected>XII RPL 1</option>
										<option value="XII RPL 2">XII RPL 2</option>
										<option value="XII RPL 3">XII RPL 3</option>
										<option value="XII RPL 4">XII RPL 4</option>
										<?php
									} else if ($kelas == 'XII RPL 2') { ?>
										<select name="class">
											<option value="XII RPL 1">XII RPL 1</option>
											<option value="XII RPL 2" selected>XII RPL 2</option>
											<option value="XII RPL 3">XII RPL 3</option>
											<option value="XII RPL 4">XII RPL 4</option>
											<?php
										} else if ($kelas == 'XII RPL 3') { ?>
											<select name="class">
												<option value="XII RPL 1">XII RPL 1</option>
												<option value="XII RPL 2">XII RPL 2</option>
												<option value="XII RPL 3" selected>XII RPL 3</option>
												<option value="XII RPL 4">XII RPL 4</option>
												<?php
											} else if ($kelas == 'XII RPL 4') { ?>
												<select name="class">
													<option value="XII RPL 1">XII RPL 1</option>
													<option value="XII RPL 2">XII RPL 2</option>
													<option value="XII RPL 3">XII RPL 3</option>
													<option value="XII RPL 4" selected>XII RPL 4</option>
												<?php } ?>
											</select>
											<div class="select-dropdown"></div>
										</div>
									</div>								
									Mapel
									<div class="input-group">
										<input class="input--style-1" type="text" placeholder="PK3" name="pk3" value="<?php echo $pk3; ?>">
									</div>
									<div class="input-group">
										<input class="input--style-1" type="text" placeholder="PK5" name="pk5" value="<?php echo $pk5; ?>">
									</div>
									<div class="input-group">
										<input class="input--style-1" type="text" placeholder="PK8" name="pk8" value="<?php echo $pk3; ?>">
									</div>
									<div class="p-t-20">
										<button class="btn btn--radius btn--green" type="submit" name="Submit">Submit</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</body>
			<script src="vendor/jquery/jquery.min.js"></script>
			<script src="vendor/select2/select2.min.js"></script>
			<script src="vendor/datepicker/moment.min.js"></script>
			<script src="vendor/datepicker/daterangepicker.js"></script>
			<script src="js/global.js"></script>

			<?php if(isset($_POST['Submit']))
			{    
				$id = $_GET['id'];
				$user = array (
					'nis' => $_POST['nis'],
					'nama' => $_POST['name'],
					'kelas' => $_POST['class'],
					'mapel' => array(
						'PK3' => $_POST['pk3'],
						'PK5' => $_POST['pk5'],
						'PK8' => $_POST['pk8']
					)
				);
				$collection->updateOne(
					array('_id' => new MongoId($id)),
					array('$set' => $user)
				);

				header("Location: index.php");
			}
			?>

			</html>