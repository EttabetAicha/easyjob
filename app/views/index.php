<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>
		JobEase
	</title>

	<link rel="stylesheet" href="../../public/css/style.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>

<body>
	<header>


		<nav class="navbar navbar-expand-md navbar-dark">
			<div class="container">
				<!-- Brand/logo -->
				<a class="navbar-brand" href="#">
					<i class="fas fa-code"></i>
					<h1>JobEase &nbsp &nbsp</h1>
				</a>

				<!-- Toggler/collapsibe Button -->
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
					<span class="navbar-toggler-icon"></span>
				</button>

				<!-- Navbar links -->
				<div class="collapse navbar-collapse" id="collapsibleNavbar">
					<ul class="navbar-nav ml-auto">
						<li class="nav-item active">
							<a class="nav-link" href="#">Home</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="#">Features</a>
						</li>

						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								language
							</a>
							<div class="dropdown-menu" aria-labelledby="navbarDropdown">
								<a class="dropdown-item" href="#">FR</a>
								<a class="dropdown-item" href="#">EN</a>
							</div>
						</li>
						<span class="nav-item active">
							<a class="nav-link" href="#">EN</a>
						</span>
						<?php
						if (!isset($_SESSION['roleUser'])) {
						?>
							<li class="nav-item">
								<a class="nav-link" href="login.php">Login</a>
							</li>
						<?php } else { ?>
							<li class="nav-item">
								<a class="nav-link" href="Controller/controller.php?logout=ok">logout</a>
							</li>
						<?php } ?>
					</ul>
				</div>
			</div>
		</nav>
	</header>




	<section action="#" method="get" class="search">
		<h2>Find Your Dream Job</h2>
		<form class="form-inline">
			<div class="form-group mb-2">
				<input type="text" id='title' onkeyup="search('title')" name="keywords" placeholder="Keywords">
			</div>
			<div class="form-group mx-sm-3 mb-2">
				<input type="text" id='location' onkeyup="search('location')" name="company" placeholder="Location">
			</div>
			<div class="form-group mx-sm-3 mb-2">
				<input type="text" id='entreprise' onkeyup="search('entreprise')" name="location" placeholder="Company">
			</div>
		</form>
	</section>

	<!--------------------------  card  --------------------->
	<section class="light">
		<h2 class="text-center py-3">Latest Job Listings</h2>
		<div class="container py-2">

			<?php
			$jobs = $jobs->GetJobs(1);
			foreach ($jobs as $job) {
			?>
				<article class="postcard light green">
					<a class="postcard__img_link" href="#">
						<img class="postcard__img" src="uploads/<?= $job['imageURL'] ?>" alt="Image Title" />
					</a>
					<div class="postcard__text t-dark">
						<h3 class="postcard__title green"><a href="#"><?= $job["title"] ?></a></h3>
						<div class="postcard__subtitle small">
							<time datetime="2020-05-25 12:00:00">
								<i class="fas fa-calendar-alt mr-2"></i>Mon, May 26th 2023
							</time>
						</div>
						<div class="postcard__bar"></div>
						<div class="postcard__preview-txt"><?= $job["description"] ?></div>
						<ul class="postcard__tagbox">
							<li class="tag__item">Enreprise : <?= $job["entreprise"] ?></li>
							<li class="tag__item">Location : <?= $job["location"] ?></li>
							<li class="tag__item play green">
								<?php
								if ($job["approve"] == 1) {
									echo "<span style='color:red'>Already aprouved</span>";
								} else {
									if (isset($_SESSION['idUser'])) {
								?>
										<form>
											<button type='button' name='applyOffre' id='applyOffre<?= $job['jobID'] ?>' onclick="addOffer(<?= $job['jobID'] ?>)" value='<?= $_SESSION['idUser'] ?>/<?= $job["jobID"] ?>' class="btn btn-success">Add Offer</button>
										</form>

									<?php
									} else {
									?>
										<a href="login.php" class="btn btn-success">Add Offer</a>
									<?php } ?>
								<?php
								}
								?>

							</li>
						</ul>
					</div>
				</article>
			<?php
			}
			?>
		</div>
	</section>




	<footer>
		<p>© 2023 JobEase </p>
	</footer>
</body>
<script>
	async function applyOffer(jobid) {
		try {
			const response = await fetch(`Controller/controller.php?applyOffre=${jobid}`);
			const result = await response.text();
			if (result === "ok") {
				Swal.fire({
					position: "top-end",
					icon: "success",
					title: "You have applied to this offer successfully",
					showConfirmButton: false,
					timer: 1500
				});
			} else {
				Swal.fire({
					icon: "error",
					title: "Sorry",
					text: "Error! You have already applied to this offer",
				});
			}
		} catch (error) {
			console.error("Error applying to the offer:", error);
		}
	}

	async function search(typeSearch) {
		try {
			const input = document.getElementById(typeSearch);
			const url = `Controller/search.php?value=${input.value}&type=${typeSearch}`;
			const response = await fetch(url);
			const htmlContent = await response.text();

			document.getElementById("articles").innerHTML = htmlContent;
		} catch (error) {
			console.error("Error performing search:", error);
		}
	}
</script>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</html>