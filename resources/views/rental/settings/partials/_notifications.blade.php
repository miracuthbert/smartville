<form method="post" action="" id="notification-settings">
    <div class="box-min">
        <div class="row">
            <div class="col-md-12">
                <strong><i class="fa fa-globe"></i> Web Notifications</strong>
                <div class="pull-right">
                    <label class="radio-inline">
                        <input type="radio" name="web_notify" id="web_notify_off" value="0"
                                {{ array_has($settings, 'notifications.web') ? $settings['notifications']['web'] == 0 ? 'checked' : '' : $default_settings['notifications']['web'] == 0 ? 'checked' : '' }}>Disabled
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="web_notify" id="web_notify_on" value="1"
                                {{ array_has($settings, 'notifications.web') ? $settings['notifications']['web'] == 1 ? 'checked' : '' : $default_settings['notifications']['web'] == 1 ? 'checked' : '' }}>Active
                    </label>
                </div>
            </div>
        </div>
    </div>

    <div class="box-min">
        <div class="row">
            <div class="col-md-12">
                <strong><i class="fa fa-envelope-square"></i> Email Notifications</strong>
                <div class="pull-right">
                    <label class="radio-inline">
                        <input type="radio" name="email_notify" id="email_notify_off"
                               value="0" {{ array_has($settings, 'notifications.email') ? $settings['notifications']['email'] == 0 ? 'checked' : '' : $default_settings['notifications']['email'] == 0 ? 'checked' : '' }}>Disabled
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="email_notify" id="email_notify_on"
                               value="1" {{ array_has($settings, 'notifications.email') ? $settings['notifications']['email'] == 1 ? 'checked' : '' : $default_settings['notifications']['email'] == 1 ? 'checked' : '' }}>Active
                    </label>
                </div>
            </div>
        </div>
    </div>

    <div class="box-min">
        <div class="row">
            <div class="col-md-12">
                <strong><i class="fa fa-envelope-o"></i> SMS Notifications</strong>
                <div class="pull-right">
                    <label class="radio-inline">
                        <input type="radio" name="sms_notify" id="sms_notify_off" value="0"
                                {{ array_has($settings, 'notifications.sms') ? $settings['notifications']['sms'] == 0 ? 'checked' : '' : $default_settings['notifications']['sms'] == 0 ? 'checked' : '' }}>Disabled
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="sms_notify" id="sms_notify_on" value="1" disabled
                                {{ array_has($settings, 'notifications.sms') ? $settings['notifications']['sms'] == 1 ? 'checked' : '' : $default_settings['notifications']['sms'] == 1 ? 'checked' : '' }}>Active
                    </label>
                </div>
            </div>
        </div>
    </div>
</form>
