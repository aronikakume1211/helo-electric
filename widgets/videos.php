<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class Videos extends \Elementor\Widget_Base
{
    public function get_name()
    {
        return 'videos';
    }

    public function get_title()
    {
        return __('Helo Videos', 'helo-addons');
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
        $this->add_control(
            'latest_videos',
            [
                'label' => esc_html__('Latest Videos', 'helo-addons'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => [
                    [
                        'name' => 'title',
                        'label' => esc_html__('Title', 'helo-addons'),
                        'type' => \Elementor\Controls_Manager::TEXT,
                    ],
                    [
                        'name' => 'thumbnail',
                        'label' => esc_html__('Thumbnail', 'helo-addons'),
                        'type' => \Elementor\Controls_Manager::MEDIA,
                        'default' => [
                            'url' => \Elementor\Utils::get_placeholder_image_src(),
                        ],
                    ],
                    [
                        'name' => 'video_url',
                        'label' => esc_html__('Video Url', 'helo-addons'),
                        'type' => \Elementor\Controls_Manager::URL,
                        'default' => [
                            'url' => 'https://www.youtube.com/',
                        ],
                    ],
                    [
                        'name' => 'publish_date',
                        'label' => esc_html__('Publish Date', 'helo-addons'),
                        'type' => \Elementor\Controls_Manager::DATE_TIME,
                    ],
                    [
                        'name' => 'watch_now_label',
                        'label' => esc_html__('Watch Now', 'helo-addons'),
                        'type' => \Elementor\Controls_Manager::TEXT,
                        'default' => 'Watch Now',
                    ],
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {

        $settings = $this->get_settings_for_display();
        $latest_videos = $settings['latest_videos'];
?>
        <section id="videos_container" class="splide" aria-label="hero section">
            <div class="splide__track">
                <ul class="splide__list ">
                    <?php if (!empty($latest_videos)) : ?>
                        <?php foreach ($latest_videos as $video) : ?>
                            <?php
                            $title = $video['title'];
                            $thumbnail = $video['thumbnail']['url'];
                            $video_url = $video['video_url'];
                            $publish_date = $video['publish_date'];
                            $watch_now = $video['watch_now_label'];
                            ?>
                            <li class="splide__slide">
                                <a href="<?php echo $video_url; ?>" class="videos_list">
                                    <div class="videos_thumbnail_container">
                                        <img src="<?php echo $thumbnail; ?>" width="481" height="331" alt="<?php echo $title; ?>" />
                                        <div class="youtube-icon">
                                            <div class="play-button"></div>
                                        </div>
                                    </div>
                                    <div class="title_date_container">
                                        <time><?php echo $publish_date; ?></time>
                                        <h3 class="videos_title_list"><?php echo $title; ?></h3>
                                    </div>
                                    <div class="read_more">
                                        <a href="<?php echo $video_url; ?>"><?php echo $watch_now; ?></a>
                                        <div class="read_more_underline"></div>
                                    </div>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </ul>
            </div>
        </section>
<?php

    }
}
