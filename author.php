<?php get_header(); ?>

<div class="container author-page">
    <h1 class="profile-header text-center"><?php the_author_meta('nickname') ?> Page</h1>

    <div class="author-main-info ">
        <div class="row author-meta">
            <div class="col-md-3">
                <?php $avatar_args = array(
                    'class' => 'img-responsive img-thumbnail d-block mx-auto'
                );
                echo get_avatar(get_the_author_meta('ID'), 196, '', 'user avatar', $avatar_args)  ?>
            </div>
            <div class="col-md-9">
                <ul class="list-unstyled">
                    <li>First Name: <?php the_author_meta('first_name') ?></li>
                    <li>Last Name: <?php the_author_meta('last_name') ?></li>
                    <li>Nick Name: <?php the_author_meta('nickname') ?></li>
                    <hr>

                    <?php if (get_the_author_meta('description')): ?>
                        <p class="author-description"><?php the_author_meta('description'); ?></p>
                    <?php
                    else:
                        echo '<p class="author-description">No Description</p>';
                    endif; ?>
                </ul>
            </div>
        </div>
    </div>


    <div class="row author-stats">
        <div class="col-md-3">
            <div class="stats">
                Post Count <span> <?php echo count_user_posts(get_the_author_meta('id')); ?></span>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stats">
                Comments Count <span>
                    <?php
                    $comments_args  = array(
                        'user_id' => get_the_author_meta('id'),
                        'count' => true
                    );
                    echo get_comments($comments_args);

                    ?>

                </span>
            </div>

        </div>
        <div class="col-md-3">
            <div class="stats">
                Something for later use <span>0</span>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stats">
                Testing <span>0</span>
            </div>
        </div>
    </div>

    <div class="row author-all-posts">
        <?php

        $author_posts_per_page = 10; // to change it smoothly when we want 
        $author_all_post = count_user_posts(get_the_author_meta('id'));
        $author_posts_args = array(
            'author' => get_the_author_meta('id'),
            'posts_per_page' =>  $author_posts_per_page // -1 return all posts 
        );
        $author_post = new WP_Query($author_posts_args);

        if ($author_post->have_posts()) :
        ?>

            <!-- <h3>Latest Posts by <?php the_author_meta('nickname') ?></h3> -->
            <div class="col-12 text-center all-posts-header-section">
                <h3 class="all-posts-header"><?php the_author_meta('nickname') ?> latest [ <?php echo $author_posts_per_page <= $author_all_post ? $author_posts_per_page : $author_all_post; ?> ] posts </h3>
            </div>

            <?php

            while ($author_post->have_posts()) :
                $author_post->the_post();
            ?>

                <div class="row author-posts">
                    <div class="col-sm-3">
                        <?php the_post_thumbnail('', ['class' => 'img-responsive img-thumbnail', 'title' => 'post image']); ?>

                    </div>
                    <div class="col-sm-9">
                        <h3 class="post-title">
                            <a href="<?php the_permalink(); ?>">
                                <?php the_title() ?>
                            </a>
                        </h3>
                        <span class="post-date"><i class="fa-solid fa-calendar "></i> <?php the_time('F j, Y'); ?>, </span>
                        <span class="post-comments"><i class="fa-solid fa-comments  "></i> <?php comments_popup_link('No Comments', '1 Comment', '% Comments', 'comments-url', 'Comments Disabled'); ?></span>
                        <div class="post-content">
                            <!-- <?php the_content('Read More...'); ?> -->
                            <?php the_excerpt(); ?>
                        </div>
                    </div>
                </div>

                <div class="clearfix"></div>

        <?php
            endwhile;
        endif;
        wp_reset_postdata();
        ?>
    </div>

    <div class="row author-comments">
        <?php
        $author_comments_per_page = 4; // to change it smoothly when we want 
        $author_all_comments = get_comments($comments_args);
        $author_comments_args = array(
            'user_id' => get_the_author_meta('id'),
            'status' => 'approve',
            'post_status' => 'publish', // not published with (ed)
            // 'number' => $author_comments_per_page,
            'post_type' => 'post'
        );

        $author_comments = get_comments($author_comments_args);

        if ($author_comments) : ?>
            <div class="col-12 text-center comments-header-section">
                <h3 class="comments-header"><?php the_author_meta('nickname') ?> latest [ <?php echo $author_comments_per_page <= $author_all_comments ? $author_all_comments : $author_comments_per_page ; ?> ] comments </h3>
            </div>

            <?php
                foreach ($author_comments as $comment) :  ?>
                <div class="row comments-listing">

                    <div class="comment-title col-12">
                        <a href="<?php echo get_permalink($comment->comment_post_ID); ?>">
                            <?php echo get_the_title($comment->comment_post_ID); ?>
                        </a>
                    </div>

                    <div class="comment-date col-12">
                        <i class="fas fa-calendar-alt"></i> <?php echo "Added on ".  mysql2date("d/m/Y", $comment->comment_date); ?>
                    </div>

                    <div class="comment-content col-12">
                        <?php echo $comment->comment_content; ?>
                    </div>


                </div> <!-- ./comments-listing -->
            <?php endforeach; ?>
        <?php else :
            echo "There is no commment belong to this user";
        endif;   ?>



    </div> <!-- ./author-comments -->
</div>


<?php get_footer(); ?>