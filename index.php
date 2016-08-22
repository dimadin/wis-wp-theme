<?php
/**
 * The main template file.
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="profile" href="http://gmpg.org/xfn/11">
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
		<?php wp_head(); ?>
		<?php // http://stackoverflow.com/a/23536146 ?>
		<style type="text/css">
		.navbar-collapse.collapse {
		  display: block!important;
		}

		.navbar-nav>li, .navbar-nav {
		  float: left !important;
		}

		.navbar-nav.navbar-right:last-child {
		  margin-right: -15px !important;
		}

		.navbar-right {
		  float: right!important;
		}
		</style>
	</head>

	<body <?php body_class(); ?>>
		<noscript>
			<div class="container">
				<div class="row">
					<div class="col-xs-12">
						<div class="jumbotron">
							<p>
								Не можете да прегледате ову страницу зато што је јаваскрипт онемогућен.
							</p>
						</div>
					</div>
				</div>
			</div>
		</noscript>

		<div id="wis-content"></div>
		<?php wp_footer(); ?>
	</body>
</html>
