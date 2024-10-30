<?php if( !defined('WPINC') ) die;

/**
 * Leyka Portlet: plugin Wizard description & link
 * Description: A portlet to display a plugin setup Wizard "inner ad".
 *
 * @var $params
 *
 * Title: #FROM_PARAMS#
 * Subtitle: #FROM_PARAMS#
 * Thumbnail: /img/icon-wizard-stick-only-blue.svg
 **/?>

<div class="wizard-init">

    <p><?php echo wp_kses_post( $params['text'] );?></p>

    <p>
        <a href="<?php echo esc_url( $params['wizard_link'] );?>" class="button button-primary">
            <?php esc_html_e('Start the Wizard', 'leyka');?>
        </a>
    </p>

</div>