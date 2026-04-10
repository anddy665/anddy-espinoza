<?php
/**
 * Portfolio Archive Template
 */

use NoxfolioTheme\Classes\Noxfolio_Helper as Helper;
use NoxfolioTheme\Classes\Noxfolio_Post_Helper;
use NoxfolioToolkit\ElementorAddon\Templates\Portfolio_Template;

get_header();

$design  = Helper::get_option( 'portfolio_design', 'design-one' );
$options = [
    'portfolio_design' => $design,
    'title_word'       => 10,
    'title_tag'        => 'h3',
    'show_category'    => 'yes',
    'show_arrow_link'  => 'yes',
];
$template = New Portfolio_Template();

?>
<div class="<?php Helper::container()?>">
    <div class="content-area">
        <div class="portfolio-archive-content">
            <?php if ( have_posts() ): ?>
                <div class="noxfolio-portfolio-items <?php echo esc_attr( $design ) ?>">
                    <?php
                        while ( have_posts() ): the_post();
						$template->render_portfolio_item( $options );
                        endwhile;
                    ?>
                </div>
                <?php Noxfolio_Post_Helper::pagination(); ?>
            <?php else : ?>
                <?php get_template_part( 'template-parts/contents/content', 'none' ); ?>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php
get_footer();
