<h3>Thông tin liên hệ</h3>
<?php
	$sql_lh = "SELECT * FROM tbl_lienhe WHERE id=1";
	$query_lh = mysqli_query($mysqli,$sql_lh);
?>

	<?php
	 	while($dong = mysqli_fetch_array($query_lh)) {
	 	?>
 			<h5><?php echo $dong['thongtinlienhe'] ?></h5>
	  	
	  <?php 
		}
	  ?>


