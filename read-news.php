<?php session_start();
  ?>
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include ('connection/config.php');
$id=$_GET['id'];
$sql = "Select * from news where id=$id";
$query_run = mysqli_query($conn, $sql);
$news=mysqli_fetch_assoc($query_run);

?>
<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
    <?php
  
    require ('components/meta.php');
    require ('constants.php');
    include ('connection/config.php');
    ?>
   <style>
    .container {
    max-width: 800px;
    margin: 0 auto;
    padding: 20px;
}

.blog-post {
    margin-bottom: 40px;
}

.blog-image {
    width: 50%;
    height: auto;
    display: block;
    margin-bottom: 20px;
}

.blog-title {
    font-size: 24px;
    margin-bottom: 10px;
}

.blog-date {
    font-style: italic;
    color: #666;
    margin-bottom: 20px;
}

.blog-description {
    font-size: 16px;
    line-height: 1.6;
    margin-bottom: 20px;
}

.blog-text {
    font-size: 16px;
    line-height: 1.6;
}

.image-left, .image-right
{
	margin: 1em 0;
}

@media (min-width: 20em)
{
    .image-left, .image-right {
        display: flex;
        align-items: center;
        /*justify-content: center;*/
        width: 60%;
        margin: auto;
        flex-wrap: wrap;}

	.image-left img
	{
		margin-right: 1em;
		float: left; /* fallback */
	}

	.image-right img
	{
		order: 1;
		margin-left: 1em;
		float: right; /* fallback */
	}
	
	/* clearfix for fallback */
	.image-left::after,
	.image-right::after
	{
		content: "";
  	display: block;
		clear: both;
	}
}

@media (min-width: 30em)
{
	.image-left img, .image-right img
	{
		flex-shrink: 0;
	}
}

   </style>
</head>

<body>
    <?php include ('components/header.php') ?>
    <main class="mt-[70px] md:mt-0">
        <!-- Page Header -->
        <section
            class="bg-[url('assets/page.jpg')] bg-cover lg:bg-fixed bg-no-repeat bg-bottom relative w-full h-fit">
            <div class="flex flex-col gap-2 items-center justify-center w-full bg-[#090909c4] px-4 py-16 md:py-24">
                <h1 class="text-2xl md:text-4xl font-bold text-white">News</h1>
                <ul class="flex flex-row space-x-3 items-center justify-center text-white text-sm">
                    <a href="index.php">Home</a>
                    <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" fill="currentColor"
                        class="font-bold bi bi-chevron-right" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z">
                        </path>
                    </svg>
                    <a href="search.php">Search</a>
                    <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" fill="currentColor"
                        class="font-bold bi bi-chevron-right" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z">
                        </path>
                    </svg>
                    <a href="#">News</a>

                </ul>
            </div>
        </section>
        <div class="image-left">
	<img src="<?=  $news['image']; ?>" alt="<?=  $news['title']; ?>" style="    width: 90%;
    height: auto;
    padding: 1% 0px;
    margin: auto;"/>


	<div>
	     <div <?php $date = $news["date"];
                                    $month = date("M", strtotime($date));
                                    $day = date(
                                        "j",
                                        strtotime($date)
                                    ); ?> class="w-fit bg-white p-2 rounded border shadow flex-shrink-0 flex flex-col text-center
                                leading-none">
                                        <span class="text-gray-500 pb-2 mb-2 border-b-2 border-gray-200">
                                            <?= $month; ?>
                                        </span>
                                        <span class="font-medium text-lg text-gray-800 title-font leading-none">
                                            <?= $day; ?>
                                        </span>
                                    </div>
        <h1 style="text-align:left;margin-top:8px;"class="font-bold text-2xl py-4"><?=  $news['title']; ?></h1>
		<p style="text-align:justify;"><?php
        $text = $news['data'];
        $text_with_line_breaks = str_replace('.', '.<br>', $text);
        echo '<div style="line-height: 1.6; margin-top: 18px;">' . $text_with_line_breaks . '</div>';

        ?></p>
	
	</div>
</div>


   
  </div>
</div>
    </main>
    <?php include ('components/footer.php'); ?>
</body>

</html>