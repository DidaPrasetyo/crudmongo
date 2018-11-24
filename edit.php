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
</head>

<body>
	<a href="index.php">Home</a>
	<br/><br/>

	<form method="POST">
		<table>
			<tr>
				<td>Nis</td>
				<td><input type="text" name="nis" value="<?php echo $nis; ?>"></td>
			</tr>
			<tr>
				<td>Nama</td>
				<td><input type="text" name="name" value="<?php echo $nama; ?>"></td>
			</tr>
			<tr>
				<td>Kelas</td>
				<td>
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
								</select></td>
							</tr>
							<tr>
								<td>Mapel</td>
							</tr>
							<tr>
								<td></td>
								<td>PK3</td>
								<td><input type="text" name="pk3" value="<?php echo $pk3; ?>"></td>
							</tr>
							<tr>
								<td></td>
								<td>PK5</td>
								<td><input type="text" name="pk5" value="<?php echo $pk5; ?>"></td>
							</tr>
							<tr>
								<td></td>
								<td>PK8</td>
								<td><input type="text" name="pk8" value="<?php echo $pk8; ?>"></td>
							</tr>
							<tr>
								<td><input type="submit" name="Submit" value="Edit"></td>
							</tr>
						</table>
					</form>
				</body>

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