<?php

/*
  Plugin Name: Simple Quiz Gutenberg
  Description: Multiple choice quiz build with wordpress Gutenberg Blocks and React components.
  Version: 1.0
  Author: Gabriel Pacheco
  Author URI: https://gabrielpacheco.com.br
*/

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class SimpleQuizGutenberg
{
  function __construct()
  {
    add_action('init', array($this, 'adminAssets'));
  }

  function adminAssets()
  {
    register_block_type(__DIR__, array(
      'render_callback' => array($this, 'theHTML')
    ));
  }

  function theHTML($attributes)
  {
    if (!is_admin()) {
      wp_enqueue_script('quizFrontend', plugin_dir_url(__FILE__) . 'build/frontend.js', array('wp-element'), '1.0', true);
    }

    ob_start(); ?>
    <div class="quiz-update-me">
      <pre style="display: none;"><?php echo wp_json_encode($attributes) ?></pre>
    </div>
<?php return ob_get_clean();
  }
}

$simpleQuizGutenberg = new SimpleQuizGutenberg();
