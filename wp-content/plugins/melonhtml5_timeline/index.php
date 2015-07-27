<?php
/*
Plugin Name: MelonHTML5 Timeline
Plugin URI: http://codecanyon.net/item/melonhtml5-timeline-wp/8639807?ref=MelonHTML5
Description: MelonHTML5 - Timeline WP
Version: 1.11
Author: Lee Le @ MelonHTML5
Author URI: http://codecanyon.net/item/melonhtml5-timeline-wp/8639807?ref=MelonHTML5
*/

define('PLUGIN_DIR',  'melonhtml5_timeline');
define('ADMIN_DIR',   'admin');

register_activation_hook( __FILE__, 'plugin_install_timeline' );

add_shortcode('melonhtml5-timeline', 'shortcode_timeline');

add_action('admin_menu',                    'add_menu_timeline');
add_action('admin_enqueue_scripts',         'include_admin_script_timeline');
add_action('wp_enqueue_scripts',            'include_plugin_script_timeline');
add_action('wp_ajax_get_timeline',          'get_json_timeline');
add_action('wp_ajax_get_timeline_theme',    'get_theme_timeline');
add_action('wp_ajax_save_timeline',         'save_timeline');
add_action('wp_ajax_add_timeline',          'add_timeline');
add_action('wp_ajax_save_timeline_theme',   'save_timeline_theme');
add_action('wp_ajax_delete_timeline',       'delete_timeline');
add_action('wp_ajax_copy_timeline',         'copy_timeline');

function mb_unserialize($string) {
  $string = preg_replace('!s:(\d+):"(.*?)";!se', "'s:'.strlen('$2').':\"$2\";'", $string);
  return unserialize($string);
}

function shortcode_timeline($attributes, $content) {
  $error = false;
  $has_facebook = false;

  if (isset($attributes['id'])) {
    $timeline_id = $attributes['id'];

    $timeline_data = get_array_timeline(array($timeline_id));

    if (count($timeline_data)) {
      $timeline_data = $timeline_data[0];

      $custom_data = 'null';

      if ($timeline_data['data_type'] == 'facebook') {
        if (!$has_facebook) {
          wp_enqueue_script('facebook-api', '//connect.facebook.net/en_US/sdk.js');
          $has_facebook = true;
        }

        $timeline_data['data']['twitter_search_key']    = false;
      } else if ($timeline_data['data_type'] == 'twitter') {
        $timeline_data['data']['facebook_app_id']       = false;
        $timeline_data['data']['facebook_access_token'] = false;
        $timeline_data['data']['facebook_page_id']      = false;
      } else if ($timeline_data['data_type'] == 'blog') {
        $timeline_data['data']['facebook_app_id']       = false;
        $timeline_data['data']['facebook_access_token'] = false;
        $timeline_data['data']['facebook_page_id']      = false;
        $timeline_data['data']['twitter_search_key']    = false;

        $posts = get_posts(array(
                           'post_status'    => 'publish',
                           'post_type'      => 'post',
                           'posts_per_page' => '-1',
                           'order'          => 'DESC',
                           'orderby'        => 'date',
                           'category'       => $timeline_data['blog_categories']
                           ));

        $custom_data = array();

        foreach ($posts as $post) {
          if ($post->post_excerpt) {
            $content = $post->post_excerpt;
          } else {
            $content = $post->post_content;
          }

          $date = explode(',', $post->post_date);
          $date = $date[0];

          $blog_images = get_post_custom_values('melonhtml5_timeline_image', $post->ID);

          $custom_data[] = array(
                                 'type'     => 'blog_post',
                                 'date'     => $date,
                                 'title'    => $post->post_title,
                                 'content'  => $content,
                                 'readmore' => get_permalink($post->ID),
                                 'images'   => $blog_images ? $blog_images : array()
                                 );
        }

        $custom_data = json_encode($custom_data);

      } else {
        $timeline_data['data']['facebook_app_id']       = false;
        $timeline_data['data']['facebook_access_token'] = false;
        $timeline_data['data']['facebook_page_id']      = false;
        $timeline_data['data']['twitter_search_key']    = false;

        $custom_data = json_encode($timeline_data['data']['element']);
      }

      $id = 'melonhtml5-timeline-' . $timeline_id;

      $scripts  = '
      <div id="' . $id . '" class="melonhtml5-timeline-container"></div>
      <script type="text/javascript">
        jQuery(document).ready(function($) {
          var timeline = new Timeline($("#' . $id . '"), ' . $custom_data . ', $);
          timeline.setOptions({
            dateFormat:             "' . $timeline_data['dateFormat'] . '",
            animation:              ' . ($timeline_data['animation'] ? 'true' : 'false' ) . ',
            lightbox:               ' . ($timeline_data['lightbox'] ? 'true' : 'false' ) . ',
            separator:              ' . ($timeline_data['separator'] ? '"' . $timeline_data['separator'] . '"' : 'null') . ',
            columnMode:             "' . $timeline_data['column_mode'] . '",
            order:                  "' . $timeline_data['order'] . '",
            max:                    ' . intval($timeline_data['max']) . ',
            loadmore:               ' . intval($timeline_data['loadmore']) . ',
            responsive_width:       ' . intval($timeline_data['responsive_width']) . ',
            facebookAppId:          ' . ($timeline_data['data']['facebook_app_id']       === false ? 'null' : '"' . $timeline_data['data']['facebook_app_id'] . '"') . ',
            facebookAccessToken:    ' . ($timeline_data['data']['facebook_access_token'] === false ? 'null' : '"' . $timeline_data['data']['facebook_access_token'] . '"') . ',
            facebookPageId:         ' . ($timeline_data['data']['facebook_page_id']      === false ? 'null' : '"' . $timeline_data['data']['facebook_page_id'] . '"') . ',
            twitterSearchKey:       ' . ($timeline_data['data']['twitter_search_key']    === false ? 'null' : '"' . $timeline_data['data']['twitter_search_key'] . '"')  . '
          });
timeline.display();
});
</script>
';

return $scripts;
} else {
  $error = true;
}
} else {
  $error = true;
}

if ($error) {
  $string = '';
  foreach ($attributes as $key => $value) {
    $string .= ' ' . $key . '=' . $value;
  }

  return '[melonhtml5-timeline' . $string . ']';
}
}

function plugin_install_timeline() {
  global $wpdb;

  $sql = 'CREATE TABLE ' . $wpdb->prefix . 'timeline (
                                                      id                      INT(10)         NOT NULL AUTO_INCREMENT,
                                                      t_theme                 VARCHAR(255)    NOT NULL,
                                                      t_name                  VARCHAR(255)    NOT NULL,
                                                      t_dateFormat            VARCHAR(255)    NOT NULL,
                                                      t_animation             TINYINT(1)      NOT NULL,
                                                      t_lightbox              TINYINT(1)      NOT NULL,
                                                      t_allow_delete          TINYINT(1)      NOT NULL,
                                                      t_separator             VARCHAR(255)    NOT NULL,
                                                      t_column_mode           VARCHAR(255)    NOT NULL,
                                                      t_order                 VARCHAR(255)    NOT NULL,
                                                      t_max                   INT(3)          NOT NULL,
                                                      t_loadmore              INT(3)          NOT NULL,
                                                      t_responsive_width      INT(4)          NOT NULL,
                                                      t_blog_categories       VARCHAR(255)    NOT NULL,
                                                      t_twitter_search_key    VARCHAR(255)    NOT NULL,
                                                      t_facebook_page_id      TEXT            NOT NULL,
                                                      t_facebook_app_id       TEXT            NOT NULL,
                                                      t_facebook_access_token TEXT            NOT NULL,
                                                      t_data_type             VARCHAR(255)    NOT NULL,
                                                      t_data                  TEXT            NOT NULL,
                                                      UNIQUE KEY id (id)
                                                      );';

require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
dbDelta($sql);
}


function add_menu_timeline() {
  add_menu_page('Timeline', 'Timeline', 'manage_options', 'melonhtml5_timeline', 'print_overview_timeline', plugins_url(PLUGIN_DIR . '/timeline.png'));
}

    // include JS / CSS files
function include_admin_script_timeline($hook) {
  plugin_install_timeline();

  wp_enqueue_script('timeline-admin-js',  plugins_url(PLUGIN_DIR . '/javascript/admin.js'));
  wp_enqueue_script('timeline-js',  plugins_url(PLUGIN_DIR . '/javascript/timeline.js'));
  wp_enqueue_style('timeline-admin-css',  plugins_url(PLUGIN_DIR . '/css/admin.css'));
}

function include_plugin_script_timeline($hook) {
  $timeline_theme = get_theme_setting();

  switch ($timeline_theme) {
    case 'light':
    $timeline_theme_css = 'timeline_theme1.css';
    break;
    case 'dark':
    $timeline_theme_css = 'timeline_theme2.css';
    break;
    case 'simple':
    $timeline_theme_css = 'timeline_theme3.css';
    break;
    case 'white':
    $timeline_theme_css = 'timeline_theme4.css';
    break;
    default:
    $timeline_theme_css = 'timeline.css';
    break;
  }

  wp_enqueue_script('jquery');
  wp_enqueue_script('timeline-main-js',   plugins_url(PLUGIN_DIR . '/javascript/timeline.js'));
  wp_enqueue_style('timeline-main-css',   plugins_url(PLUGIN_DIR . '/css/' . $timeline_theme_css));
}

function print_overview_timeline() {
  global $wpdb;

  require_once(ADMIN_DIR . '/overview.php');
}

    // old WP versions
if (!function_exists('wp_send_json')) {
  function wp_send_json($response) {
    @header( 'Content-Type: application/json; charset=' . get_option( 'blog_charset' ) );
    echo json_encode( $response );
    if ( defined( 'DOING_AJAX' ) && DOING_AJAX )
      wp_die();
    else
      die;
  }
}

function get_json_timeline() {
  $response = get_array_timeline();
  print wp_send_json($response);
}

function get_theme_timeline() {
  $theme = get_theme_setting();
  print wp_send_json($theme);
}

function get_theme_setting() {
        global $wpdb; // this is how you get access to the database

        $settings = $wpdb->get_results('SELECT t_theme FROM ' . $wpdb->prefix . 'timeline WHERE t_theme != "" Limit 0, 1');

        if (count($settings)) {
          return $settings[0]->t_theme;
        } else {
          return 'default';
        }
      }

      function data_asc($a, $b) {
        if (!isset($a['date']) || !isset($b['date'])) {
          return 0;
        }

        if ($a['date'] == $b['date']) {
          return 0;
        }

        return ($a['date'] < $b['date']) ? -1 : 1;
      }

      function data_desc($a, $b) {
        if (!isset($a['date']) || !isset($b['date'])) {
          return 0;
        }

        if ($a['date'] == $b['date']) {
          return 0;
        }

        return ($a['date'] < $b['date']) ? 1 : -1;
      }


      function get_array_timeline($ids = array()) {
        global $wpdb; // this is how you get access to the database

        $response = array();
        $timeline_rows = $wpdb->get_results('SELECT * FROM ' . $wpdb->prefix . 'timeline' . (count($ids) ? ' WHERE id IN (' . implode(', ', $ids) . ')' : '') . ' ORDER BY id DESC');

        // validation
        $default_options = array(
                                 'type'       => 'blog_post',
                                 'height'     => 200,
                                 'date'       => Date('Y-m-d'),
                                 'title'      => '',
                                 'url'        => '',
                                 'content'    => '',
                                 'readmore'   => '',
                                 'images'     => array()

                                 );

        foreach ($timeline_rows as $timeline) {
          $element_data = mb_unserialize($timeline->t_data) ? mb_unserialize($timeline->t_data) : array();

            // validation
          foreach ($element_data as $key => $data) {
            $element_data[$key] = array_merge($default_options, $data);

            foreach ($default_options as $option => $value) {
              if (!$element_data[$key][$option]) {
                $element_data[$key][$option] = $value;
              }
            }
          }

            // sort
          if ($timeline->t_order === 'asc') {
            usort($element_data, 'data_asc');
          } else {
            usort($element_data, 'data_desc');
          }

          $response[] = array(
                              'id'               => $timeline->id,
                              'name'             => $timeline->t_name,
                              'dateFormat'       => $timeline->t_dateFormat ? $timeline->t_dateFormat : 'DD MMM YYYY',
                              'animation'        => $timeline->t_animation,
                              'lightbox'         => $timeline->t_lightbox,
                              'order'            => $timeline->t_order,
                              'max'              => $timeline->t_max,
                              'loadmore'         => $timeline->t_loadmore,
                              'responsive_width' => $timeline->t_responsive_width,
                              'blog_categories'  => $timeline->t_blog_categories,
                              'separator'        => $timeline->t_separator,
                              'column_mode'      => $timeline->t_column_mode,
                              'data_type'        => $timeline->t_data_type ? $timeline->t_data_type : 'custom',
                              'data'             => array(
                                                          'facebook_app_id'       => $timeline->t_facebook_app_id,
                                                          'facebook_access_token' => $timeline->t_facebook_access_token,
                                                          'facebook_page_id'      => $timeline->t_facebook_page_id,
                                                          'twitter_search_key'    => $timeline->t_twitter_search_key,
                                                          'element'               => $element_data
                                                          )
                              );
};

return $response;
}

function build_post_data_timeline() {
  $data = $_POST['data'];

  $timeline_data = array(
                         'name'                  => (isset($data['name'])                          ? $data['name']                          : ''),
                         'dateFormat'            => (isset($data['dateFormat'])                    ? $data['dateFormat']                    : 'DD MMM YYYY'),
                         'animation'             => (isset($data['animation'])                     ? $data['animation']                     : 1),
                         'lightbox'              => (isset($data['lightbox'])                      ? $data['lightbox']                      : 1),
                         'order'                 => (isset($data['order'])                         ? $data['order']                         : 'desc'),
                         'max'                   => (isset($data['max'])                           ? $data['max']                           : 20),
                         'loadmore'              => (isset($data['loadmore'])                      ? $data['loadmore']                      : 0),
                         'responsive_width'      => (isset($data['responsive_width'])              ? $data['responsive_width']              : 768),
                         'blog_categories'       => (isset($data['blog_categories'])               ? $data['blog_categories']               : ''),
                         'separator'             => (isset($data['separator'])                     ? $data['separator']                     : 'year'),
                         'column_mode'           => (isset($data['column_mode'])                   ? $data['column_mode']                   : 'dual'),
                         'facebook_app_id'       => (isset($data['data']['facebook_app_id'])       ? $data['data']['facebook_app_id'] : ''),
                         'facebook_access_token' => (isset($data['data']['facebook_access_token']) ? $data['data']['facebook_access_token'] : ''),
                         'facebook_page_id'      => (isset($data['data']['facebook_page_id'])      ? $data['data']['facebook_page_id']      : ''),
                         'twitter_search_key'    => (isset($data['data']['twitter_search_key'])    ? $data['data']['twitter_search_key']    : ''),
                         'data_type'             => (isset($data['data_type'])                     ? $data['data_type']                     : 'custom'),
                         'data'                  => (isset($data['data']['element'])               ? serialize($data['data']['element'])    : '')
                         );

return $timeline_data;
}

function get_data_sql_timeline($timeline_data) {
  $sql = 't_name="'                  . $timeline_data['name'] . '", ' .
  't_dateFormat="'            . $timeline_data['dateFormat'] . '", ' .
  't_animation="'             . $timeline_data['animation'] . '", ' .
  't_lightbox="'              . $timeline_data['lightbox'] . '", ' .
  't_order="'                 . $timeline_data['order'] . '", ' .
  't_max="'                   . $timeline_data['max'] . '", ' .
  't_loadmore="'              . $timeline_data['loadmore'] . '", ' .
  't_responsive_width="'      . $timeline_data['responsive_width'] . '", ' .
  't_blog_categories="'       . $timeline_data['blog_categories'] . '", ' .
  't_separator="'             . $timeline_data['separator'] . '", ' .
  't_column_mode="'           . $timeline_data['column_mode'] . '", ' .
  't_facebook_app_id="'       . esc_sql($timeline_data['facebook_app_id']) . '", ' .
  't_facebook_access_token="' . esc_sql($timeline_data['facebook_access_token']) . '", ' .
  't_facebook_page_id="'      . esc_sql($timeline_data['facebook_page_id']) . '", ' .
  't_twitter_search_key="'    . esc_sql($timeline_data['twitter_search_key']) . '", ' .
  't_data_type="'             . $timeline_data['data_type'] . '", ' .
  't_data="'                  . esc_sql($timeline_data['data']) . '"';

  return $sql;
}

function delete_timeline() {
  global $wpdb;

  if (isset($_POST['id'])) {
    $sql = 'DELETE FROM ' . $wpdb->prefix . 'timeline WHERE id = "' . $_POST['id'] . '"';
    $result = $wpdb->get_results($sql);
  }
}

function copy_timeline() {
  global $wpdb;

  if (isset($_POST['ids'])) {
    $columns = '`t_name`, `t_dateFormat`, `t_animation`, `t_lightbox`, `t_order`, `t_max`, `t_loadmore`, `t_responsive_width`, `t_blog_categories`, `t_separator`, `t_column_mode`, `t.facebook_app_id`, `t_facebook_access_token`, `t_facebook_page_id`, `t_twitter_search_key`, `t_data_type`, `t_data`';
    $ids     = explode(',', $_POST['ids']);

    $new_ids = array();
    foreach ($ids as $id) {
      $sql = 'INSERT INTO ' . $wpdb->prefix . 'timeline (' . $columns . ') SELECT ' . $columns . ' FROM ' . $wpdb->prefix . 'timeline WHERE id = ' . $id;
      $result = $wpdb->get_results($sql);

      $new_ids[] = $wpdb->insert_id;
    }

    $response = get_array_timeline($new_ids);
    print wp_send_json($response);
  }
}

function add_timeline() {
  global $wpdb;

  _magic_quote_fix();

  if (isset($_POST['data'])) {
    $data = $_POST['data'];

    $timeline_data = build_post_data_timeline();

    $sql = 'INSERT INTO ' . $wpdb->prefix . 'timeline SET ' . get_data_sql_timeline($timeline_data);
    $result = $wpdb->get_results($sql);

    print wp_send_json(array('id' => $wpdb->insert_id));
  }
}

function save_timeline() {
  global $wpdb;

  _magic_quote_fix();

  if (isset($_POST['data']) && isset($_POST['id'])) {
    $data = $_POST['data'];

    $timeline_data = build_post_data_timeline();
    $timeline_data['id'] = $_POST['id'];

    $sql = 'UPDATE ' . $wpdb->prefix . 'timeline SET ' . get_data_sql_timeline($timeline_data) . ' WHERE id = ' . $timeline_data['id'];

    $wpdb->get_results($sql);
  }
}

function save_timeline_theme() {
  global $wpdb;

  _magic_quote_fix();

  if (isset($_POST['theme'])) {
    $theme = $_POST['theme'];

    $sql = 'UPDATE ' . $wpdb->prefix . 'timeline SET t_theme = "' . esc_sql($theme) .  '"';
    $wpdb->get_results($sql);
  }
}

if (!function_exists('_magic_quote_fix')) {
  function _magic_quote_fix() {
    $_POST      = array_map('stripslashes_deep', $_POST);
    $_GET       = array_map('stripslashes_deep', $_GET);
    $_COOKIE    = array_map('stripslashes_deep', $_COOKIE);
    $_REQUEST   = array_map('stripslashes_deep', $_REQUEST);
  }
}
?>
