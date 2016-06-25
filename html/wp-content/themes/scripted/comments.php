
<?php // Check if password protected
    if ( post_password_required() ) return;
?>

<?php $comments_by_type = separate_comments( $comments ); ?>

<?php if ( !empty( $comments_by_type['comment'] ) ) : ?>

	<!--Comments Section-->
	<div class="entry-comments" id="comments">	
		<h3><?php comments_number( __( '0 Replies', 'scripted'), __( '1 Reply', 'scripted' ), __( '% Replies', 'scripted' ) ); ?></h3>      
        <?php if ( !comments_open() && '0' != get_comments_number() ) : ?>
			<p class="comments-closed"><?php _e( 'Reply section is closed.', 'scripted' ) ?></p>
		<?php else : ?>
        	<ol class="comment-list">
            	<?php wp_list_comments( 'type=comment&callback=scripted_comment' ); ?>
        	</ol>
            <?php paginate_comments_links() ?>
    	<?php endif; ?>    	
	</div>

<?php elseif ( !comments_open() && !is_page() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>
   
    <p><?php _e( 'Reply section is closed.', 'scripted' ) ?></p>

<?php endif; ?>


<?php if ( comments_open() ) : ?>
    
	<!--Leave Response-->
	<?php
        $fields = array(
            'comment_field'        => '<p class="comment-form-comment"><label>' . __( 'Comment', 'scripted' ) . '</label><textarea id="comment" name="comment" aria-required="true"></textarea></p>',
            'must_log_in'          => '<p class="must-log-in">' .  sprintf( __( 'You must be <a href="%s">logged in</a> to post a comment.', 'scripted' ), esc_url( wp_login_url( apply_filters( 'the_permalink', get_permalink( ) ) ) ) ) . '</p>',
            'logged_in_as'         => '<p class="logged-in-as">' . sprintf( __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out</a>', 'scripted' ), esc_url ( admin_url( 'profile.php' ) ), $user_identity, esc_url( wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) ) ) ) . '</p>',
            'comment_notes_before' => '',
            'comment_notes_after'  => '',
            'title_reply'          => __( 'Reply', 'scripted' ),
            'title_reply_to'       => __( 'Reply to %s', 'scripted' ),
            'cancel_reply_link'    => __( 'X', 'scripted' ),
            'label_submit'         => __( 'Post Reply', 'scripted' )
        );
    ?>
    		    	
    <?php comment_form( $fields ); ?>
    
<?php endif; ?>
