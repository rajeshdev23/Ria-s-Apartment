<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package ria\'s-apartment
 */

get_header();
?>
<style>
	.error_page{
		display: flex;
		flex-direction: column;
		
	}
</style>

<section class="gallery hero__main error">
	<div class="container">
		<div class="gallery__wrapper">
			<div class="location__header mx-auto error_page">
				<h1 class="section-head-big text-center">404
				</h1>
				<a target="_self" href="<?php echo esc_url(home_url('/')); ?>" class="btn-theme"> Go Back To Home </a>
			</div>
		</div>
	</div>
</section>
<?php
get_footer();
