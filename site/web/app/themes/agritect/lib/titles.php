<?php

namespace Roots\Sage\Titles;


function filter_archive_title($title) {
  //$title_prefixes = array ( 'Category: ', 'Archives: ' );
  $title_prefixes = array ( 'Archives: ' );
  return str_replace($title_prefixes, '', $title);
}
add_filter('get_the_archive_title', __NAMESPACE__ . '\\filter_archive_title');


/**
 * Page titles
 */
function title() {
  if (is_home()) {
    if (get_option('page_for_posts', true)) {
      return get_the_title(get_option('page_for_posts', true));
    } else {
      return __('Latest Posts', 'sage');
    }
  } elseif (is_archive()) {
    return get_the_archive_title();
  } elseif (is_search()) {
    return sprintf(__('Search: %s', 'sage'), get_search_query());
  } elseif (is_404()) {
    return __('Not Found', 'sage');
  } else {
    return get_the_title();
  }
}