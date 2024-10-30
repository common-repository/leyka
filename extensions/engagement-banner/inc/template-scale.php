<?php if( !defined('WPINC') ) die;

/** @var $scale array */ ?>
<div class="engb-scale-block">
    <div class="engb-scale-circle p<?php echo esc_attr( $scale['percentage'] ); ?>">
        <span><?php echo esc_html( $scale['percentage'] );?>%</span>
        <div class="left-half-clipper">
            <div class="first50-bar"></div><div class="value-bar"></div>
        </div>
    </div>
    <?php if($scale['delta'] > 0 ) { ?>
        <div class="engb-scale-label">
            <?php
            /* translators: 1: Label, 2: Currency. */
            printf( esc_html__('Out of %1$s %2$s', 'leyka'), "<b>" . esc_html( $scale['target'] ) . "</b>", esc_html( $scale['currency'] ) ); ?>
        </div>
    <?php } ?>
</div>
