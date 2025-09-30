<?php
/**
 * Block template for LC FAQ.
 *
 * @package lc-harrier2025
 */

defined( 'ABSPATH' ) || exit;

// Check if this is the first FAQ block on the page.
static $first_faq_block = true;

$is_faq_page     = $first_faq_block;
$first_faq_block = false;
?>
<section class="faq py-5">
    <div class="container">
        <h2><?= esc_html( get_field( 'title' ) ); ?></h2>
        <div class="faq__intro w-constrained-md mb-5"><?= esc_html( get_field( 'intro' ) ); ?></div>
        <?php
        $accordion = random_str( 5 );

        echo '<div class="faq__inner">';
        echo '<div ' . ( $is_faq_page ? 'itemscope="" itemtype="https://schema.org/FAQPage" ' : '' ) . 'id="accordion' . esc_attr( $accordion ) . '" class="accordion">';

        $counter   = 0;
        $show      = '';
        $collapsed = 'collapsed';
        $expanded  = 'false';
        $collapse  = '';
        $button    = 'collapsed';

        while ( have_rows( 'faq_items' ) ) {
            the_row();

            $ac = $accordion . '_' . $counter;
            ?>
                <div itemscope="" <?= $is_faq_page ? 'itemprop="mainEntity" ' : ''; ?>itemtype="https://schema.org/Question" class="accordion-item">
                    <div class="accordion-header">
                        <button class="accordion-button fs-500 <?= esc_attr( $button ); ?>"
                            itemprop="name" type="button" data-bs-toggle="collapse"
                            data-bs-target="#c<?= esc_attr( $ac ); ?>"
                            aria-expanded="<?= esc_attr( $expanded ); ?>"
                            aria-controls="c<?= esc_attr( $ac ); ?>">
                            <?= wp_kses_post( get_sub_field( 'question' ) ); ?>
                        </button>
                    </div>
                    <div id="c<?= esc_attr( $ac ); ?>"
                        class="collapse <?= esc_attr( $show ); ?>" itemscope=""
                        itemprop="acceptedAnswer" itemtype="https://schema.org/Answer"
                        data-bs-parent="#accordion<?= esc_attr( $accordion ); ?>">
                        <div class="accordion-body" itemprop="text">
                            <?= wp_kses_post( get_sub_field( 'answer' ) ); ?>
                        </div>
                    </div>
                </div>
            <?php
            ++$counter;
            $show      = '';
            $collapsed = 'collapsed';
        }
        echo '</div>';
        echo '</div>';
        ?>
    </div>
</section>