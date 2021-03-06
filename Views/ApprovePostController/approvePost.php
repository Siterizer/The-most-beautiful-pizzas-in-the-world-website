<?php
    if(!isset($_SESSION['id']) and !isset($_SESSION['role'])) {
        die('You are not logged in!');
    }

    if(!in_array('ROLE_ADMIN', $_SESSION['role'])) {
        die('You do not have permission to watch this page!');
    }
?>

<!DOCTYPE_HTML>

<html lang="pl">
	<head>
		<meta charset="utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<title>Najpiękniejsze Pizze Świata</title>
		<meta name="description" content="Serwis zrzeszający wszystkich fanatyków pięknych pizz na świecie" />
		<meta name="keywords" content="pizza, pizzy, zdjęcia, obrazki, piękne, piekne" />
		<link href="../Public/css/style.css" rel="stylesheet" type="text/css" />
		<link href="../Public/css/approvePost.css" rel="stylesheet" type="text/css" />
		<script src="https://kit.fontawesome.com/397b33f34a.js" crossorigin="anonymous"></script>
	</head>
	<body>
		<div id="container">
			<?php include(dirname(__DIR__).'/Common/navbar.php'); ?>
			<div id="wrapper">
				<?php include(dirname(__DIR__).'/Common/logo.php'); ?>
				<div id="mainContent">
					
					<div class = "arrowContainer">
						<form action='<?php echo($_SERVER['REQUEST_URI'])?>' method="POST">
							<button type="submit" name="previous" value="Następna" class="arrow">
								<i class="fas fa-arrow-left"></i>
							</button>
						</form>
					</div>
					<?php foreach($posts as $post): ?>
                        <div class="post">
                            <form action="?page=approvePost" method="POST" style="all: unset;">
                                <img src="../Uploads//<?php echo $post->getSource()?>" class="PostImage">
                                <ul class="postDescription">
                                    <li>  <?php echo" Tytuł: ".
                                                "<input type='text' name='title' value='{$post->getTitle()}'>"?>
                                    </li>
                                    <li>  <?php echo"Opis: ".
                                            "<input type='text' name='description' value='{$post->getDescription()}'>"?>
                                    </li>
                                    <li> <?php echo "Kategoria <1-6>: 
                                            <input type='text' name='category'> "?></li>
                                    <li> <?php echo "Dodano przez: ".$post->getUserId()?> </li>
                                    <li> <?php echo(
                                            '<button type = "submit" class="submit" name="confirm">
                                                <i class=" confirm fas fa-check"></i>
                                             </button>'.
                                            '<button type = "submit" class="submit" name="denny">
                                                <i class=" denny fas fa-times"></i>
                                             </button>') ?>
                                    </li>
                                </ul>
                                <input type="hidden" name="postId" value=<?php echo($post->getId()) ?>>
                                <input type="hidden" name="postSource" value=<?php echo($post->getSource()) ?>>
                            </form>
					    </div>
					<?php endforeach ?>
					<div class = "arrowContainer">
						<form action='<?php echo($_SERVER['REQUEST_URI'])?>' method="POST">
							<button type="submit" name="next" value="Następna" class="arrow">
								<i class="fas fa-arrow-right"></i>
							</button>
						</form>
					</div>
					<div style="clear: both;"></div>	
				</div>
			</div>
			<?php include(dirname(__DIR__).'/Common/footer.php'); ?>
		</div>
	</body>
</html>