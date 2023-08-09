<?php

function display_custom_fields_on_received_order()
{
     $user_id = get_current_user_id();
     $how_heard = get_user_meta($user_id, 'How did you hear about us?', true);
     $communication_mode = get_user_meta($user_id, 'Preferable mode of communication', true);
    
    if ($how_heard) {
        echo '<p>' . __('How did you hear about us?') . ': ' . $how_heard . '</p>';
    }
    if ($communication_mode) {
        echo '<p>' . __('Preferable mode of communication') . ': ' . $communication_mode . '</p>';
    }
}
add_action('woocommerce_thankyou', 'display_custom_fields_on_received_order');
