<?php

/**
 * License Admin Page
 *
 * @link       https://www.lewe.com
 * @since      1.0.0
 *
 * @package    ChordPress
 * @subpackage ChordPress/admin/partials
 */

/**
 * If this file is called directly, abort.
 */
if (!defined('WPINC')) {
    die;
}

/**
 * Get plugin information.
 */
$P = new ChordPress();
$ptitle = $P->get_plugin_title();
$pname = $P->get_plugin_name();
$pprefix = $P->get_plugin_prefix();
$puri = $P->get_plugin_uri();
$pdonuri = $P->get_plugin_donation_uri();

$L = new ChordPress_License();
?>

<div class="wrap">

    <div style="background:#003A6B !important;width:100% !important;height:80px !important;">
        <img src="<?php echo plugins_url('../images/banner-247x80.png', __FILE__); ?>" alt="" style="text-align:left;">
    </div>
    <div style="clear:both;">
        <h1><?php echo esc_html(__($ptitle . ' License', 'chordpress')); ?></h1>
        <p>
            <a href="<?php echo $puri; ?>" target="_blank" class="<?php echo $pprefix; ?>-btn <?php echo $pprefix; ?>-btn-info <?php echo $pprefix; ?>-btn-xs"><?php echo esc_html(__('Documentation', 'chordpress')); ?></a>
        </p>
    </div>

    <?php
    if ($show_alert) echo $P->alert($alert_style, $alert_title, 'h4', $alert_text, true, '98%');
    settings_errors();
    ?>

    <div style="clear:both;">

        <form name="form" action="<?php echo admin_url('admin.php?page=' . $pname . '%2Fadmin%2Fpartials%2Fchordpress-admin-license.php') ?>" method="post">

            <?php settings_fields($pname . '_options_group'); ?>

            <table class="form-table" style="margin-left:16px;<?php echo $display; ?>">
                <tbody>
                    <tr>
                        <td scope="row" colspan="2">
                            <?php
                            //
                            // Activate License
                            //
                            if (isset($_REQUEST['activate_license'])) {
                                $L->setKey($_REQUEST[$pname . '_license_key']);
                                $response = $L->activate();

                                // Uncomment it to look at the data

                                // $PL->pretty_dump($response);
                                echo $L->showResult($response);

                                if ($response->result == 'success') {
                                    update_option($pname . '_license_key', $L->getKey()); ?>
                                <?php }
                            }
                            //
                            // Deactivate License
                            //
                            if (isset($_REQUEST['deactivate_license'])) {
                                $L->setKey($_REQUEST[$pname . '_license_key']);
                                $response = $L->deactivate();

                                // Uncomment it if you want to look at the full response
                                // $PL->pretty_dump($response);
                                echo $L->showResult($response);

                                if ($response->result == 'success') {
                                    update_option($pname . '_license_key', ''); ?>
                                    <?php }
                            }

                            if (get_option($pname . '_license_key')) {
                                $L->setKey(get_option($pname . '_license_key'));
                                $L->load();
                                // $PL->pretty_dump($L->details);
                                echo $L->showStatus($L->details, true);

                                if ($L->isExpired() && $L->isInGracePeriod()) {
                                    $renewInDays = (30 + intval($L->daysToExpiry()));
                                    echo '<div class="' . $pprefix . '-alert ' . $pprefix . '-alert-warning">' . esc_html(__('Your Connector Jira Server license has expired', 'chordpress')) . ' ' . str_replace('-', '', $L->daysToExpiry()) . ' ' . esc_html(__('days ago. Please renew your license within', 'chordpress')) . ' ' . $renewInDays . ' days.</div>';
                                }

                                switch ($L->status()) {

                                    case 'active':
                                        if (intval($L->daysToExpiry()) <= 30) { ?>
                                            <script>
                                                var badge = document.getElementById($pprefix.
                                                    "-license-badge");
                                                badge.innerHTML = '<?php echo esc_html(__('Expiring soon!', 'chordpress')); ?>';
                                                badge.classList.remove($pprefix.
                                                    '-badge-secondary');
                                                badge.classList.remove($pprefix.
                                                    '-badge-success');
                                                badge.classList.remove($pprefix.
                                                    '-badge-danger');
                                                badge.classList.add($pprefix.
                                                    '-badge-warning');
                                            </script>
                                        <?php
                                            $buttons = '<input type="submit" id="deactivate_license" name="deactivate_license" value="' . esc_html(__('Deactivate', 'chordpress')) . '" class="' . $pprefix . '-btn ' . $pprefix . '-btn-danger ' . $pprefix . '-btn-sm" /> <a href="https://support.lewe.com/how-to-get-a-license/" target="_blank" class="' . $pprefix . '-btn ' . $pprefix . '-btn-warning ' . $pprefix . '-btn-sm">' . esc_html(__('Renew', 'chordpress')) . '</a>';
                                        } else { ?>
                                            <script>
                                                var badge = document.getElementById($pprefix.
                                                    "-license-badge");
                                                badge.innerHTML = '<?php echo esc_html(__('Active', 'chordpress')); ?>';
                                                badge.classList.remove($pprefix.
                                                    '-badge-secondary');
                                                badge.classList.remove($pprefix.
                                                    '-badge-warning');
                                                badge.classList.remove($pprefix.
                                                    '-badge-danger');
                                                badge.classList.add($pprefix.
                                                    '-badge-success');
                                            </script>
                                        <?php
                                            $buttons = '<input type="submit" id="deactivate_license" name="deactivate_license" value="' . esc_html(__('Deactivate', 'chordpress')) . '" class="' . $pprefix . '-btn ' . $pprefix . '-btn-danger ' . $pprefix . '-btn-sm" />';
                                        }
                                        break;

                                    case 'blocked': ?>
                                        <script>
                                            var badge = document.getElementById($pprefix.
                                                "-license-badge");
                                            badge.innerHTML = '<?php echo esc_html(__('Blocked', 'chordpress')); ?>';
                                            badge.classList.remove($pprefix.
                                                '-badge-secondary');
                                            badge.classList.remove($pprefix.
                                                '-badge-success');
                                            badge.classList.remove($pprefix.
                                                '-badge-warning');
                                            badge.classList.add($pprefix.
                                                '-badge-danger');
                                        </script>
                                    <?php
                                        $buttons = '<input type="submit" id="deactivate_license" name="deactivate_license" value="' . esc_html(__('Deactivate', 'chordpress')) . '" class="' . $pprefix . '-btn ' . $pprefix . '-btn-danger ' . $pprefix . '-btn-sm" /> <a href="https://support.lewe.com/how-to-get-a-license/" target="_blank" class="' . $pprefix . '-btn ' . $pprefix . '-btn-warning ' . $pprefix . '-btn-sm">' . esc_html(__('Unblock', 'chordpress')) . '</a>';
                                        break;

                                    case 'expired': ?>
                                        <script>
                                            var badge = document.getElementById($pprefix.
                                                "-license-badge");
                                            badge.innerHTML = '<?php echo esc_html(__('Expired', 'chordpress')); ?>';
                                            badge.classList.remove($pprefix.
                                                '-badge-secondary');
                                            badge.classList.remove($pprefix.
                                                '-badge-success');
                                            badge.classList.remove($pprefix.
                                                '-badge-danger');
                                            badge.classList.add($pprefix.
                                                '-badge-warning');
                                        </script>
                                    <?php
                                        $buttons = '<a href="https://support.lewe.com/how-to-get-a-license/" target="_blank" class="' . $pprefix . '-btn ' . $pprefix . '-btn-warning ' . $pprefix . '-btn-sm">' . esc_html(__('Renew', 'chordpress')) . '</a>';
                                        break;

                                    case 'pending': ?>
                                        <script>
                                            var badge = document.getElementById($pprefix.
                                                "-license-badge");
                                            badge.innerHTML = '<?php echo esc_html(__('Pending', 'chordpress')); ?>';
                                            badge.classList.remove($pprefix.
                                                '-badge-secondary');
                                            badge.classList.remove($pprefix.
                                                '-badge-success');
                                            badge.classList.remove($pprefix.
                                                '-badge-danger');
                                            badge.classList.add($pprefix.
                                                '-badge-warning');
                                        </script>
                                <?php
                                        $buttons = '<input type="submit" id="activate_license" name="activate_license" value="' . esc_html(__('Activate', 'chordpress')) . '" class="' . $pprefix . '-btn ' . $pprefix . '-btn-success ' . $pprefix . '-btn-sm" />';
                                        break;
                                }
                            } else { ?>
                                <div class="<?php echo $pprefix; ?>-callout <?php echo $pprefix; ?>-callout-danger">
                                    <span class="<?php echo $pprefix; ?>-text-danger"><strong><?php echo esc_html(__('Missing License', 'chordpress')); ?></strong></span>
                                    <hr>
                                    <?php echo esc_html(__('Please enter the license key for this plugin. You were given a license key when you purchased this item.', 'chordpress')); ?>
                                </div>
    </div>
    <script>
        var badge = document.getElementById($pprefix.
            "-license-badge");
        badge.innerHTML = '<?php echo esc_html(__('Missing', 'chordpress')); ?>';
        badge.classList.remove($pprefix.
            '-badge-secondary');
        badge.classList.remove($pprefix.
            '-badge-success');
        badge.classList.remove($pprefix.
            '-badge-warning');
        badge.classList.add($pprefix.
            '-badge-danger');
    </script>
<?php
                                $buttons = '<input type="submit" id="activate_license" name="activate_license" value="' . esc_html(__('Activate', 'chordpress')) . '" class="' . $pprefix . '-btn ' . $pprefix . '-btn-success ' . $pprefix . '-btn-sm" /> <a href="https://support.lewe.com/how-to-get-a-license/" target="_blank" class="' . $pprefix . '-btn ' . $pprefix . '-btn-warning ' . $pprefix . '-btn-sm">' . esc_html(__('Get a license', 'chordpress')) . '</a>';
                            } ?>
</td>
</tr>
<tr>
    <th scope="row"><label for="<?php echo $pname; ?>_license_key"><?php echo esc_html(__('License Key', 'chordpress')); ?></label></th>
    <td>
        <input type="text" id="<?php echo $pname; ?>_license_key" name="<?php echo $pname; ?>_license_key" value="<?php echo get_option($pname . '_license_key'); ?>">
    </td>
</tr>
<tr>
    <th scope="row">&nbsp;</th>
    <td sope="row"><?php echo $buttons; ?></td>
</tr>
</tbody>
</table>

</form>

</div>

</div>
<hr>