<?php if( !defined('WPINC') ) die;
/** Custom field group for the MIXPLAT payments cards. */
/** @var $this Leyka_Text_Block A block for which the template is used. */?>

<div class="<?php echo esc_attr( $this->field_type );?> custom-block-mixplat_registration mixplat-steps">
    <p><?php esc_html_e("After submitting the application, the Mixplat Processing manager will contact you to confirm the registration and organization data, after which you will receive a login and password to the Mixplat personal account.", "leyka"); ?></p>
    


    <div class="step">
        <div class="block-separator"><div></div></div>
        <p>
            <?php esc_html_e("To log in click on the ", "leyka"); ?> <a href="https://stat.mixplat.ru/login?returnUrl=%2F" target="_blank"><?php esc_html_e( 'link', 'leyka' ); ?>.</a>
        </p>
        <div class="captioned-screen">
            <div class="screen-wrapper">
                <img src="/wp-content/plugins/leyka/img/mixplat/mixplat_img02.png" class="leyka-instructions-screen" alt="">
                <img src="/wp-content/plugins/leyka/img/icon-zoom-screen.svg" class="zoom-screen" alt="">
            </div>
            <img src="/wp-content/plugins/leyka/img/mixplat/mixplat_img02.png" class="leyka-instructions-screen-full" alt="" style="display: none; position: fixed; z-index: 9991; left: 50%; top: 100px;">
        </div>
    </div>

    <div class="step">
        <div class="block-separator"><div></div></div>
        <p><?php esc_html_e("After authorization, go to the project creation page, to do this, go to &quot;Project Settings&quot; https://stat.mixplat.ru/projects item in the navigation menu", "leyka"); ?></p>
        <div class="captioned-screen">
            <div class="screen-wrapper">
                <img src="/wp-content/plugins/leyka/img/mixplat/mixplat_img03.png" class="leyka-instructions-screen" alt="">
                <img src="/wp-content/plugins/leyka/img/icon-zoom-screen.svg" class="zoom-screen" alt="">
            </div>
            <img src="/wp-content/plugins/leyka/img/mixplat/mixplat_img03.png" class="leyka-instructions-screen-full" alt="" style="display: none; position: fixed; z-index: 9991; left: 50%; top: 100px;">
        </div>
    </div>

    <div class="step">
        <div class="block-separator"><div></div></div>
        <p>
            <?php esc_html_e("Next, click on the &quot;Create a project&quot; button", "leyka"); ?>
        </p>
        <div class="captioned-screen">
            <div class="screen-wrapper">
                <img src="/wp-content/plugins/leyka/img/mixplat/mixplat_img04.png" class="leyka-instructions-screen" alt="">
                <img src="/wp-content/plugins/leyka/img/icon-zoom-screen.svg" class="zoom-screen" alt="">
            </div>
            <img src="/wp-content/plugins/leyka/img/mixplat/mixplat_img04.png" class="leyka-instructions-screen-full" alt="" style="display: none; position: fixed; z-index: 9991; left: 50%; top: 100px;">
        </div>
    </div>

    <div class="step">
        <div class="block-separator"><div></div></div>
        <p>
            <?php esc_html_e("Fill in all the fields of the form and click on the &quot;Submit for moderation&quot; button", "leyka"); ?>
        </p>
        <div class="captioned-screen">
            <div class="screen-wrapper">
                <img src="/wp-content/plugins/leyka/img/mixplat/mixplat_img05.png" class="leyka-instructions-screen" alt="">
                <img src="/wp-content/plugins/leyka/img/icon-zoom-screen.svg" class="zoom-screen" alt="">
            </div>
            <img src="/wp-content/plugins/leyka/img/mixplat/mixplat_img05.png" class="leyka-instructions-screen-full" alt="" style="display: none; position: fixed; z-index: 9991; left: 50%; top: 100px;">
        </div>
    </div>

</div>
