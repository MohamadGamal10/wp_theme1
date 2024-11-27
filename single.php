<?php get_header(); ?>

<?php include(get_template_directory() . '/includes/breadcrumb.php');?>


<div class="container mt-3 post-page">


    <?php

    if (have_posts()) :
        while (have_posts()) :
            the_post();
    ?>


            <div class="main-post single-post">
                <?php edit_post_link('Edit <i class="fa-solid fa-pen-to-square"></i>'); ?>
                <h3 class="post-title">
                    <a href="<?php the_permalink(); ?>">
                        <?php the_title() ?>
                    </a>
                </h3>
                <!-- <span class="post-author"><i class="fa-solid fa-user "></i> <?php the_author_posts_link(); ?>, </span> -->
                <span class="post-date"><i class="fa-solid fa-calendar "></i> <?php the_time('F j, Y'); ?>, </span>
                <span class="post-comments"><i class="fa-solid fa-comments  "></i> <?php comments_popup_link('No Comments', '1 Comment', '% Comments', 'comments-url', 'Comments Disabled'); ?></span>
                <?php the_post_thumbnail('', ['class' => 'img-responsive img-thumbnail', 'title' => 'post image']); ?>
                <div class="post-content">
                    <!-- <?php the_content('Read More...'); ?> -->
                    <!-- <?php the_excerpt(); ?> -->
                    <?php the_content(); ?>
                </div>
                <hr>
                <p class="post-categories">
                    <i class="fa-solid fa-tags fa-lg"></i>
                    <?php the_category(','); ?>
                </p>
                <p class="post-tags">
                    <?php
                    if (has_tag()) {
                        the_tags();
                    } else {
                        echo 'No Tags';
                    } ?>
                </p>
            </div>


        <?php
        endwhile;
    endif;

    echo '<div class="clearfix"></div>';


    //get post id 
    // global $post;
    // echo $post->ID . '<br>';
    // echo get_queried_object_id();
    // print_r(wp_get_post_categories(get_the_ID()));


    $random_posts_args = array(
        'posts_per_page' => 5,
        'orderby'   => "rand",
        'category__in' => wp_get_post_categories(get_the_ID()),
        'post__not_in'  => array(get_queried_object_id())
    );
    $random_post = new WP_Query($random_posts_args);

    if ($random_post->have_posts()) :


        while ($random_post->have_posts()) :
            $random_post->the_post();
        ?>

          <div class="author-posts">

         

            <h3 class="post-title">
                <a href="<?php the_permalink(); ?>">
                    <?php the_title() ?>
                </a>
            </h3>
          <hr>
            </div>


            <div class="clearfix"></div>

    <?php
        endwhile;
    endif;
    wp_reset_postdata();

    ?>

    <div class="row author-meta">
        <div class="col-md-2">
            <?php
            $avatar_args = array(
                'class' => 'img-responsive img-thumbnail d-block mx-auto'
            );
            echo get_avatar(get_the_author_meta('ID'), 96, '', 'user avatar', $avatar_args)  ?>
        </div>
        <div class="col-md-10 author-info">
            <h4>
                <?php the_author_meta('first_name') ?>
                <?php the_author_meta('last_name') ?>
                (<span class="nickname"><?php the_author_meta('nickname') ?></span>)
            </h4>

            <?php if (get_the_author_meta('description')): ?>
                <p class="author-description"><?php the_author_meta('description'); ?></p>
            <?php
            else:
                echo '<p class="author-description">No Description</p>';
            endif; ?>

        </div>

        <hr>
        <div class="col-md-3 author-info-links">
            <p class="author-stats">
                <i class="fas fa-tags"></i>
                Posts Created By This User: <span class="post-count"> <?php echo count_user_posts(get_the_author_meta('id')); ?></span>
            </p>
            <p>
                <i class="fas fa-user"></i>
                User Profile Page: <span> <?php the_author_posts_link(); ?></span>
            </p>
        </div>

    </div>
    <?php
    echo '<hr class="comment-sparator"></hr>';
    echo "<div class='post-pagination'>";

    if (get_previous_post_link()) {
        previous_post_link('%link', '<i class="fa-solid fa-arrow-left"></i> %title');
    } else {
        echo '<span class="disabled">previous article none</span>';
    }

    if (get_next_post_link()) {
        next_post_link('%link', '%title <i class="fa-solid fa-arrow-right"></i> ');
    } else {
        echo '<span class="disabled">next article none</span>';
    }

    echo "</div>";

    echo '<hr class="comment-sparator"></hr>';

    comments_template();
    ?>

</div>



<?php get_footer(); ?>