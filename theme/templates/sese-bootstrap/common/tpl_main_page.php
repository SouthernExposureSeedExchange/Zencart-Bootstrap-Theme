<?php
/**
 * Common Template - tpl_main_page.php
 *
 * Governs the overall layout of an entire page<br />
 * Normally consisting of a header, left side column. center column. right side column and footer<br />
 * For customizing, this file can be copied to /templates/your_template_dir/pagename<br />
 * example: to override the privacy page<br />
 * - make a directory /templates/my_template/privacy<br />
 * - copy /templates/templates_defaults/common/tpl_main_page.php to /templates/my_template/privacy/tpl_main_page.php<br />
 * <br />
 * to override the global settings and turn off columns un-comment the lines below for the correct column to turn off<br />
 * to turn off the header and/or footer uncomment the lines below<br />
 * Note: header can be disabled in the tpl_header.php<br />
 * Note: footer can be disabled in the tpl_footer.php<br />
 * <br />
 * $flag_disable_header = true;<br />
 * $flag_disable_left = true;<br />
 * $flag_disable_right = true;<br />
 * $flag_disable_footer = true;<br />
 * <br />
 * // example to not display right column on main page when Always Show Categories is OFF<br />
 * <br />
 * if ($current_page_base == 'index' and $cPath == '') {<br />
 *  $flag_disable_right = true;<br />
 * }<br />
 * <br />
 * example to not display right column on main page when Always Show Categories is ON and set to categories_id 3<br />
 * <br />
 * if ($current_page_base == 'index' and $cPath == '' or $cPath == '3') {<br />
 *  $flag_disable_right = true;<br />
 * }<br />
 *
 * @package templateSystem
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_main_page.php 6564 2007-07-05 20:35:51Z drbyte $
 */

  if (!isset($flag_disable_left)) { $flag_disable_left = false; }
  if (!isset($flag_disable_right)) { $flag_disable_right = false; }

  // global disable of column_left
  if (COLUMN_LEFT_STATUS == 0 or BootstrapCheckout::user_in_checkout()) {
    $flag_disable_left = true;
  }

  if ($flag_disable_left) {
    $main_content_class = 'col-sm-offset-1 col-sm-10';
  } else {
    $main_content_class = 'col-sm-push-3 col-sm-9 col-lg-push-2 col-lg-10';
  }

  $header_template = 'tpl_header.php';
  $footer_template = 'tpl_footer.php';
  $left_column_file = 'column_left.php';
  $right_column_file = 'column_right.php';  // Not Used
  $body_id = ($this_is_home_page) ? 'indexHome' : str_replace('_', '', $_GET['main_page']);
?>
<body id="<?php echo $body_id . 'Body'; ?>"<?php if($zv_onload !== '') echo ' onload="' . $zv_onload . '"'; ?> itemscope itemtype="http://schema.org/WebPage">

<?php
  /* Display the Nav Menu / Page Header */
  require($template->get_template_dir($header_template, DIR_WS_TEMPLATE, $current_page_base, 'common') . '/' . $header_template);
?>

<div class='container'>
<div class='row'>
<?php
  /* Show Breadcrumbs */
  if (DEFINE_BREADCRUMB_STATUS == '1' || (DEFINE_BREADCRUMB_STATUS == '2' && !$this_is_home_page) ) {
      echo '<div class="col-sm-12 hidden-xs" itemprop="breadcrumb">' . BootstrapBreadcrumbs::render($breadcrumb) . '</div>';
  }

  /* Show Upload Messages */
  if ($messageStack->size('upload') > 0) {
    echo $messageStack->output('upload');
  }
?>
  <div class='<?php echo $main_content_class; ?>'>
    <?php /* Display the Main Content */ require($body_code); ?>
  </div>
<?php
  /* Display the Left Sidebar */
  if (!$flag_disable_left) { ?>
    <div class=' col-sm-pull-9 col-sm-3 col-lg-pull-10 col-lg-2' id='sidebar'>
      <ul class='nav nav-pills nav-stacked text-center'>
        <li role="presentation"><a href="/about-us-ezp-18.html">About Us</a></li>
        <li role="presentation"><a href="/growing-guides-library-ezp-41.html">Growing Guides</a></li>
        <li role="presentation"><a href="/retail-stores-ezp-17.html">Retail Stores</a></li>
        <li role="presentation"><a href="/events-ezp-40.html">Events</a></li>
        <li role="presentation"><a href="/faq-ezp-21.html">FAQ</a></li>
        <li role="presentation"><a href="/links-ezp-24.html">Links</a></li>
        <li role="presentation"><a href="/blog/" target="_blank">Blog</a></li>
        <li role="presentation"><a href="/contact_us.html">Contact Us</a></li>
        <li role="presentation"><a href="/seeds-for-schools-ezp-219.html">Fundraisers</a></li>
      </ul>

<?php /* Include Sideboxes */
      require(DIR_WS_MODULES . zen_get_module_directory($left_column_file)); ?>
    </div>
<?php } ?>

</div>  <!-- .row -->
</div>  <!-- .container -->

<?php
/* Display the Footer */
require($template->get_template_dir($footer_template, DIR_WS_TEMPLATE, $current_page_base, 'common') . '/' . $footer_template);?>

<?php
if (DISPLAY_PAGE_PARSE_TIME == 'true') {
  /* Display Performance Statistics */ ?>
  <div class="text-center">Parse Time: <?php echo $parse_time; ?> - Number of Queries: <?php echo $db->queryCount(); ?> - Query Time: <?php echo $db->queryTime(); ?></div>
<?php
} ?>

<?php
if (GOOGLE_ANALYTICS_TRACKING_TYPE == "Asynchronous") {
  // Do nothing - taken care of in <head>
} else {
  require($template->get_template_dir('google_analytics.php', DIR_WS_TEMPLATE, $current_page_base, 'google_analytics') . '/google_analytics.php');
} ?>

</body>
