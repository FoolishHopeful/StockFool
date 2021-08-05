<?php

/**
 * Selector Block Template.
 *
 */

$title = get_field('selector_title');
$selected = get_field('articles');
$order = get_field('sort_order');

global $wp_query;

$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

$args = array( 'post_type'=>'news', 'post__in' => $selected ,'posts_per_page' => 10,'paged' => $paged,'orderby' => 'post_date','order' => $order );


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
    $total_pages = $loop->max_num_pages;
    //Adds the 10 section pagination requirement
    if ($total_pages > 1) {
        $current_page = max(1, get_query_var('paged'));
        echo '<div>';
        echo paginate_links(array(
            'base' => get_pagenum_link(1) . '%_%',
            'format' => 'page/%#%',
            'current' => $current_page,
            'total' => $total_pages,
            'prev_text'    => __('« prev'),
            'next_text'    => __('next »'),
        ));
        echo '</div>';
    }
}
wp_reset_postdata();
