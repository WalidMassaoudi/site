<?php
	include('session.php');
	
	$fileInfo = PATHINFO($_FILES["image"]["name"]);
	
	if (empty($_FILES["image"]["name"])){
		$location=$srow['photo'];
		?>
			<script>
				window.alert('La photo téléchargée est vide!');
				window.history.back();
			</script>
		<?php
	}
	else{
		if ($fileInfo['extension'] == "jpg" OR $fileInfo['extension'] == "png") {
			$newFilename = $fileInfo['filename'] . "_" . time() . "." . $fileInfo['extension'];
			move_uploaded_file($_FILES["image"]["tmp_name"], "../upload/" . $newFilename);
			$location = "upload/" . $newFilename;
			
			mysqli_query($conn,"update `user` set photo='$location' where userid='".$_SESSION['id']."'");
	
			?>
				<script>
					window.alert('Photo mise à jour avec succès!');
					window.history.back();
				</script>
			<?php
		}
		else{
			?>
				<script>
					window.alert('Photo non mise à jour. Veuillez ne télécharger que des fichiers JPG ou PNG!');
					window.history.back();
				</script>
			<?php
		}
	}
	
	

?>