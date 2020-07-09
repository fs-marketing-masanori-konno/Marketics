<?php
/*
Template Name: 汎用
*/

get_header(); ?>

		<!-- main -->
		<div class="l-main">
		
			<?php
			while ( have_posts() ) : the_post();
				remove_filter('the_content', 'wpautop');
				the_content();
			endwhile;
			?>

		</div>
		<!-- /main -->

<?php get_footer(); ?>
