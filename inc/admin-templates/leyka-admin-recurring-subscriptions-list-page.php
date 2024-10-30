<?php if( !defined('WPINC') ) die;
/** Admin Recurring subscriptions list page template */

/** @var $this Leyka_Admin_Setup */

$current_page = $_GET['page'];

?>

<div class="leyka-admin wrap recurring-subscriptions-list leyka-settings-page" data-leyka-admin-page-type="recurring-subscriptions-list-page">

    <div class="leyka-header-wrap">

        <h1 class="wp-heading-inline"><?php esc_html_e('Recurring subscriptions', 'leyka');?></h1>

        <div class="leyka-recurring-subscriptions-check">
            <form action="#" method="get">
                <input type="hidden" name="page" value="<?php echo esc_attr( $current_page );?>">
                <input type="submit" class="submit" name="subscriptions-update-all-statuses" value="<?php esc_attr_e('Check all subscriptions', 'leyka');?>" />
            </form>
        </div>

        <div class="recurring-subscriptions-list-export admin-list-export">
            <form action="#" method="get">
                <?php $get_params_string = '';

                foreach($_GET as $param_name => &$param_value) {

                    $param_value = $param_value ? esc_attr( str_replace('>', '', wp_strip_all_tags(trim($param_value))) ) : '';

                    if($param_name === 'first-date' && is_array($param_value)) {
                        $param_value = $param_value[0].'-'.$param_value[1];
                    }

                    $get_params_string .= $get_params_string === '' ? '' : '&';
                    $get_params_string .= $param_name === 'paged' ? '' : $param_name.'='.$param_value;

                } ?>
                <input type="hidden" name="get-params" value="<?php echo esc_attr( $get_params_string ); ?>">
                <input type="hidden" name="page" value="<?php echo esc_attr( $current_page );?>">
                <input type="submit" class="submit" name="subscriptions-list-export" value="<?php esc_attr_e('Export the list in CSV', 'leyka');?>">
            </form>
        </div>

        <div class="toggle-filters-button leyka-visibility-control-button" data-visibility-control-target=".recurring-subscriptions-list-filters"><?php esc_html_e('Filters', 'leyka');?></div>

    </div>

    <div id="poststuff">
        <div>

            <form class="recurring-subscriptions-list-controls admin-list-controls" action="#" method="get">

                <div class="recurring-subscriptions-list-filters admin-list-filters leyka-hidden">

                    <input type="hidden" name="page" value="<?php echo esc_attr( $current_page ); ?>">

                    <div class="col-1">

                        <div class="filters-row">

                            <?php $filter_value = isset($_GET['recurring_subscription_status']) ? esc_attr( str_replace('>', '', wp_strip_all_tags(trim($_GET['recurring_subscription_status']))) ) : false;?>
                            <div class="leyka-admin-list-filter-wrapper">
                                <select name="recurring_subscription_status" class="leyka-selector leyka-select-menu">
                                    <option value="" <?php selected( $filter_value, '' ); ?>>
                                        <?php esc_html_e('All subscriptions', 'leyka');?>
                                    </option>
                                    <option value="active" <?php selected( $filter_value, 'active' ); ?>>
                                        <?php esc_html_e('Only active', 'leyka');?>
                                    </option>
                                    <option value="problematic" <?php selected( $filter_value, 'problematic' ); ?>>
                                        <?php esc_html_e('Problematic', 'leyka');?>
                                    </option>
                                    <option value="non-active" <?php selected( $filter_value, 'non-active' ); ?>>
                                        <?php esc_html_e('Only not active', 'leyka');?>
                                    </option>
                                </select>
                            </div>

                            <?php $filter_value = isset($_GET['donor-name-email']) ? esc_attr( str_replace('>', '', wp_strip_all_tags(trim($_GET['donor-name-email']))) ) : '';?>
                            <div class="leyka-admin-list-filter-wrapper">
                                <input type="text" name="donor-name-email" class="leyka-donor-name-email-selector leyka-selector" data-search-donors-in="donations" value="<?php echo esc_attr( $filter_value );?>" placeholder="<?php esc_attr_e("Donor's name or email", 'leyka');?>">
                            </div>

                            <div class="leyka-admin-list-filter-wrapper">

                                <input type="text" name="campaigns-input" class="leyka-campaigns-selector leyka-selector leyka-autocomplete" value="" placeholder="<?php esc_attr_e('All campaigns', 'leyka');?>">
                                <?php $filter_value = isset($_GET['campaigns']) ? (array)$_GET['campaigns'] : [];?>

                                <select class="leyka-campaigns-select autocomplete-select" name="campaigns[]" multiple="multiple">
                                <?php $campaigns = $filter_value ? leyka_get_campaigns_list(['include' => $filter_value]) : [];
                                foreach($campaigns as $campaign_id => $campaign_title) {?>
                                    <option value="<?php echo esc_attr( $campaign_id );?>" <?php echo is_array($filter_value) && in_array($campaign_id, $filter_value) ? 'selected="selected"' : '';?>>
                                        <?php echo esc_html( $campaign_title ); ?>
                                    </option>
                                <?php }?>
                                </select>

                            </div>

                        </div>

                        <div class="filters-row">

                            <?php $filter_value = isset($_GET['first-date']) ? esc_attr( str_replace('>', '', wp_strip_all_tags(trim($_GET['first-date']))) ) : '';?>
                            <div class="leyka-admin-list-filter-wrapper leyka-donation-date-filter-wrapper">
                                <input type="text" name="first-date" autocomplete="off" class="leyka-first-donation-date-selector leyka-selector datepicker-ranged-selector" value="<?php echo esc_attr( $filter_value );?>" placeholder="<?php esc_attr_e('First payment dates', 'leyka');?>">
                            </div>

                            <div class="leyka-admin-list-filter-wrapper">

                                <?php $filter_value = isset($_GET['gateway']) ? (array)$_GET['gateway'] : [];?>

                                <select id="leyka-gateways-select" class="leyka-select-menu" name="gateway">
                                    <option value="" <?php selected( ! empty($filter_value), '' ); ?>>
                                        <?php esc_html_e('All gateways', 'leyka');?>
                                    </option>

                                    <?php $gateways = leyka_get_gateways();
                                    usort($gateways, function($gateway_first, $gateway_second){
                                        return strcmp($gateway_first->name, $gateway_second->name);
                                    });

                                    foreach($gateways as $gateway) {?>
                                        <option value="<?php echo esc_attr( $gateway->id ); ?>" <?php echo is_array($filter_value) && in_array($gateway->id, $filter_value) ? 'selected="selected"' : '';?> data-active-class="<?php echo esc_attr( $gateway->is_active ? "active-gateway" : "" ); ?>">
                                            <?php echo esc_html( $gateway->name ); ?>
                                        </option>
                                    <?php }?>

                                </select>

                            </div>

                            <?php $filter_value = isset($_GET['day']) ? esc_attr( str_replace('>', '', wp_strip_all_tags(trim($_GET['day']))) ) : '';?>
                            <div class="leyka-admin-list-filter-wrapper">
                                <input type="number" max="30" min="1" name="day" class="leyka-day-selector leyka-selector" value="<?php echo esc_attr( $filter_value );?>" placeholder="<?php esc_attr_e("Payment day (from 1 to 30)", 'leyka');?>">
                            </div>

                        </div>

                        <div class="filters-row"><div class="filter-warning" id="leyka-filter-warning"></div></div>

                    </div>

                    <div class="col-2">
                        <input type="submit" class="button" value="<?php esc_attr_e('Filter the data', 'leyka');?>">
                        <a href="<?php echo esc_url( admin_url('/admin.php?page=leyka_recurring_subscriptions') );?>" class="reset-filters"><?php esc_html_e('Reset the filter', 'leyka');?></a>
                    </div>

                </div>



            </form>

            <div id="post-body-content" class="<?php if($this->_recurring_subscriptions_list_table->get_items_count() === 0) {?>empty-donors-list<?php }?>">
                <div class="meta-box-sortables ui-sortable">
                    <form method="post">

                        <?php $this->_recurring_subscriptions_list_table->prepare_items();
                        $this->_recurring_subscriptions_list_table->display();

                        if($this->_recurring_subscriptions_list_table->has_items()) {
                            $this->_recurring_subscriptions_list_table->bulk_edit_fields();
                        }?>

                    </form>
                </div>
            </div>

        </div>

    </div>
</div>
<div class="clear"></div>

