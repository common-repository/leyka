<?php if( !defined('WPINC') ) die;
/**
 * Leyka Template: Neo
 * Description: An updated version of "Toggles" form template
 * Deprecated: true
 **/

/** @var $campaign Leyka_Campaign */

$active_pm = apply_filters('leyka_form_pm_order', leyka_get_pm_list(true));
$supported_curr = leyka_get_currencies_data();
$mode = leyka_options()->opt_template('donation_sum_field_type'); // fixed/flexible/mixed

/** @var Leyka_Payment_Form $leyka_current_pm */
global $leyka_current_pm; /** @todo Make it a Leyka_Payment_Form class singleton */

leyka_pf_submission_errors();?>

<div id="leyka-payment-form" class="leyka-tpl-neo" data-template="neo" data-leyka-ver="<?php echo esc_attr(Leyka_Payment_Form::get_plugin_ver_for_atts());?>">

    <?php $counter = 0;

    foreach($active_pm as $i => $pm) {

        leyka_setup_current_pm($pm);
        $counter++;?>

        <div class="leyka-payment-option toggle <?php if($counter == 1) echo 'toggled';?> <?php echo esc_attr($pm->full_id);?>">
            <div class="leyka-toggle-trigger <?php echo count($active_pm) > 1 ? '' : 'toggle-inactive';?>">
                <?php echo esc_attr(leyka_pf_get_pm_label());?>
            </div>
            <div class="leyka-toggle-area">
                <form class="leyka-pm-form" action="<?php echo esc_attr(leyka_pf_get_form_action());?>" method="post">

                    <div class="leyka-pm-fields">

                    <?php if($leyka_current_pm->is_field_supported('amount') ) {

                        $current_curr = $leyka_current_pm->get_current_currency();

                        if(empty($supported_curr[$current_curr])) {
                            return; // Current currency isn't supported
                        }?>

                        <div class="leyka-field amount-selector amount mixed">

                            <div class="currency-selector-row" >
                                <div class="currency-variants">
                                    <?php foreach($supported_curr as $currency => $data) {

                                        if($mode == 'fixed' || $mode == 'mixed') {
                                            $variants = explode(',', $data['amount_settings']['fixed']);
                                        } else {
                                            $variants = [];
                                        }?>
                                        <div class="<?php echo esc_attr( $currency );?> amount-variants-container" <?php echo esc_html( $currency == $current_curr ? '' : 'style="display:none;"');?>>
                                            <div class="amount-variants-row">
                                                <?php foreach($variants as $i => $amount) {?>
                                                    <label class="figure rdc-radio" title="<?php esc_attr_e('Please, specify your donation amount', 'leyka');?>">
                                                        <input type="radio" value="<?php echo esc_attr( (int)$amount );?>" name="leyka_donation_amount" class="rdc-radio__button" <?php checked($i, 0);?> <?php echo wp_kses_post( $currency == $current_curr ? '' : 'disabled="disabled"' );?> >
                                                        <span class="rdc-radio__label"><?php echo esc_attr( (int)$amount );?></span>
                                                    </label>
                                                <?php }?>

                                                <label class="figure-flex">
                                                    <?php if($mode == 'mixed' && $variants) {?>
                                                    <span class="figure-sep"><?php esc_html_e('or', 'leyka');?></span>
                                                    <?php }

                                                    if($mode != 'fixed') {?>
                                                    <input type="text" title="<?php esc_attr_e('Specify the amount of your donation', 'leyka');?>" name="leyka_donation_amount" class="donate_amount_flex" value="<?php echo esc_attr($supported_curr[$current_curr]['amount_settings']['flexible']);?>" maxlength="6" <?php echo wp_kses_post( $currency == $current_curr ? '' : 'disabled="disabled"' );?>>
                                                    <?php }?>
                                                </label>
                                            </div>
                                        </div>
                                    <?php }?>
                                </div>
                                <div class="currency"><span class="currency-frame"><?php echo wp_kses_post( $leyka_current_pm->get_currency_field() );?></span></div>
                            </div>

                            <div class="leyka_donation_amount-error field-error"></div>

                        </div>

                    <?php }
                    // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                    echo leyka_pf_get_recurring_field(empty($campaign) ? false : $campaign->id);
                    // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                    echo leyka_pf_get_hidden_fields(empty($campaign) ? false : $campaign->id);?>

                    <input name="leyka_payment_method" value="<?php echo esc_attr($pm->full_id);?>" type="hidden">
                    <input name="leyka_ga_payment_method" value="<?php echo esc_attr($pm->label);?>" type="hidden">

                    <div class="leyka-donor-fields">
                    <?php if($leyka_current_pm->is_field_supported('name') ) { ?>
                        <div class="rdc-textfield leyka-field name">
                            <input type="text" class="required rdc-textfield__input" name="leyka_donor_name" id="leyka_donor_name" value="" placeholder="<?php esc_attr_e('Your name', 'leyka');?>">
                            <label for="leyka_donor_name" class="leyka-screen-reader-text rdc-textfield__label"><?php esc_html_e('Your name', 'leyka');?></label>
                            <span id="leyka_donor_name-error" class="leyka_donor_name-error field-error rdc-textfield__error"></span>
                        </div>

                    <?php }

                    if($leyka_current_pm->is_field_supported('email') ) {?>
                        <div class="rdc-textfield leyka-field email">
                            <input type="text" value="" id="leyka_donor_email" name="leyka_donor_email" class="required email rdc-textfield__input" placeholder="<?php esc_attr_e('Your email', 'leyka');?>">
                            <label class="leyka-screen-reader-text rdc-textfield__label" for="leyka_donor_email"><?php esc_html_e('Your email', 'leyka');?></label>
                            <span class="leyka_donor_email-error field-error rdc-textfield__error" id="leyka_donor_email-error"></span>
                        </div>

                    <?php }

                    if($leyka_current_pm->is_field_supported('comment') && leyka_options()->opt_template('show_donation_comment_field')) {?>
                        <div class="rdc-textfield leyka-field comment">
                            <textarea id="leyka_donor_comment" name="leyka_donor_comment" class="comment leyka-donor-comment rdc-textfield__input" data-max-length="<?php echo esc_attr(leyka_options()->opt_template('donation_comment_max_length'));?>"></textarea>
                            <label class="leyka-screen-reader-text rdc-textfield__label" for="leyka_donor_comment"><?php esc_html_e('Your comments', 'leyka');?></label>
                            <p class="field-comment">
                                <?php
                                /* translators: %d: Label. */
                                echo leyka_options()->opt_template('donation_comment_max_length') ? sprintf(esc_html__('Your comment (<span class="donation-comment-current-length">0</span> / <span class="donation-comment-max-length">%d</span> symbols)', 'leyka'), esc_html(leyka_options()->opt_template('donation_comment_max_length'))) : esc_html__('Your comment', 'leyka');?>
                            </p>
                            <span class="leyka_donor_comment-error field-error rdc-textfield__error" id="leyka_donor_comment-error"></span>
                        </div>

                    <?php }?>
                    </div>

                    <?php
                    // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                    echo leyka_pf_get_pm_fields();
                    // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                    echo leyka_pf_get_agree_field();?>

                    <div class="leyka-field submit">
                        <?php if($leyka_current_pm->is_field_supported('submit') ) { ?>
                            <input type="submit" class="rdc-submit-button" id="leyka_donation_submit" name="leyka_donation_submit" value="<?php echo esc_attr(leyka_options()->opt_template('donation_submit_text'));?>">
                        <?php }

                        $icons = leyka_pf_get_pm_icons();
                        if($icons) {

                            $list = [];
                            foreach($icons as $i) {
                                $list[] = "<li>".(is_ssl() ? str_replace('http:', 'https:', $i) : $i)."</li>";
                            }

                            echo '<ul class="leyka-pm-icons cf">'.wp_kses_post(implode('', $list)).'</ul>';

                        }?>
                        </div>

                    </div>

                    <div class="leyka-pm-desc">
                        <?php echo wp_kses_post(apply_filters('leyka_the_content', leyka_pf_get_pm_description())); ?>
                    </div>

                </form>
            </div>
        </div>
    <?php }?>
</div>

<?php if(leyka_options()->opt_template('show_campaign_sharing')) {
    leyka_share_campaign_block(empty($campaign) ? false : $campaign->id);
}

leyka_pf_footer();?>