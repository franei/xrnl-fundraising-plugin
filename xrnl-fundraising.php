<?php
/**
 * Plugin Name: XRNL Fundraising
 * Description: Metrics for the Fundraising team.
 * Version: 0.1
 * Author: XRNL Tech
 */

function get_redirect_url($lang)
{
  return 'https://www.whydonate.nl/fundraising/help-extinction-rebellion-nederland/' . $lang;
}

function xrnlf_shortcode()
{
  $donate_page = get_page_by_path('/donate');
  $postID = $donate_page->ID;
  $counts = get_post_meta($postID, 'xrnlf_views_count', false);
  $row = 0;
  foreach ($counts[0] as $date => $count) {
    $row++;
    $rows .= '<tr><td>' . $row . '</td><td>' . $date . '</td><td>' . $count . '</td></tr>';
  }
  return $rows;
}
add_shortcode('xrnl-fundraising', 'xrnlf_shortcode');

function xrnlf_update_count($postID)
{
  $date = date('d-m-y');
  $counts = get_post_meta($postID,'xrnlf_views_count',false);
  if (array_key_exists($date, $counts[0])) {
    $counts[0][$date]++;
  } else {
    $counts[0][$date] = 1;
  }
  delete_post_meta($postID, 'xrnlf_views_count');
  add_post_meta($postID, 'xrnlf_views_count', $counts[0]);
}

function xrnlf_uri_handler()
{
  if (preg_match('/^\/(en\/)?donate\/?$/', $_SERVER["REQUEST_URI"])) {
    $donate_page = get_page_by_path('/donate');
    xrnlf_update_count($donate_page->ID);
    $lang = get_locale() === 'en_US' ? 'en' : 'nl';
    wp_redirect(get_redirect_url($lang));
    exit();
  }
}
add_action('init', 'xrnlf_uri_handler');
