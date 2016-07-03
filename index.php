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
	</head>

	<body <?php body_class(); ?>>
		<div id="container">
			<div id="content">
				<div class="container">
					<div class="row">
						<div class="col-xs-12">
							<div id="wis-content">
							</div><!-- #wis-content -->
						</div><!-- .col-xs-12 -->
					</div><!-- .row -->
				</div><!-- .container -->
			</div><!-- #content -->
		</div><!-- #container -->
		<?php wp_footer(); ?>
	</body>
</html>
