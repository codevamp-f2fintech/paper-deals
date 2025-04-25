<?php
if (isset($_SESSION['status'])) {
	?>
	<div class="alert alert-warning alert-dismissible fade show" role="alert">
		<strong>Hey!</strong>
		<?php echo $_SESSION['status']; ?>
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
	</div>
	<?php
	unset($_SESSION['status']);
}


if (isset($_SESSION['success'])) { ?>
	<div class="alert alert-success alert-dismissible">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		<h5><i class="icon fas fa-check"></i> Alert!</h5>
		<?= $_SESSION['success']; ?>
	</div>
	<?php
	unset($_SESSION['success']);
}

if (isset($_SESSION['error'])) { ?>
	<div class="alert alert-danger alert-dismissible">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		<h5><i class="icon fas fa-ban"></i> Alert!</h5>
		<?= $_SESSION['error']; ?>
	</div>
	<?php
	unset($_SESSION['error']);
}
?>