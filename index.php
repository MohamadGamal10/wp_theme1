<?php get_header(); ?>

<div class="container mt-3  home-page">
    <div class="row">

        <?php

        if (have_posts()) :
            while (have_posts()) :
                the_post();
        ?>

                <div class="col-sm-6">
                    <div class="main-post">
                        <h3 class="post-title">
                            <a href="<?php the_permalink(); ?>">
                                <?php the_title() ?>
                            </a>
                        </h3>
                        <span class="post-author"><i class="fa-solid fa-user "></i> <?php the_author_posts_link(); ?>, </span>
                        <span class="post-date"><i class="fa-solid fa-calendar "></i> <?php the_time('F j, Y'); ?>, </span>
                        <span class="post-comments"><i class="fa-solid fa-comments  "></i> <?php comments_popup_link('No Comments', '1 Comment', '% Comments' , 'comments-url' , 'Comments Disabled'); ?></span>
                        <?php the_post_thumbnail('' , ['class' => 'img-responsive img-thumbnail' , 'title' => 'post image']); ?>
                        <div class="post-content">
                            <!-- <?php the_content('Read More...'); ?> -->
                            <?php the_excerpt(); ?>
                        </div>
                        <hr>
                        <p class="post-categories">
                            <i class="fa-solid fa-tags fa-lg"></i>
                            <?php the_category(','); ?>
                        </p>
                        <p class="post-tags">
                            <?php
                            if(has_tag()){
                            the_tags();
                            }else{
                            echo 'No Tags';
                            } ?>
                        </p>
                    </div>
                </div>

        <?php
            endwhile;
        endif;

        echo '<div class="clearfix"></div>';
        // echo "<div class='post-pagination'>";

        // if(get_previous_posts_link()){
        //     previous_posts_link('<i class="fa-solid fa-arrow-left"></i> prev');
        // }else{
        //     echo '<span class="disabled">no previous page</span>';
        // }

        // if(get_next_posts_link()){
        //     next_posts_link('next <i class="fa-solid fa-arrow-right "></i>');
        // }else{
        //     echo '<span class="disabled">no next page</span>';
        // }

        // echo "</div>";

        echo '<div class="number-pagination">';
        echo numbering_pagination();
        echo '</div>';
        ?>



    </div>
</div>




<?php get_footer(); ?>