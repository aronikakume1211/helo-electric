<?php
if (!defined('ABSPATH')) exit;

class Products_List extends \Elementor\Widget_Base
{
    public function get_name()
    {
        return 'products_list';
    }
    public function get_title()
    {
        return esc_html__('Products List', 'helo-addons');
    }
    public function get_icon()
    {
        return 'eicon-products';
    }
    public function get_categories()
    {
        return ['helo'];
    }

    protected function register_controls()
    {
        $this->start_controls_section(
            'section_content',
            [
                'label' => esc_html__('Content', 'helo-addons'),
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $args = array(
            'post_type' => 'product',
            'posts_per_page' => 3,
            'post_status' => 'publish',
        );

        $products = new WP_Query($args);
?>
        <div class="products_container_fluid">
            <div class="products_heading_container">
                <h2 class="product_heading">Featured Vehicles</h2>
                <div class="products_categories mixit_buttons">
                    <?php
                    $product_categories = array();
                    if ($products->have_posts()) {
                        while ($products->have_posts()) {
                            $products->the_post();

                            // Get the categories for the current product
                            $categories = get_the_terms(get_the_ID(), 'product_cat');

                            if (!empty($categories) && !is_wp_error($categories)) {

                                foreach ($categories as $category) {
                                    // $product_categories.array_push($category->name)
                                    // array_push($product_categories, $category->slug);
                                    // array_push($product_categories, $category->name);
                                    $product_categories[$category->slug] = $category->name;
                                }
                            }
                        }
                        wp_reset_postdata();
                    } ?>
                    <?php
                    // Remove duplicate values
                    $unique_categories = array_unique($product_categories);

                    // Loop through unique values
                    ?>
                    <ul class="">
                        <li class="variant active_variant">
                            <button data-filter=".all-variants">All Variants
                            </button>
                        </li>
                        <?php foreach ($unique_categories as  $slug=>$name) : ?>
                            <li class="variant">
                                <button data-filter=".<?php echo $slug; ?>"><?php echo $name; ?></button>
                            </li>
                        <?php endforeach; ?>
                    </ul>

                </div>
            </div>
            <ul class="custom_woocommerce_products product-mixit d-flex flex-wrap gap-40 justify-between" data-cartApi="<?php echo get_rest_url(null, 'v1/check-cart'); ?>">
                <?php
                if ($products->have_posts()) : while ($products->have_posts()) : $products->the_post();
                        global $product;
                        $regular_price = (float) $product->get_regular_price();
                        $sale_price = (float) $product->get_sale_price();
                        $categories = get_the_terms(get_the_ID(), 'product_cat');
                ?>
                        <li class="custom_woocommerce_product mix all-variants <?php
                                                                                foreach ($categories as $cate) {
                                                                                    echo $cate->slug;
                                                                                }

                                                                                ?>">
                            <div class="product_image_container">
                                <?php echo  $product->get_image(); ?>
                            </div>
                            <div class="product_contents">
                                <div>

                                    <h3 class="custom_product_title"><?php echo $product->get_name(); ?></h3>
                                    <div class="product_short_description">
                                        <!-- <ul>
                                    <li>Fresh & Organic Direct from the Farm</li>
                                    <li>100% Pure, Chemical-free, and Farm-fresh</li>
                                    <li>No Added Water, Powder, or Thickneres</li>
                                    <li>Delivered Fresh Within 2 Hours of Milking</li>
                                </ul> -->
                                        <?php
                                        echo get_the_excerpt();
                                        ?>
                                    </div>

                                    <div class="price_container">
                                        <p>Andhra Pradesh</p>
                                        <p class="prices"><?php echo $sale_price; ?></p>
                                    </div>
                                </div>
                                <?php
                                $cart = WC()->cart->get_cart();
                                $product_id = $product->get_id();
                                $is_in_cart = false;

                                // Check if the product is in the cart
                                foreach ($cart as $cart_item_key => $cart_item) {
                                    if ($cart_item['product_id'] == $product_id) {
                                        $is_in_cart = true;
                                        break;
                                    }
                                }
                                ?>
                                <div class="hr"></div>
                                <?php if ($is_in_cart) : ?>
                                    <button class="btn_is_in_cart">Added To Cart</button>
                                <?php else : ?>
                                    <div class="add_to_cart_more_details_container">
                                        <?php woocommerce_template_loop_add_to_cart(array('product_id' => $product->get_id())); ?>
                                        <div class="vertical"></div>
                                        <a href="<?php echo get_the_permalink(); ?>" class="more_details">More Details</a>
                                    </div>
                                <?php endif; ?>

                            </div>
                        </li>
                <?php
                    endwhile;
                endif; ?>
            </ul>

        </div>
<?php

    }
}
