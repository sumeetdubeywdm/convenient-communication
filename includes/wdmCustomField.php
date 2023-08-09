<?php

function custom_checkout_field($checkout)
{
    $uid = get_current_user_id();

    echo '<div id="custom_checkout_option"><h2>' . __('Please tell something about it') . '</h2>';

    $how_heard = get_user_meta($uid, 'How did you hear about us?', true);
    $communication_mode = get_user_meta($uid, 'Preferable mode of communication', true);

    woocommerce_form_field('heard_about_us', array(
        'type' => 'textarea',
        'class' => array('my-field-class form-row-wide'),
        'label' => __('How did you hear about us?'),
        'placeholder' => __('Enter how you heard about us'),
        'default' => $how_heard, 
    ), $checkout->get_value('heard_about_us'));

    woocommerce_form_field('pre_communication', array(
        'type' => 'select',
        'class' => array('my-field-class form-row-wide'),
        'label' => __('Preferable mode of communication'),
        'options' => array(
            '' => __('Select an option'),
            'email' => __('Email'),
            'call' => __('Call'),
            'message' => __('Message'),
        ),
        'default' => $communication_mode, 
    ), $checkout->get_value('pre_communication'));

    echo '</div>';
}
add_action('woocommerce_after_order_notes', 'custom_checkout_field');
