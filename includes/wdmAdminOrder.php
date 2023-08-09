<?php

function custom_field_display_admin_order_meta($order)
{

    $uid = get_current_user_id();
    $how_heard = get_user_meta($uid, 'How did you hear about us?', true);
    $communication_mode = get_user_meta($uid, 'Preferable mode of communication', true);

    echo '<p><strong>' . __('How did you hear about us?') . ':</strong> ' . $how_heard . '</p>';
    echo '<p><strong>' . __('Preferable mode of communication') . ':</strong> ' . $communication_mode . '</p>';
}

add_action('woocommerce_admin_order_data_after_billing_address', 'custom_field_display_admin_order_meta');

