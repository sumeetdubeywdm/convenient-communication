<?php

function enqueue_scripts()
{
    wp_enqueue_script('main.js', plugin_dir_url(__FILE__) . '../public/js/main.js');
}

function display_custom_checkout_fields_on_dashboard($order_id)
{
    echo '<div id="my-account-dashboard"><h4>' . __('Preferred Communication') . '</h4>';

    $uid = get_current_user_id();
    $how_heard = get_user_meta($uid, 'How did you hear about us?', true);
    $communication_mode = get_user_meta($uid, 'Preferable mode of communication', true);

    if (isset($_POST['update_metadata'])) {

        if (isset($_POST['heard_about_us'])) {
            update_user_meta($uid, 'How did you hear about us?', sanitize_text_field($_POST['heard_about_us']));
        }

        if (isset($_POST['pre_communication'])) {
            update_user_meta($uid, 'Preferable mode of communication', sanitize_text_field($_POST['pre_communication']));
        }

        if (!empty($how_heard) && $how_heard !== $_POST['heard_about_us']) {
            $note = sprintf(__('How did you hear: %s'), sanitize_text_field($_POST['heard_about_us']));
            wc_create_order_note($order_id, $note);
        }

        if (!empty($communication_mode) && $communication_mode !== $_POST['pre_communication']) {
            $note = sprintf(__('Preferable communication: %s'), sanitize_text_field($_POST['pre_communication']));
            wc_create_order_note($order_id, $note);
        }
    }
?>

    <div id="avlForm" style="display: block;">
        <?php
        if (!empty($how_heard)) {
            echo '<p><strong>' . __('How did you hear about us?') . '</strong><br>' . esc_html($how_heard) . '</p>';
        }

        if (!empty($communication_mode)) {
            echo '<p><strong>' . __('Preferable mode of communication') . '</strong><br>' . esc_html($communication_mode) . '</p>';
        }
        ?>
        <button id="editButton">Edit</button>
    </div>
    <!-- Edit Button -->

    <div id="editForm" style="display: none;">
        <form method="post">
            <label for="heard_about_us">How did you hear about us?</label>
            <textarea name="heard_about_us"><?php echo esc_textarea($how_heard); ?></textarea>

            <br>

            <label for="pre_communication">Preferable mode of communication</label>
            <select name="pre_communication" id="pre_communication">
                <option value=" ">Select an option</option>
                <option value="email" <?php selected($communication_mode, 'email'); ?>>Email</option>
                <option value="message" <?php selected($communication_mode, 'message'); ?>>Message</option>
                <option value="call" <?php selected($communication_mode, 'call'); ?>>Call</option>
            </select><br>

            <input type="submit" name="update_metadata" value="Update">
        </form>
    </div>
<?php

}
add_action('woocommerce_account_dashboard', 'display_custom_checkout_fields_on_dashboard');
add_action('wp_enqueue_scripts', 'enqueue_scripts');

function history_order_note($order_id)
{
    $order = wc_get_order($order_id);
    $user_id = $order->get_user_id();

    $how_heard = get_user_meta($user_id, 'How did you hear about us?', true);
    $communication_mode = get_user_meta($user_id, 'Preferable mode of communication', true);

    $note = sprintf(__('How did you hear about us: %s, Preferable communication: %s'), $how_heard, $communication_mode);
    $order->add_order_note($note);
}
add_action('woocommerce_new_order', 'history_order_note');
