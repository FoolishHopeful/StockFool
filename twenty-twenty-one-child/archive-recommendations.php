<?php
/**
 * The template for displaying the recommendations archive.
 */

get_header();

$description = get_the_archive_description();
?>
<?php if (have_posts()) : ?>
	<header class="page-header alignwide">
	<h1 class="page-title">Recommendations Archive</h1>
	</header><!-- .page-header -->
  <div class="entry-content">
	<?php while (have_posts()) : ?>
		<?php the_post();
    $terms = get_the_terms(get_the_ID(), 'stock_index');
    $exchange = get_field('exchange', $terms[0]);
    $symbol = get_field('symbol', $terms[0]);
    $excerpt = get_the_excerpt();
    $excerpt = substr($excerpt, 0, 260);
    $result = substr($excerpt, 0, strrpos($excerpt, ' ')) . '...</br><a href="' . esc_url(get_permalink(get_the_ID())) .'"><div class="archive-button">Read More</div></a>';
    ?>
    <div class="archive-box">
      <span class="archive-title"><i class="far fa-newspaper"></i> <?php echo get_the_title(); ?></span><span class="archive-stockInfo">(<?php echo $exchange . ':' . $symbol; ?>)</span>
      <div class="archive-excerpt"><?php echo $result;?></div>
    </div>
	<?php endwhile; ?>
</div>
	<?php twenty_twenty_one_the_posts_navigation(); ?>

<?php else : ?>
	<?php get_template_part('template-parts/content/content-none'); ?>
<?php endif; ?>

<?php get_footer(); ?>
