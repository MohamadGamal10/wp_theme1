<?php

if(comments_open()){
      // foreach($comments as $comment){
    //     echo '<div class="comment">';
    //     echo '<h3 class="comment-author">' . $comment->comment_author . '</h3>';
    //     echo '<p class="comment-content">' . $comment->comment_content . '</p>';
    //     echo '</div>';
    // }
?>

    <h3 class="comments-count"><?php comments_number('No Comments', '1 Comment', '% Comments') ?></h3>

    <?php
    echo '<ul class="list-unstyled comments-list">';

    $list_args = array(
        'max_depth' => 3,
        'type' => 'comment',
        'avatar_size' => 64
    );

    wp_list_comments($list_args);

    echo '</ul>';


    echo '<hr class="comment-sparator"></hr>';

    $form_args = array(
        // 'fields' => array(
        //     'author' => '<div class="form-group"><label>Name</label>This is Name Field</div>',
        //     'email' => '<div class="form-group"><label>Name</label>This is Name Field</div>',
        //     'url' => '<div class="form-group"><label>Name</label>This is Name Field</div>',
        // ),
        // 'comment_field' => '<div class="form-group">textarea</div>',
        'title_reply' => "Add Your Comment", 
        "title_reply_to" => "Add a replay to [%s]", 
        "class_submit" =>"btn btn-primary btn-md", 
        "comment_notes_before" => '' 
    );
    comment_form($form_args);
  
}else{
    echo 'Comments are closed';
}