<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class News extends \Elementor\Widget_Base
{
    public function get_name()
    {
        return 'news';
    }

    public function get_title()
    {
        return __('Helo News', 'helo-addons');
    }

    public function get_icon()
    {
        return 'eicon-lock-user';
    }

    public function get_categories()
    {
        return ['helo'];
    }
    protected function _register_controls()
    {
        $this->start_controls_section(
            'content_section',
            [
                'label' => __('Content', 'helo-addons'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
    }

    protected function render()
    {
        $args = array(
            'post_type' => 'post',
            'posts_per_page' => -1,
            'post_status' => 'publish',
        );

        $news = new WP_Query($args);
?>
        <section id="news_container" class="splide" aria-label="hero section">
            <div class="splide__track">
                <ul class="splide__list ">
                    <?php if ($news->have_posts()) : while ($news->have_posts()) : $news->the_post(); ?>
                            <?php
                            global $post;
                            $title = get_the_title();
                            $thumbnail = get_the_post_thumbnail_url();
                            $permalink = get_the_permalink();
                            $date = get_the_date('j M Y');
                            $the_excerpt = get_the_excerpt();
                            ?>
                            <li class="splide__slide">
                                <a href="<?php echo $permalink; ?>" class="news_list">
                                    <div class="news_thumbnail_container">
                                        <img src="<?php echo $thumbnail; ?>" width="481" height="331" alt="<?php echo $title; ?>" />
                                    </div>
                                    <div class="title_date_container">
                                        <time><?php echo $date; ?></time>
                                        <h3 class="news_title_list"><?php echo $title; ?></h3>
                                    </div>
                                    <div class="read_more">
                                        <a href="<?php echo $permalink;?>">Read More</a>
                                        <div class="read_more_underline"></div>
                                    </div>
                                </a>
                            </li>

                    <?php endwhile;
                    endif; 
                    wp_reset_postdata();
                    ?>
                </ul>
            </div>
        </section>
<?php

    }
}
