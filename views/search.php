<?php
// search.php
namespace App\Controllers;
require __DIR__ . '/../../vendor/autoload.php';

use App\Controllers\JobController;

$jobsController = new JobController();

if (isset($_GET['value']) && isset($_GET['type'])) {
    $searchValue = $_GET['value'];
    $searchType = $_GET['type'];

    $searchResults = $jobsController->searchJobs($searchType, $searchValue);
?>
<div id="search-results">
    <?php
    if (!empty($searchResults)) {
        foreach ($searchResults as $job) {
    ?>
            <article class="postcard light green">
                <a class="postcard__img_link" href="#">
                    <img class="postcard__img" src="../../public/upload/<?= $job['imageURL'] ?>" alt="Image Title" />
                </a>
                <div class="postcard__text t-dark">
                    <h3 class="postcard__title green"><a href="#"><?= $job["title"] ?></a></h3>
                    <div class="postcard__subtitle small">
                        <time datetime="2020-05-25 12:00:00">
                            <i class="fas fa-calendar-alt mr-2"></i>Mon, May 26th 2023
                        </time>
                    </div>
                    <div class="postcard__bar"></div>
                    <div class="postcard__preview-txt"><?php echo $job["description"] ?></div>
                    <ul class="postcard__tagbox">
                        <li class="tag__item">Enreprise : <?php echo $job["entreprise"] ?></li>
                        <li class="tag__item">Location : <?php echo $job["location"] ?></li>
                        <li class="tag__item play green">
                            <?php
                            if ($job["approve"] == 1) {
                                echo "<span style='color:red'>Already approved</span>";
                            } else {
                                if (isset($_SESSION['id'])) {
                            ?>
                                    <!-- Use a proper HTML form for apply offer -->
                                    <form>
                                        <button type="button" name="applyOffre" id="applyOffre<?= $job['jobID'] ?>" class="btn btn-info" onclick="applyOffer(<?= $job['jobID'] ?>)">Apply Offer</button>
                                    </form>
                                <?php
                                } else {
                                ?>
                                    <a href="login.php" class="btn btn-success">Add Offer</a>
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
        echo "<p>No results found</p>";
    }
}
    ?>
</div>
