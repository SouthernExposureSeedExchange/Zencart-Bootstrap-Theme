<?php
/* Utility functions for the SESE Bootstrap Theme */
class BootstrapUtils
{
  /** CSS classes for the responsive grid created by tpl_columnar_display */
  public static $thumbnail_grid_classes = "col-lg-2 col-md-3 col-xs-6 text-center";

  /** Return the URL of the category page, given an array of category ids */
  public static function category_url($category_ids) {
    $cPath = implode($category_ids, '_');
    return zen_href_link(FILENAME_DEFAULT, "cPath=$cPath");
  }

  /** Return an array of SESE Product Icon arrays containing the title and image */
  public static function sese_product_icons($template, $current_page) {
    $template_image_folder = $template->get_template_dir(
      '', DIR_WS_TEMPLATE, $current_page, 'img/icons/'
    );
    $icons = array(
      'organic' =>
        array('title' => 'Certified Organic',
              'image' => "$template_image_folder/organic-certified.png"),
      'heirloom' =>
        array('title' => 'Heirloom',
              'image' => "$template_image_folder/heirloom.png"),
      'southeast' =>
        array('title' => 'Especially well-suited to the Southeast',
              'image' => "$template_image_folder/southeast.png"),
      'eco' =>
        array('title' => 'Ecologically Grown',
              'image' => "$template_image_folder/ecologically-grown.png"),
    );
    return $icons;
  }

  /** Replace the sold out variation of a button returned from the
   * zen_get_buy_now_button function with a bootstrap label
   */
  public static function clean_buy_now_button($button_html, $product_link) {
    if (strpos($button_html, BUTTON_SOLD_OUT_ALT) !== false) {
      $button_html = "<div class='text-center'><span class='h4'><span class='label label-danger'>" .
        BUTTON_SOLD_OUT_ALT . "</span></span>";
      if ($product_link !== '') {
        $button_html .= "<a href='{$product_link}'><div><small>" .
          MORE_INFO_TEXT . "</small></div></a>";
      }
      $button_html .= "</div>";
    }
    return $button_html;
  }

  /** Return the HTML for a glyphicon, with optional screenreader-only text */
  public static function glyphicon($icon_name, $alt_text='') {
    if ($alt_text != '') {
      $alt_text = "<span class='sr-only'>{$alt_text}</span>";
    }
    return "{$alt_text}<span class='glyphicon glyphicon-{$icon_name}'></span>";
  }

  /** Return the HTML for an Address, given Customer & Address IDs */
  public static function render_address($customer_id, $address_id) {
    $address = zen_address_label($customer_id, $address_id, true, ' ', '<br />');
    return "<address>{$address}</address>";
  }

  /** Return a left-pulled Link to take the User Back a Page. */
  public static function back_link() {
    return zen_back_link() . "<span class='pull-left btn btn-default'>" .
      BUTTON_BACK_ALT . "</span></a>";
  }
}
?>
