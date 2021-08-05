<?php

/**
 * Author Block Template.
 *
 */

$author = get_field('author');

?>
<div class="authorBox">
          <span class="authorTitle"><i class="fa fa-user" aria-hidden="true"></i>
 Written By:</span> <?php echo $author["user_firstname"] . " " . $author["user_lastname"]; ?></span>
          <span class="postDate"><i class="fa fa-calendar" aria-hidden="true"></i>
Published: <time datetime="<?php echo get_the_date('c'); ?>" itemprop="datePublished"><?php echo get_the_date(); ?></time></span>
</div>
