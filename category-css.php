<?php get_header(); ?>

<div class="container mt-3  home-page category-page">
    <div class="row cat-info">
        <div class="col-md">
            <h1 class="cat-title"><?php single_cat_title(); ?></h1>
        </div>
        <div class="col-md">
            <div class="cat-desc"><?php echo category_description(); ?></div>
        </div>
        <div class="col-md">
            <div class="cat-stats">
                <span> Posts Count: 20, </span>
                <span> Comments Count: 100</span>
            </div>
        </div>

    </div>

    <div class="row ">

        <div class="col-sm-9">
            <?php

            if (have_posts()) :
                while (have_posts()) :
                    the_post();
            ?>


                    <div class="main-post">
                        <div class="row">
                            <div class="col-md-6 post-img">
                            <?php the_post_thumbnail('', ['class' => 'img-responsive img-thumbnail', 'title' => 'post image']); ?>

                            </div>
                            <div class="col-md-6 post-title">
                            <h3 class="post-title">
                            <a href="<?php the_permalink(); ?>">
                                <?php the_title() ?>
                            </a>
                        </h3>
                        <span class="post-author"><i class="fa-solid fa-user "></i> <?php the_author_posts_link(); ?>, </span>
                        <span class="post-date"><i class="fa-solid fa-calendar "></i> <?php the_time('F j, Y'); ?>, </span>
                        <span class="post-comments"><i class="fa-solid fa-comments  "></i> <?php comments_popup_link('No Comments', '1 Comment', '% Comments', 'comments-url', 'Comments Disabled'); ?></span>
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
                            if (has_tag()) {
                                the_tags();
                            } else {
                                echo 'No Tags';
                            } ?>
                        </p>
                            </div>
                        </div>
                       
                    </div>


            <?php
                endwhile;
            endif;
            ?>
        </div>


        <div class="col-sm-3 sidebar-cat">
            <?php
            // if(is_active_sidebar('main-sidebar')){
            //    dynamic_sidebar('main-sidebar');
            // }

            get_sidebar('css');
            ?>
        </div>

        <?php

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