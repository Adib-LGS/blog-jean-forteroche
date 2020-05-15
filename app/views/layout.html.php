<!DOCTYPE HTML>
<html lang="en">
<head>
<title> <?= $pageTitle ?></title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="UTF-8">
	<!-- Font -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500" rel="stylesheet">
	<!-- Stylesheets -->
	<link href="common-css/bootstrap.css" rel="stylesheet">
	<link href="common-css/ionicons.css" rel="stylesheet">
	<link href="layout-1/css/styles.css" rel="stylesheet">
	<link href="layout-1/css/responsive.css" rel="stylesheet">

	<script src="https://cdn.tiny.cloud/1/7y7wzz7wq0b0923cyy3t04n91woxhnkekhmppfwjifbl7gla/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    
 	<script>
    tinymce.init({
      selector: '#tiny',
      plugins: 'a11ychecker advcode casechange formatpainter linkchecker autolink lists checklist media mediaembed pageembed permanentpen powerpaste table advtable tinycomments tinymcespellchecker bbcode',
	  spellchecker_language: 'fr',
  	  bbcode_dialect: "punbb",
	  toolbar: 'undo redo | styleselect | bold italic | link image',
      toolbar_mode: 'floating',
  	  language: 'fr_FR',
      width: 600,
      height: 300,
    });

  	</script>
	
</head>
<body >

  <?= $pageContent ?>

	<footer>
		<div class="container">
			<div class="row">

				<div class="col-lg-4 col-md-6">
					<div class="footer-section">

						<a class="logo" href="#"><img src="images/logo.png" alt="Logo Image"></a>
						<p class="copyright">Bona @ 2017. All rights reserved.</p>
						<p class="copyright">Designed by <a href="https://colorlib.com" target="_blank">Colorlib</a></p>
					</div><!-- footer-section -->
				</div><!-- col-lg-4 col-md-6 -->

				<div class="col-lg-4 col-md-6">
					<div class="footer-section">
					</div><!-- footer-section -->
				</div><!-- col-lg-4 col-md-6 -->
			</div><!-- row -->
		</div><!-- container -->
	</footer>
	<!-- SCIPTS -->
	<script src="common-js/jquery-3.1.1.min.js"></script>
	<script src="common-js/tether.min.js"></script>
	<script src="common-js/bootstrap.js"></script>
	<script src="common-js/scripts.js"></script>
</body>
</html>
