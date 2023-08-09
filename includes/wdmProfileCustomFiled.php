<?php 


function add_custom_user_fields()
{
    if (!current_user_can('manage_options')) {
        return;
    }
    $uid = get_current_user_id();
    
    $how_heard = get_user_meta($uid, 'How did you hear about us?', true);
    $communication_mode = get_user_meta($uid, 'Preferable mode of communication', true);
    ?>
<h3> Custom User Fields</h3>

<table class="form-table">
    <tr>
        <th><label for="how_heard">How did you hear about us?</label></th>
        <td><textarea id="how_heard" name="how_heard"><?php echo esc_textarea($how_heard); ?></textarea></td>
    </tr>

    <tr>
        <th><label for="pre_communication">Preferable mode of communication</label></th>
        <td>
            <select name="pre_communication" id="pre_communication">
                <option value=" ">Select an option</option>
                <option value="email" <?php selected($communication_mode, 'email'); ?>>Email</option>
                <option value="message" <?php selected($communication_mode, 'message'); ?>>Message</option>
                <option value="call" <?php selected($communication_mode, 'call'); ?>>Call</option>
            </select><br>
        </td>
    </tr>

</table>
<?php
}
add_action('show_user_profile', 'add_custom_user_fields');

function save_custom_user_fields()
{
    $uid = get_current_user_id();
    if (!current_user_can('edit_user', $uid)) {
        return;
    }
    
    update_user_meta($uid, 'How did you hear about us?', sanitize_text_field($_POST['how_heard']));
    update_user_meta($uid, 'Preferable mode of communication', sanitize_text_field($_POST['pre_communication']));
}
add_action('personal_options_update', 'save_custom_user_fields');