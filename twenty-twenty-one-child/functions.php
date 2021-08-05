<?php
//Create Author Block
add_action('acf/init', 'my_acf_init_block_types');
function my_acf_init_block_types()
{

    // Check function exists.
    if (function_exists('acf_register_block_type')) {

        // register a testimonial block.
        acf_register_block_type(array(
            'name'              => 'author',
            'title'             => __('Author Block'),
            'description'       => __('A custom author block.'),
            'render_template'   => 'template-parts/blocks/author/author.php',
            'category'          => 'formatting',
            'icon'              => 'admin-users',
            'keywords'          => 'author',
        ));
    }
}
//Create Recommendations Block
add_action('acf/init', 'recommended_article_init_block_types');
function recommended_article_init_block_types()
{

    // Check function exists.
    if (function_exists('acf_register_block_type')) {

        // register a Recommendations block.
        acf_register_block_type(array(
            'name'              => 'recommended',
            'title'             => __('Recommended Article'),
            'description'       => __('Displays Recommended Stock Articles'),
            'render_template'   => 'template-parts/blocks/recommended/recommended.php',
            'category'          => 'formatting',
            'icon'              => 'portfolio',
            'keywords'          => 'recommended',
        ));
    }
}

//Create News Block
add_action('acf/init', 'news_init_block_types');
function news_init_block_types()
{

    // Check function exists.
    if (function_exists('acf_register_block_type')) {

        // register a news block.
        acf_register_block_type(array(
            'name'              => 'news',
            'title'             => __('News Article'),
            'description'       => __('Displays Related News Articles'),
            'render_template'   => 'template-parts/blocks/news/news.php',
            'category'          => 'formatting',
            'icon'              => 'portfolio',
            'keywords'          => 'news',
        ));
    }
}

//Adds child theme style
add_action('wp_enqueue_scripts', 'my_theme_enqueue_styles', 11);
function my_theme_enqueue_styles()
{
    wp_enqueue_style('child-style', get_stylesheet_uri());
}

//Adds Font Awesome
add_action('wp_enqueue_scripts', 'enqueue_fa', 12);
function enqueue_fa()
{
    wp_enqueue_style('enqueue-fa', 'https://use.fontawesome.com/releases/v5.15.3/css/all.css');
}

//Fixes pagination issues
add_filter('redirect_canonical', 'pif_disable_redirect_canonical');
function pif_disable_redirect_canonical($redirect_url)
{
    if (is_singular()) {
        $redirect_url = false;
    }
    return $redirect_url;
}
