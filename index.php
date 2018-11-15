<!DOCTYPE html>
<html>
<?php
require_once __DIR__ . "/vendor/autoload.php";

$connection = new MongoDB\Driver\Manager();

$collection = (new MongoDB\Client)->telkom->siswa;

$result = $collection->find();

?>
<head>
	<title></title>
</head>
<body>
	<form act method="POST">
		<table>
			<tr>
				<td>Nis</td>
				<td><input type="text" name="nis"></td>
			</tr>
			<tr>
				<td>Nama</td>
				<td><input type="text" name="name"></td>
			</tr>
			<tr>
				<td>Kelas</td>
				<td><input type="text" name="class"></td>
			</tr>
			<tr>
				<td>Mapel</td>
			</tr>
			<tr>
				<td></td>
				<td>PK3</td>
				<td><input type="text" name="pk3"></td>
			</tr>
			<tr>
				<td></td>
				<td>PK5</td>
				<td><input type="text" name="pk5"></td>
			</tr>
			<tr>
				<td></td>
				<td>PK8</td>
				<td><input type="text" name="pk8"></td>
			</tr>
			<tr>
				<td><input type="submit" name="Submit" value="Add"></td>
			</tr>
		</table>
		<table width='80%' border=0>
 
    <tr bgcolor='#CCCCCC'>
        <td>Nis</td>
        <td>Nama</td>
        <td>Kelas</td>
        <td>Nilai PK3</td>
        <td>Nilai PK5</td>
        <td>Nilai PK8</td>
        <td>Action</td>
    </tr>
    <?php     
    foreach ($result as $res) {
        echo "<tr>";
        echo "<td>".$res['nis']."</td>";
        echo "<td>".$res['nama']."</td>";    
        echo "<td>".$res['kelas']."</td>";  
        echo "<td>".$res['mapel.PK3']."</td>";
        echo "<td>".$res['mapel.PK5']."</td>";
        echo "<td>".$res['mapel.PK8']."</td>";  
        echo "<td>
        <a href=\"edit.php?id=$res[_id]\">Edit</a>
        <a href=\"delete.php?id=$res[_id]\" onClick=\"return confirm('Are you sure you want to delete?')\">Delete</a></td>";        
    }
    ?>
    </table>
	</form>
</body>
</html>

<?php
if(isset($_POST['Submit'])){
$insertOneResult = $collection->insertOne([
    'nis' => $_POST['nis'],
    'nama' => $_POST['name'],
    'kelas' => $_POST['class'],
    'mapel.pk3' => $_POST['pk3'],
    'mapel.pk5' => $_POST['pk5'],
    'mapel.pk8' => $_POST['pk8'],
]);}



?>