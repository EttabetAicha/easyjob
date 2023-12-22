<?php session_start();
$lang = isset($_GET['lang']) ? $_GET['lang'] : 'en';
// $_SESSION['lang'] = $lang;
$translationFilePath = __DIR__ . "/../app/localization/{$lang}.php";

$translations = file_exists($translationFilePath) ? include_once($translationFilePath) : include_once(__DIR__ . "/../app/localization/en.php");

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>
		JobEase
	</title>

	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>JobEase</title>
	<!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"> -->
	<!-- Bootstrap CSS -->
	<!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

	<!-- Bootstrap JS and Popper.js (required for dropdowns) -->
	<script src="https://code.jquery.com/jquery-3.6.4.slim.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	<!-- Your custom styles -->
	<link rel="stylesheet" href="../public/css/style.css">

	<!-- SweetAlert CSS -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
</head>
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
							<a class="nav-link" href="#"><?= $translations['Home']; ?></a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="#"><?= $translations['features']; ?></a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="notification.php"><?= $translations['Notification']; ?></a>
						</li>

						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								languages
							</a>
							<div class="dropdown-menu" aria-labelledby="navbarDropdown">
								<a class="dropdown-item" href="?lang=fr">FR</a>
								<a class="dropdown-item" href="?lang=en">EN</a>
							</div>
						</li>



						<li class="nav-item">
							<?php if (isset($_SESSION['id'])) {
								echo '<a class="nav-link" href="login.php">' . $_SESSION['id'] . '</a>';
							} ?>
						</li>
						<?php
						if (!isset($_SESSION['role'])) {

						?>
							<li class="nav-item">
								<a class="nav-link" href="login.php"><?= $translations['login']; ?></a>

							</li>


						<?php } else {
						?>
							<li class="nav-item">
								<form method="post">
									<button type='submit' class="btn btn-light text-dark" href="login.php" name="logout"><?= $translations['logout']; ?></button>
								</form>
							</li>
						<?php }
						if (isset($_POST['logout'])) {
							session_destroy();
							header('location:login.php');
						}; ?>
					</ul>
				</div>
			</div>
		</nav>
	</header>




	<section action="#" method="get" class="search">
		<h2><?= $translations['Find_Your_Dream_Job']; ?></h2>
		<form class="form-inline">
			<div class="form-group mb-2">
				<input type="text" id='title' oninput="search('title')" name="keywords" placeholder="Keywords">
			</div>
			<div class="form-group mx-sm-3 mb-2">
				<input type="text" id='location' oninput="search('location')" name="company" placeholder="Location">
			</div>
			<div class="form-group mx-sm-3 mb-2">
				<input type="text" id='entreprise' oninput="search('entreprise')" name="location" placeholder="Company">
			</div>
		</form>

		<div id="search-results">
			<!-- Results will be displayed here -->
		</div>
	</section>

	<!--------------------------  card  --------------------->
	<section class="light">
		<h2 class="text-center py-3"><?= $translations['Latest_Job_Listings']; ?></h2>
		<div class="container py-2">

			<?php
			require __DIR__ . '/../vendor/autoload.php';
			use App\Controllers\JobController;
			$jobsController = new JobController();
			$jobs = $jobsController->getJobs(1);
			if (!empty($jobs)) {
				foreach ($jobs as $job) {
			?>
					<article class="postcard light green bottom-cards">
						<a class="postcard__img_link" href="#">
							<img class="postcard__img" src="../public/upload/<?= $job['imageURL'] ?>" alt="Image Title" />
						</a>
						<div class="postcard__text t-dark">
							<h3 class="postcard__title green"><a href="#"><?php echo $job["title"] ?></a></h3>
							<div class="postcard__subtitle small">
								<time datetime="2020-05-25 12:00:00">
									<i class="fas fa-calendar-alt mr-2"></i>Mon, May 26th 2023
								</time>
							</div>
							<div class="postcard__bar"></div>
							<div class="postcard__preview-txt"><?php echo $job["description"] ?></div>
							<ul class="postcard__tagbox">
								<li class="tag__item"><?= $translations['Entreprise']; ?> : <?php echo $job["entreprise"] ?></li>
								<li class="tag__item"><?= $translations['Location']; ?> : <?php echo $job["location"] ?></li>
								<li>
									<?php
									if ($job["approve"] == 1) {
										echo "<span style='color:red'>Already approved</span>";
									} else {
										if (isset($_SESSION['id'])) {
											$userId = $_SESSION['id'];
									?>
											<button type='button' class=" btn btn-warning text-light" onclick="applyOffer(<?= $job['jobID'] ?>, <?= $userId ?>)"><?= $translations['Apply_offer']; ?></button>
										<?php
										} else {
										?>
											<a href="login.php" class="btn btn-warning text-light"><?= $translations['Add_offer']; ?></a>
									<?php
										}
									}
									?>
								</li>



							</ul>
						</div>
					</article>
			<?php
				}
			} else {
				echo  $translations['No_job_found'];
			}

			?>
		</div>
	</section>




	<footer>
		<p>© 2023 JobEase </p>
	</footer>
</body>



<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script>
	function search(field) {
		var keywords = $('#title').val();
		var location = $('#location').val();
		var entreprise = $('#entreprise').val();

		var searchData = {
			'field': field,
			'keywords': keywords,
			'location': location,
			'entreprise': entreprise
		};

		$.ajax({
			type: 'POST',
			url: './dashboard/api.php',
			data: {
				action: 'search',
				searchData: searchData
			},
			dataType: 'json',
			success: function(response) {
				console.log(response);

				if (response.success) {
					updateUI(response.data);
				} else {
					var errorMessage = response.message || 'Unknown error occurred';
					console.error('Search failed:', errorMessage);
				}
			},
			error: function(error) {
				console.error('AJAX request failed:', error);
			}
		});
	}

	function updateUI(results) {
		$('#search-results').empty();

		if (results && Array.isArray(results) && results.length > 0) {
			var result = results[0];

			var resultCard = '<article class="postcard light green">' +
				'<a class="postcard__img_link" href="#">' +
				'<img class="postcard__img" src="../public/upload/' + result.imageURL + '" alt="Image Title" />' +
				'</a>' +
				'<div class="postcard__text t-dark">' +
				'<h3 class="postcard__title green"><a href="#">' + result.title + '</a></h3>' +
				'<div class="postcard__subtitle small">' +
				'<time datetime="2020-05-25 12:00:00">' +
				'<i class="fas fa-calendar-alt mr-2"></i>Mon, May 26th 2023' +
				'</time>' +
				'</div>' +
				'<div class="postcard__bar"></div>' +
				'<div class="postcard__preview-txt">' + result.description + '</div>' +
				'<ul class="postcard__tagbox">' +
				'<li class="tag__item">Enreprise : ' + result.entreprise + '</li>' +
				'<li class="tag__item">Location : ' + result.location + '</li>' +
				'<li class="tag__item play green">' +
				'</li>' +
				'</ul>' +
				'</div>' +
				'</article>';

			$('#search-results').append(resultCard);

			$('.bottom-cards').hide();
		} else {
			$('.bottom-cards').show();

			$('#search-results').append('<div>No results found.</div>');
		}
	}
</script>





<!-- Your custom script -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
	function applyOffer(jobID, userID) {
		var formData = new FormData();
		formData.append('action', 'applyoffer');
		formData.append('applyOffre', userID + '/' + jobID);

		$.ajax({
			url: './dashboard/api.php',
			type: 'POST',
			data: formData,
			contentType: false,
			processData: false,
			success: function(response) {
				if (response == "seccess") {
					Swal.fire({
						position: "top-start",
						icon: "success",
						title: "You have applied for this offer successfully",
						showConfirmButton: false,
						timer: 1500
					});
				} else {
					Swal.fire({
						position: "top-start",
						icon: "success",
						title: "You have applied for this offer successfully",
						showConfirmButton: false,
						timer: 1500
					});
				}
			},
			error: function(xhr, status, error) {
				console.error('AJAX request failed:', status, error);
				alert('AJAX request failed. Please try again. See console for details.');
			}
		});
	}
</script>
<!-- <script>
    function applyOffer(jobID, userID) {
        var formData = new FormData();
        formData.append('action', 'applyoffer');
        formData.append('applyOffre', userID + '/' + jobID);

        $.ajax({
            url: './dashboard/api.php',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                if (response == "seccess") {
                    Swal.fire({
                        position: "top-start",
                        icon: "success",
                        title: "You have applied for this offer successfully",
                        showConfirmButton: false,
                        timer: 1500
                    });
                } else {
                    Swal.fire({
                        position: "top-start",
                        icon: "error",
                        title: "Failed to apply for this offer",
                        showConfirmButton: false,
                        timer: 1500
                    });
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX request failed:', status, error);
                alert('AJAX request failed. Please try again. See console for details.');
            }
        });
    }
</script> -->

</html>