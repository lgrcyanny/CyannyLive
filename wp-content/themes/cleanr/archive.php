<?php  get_header(); ?>

	<div class="grid_11">
	<div id="content">

		<?php if (have_posts()) : ?>

 	  	<header class="page-header">
			<h2 class="pagetitle">
				<?php if ( is_day() ) : ?>
					<?php printf( __( 'Daily Archives: %s', 'cleanr' ), '<span>' . get_the_date() . '</span>' ); ?>
				<?php elseif ( is_month() ) : ?>
					<?php printf( __( 'Monthly Archives: %s', 'cleanr' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'cleanr' ) ) . '</span>' ); ?>
				<?php elseif ( is_year() ) : ?>
					<?php printf( __( 'Yearly Archives: %s', 'cleanr' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'cleanr' ) ) . '</span>' ); ?>				
				<?php elseif (is_category()) : ?>
					<?php single_cat_title(); ?>
				<?php else : ?>
					<?php _e( 'Archives', 'cleanr' ); ?>
				<?php endif; ?>
			</h2>
		</header>

		<?php while (have_posts()) : the_post(); ?>
		
		<div <?php post_class() ?>>
				<span class="postmetadata"><?php the_category(' / '); ?> &mdash; <?php edit_post_link( __( 'Edit', 'cleanr' ), '', ' &mdash; '); ?>  <?php comments_popup_link( __( 'No Comments', 'cleanr' ), '1 Comment', '% Comments' ); ?></span><br/>
			    <small><span class="datef"><?php the_time('d'); ?></span><br /><?php the_time('M y'); ?> <!-- by <?php the_author() ?> --></small>
				<h2><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php _e( 'Permanent link to ', 'cleanr' ); ?><?php  the_title_attribute(); ?>"><?php the_title(); ?></a></h2>

				<div class="entry">
					<?php the_content( '<em>Continue reading &rarr;</em>' ); ?>
				</div>
				<div class="clearfix"></div>				

			</div>

		<?php endwhile; ?>

		<div class="navigation">
			<div class="alignleft"><?php next_posts_link('&larr; Older Entries') ?></div>
			<div class="alignright"><?php previous_posts_link('Newer Entries &rarr;') ?></div>
			<div class="clearfix"></div>
		</div>
	<?php else :

		if ( is_category() ) { // If this is a category archive
			printf("<h2 class='center'>Sorry, but there aren't any posts in the %s category yet.</h2>", single_cat_title('',false));
		} else if ( is_date() ) { // If this is a date archive
			echo("<h2>Sorry, but there aren't any posts with this date.</h2>");
		} else if ( is_author() ) { // If this is a category archive
			$userdata = get_userdatabylogin(get_query_var('author_name'));
			printf("<h2 class='center'>Sorry, but there aren't any posts by %s yet.</h2>", $userdata->display_name);
		} else {
			echo("<h2 class='center'>No posts found.</h2>");
		}
		//get_search_form();

	endif;
?>

	</div>
	</div>

<?php  get_sidebar(); ?>

<?php get_footer(); ?>
