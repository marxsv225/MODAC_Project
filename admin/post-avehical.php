<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:index.php');
}
else{ 

if(isset($_POST['submit']))
  {
	$nomprod=$_POST['nomprod'];
    $categorie=$_POST['categorie'];
    $details=$_POST['details'];
    $prixparjour=$_POST['prixparjour'];
    $emailuser=$_POST['emailuser'];
    $dateacqui=$_POST['dateacqui'];
    $vimage1=$_FILES['img1']['name'];
    $filetemp = $_FILES['img1']['tmp_name'];
    move_uploaded_file($filetemp, "./img/vehicleimages/".$vimage1);
    $vimage2=$_FILES['img2']['name'];
    $filetemp = $_FILES['img2']['tmp_name'];
    move_uploaded_file($filetemp, "./img/vehicleimages/".$vimage2);
    $vimage3=$_FILES['img3']['name'];
    $filetemp = $_FILES['img3']['tmp_name'];
    move_uploaded_file($filetemp, "./img/vehicleimages/".$vimage3);
    $vimage4=$_FILES['img4']['name'];
    $filetemp = $_FILES['img4']['tmp_name'];
    move_uploaded_file($filetemp, "./img/vehicleimages/".$vimage4);
    $vimage5=$_FILES['img5']['name'];
    $filetemp = $_FILES['img5']['tmp_name'];
    move_uploaded_file($filetemp, "./img/vehicleimages/".$vimage5);
    $utilise=$_POST['utilise'];
    $bonetat=$_POST['bonetat'];
    $nouveau=$_POST['nouveau'];
    // move_uploaded_file($_FILES["img1"]["tmp_name"],"admin/img/vehicleimages/".$_FILES["img1"]["name"]);
    // move_uploaded_file($_FILES["img2"]["tmp_name"],"admin/img/vehicleimages/".$_FILES["img2"]["name"]);
    // move_uploaded_file($_FILES["img3"]["tmp_name"],"admin/img/vehicleimages/".$_FILES["img3"]["name"]);
    // move_uploaded_file($_FILES["img4"]["tmp_name"],"admin/img/vehicleimages/".$_FILES["img4"]["name"]);
    // move_uploaded_file($_FILES["img5"]["tmp_name"],"admin/img/vehicleimages/".$_FILES["img5"]["name"]);
    
    $sql="INSERT INTO tblvehicles(NomProd,Categorie,Details,PrixParjour,EmailUser,DateAcqui,Vimage1,Vimage2,Vimage3,Vimage4,Vimage5,Utilise,BonEtat,Nouveau) VALUES(:nomprod,:categorie,:details,:prixparjour,:emailuser,:dateacqui,:vimage1,:vimage2,:vimage3,:vimage4,:vimage5,:utilise,:bonetat,:nouveau)";
    $query = $dbh->prepare($sql);
    $query->bindParam(':nomprod',$nomprod,PDO::PARAM_STR);
    $query->bindParam(':categorie',$categorie,PDO::PARAM_STR);
    $query->bindParam(':details',$details,PDO::PARAM_STR);
    $query->bindParam(':prixparjour',$prixparjour,PDO::PARAM_STR);
    $query->bindParam(':emailuser',$emailuser,PDO::PARAM_STR);
    $query->bindParam(':dateacqui',$dateacqui,PDO::PARAM_STR);
    $query->bindParam(':vimage1',$vimage1,PDO::PARAM_STR);
    $query->bindParam(':vimage2',$vimage2,PDO::PARAM_STR);
    $query->bindParam(':vimage3',$vimage3,PDO::PARAM_STR);
    $query->bindParam(':vimage4',$vimage4,PDO::PARAM_STR);
    $query->bindParam(':vimage5',$vimage5,PDO::PARAM_STR);
    $query->bindParam(':utilise',$utilise,PDO::PARAM_STR);
    $query->bindParam(':bonetat',$bonetat,PDO::PARAM_STR);
    $query->bindParam(':nouveau',$nouveau,PDO::PARAM_STR);
    $query->execute();
    $lastInsertId = $dbh->lastInsertId();
    if($lastInsertId)
    {
    $msg="Produit enregistré avec succès !";
    }
    else 
    {
    $error="Echec d'enregistrement, veuillez reprendre s'il vous plaît !";
    }

}


	?>
<!doctype html>
<html lang="en" class="no-js">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<meta name="theme-color" content="#3e454c">
	
	<title>RentMarket | Admin </title>

	<!-- Font awesome -->
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<!-- Sandstone Bootstrap CSS -->
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<!-- Bootstrap Datatables -->
	<link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
	<!-- Bootstrap social button library -->
	<link rel="stylesheet" href="css/bootstrap-social.css">
	<!-- Bootstrap select -->
	<link rel="stylesheet" href="css/bootstrap-select.css">
	<!-- Bootstrap file input -->
	<link rel="stylesheet" href="css/fileinput.min.css">
	<!-- Awesome Bootstrap checkbox -->
	<link rel="stylesheet" href="css/awesome-bootstrap-checkbox.css">
	<!-- Admin Stye -->
	<link rel="stylesheet" href="css/style.css">
<style>
		.errorWrap {
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #dd3d36;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
.succWrap{
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #5cb85c;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}

.accordion {
  background-color: #eee;
  color: #444;
  cursor: pointer;
  padding: 18px;
  width: 100%;
  border: none;
  text-align: left;
  outline: none;
  font-size: 15px;
  transition: 0.4s;
}

.active, .accordion:hover {
  background-color: #ccc; 
}
		</style>

</head>

<body>
	<?php include('includes/header.php');?>
	<div class="ts-main-content">
	<?php include('includes/leftbar.php');?>
		<div class="content-wrapper">
			<div class="container-fluid">

				<div class="row">
					<div class="col-md-12">
					
						<h2 class="page-title">Ajouter un produit</h2>

						<div class="row">
							<div class="col-md-12">
								<div class="panel panel-default">
									<div class="panel-heading">Infos produit</div>
<?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
				else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>

									<div class="panel-body">
									<form method="post" class="form-horizontal" enctype="multipart/form-data">
										<div class="form-group">
											<label class="col-sm-2 control-label">Catégorie<span style="color:red">*</span></label>
											<div class="col-sm-4">
											<select class="selectpicker form-control white_bg" name="categorie" required>
												<option value="" selected disabled> Selectionez la catégorie </option>

<?php $ret="select id,BrandName from tblbrands";
	$query= $dbh -> prepare($ret);
	//$query->bindParam(':id',$id, PDO::PARAM_STR);
	$query-> execute();
	$results = $query -> fetchAll(PDO::FETCH_OBJ);
	if($query -> rowCount() > 0)
	{
	foreach($results as $result)
	{
?>
												<option value="<?php echo htmlentities($result->id);?>"><?php echo htmlentities($result->BrandName);?></option>
<?php }} ?>

											</select>
											</div>
											<label class="col-sm-2 control-label">Sous Catégorie<span style="color:red">*</span></label>
											<div class="col-sm-4">
											<select class="selectpicker form-control white_bg" name="categorie" required>
												<option value="" selected disabled> Selectioner la sous categorie </option>
<?php $ret="select id,BrandName from tblbrands";
$query= $dbh -> prepare($ret);
//$query->bindParam(':id',$id, PDO::PARAM_STR);
$query-> execute();
$results = $query -> fetchAll(PDO::FETCH_OBJ);
if($query -> rowCount() > 0)
{
foreach($results as $result)
{
?>
												<option value="<?php echo htmlentities($result->id);?>"><?php echo htmlentities($result->BrandName);?></option>
<?php }} ?>

											</select>
										</div>
									</div>
<div class="hr-dashed"></div>
<div class="form-group">
<label class="col-sm-2 control-label">Détails produit<span style="color:red">*</span></label>
<div class="col-sm-10">
<textarea class="form-control white_bg" name="details" rows="3" required></textarea>
</div>
</div>

<div class="form-group">
<label class="col-sm-2 control-label">Prix par jour(en FCFA)<span style="color:red">*</span></label>
<div class="col-sm-4">
<input type="text" name="prixparjour" class="form-control white_bg" required>
</div>
<label class="col-sm-2 control-label">Vendeur <span style="color:red">*</span></label>
<div class="col-sm-4">
<input type="text" name="emailuser" class="form-control white_bg" value="
<?php echo ($_SESSION['alogin']);?>" readonly required>
</div>
</div>


<div class="form-group">
<label class="col-sm-2 control-label">Date d'acquisition<span style="color:red">*</span></label>
<div class="col-sm-10">
<input type="date" name="dateacqui" class="form-control white_bg" required>
</div>
</div>
<div class="hr-dashed"></div>


<div class="form-group">
<div class="col-sm-12">
<h4><b>Chargez les images du produit (au moins 4)</b></h4>
</div>
</div>


<div class="form-group">
<div class="col-sm-4">
Image 1 <span style="color:red">*</span><input type="file" name="img1" required>
</div>
<div class="col-sm-4">
Image 2<span style="color:red">*</span><input type="file" name="img2" required>
</div>
<div class="col-sm-4">
Image 3<span style="color:red">*</span><input type="file" name="img3" required>
</div>
</div>


<div class="form-group">
<div class="col-sm-4">
Image 4<span style="color:red">*</span><input type="file" name="img4" required>
</div>
<div class="col-sm-4">
Image 5<input type="file" name="img5">
</div>

</div>
<div class="hr-dashed"></div>
</div>
</div>
</div>
</div>

<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">Les détails du produit</div>
			<div class="panel-body">
				<div id="accordion">
					<div class="card">
						<div class="card-header">
							<a class="card-link" data-toggle="collapse" href="#collapseOne">
							Collapsible Group Item #1
							</a>
						</div>
						<div id="collapseOne" class="collapse show" data-parent="#accordion">
							<div class="card-body">
							Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
							</div>
						</div>
						</div>
						<div class="card">
						<div class="card-header">
							<a class="collapsed card-link" data-toggle="collapse" href="#collapseTwo">
							Collapsible Group Item #2
						</a>
						</div>
						<div id="collapseTwo" class="collapse" data-parent="#accordion">
							<div class="card-body">
							Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
							</div>
						</div>
						</div>
						<div class="card">
						<div class="card-header">
							<a class="collapsed card-link" data-toggle="collapse" href="#collapseThree">
							Collapsible Group Item #3
							</a>
						</div>
						<div id="collapseThree" class="collapse" data-parent="#accordion">
							<div class="card-body">
							Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="row">
<div class="col-md-12">
<div class="panel panel-default">
<div class="panel-heading">Les conditions du produit</div>
<div class="panel-body">


<div class="form-group">
<div class="col-sm-3">
<div class="checkbox checkbox-inline">
<input type="checkbox" id="airconditioner" name="utilise" value="1">
<label for="airconditioner"> Déja utilisé </label>
</div>
</div>
<div class="col-sm-3">
<div class="checkbox checkbox-inline">
<input type="checkbox" id="powerdoorlocks" name="bonetat" value="1">
<label for="powerdoorlocks"> En bon état </label>
</div></div>
<div class="col-sm-3">
<div class="checkbox checkbox-inline">
<input type="checkbox" id="antilockbrakingsys" name="nouveau" value="1">
<label for="antilockbrakingsys"> Nouveau </label>
</div></div>
<!-- <div class="checkbox checkbox-inline">
<input type="checkbox" id="brakeassist" name="brakeassist" value="1">
<label for="brakeassist"> Brake Assist </label>
</div> -->
</div><br><br><br><br><br>



<!-- <div class="form-group">
<div class="col-sm-3">
<div class="checkbox checkbox-inline">
<input type="checkbox" id="powersteering" name="powersteering" value="1">
<input type="checkbox" id="powersteering" name="powersteering" value="1">
<label for="inlineCheckbox5"> Power Steering </label>
</div>
</div>
<div class="col-sm-3">
<div class="checkbox checkbox-inline">
<input type="checkbox" id="driverairbag" name="driverairbag" value="1">
<label for="driverairbag">Driver Airbag</label>
</div>
</div>
<div class="col-sm-3">
<div class="checkbox checkbox-inline">
<input type="checkbox" id="passengerairbag" name="passengerairbag" value="1">
<label for="passengerairbag"> Passenger Airbag </label>
</div></div>
<div class="checkbox checkbox-inline">
<input type="checkbox" id="powerwindow" name="powerwindow" value="1">
<label for="powerwindow"> Power Windows </label>
</div>
</div> -->


<!-- <div class="form-group">
<div class="col-sm-3">
<div class="checkbox checkbox-inline">
<input type="checkbox" id="cdplayer" name="cdplayer" value="1">
<label for="cdplayer"> CD Player </label>
</div>
</div>
<div class="col-sm-3">
<div class="checkbox h checkbox-inline">
<input type="checkbox" id="centrallocking" name="centrallocking" value="1">
<label for="centrallocking">Central Locking</label>
</div></div>
<div class="col-sm-3">
<div class="checkbox checkbox-inline">
<input type="checkbox" id="crashcensor" name="crashcensor" value="1">
<label for="crashcensor"> Crash Sensor </label>
</div></div>
<div class="col-sm-3">
<div class="checkbox checkbox-inline">
<input type="checkbox" id="leatherseats" name="leatherseats" value="1">
<label for="leatherseats"> Leather Seats </label>
</div>
</div>
</div> -->




											<div class="form-group">
												<div class="col-sm-8 col-sm-offset-2">
													<button class="btn btn-default" type="reset">Annuler</button>
													<button class="btn btn-primary" name="submit" type="submit">Enregistrer</button>
												</div>
											</div>

										</form>
									</div>
								</div>
							</div>
						</div>
						
					

					</div>
				</div>
				
			

			</div>
		</div>
	</div>

	<!-- Loading Scripts -->
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap-select.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.dataTables.min.js"></script>
	<script src="js/dataTables.bootstrap.min.js"></script>
	<script src="js/Chart.min.js"></script>
	<script src="js/fileinput.js"></script>
	<script src="js/chartData.js"></script>
	<script src="js/main.js"></script>
</body>
</html>
<?php } ?>