<div class="box-min">
    <form method="post" action="" id="tenant-layout-settings">
        <div class="form-group clearfix">
            <div class="row">
                <div class="col-md-4">
                    <strong><i class="fa fa-users"></i> Tenants</strong>
                </div>
                <div class="col-md-8">
                    <div class="pull-right">
                        <label class="radio-inline">
                            <input type="radio" name="tenants_layout" id="tenant_list"
                                   value="list" {{ array_has($settings, 'layouts.tenants') ? $settings['layouts']['tenants'] == 'list' ? 'checked' : '' : $default_settings['layouts']['tenants'] == 'list' ? 'checked' : '' }}>
                            List View
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="tenants_layout" id="tenant_grid"
                                   value="grid" {{ array_has($settings, 'layouts.tenants') ? $settings['layouts']['tenants'] == 'grid' ? 'checked' : '' : $default_settings['layouts']['tenants'] == 'grid' ? 'checked' : '' }}>
                            Grid View
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
