<?php

function save_custom_fields($order_id){
    $uid = get_current_user_id(); 
    if(!empty($_POST['heard_about_us'])){
        update_user_meta($uid, 'How did you hear about us?', sanitize_text_field($_POST['heard_about_us']));

    }
    if(!empty($_POST['pre_communication'])){
        update_user_meta($uid, 'Preferable mode of communication', sanitize_text_field($_POST['pre_communication']));

    }
}

add_action('woocommerce_checkout_update_order_meta', 'save_custom_fields');
