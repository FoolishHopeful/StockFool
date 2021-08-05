<?php

/**
 * Recommendations Block Template.
 */

$title = get_field('selector_title');
$selected = get_field('articles');

global $wp_query;

$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

$args = array( 'post_type'=>'recommendations', 'post__in' => $selected ,'posts_per_page' => -1,'orderby' => 'post_date','order' => get_field('sort_order') );


$loop = new WP_Query($args);
if ($loop->have_posts()) {
    echo '<div class="selectorHeading">' . get_field('selector_title') . '</div><div class="selectorContainer">';
    while ($loop->have_posts()) : $loop->the_post();

    $terms = get_the_terms(get_the_ID(), 'stock_index');
    $exchange = get_field('exchange', $terms[0]);
    $symbol = get_field('symbol', $terms[0]);
    $title = get_the_title(get_the_ID());
    echo '<div class="selectorBox"><a class="selectorLink" href="' . esc_url(get_permalink(get_the_ID())) . '"><span class="selectorTitle">' . $title . '</span><div class="selectorStock">' . $exchange . ":" . $symbol . "</div></a></div>";

    endwhile;
    echo '</div>';
}
wp_reset_postdata();
