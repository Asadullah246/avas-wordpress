<?php
/**
* 
* @package tx
* @author theme-x
* @link https://theme-x.org/
*
*/

function tx_team_meta_box() {

    add_meta_box(
        'team_sectionid',
        esc_html__( 'Team Profile', 'avas-core' ),
        'tx_team_meta_box_callback',
        'team',              // post type
        'normal'
    );

}
add_action( 'add_meta_boxes', 'tx_team_meta_box' );

/**
 * Prints the box content.
 *
 * @param WP_Post $post The object for the current post/page.
 */
function tx_team_meta_box_callback( $post ) {

// Add a nonce field so we can check for it later.
wp_nonce_field( 'tx_team_save_meta_box_data', 'tx_team_meta_box_nonce' );

/*
 * Use get_post_meta() to retrieve an existing value
 * from the database and use the value for the form.
 */


$skill_title = get_post_meta( $post->ID, 'skill_title', true );
$skill_fields = get_post_meta($post->ID, 'skill_fields', true);
$team_fb = get_post_meta( $post->ID, 'team_fb', true );
$team_tw = get_post_meta( $post->ID, 'team_tw', true );
$team_gp = get_post_meta( $post->ID, 'team_gp', true );
$team_ln = get_post_meta( $post->ID, 'team_ln', true );
$team_in = get_post_meta( $post->ID, 'team_in', true );

$hire_me = get_post_meta( $post->ID, 'hire_me', true );
$hour_rate = get_post_meta( $post->ID, 'hour_rate', true );
?>

    <script type="text/javascript">
    jQuery(document).ready(function($){
        $( '#add-row' ).on('click', function() {
            var row = $( '.empty-row.screen-reader-text' ).clone(true);
            row.removeClass( 'empty-row screen-reader-text' );
            row.insertBefore( '#project-fieldset-one tbody>tr:last' );
            return false;
        });
    
        $( '.remove-row' ).on('click', function() {
            $(this).parents('tr').remove();
            return false;
        });
    });
    </script>

<table id="project-fieldset-one" class="tx_project_details_table">
        <tbody>
            <tr><th><?php esc_html_e('Title','avas-core'); ?></th></tr>
            <tr class="tx_pb_10">
                <td><input type="text" class="widefat" name="skill_title" value="<?php echo esc_attr( $skill_title ); ?>" size="50" /></td>
            </tr>
            <tr>
                <th><?php esc_html_e('Name','avas-core'); ?></th>
                <th><?php esc_html_e('Value','avas-core'); ?></th>
            </tr>
        <?php
        if ( $skill_fields ) :
        foreach ( $skill_fields as $field ) { ?>
            <tr>
                <td><input type="text" class="widefat" name="name[]" value="<?php if($field['name'] != '') echo esc_attr( $field['name'] ); ?>" size="50" /></td>
                <td><input type="text" class="widefat" name="value[]" value="<?php if ($field['value'] != '') echo esc_attr( $field['value'] ); ?>" size="50" /></td>
                <td><a class="button remove-row" href="#"><?php esc_html_e('Remove','avas-core'); ?></a></td>
            </tr>
        <?php } else : ?>
            <tr>
                <td><input type="text" class="widefat" name="name[]" /></td>
                <td><input type="text" class="widefat" name="value[]" /></td>
                <td><a class="button remove-row" href="#"><?php esc_html_e('Remove','avas-core'); ?></a></td>
            </tr>
        <?php endif; ?>
            <tr class="empty-row screen-reader-text">
                <td><input type="text" class="widefat" name="name[]" /></td>
                <td><input type="text" class="widefat" name="value[]" /></td>
                <td><a class="button remove-row" href="#"><?php esc_html_e('Remove','avas-core'); ?></a></td>
            </tr>
            <tr><td><a id="add-row" class="button" href="#"><?php esc_html_e('Add New','avas-core'); ?></a> </td></tr>
        </tbody>    
</table>
<table class="form-table">
    <tr>
        <th><label for="team_fb"><?php echo esc_html_e( 'Facebook', 'avas-core' ); ?></label></th>
        <td><input type="text" id="team_fb" name="team_fb" value="<?php echo esc_attr( $team_fb ); ?>" size="50" /></td>
    </tr>
    <tr>
        <th><label for="team_tw"><?php echo esc_html_e( 'Twitter', 'avas-core' ); ?></label></th>
        <td><input type="text" id="team_tw" name="team_tw" value="<?php echo esc_attr( $team_tw ); ?>" size="50" /></td>
    </tr>
    <tr>
        <th><label for="team_gp"><?php echo esc_html_e( 'Youtube', 'avas-core' ); ?></label></th>
        <td><input type="text" id="team_gp" name="team_gp" value="<?php echo esc_attr( $team_gp ); ?>" size="50" /></td>
    </tr>
    <tr>
        <th><label for="team_ln"><?php echo esc_html_e( 'LinkedIn', 'avas-core' ); ?></label></th>
        <td><input type="text" id="team_ln" name="team_ln" value="<?php echo esc_attr( $team_ln ); ?>" size="50" /></td>
    </tr>
    <tr>
        <th><label for="team_in"><?php echo esc_html_e( 'Instagram', 'avas-core' ); ?></label></th>
        <td><input type="text" id="team_in" name="team_in" value="<?php echo esc_attr( $team_in ); ?>" size="50" /></td>
    </tr>
    <tr>
        <th><label for="hire_me"><?php echo esc_html_e( 'Link URL', 'avas-core' ); ?></label></th>
        <td><input type="text" id="hire_me" name="hire_me" value="<?php echo esc_attr( $hire_me ); ?>" size="40" /></td>
    </tr>
    <tr>
        <th><label for="hour_rate"><?php echo esc_html_e( 'Link Text', 'avas-core' ); ?></label></th>
        <td><input type="text" id="hour_rate" name="hour_rate" value="<?php echo esc_attr( $hour_rate ); ?>" size="40" /></td>
    </tr>
</table>

<?php
}

/**
 * When the post is saved, saves our custom data.
 *
 * @param int $post_id The ID of the post being saved.
 */
add_action( 'save_post', 'tx_team_save_meta_box_data' );
 function tx_team_save_meta_box_data( $post_id ) {

 if ( ! isset( $_POST['tx_team_meta_box_nonce'] ) ) {
    return;
 }

 if ( ! wp_verify_nonce( $_POST['tx_team_meta_box_nonce'], 'tx_team_save_meta_box_data' ) ) {
    return;
 }

 if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
    return;
 }

 // Check the user's permissions.
 if ( isset( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {

    if ( ! current_user_can( 'edit_page', $post_id ) ) {
        return;
    }

 } else {

    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }
 }


// Sanitize user input

$skill_title_data = isset( $_POST[ 'skill_title' ] ) ? sanitize_text_field( $_POST[ 'skill_title' ] ) : '';
$team_fb_data = isset( $_POST[ 'team_fb' ] ) ? sanitize_text_field( $_POST[ 'team_fb' ] ) : '';
$team_tw_data = isset( $_POST[ 'team_tw' ] ) ? sanitize_text_field( $_POST[ 'team_tw' ] ) : '';
$team_gp_data = isset( $_POST[ 'team_gp' ] ) ? sanitize_text_field( $_POST[ 'team_gp' ] ) : '';
$team_ln_data = isset( $_POST[ 'team_ln' ] ) ? sanitize_text_field( $_POST[ 'team_ln' ] ) : '';
$team_in_data = isset( $_POST[ 'team_in' ] ) ? sanitize_text_field( $_POST[ 'team_in' ] ) : '';
$hire_me_data = isset( $_POST[ 'hire_me' ] ) ? sanitize_text_field( $_POST[ 'hire_me' ] ) : '';
$hour_rate_data = isset( $_POST[ 'hour_rate' ] ) ? sanitize_text_field( $_POST[ 'hour_rate' ] ) : '';

// Update the meta field in the database
update_post_meta( $post_id, 'skill_title', $skill_title_data );
update_post_meta( $post_id, 'team_fb', $team_fb_data );
update_post_meta( $post_id, 'team_tw', $team_tw_data );
update_post_meta( $post_id, 'team_gp', $team_gp_data );
update_post_meta( $post_id, 'team_ln', $team_ln_data );
update_post_meta( $post_id, 'team_in', $team_in_data );
update_post_meta( $post_id, 'hire_me', $hire_me_data );
update_post_meta( $post_id, 'hour_rate', $hour_rate_data );

$old = get_post_meta($post_id, 'skill_fields', true);
    $new = array();
    $names = $_POST['name'];
    $values = $_POST['value'];
    $count = count( $names );

    for ( $i = 0; $i < $count; $i++ ) {
        if ( $names[$i] != '' ) :
            $new[$i]['name'] = stripslashes( strip_tags( $names[$i] ) );
        
            if ( $values[$i] == '' )
                $new[$i]['value'] = '';
            else
                $new[$i]['value'] = stripslashes( $values[$i] );
        endif;
    }
    if ( !empty( $new ) && $new != $old ) {
        update_post_meta( $post_id, 'skill_fields', $new );
    }
    elseif ( empty($new) && $old ) {
        delete_post_meta( $post_id, 'skill_fields', $old );
    }

}


/* ---------------------------------------------------------
   Team Template Settings
------------------------------------------------------------ */
add_action('add_meta_boxes', 'tx_team_temp_settings');
function tx_team_temp_settings()
{
    global $post;

     if(!empty($post))
     {
        $pageTemplate = get_post_meta($post->ID, '_wp_page_template', true);

         if($pageTemplate == 'templates/team.php' || $pageTemplate == 'templates/team-full.php' ) // display on services template only
         {
            add_meta_box(
                'tx_team_temp_settings', // $id
                esc_html__('Team Settings','avas-core'), // $title
                'tx_team_temp_settings_cb', // $callback
                'page', // $page
                'normal', // $context
                'high'); // $priority
         }
     }
}

function tx_team_temp_settings_cb( $post ) {
wp_nonce_field( 'tx_team_temp_settings_nonce', 'tx_team_temp_settings_nonce' );

$item_per_page = get_post_meta( $post->ID, 'item_per_page', true );
$display = get_post_meta( $post->ID, 'display', true );
$title = get_post_meta( $post->ID, 'title', true );
$desc = get_post_meta( $post->ID, 'desc', true );
$social_profiles = get_post_meta( $post->ID, 'social_profiles', true );
$team_category = get_post_meta( $post->ID, 'team_category', true );
?>
   
  <div class="tx-portfolio-settings">
     
    
    <div>
        <p for="display"><?php echo esc_html_e('Display Type','avas-core'); ?></p>
        <select name="display" id="display">
          <option value="grid_t" <?php selected( $display, 'grid' ); ?>><?php echo esc_html_e('Grid','avas-core'); ?></option>
          <option value="card_t" <?php selected( $display, 'card' ); ?>><?php echo esc_html_e('Card','avas-core'); ?></option>
        </select>
    </div>
    <div>
        <p for="team_category"><?php echo esc_html_e('Category','avas-core'); ?></p>
        <select name="team_category" id="team_category">
          <option value="show" <?php selected( $team_category, 'show' ); ?>><?php echo esc_html_e('Show','avas-core'); ?></option>
          <option value="hide" <?php selected( $team_category, 'hide' ); ?>><?php echo esc_html_e('Hide','avas-core'); ?></option>
        </select>
    </div>
    <div>
        <p for="title"><?php echo esc_html_e('Title','avas-core'); ?></p>
        <select name="title" id="title">
          <option value="show" <?php selected( $title, 'show' ); ?>><?php echo esc_html_e('Show','avas-core'); ?></option>
          <option value="hide" <?php selected( $title, 'hide' ); ?>><?php echo esc_html_e('Hide','avas-core'); ?></option>
        </select>
    </div>
    <div>
        <p for="desc"><?php echo esc_html_e('Excerpt','avas-core'); ?></p>
        <select name="desc" id="desc">
          <option value="show" <?php selected( $desc, 'show' ); ?>><?php echo esc_html_e('Show','avas-core'); ?></option>
          <option value="hide" <?php selected( $desc, 'hide' ); ?>><?php echo esc_html_e('Hide','avas-core'); ?></option>
        </select>
    </div>
    <div>
        <p for="social_profiles"><?php echo esc_html_e('Social Profiles','avas-core'); ?></p>
        <select name="social_profiles" id="social_profiles">
          <option value="show" <?php selected( $social_profiles, 'show' ); ?>><?php echo esc_html_e('Show','avas-core'); ?></option>
          <option value="hide" <?php selected( $social_profiles, 'hide' ); ?>><?php echo esc_html_e('Hide','avas-core'); ?></option>
        </select>
    </div>
    <div>
        <p for="item_per_page"><?php echo esc_html_e('Item per page','avas-core'); ?></p>
        <input type="text" name="item_per_page" id="item_per_page" value="<?php echo $item_per_page; ?>" placeholder="<?php echo esc_html_e('Default 9. Enter -1 to show all','avas-core'); ?>" size="27" />
    </div>

<?php
}

add_action( 'save_post', 'tx_team_temp_settings_save' );
function tx_team_temp_settings_save( $post_id ) {

    // Bail if we're doing an auto save
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
     
    // if our nonce isn't there, or we can't verify it, bail
    if( !isset( $_POST['tx_team_temp_settings_nonce'] ) || !wp_verify_nonce( $_POST['tx_team_temp_settings_nonce'], 'tx_team_temp_settings_nonce' ) ) return;
     
    // if our current user can't edit this page, bail
    if( !current_user_can( 'edit_post', $post_id ) ) return;
     
$item_per_page_data = isset( $_POST[ 'item_per_page' ] ) ? sanitize_text_field( $_POST[ 'item_per_page' ] ) : '';
$display_data = isset( $_POST[ 'display' ] ) ? sanitize_text_field( $_POST[ 'display' ] ) : '';
$title_data = isset( $_POST[ 'title' ] ) ? sanitize_text_field( $_POST[ 'title' ] ) : '';
$desc_data = isset( $_POST[ 'desc' ] ) ? sanitize_text_field( $_POST[ 'desc' ] ) : '';
$social_profiles_data = isset( $_POST[ 'social_profiles' ] ) ? sanitize_text_field( $_POST[ 'social_profiles' ] ) : '';
$team_category_data = isset( $_POST[ 'team_category' ] ) ? sanitize_text_field( $_POST[ 'team_category' ] ) : '';

update_post_meta( $post_id, 'item_per_page', $item_per_page_data );
update_post_meta( $post_id, 'display', $display_data );
update_post_meta( $post_id, 'title', $title_data );
update_post_meta( $post_id, 'desc', $desc_data );
update_post_meta( $post_id, 'social_profiles', $social_profiles_data );
update_post_meta( $post_id, 'team_category', $team_category_data );        

}




/* ---------------------------------------------------------
   EOF
------------------------------------------------------------ */ 