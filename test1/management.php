<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8">
		<title>Редагування</title>
		
		<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
		<script src="bootstrap/js/bootstrap.min.js"></script>
		<script src="https://code.jquery.com/jquery.js"></script>
		
		<!-- обмеження кількості символів на коментування -->
		<script>
			$(document).ready(function(){   
				$('#comment').keyup(function(){
					var $this = $(this);
					if($this.val().length > 200)
					$this.val($this.val().substr(0, 200));           
				});
			});
		</script>		
	</head>
	<body> 
	<?php 
		include "management_function.php";
	?>
		<form class="form-horizontal" method="POST">
			<div class="row">
				<div class="col-xs-1 col-md-4 col-md-offset-1">
					<br>
					<div class="form-group">
						<div class="col-sm-12">
							<textarea class="form-control" rows="5" name="comment" id="comment" placeholder="<?php echo $object->GetComment();?>"></textarea>
						</div>
					</div>
				
					<div class="form-group">
						<div class="col-sm-12">
							<button type="submit" class="btn btn-default" name="save">Зберегти зміни</button>
						</div>
					</div>
				</div>
					
				<div class="col-xs-1 col-md-5 col-md-offset-1">
					<br>
					<p>
						<img src="<?php echo 'images/thumbs/'.$_SESSION['image'];?>">
					</p>
					
					<div class="form-group">
						<div class="col-sm-12">
							<button type="submit" class="btn btn-default" name="delete">Видалити зображення</button>
						</div>
					</div>
				</div>
			</div>
		</form>
	</body>
</html>