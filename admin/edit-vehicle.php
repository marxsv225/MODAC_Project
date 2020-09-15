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
$dateacqui=$_POST['dateacqui'];
$emailuser=$_POST['emailuser'];
$utilise=$_POST['utilise'];
$bonetat=$_POST['bonetat'];
$nouveau=$_POST['nouveau'];
$id=intval($_GET['id']);

$sql="update tblvehicles set NomProd=:nomprod,Categorie=:categorie,Details=:details,PrixParjour=:prixparjour,DateAcqui=:dateacqui,EmailUser=:emailuser,Utilise=:utilise,BonEtat=:bonetat,Nouveau=:nouveau where id=:id ";
$query = $dbh->prepare($sql);
$query->bindParam(':nomprod',$nomprod,PDO::PARAM_STR);
$query->bindParam(':categorie',$categorie,PDO::PARAM_STR);
$query->bindParam(':details',$details,PDO::PARAM_STR);
$query->bindParam(':prixparjour',$prixparjour,PDO::PARAM_STR);
$query->bindParam(':dateacqui',$dateacqui,PDO::PARAM_STR);
$query->bindParam(':emailuser',$emailuser,PDO::PARAM_STR);
$query->bindParam(':utilise',$utilise,PDO::PARAM_STR);
$query->bindParam(':bonetat',$bonetat,PDO::PARAM_STR);
$query->bindParam(':nouveau',$nouveau,PDO::PARAM_STR);
$query->bindParam(':id',$id,PDO::PARAM_STR);
$query->execute();

$msg="Données mises à jour avec succès !";


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
					
						<h2 class="page-title">Modification d'un produit</h2>

						<div class="row">
							<div class="col-md-12">
								<div class="panel panel-default">
									<div class="panel-heading">Produit</div>
									<div class="panel-body">
<?php if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php } ?>
<?php 
$id=intval($_GET['id']);
$sql ="SELECT tblvehicles.*,tblbrands.BrandName,tblbrands.id as bid from tblvehicles join tblbrands on tblbrands.id=tblvehicles.Categorie where tblvehicles.id=:id";
$query = $dbh -> prepare($sql);
$query-> bindParam(':id', $id, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{	?>

<form method="post" class="form-horizontal" enctype="multipart/form-data">
<div class="form-group">
<label class="col-sm-2 control-label">Nom Produit<span style="color:red">*</span></label>
<div class="col-sm-4">
<input type="text" name="nomprod" class="form-control" value="<?php echo htmlentities($result->NomProd)?>" required>
</div>
<label class="col-sm-2 control-label">Catégorie<span style="color:red">*</span></label>
<div class="col-sm-4">
<select class="selectpicker" name="categorie" required>
<option value="<?php echo htmlentities($result->bid);?>"><?php echo htmlentities($bdname=$result->BrandName); ?> </option>
<?php $ret="select id,BrandName from tblbrands";
$query= $dbh -> prepare($ret);
//$query->bindParam(':id',$id, PDO::PARAM_STR);
$query-> execute();
$resultss = $query -> fetchAll(PDO::FETCH_OBJ);
if($query -> rowCount() > 0)
{
foreach($resultss as $results)
{
if($results->BrandName==$bdname)
{
continue;
} else{
?>
<option value="<?php echo htmlentities($results->id);?>"><?php echo htmlentities($results->BrandName);?></option>
<?php }}} ?>

</select>
</div>
</div>
											
<div class="hr-dashed"></div>
<div class="form-group">
<label class="col-sm-2 control-label">Détails<span style="color:red">*</span></label>
<div class="col-sm-10">
<textarea class="form-control" name="details" rows="3" required><?php echo htmlentities($result->Details);?></textarea>
</div>
</div>

<div class="form-group">
<label class="col-sm-2 control-label">Prix par jour(en FCFA)<span style="color:red">*</span></label>
<div class="col-sm-4">
<input type="text" name="prixparjour" class="form-control" value="<?php echo htmlentities($result->PrixParjour);?>" required>
</div>
</div>


<div class="form-group">
<label class="col-sm-2 control-label">Date d'acquisition<span style="color:red">*</span></label>
<div class="col-sm-4">
<input type="text" name="dateacqui" class="form-control" value="<?php echo htmlentities($result->DateAcqui);?>" required>
</div>
<label class="col-sm-2 control-label">Email user<span style="color:red">*</span></label>
<div class="col-sm-4">
<input type="text" name="emailuser" class="form-control" value="<?php echo htmlentities($result->EmailUser);?>" required>
</div>
</div>
<div class="hr-dashed"></div>								
<div class="form-group">
<div class="col-sm-12">
<h4><b>Images du produit</b></h4>
</div>
</div>


<div class="form-group">
<div class="col-sm-4">
Image 1 <img src="img/vehicleimages/<?php echo htmlentities($result->Vimage1);?>" width="300" height="200" style="border:solid 1px #000">
<a href="changeimage1.php?imgid=<?php echo htmlentities($result->id)?>">Change Image 1</a>
</div>
<div class="col-sm-4">
Image 2<img src="img/vehicleimages/<?php echo htmlentities($result->Vimage2);?>" width="300" height="200" style="border:solid 1px #000">
<a href="changeimage2.php?imgid=<?php echo htmlentities($result->id)?>">Change Image 2</a>
</div>
<div class="col-sm-4">
Image 3<img src="img/vehicleimages/<?php echo htmlentities($result->Vimage3);?>" width="300" height="200" style="border:solid 1px #000">
<a href="changeimage3.php?imgid=<?php echo htmlentities($result->id)?>">Change Image 3</a>
</div>
</div>


<div class="form-group">
<div class="col-sm-4">
Image 4<img src="img/vehicleimages/<?php echo htmlentities($result->Vimage4);?>" width="300" height="200" style="border:solid 1px #000">
<a href="changeimage4.php?imgid=<?php echo htmlentities($result->id)?>">Change Image 4</a>
</div>
<div class="col-sm-4">
Image 5
<?php if($result->Vimage5=="")
{
echo htmlentities("Fichier non chargé");
} else {?>
<img src="img/vehicleimages/<?php echo htmlentities($result->Vimage5);?>" width="300" height="200" style="border:solid 1px #000">
<a href="changeimage5.php?imgid=<?php echo htmlentities($result->id)?>">Change Image 5</a>
<?php } ?>
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
<div class="panel-heading">Conditions du produit</div>
<div class="panel-body">


<div class="form-group">
<div class="col-sm-3">
<?php if($result->Utilise==1)
{?>
<div class="checkbox checkbox-inline">
<input type="checkbox" id="inlineCheckbox1" name="utilise" checked value="1">
<label for="inlineCheckbox1"> Utilisé </label>
</div>
<?php } else { ?>
<div class="checkbox checkbox-inline">
<input type="checkbox" id="inlineCheckbox1" name="utilise" value="1">
<label for="inlineCheckbox1"> Utilisé </label>
</div>
<?php } ?>
</div>
<div class="col-sm-3">
<?php if($result->BonEtat==1)
{?>
<div class="checkbox checkbox-inline">
<input type="checkbox" id="inlineCheckbox1" name="bonetat" checked value="1">
<label for="inlineCheckbox2"> Bon état </label>
</div>
<?php } else {?>
<div class="checkbox checkbox-success checkbox-inline">
<input type="checkbox" id="inlineCheckbox1" name="bonetat" value="1">
<label for="inlineCheckbox2"> Bon état </label>
</div>
<?php }?>
</div>
<div class="col-sm-3">
<?php if($result->Nouveau==1)
{?>
<div class="checkbox checkbox-inline">
<input type="checkbox" id="inlineCheckbox1" name="nouveau" checked value="1">
<label for="inlineCheckbox3"> Nouveau </label>
</div>
<?php } else {?>
<div class="checkbox checkbox-inline">
<input type="checkbox" id="inlineCheckbox1" name="nouveau" value="1">
<label for="inlineCheckbox3">Nouveau </label>
</div>
<?php } ?>
</div>

<?php }} ?>


											<div class="form-group">
												<div class="col-sm-8 col-sm-offset-2" >
													
													<button class="btn btn-primary" name="submit" type="submit" style="margin-top:4%">Sauvegarder modification</button>
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