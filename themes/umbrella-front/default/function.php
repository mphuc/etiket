<?php

add_action('wp_head', 'picksite_head', 10);
function picksite_head(){
    return "<script>console.log('wp head');</script>";
}

add_action('wp_footer', 'picksite_footer', 11);
function picksite_footer(){
    return "<script>console.log('wp footer');</script>";
}