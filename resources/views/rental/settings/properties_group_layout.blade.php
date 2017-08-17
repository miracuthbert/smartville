<div class="box-min">
    <form method="post" action="" id="property-group-layout-settings">
        <div class="form-group clearfix">
            <div class="row">
                <div class="col-md-4">
                    <span class="lead"><i class="fa fa-building-o"></i> Properties Group View Layout</span>
                </div>
                <div class="col-md-8">
                    <div class="pull-right">
                        <label class="radio-inline">
                            <input type="radio" name="properties_group_layout" id="prop_group_list"
                                   value="list" {{ array_has($settings, 'layouts.groups') ? $settings['layouts']['groups'] == 'list' ? 'checked' : '' : $default_settings['layouts']['groups'] == 'list' ? 'checked' : '' }}>List
                            View
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="properties_group_layout" id="prop_group_grid"
                                   value="grid" disabled {{ array_has($settings, 'layouts.groups') ? $settings['layouts']['groups'] == 'grid' ? 'checked' : '' : $default_settings['layouts']['groups'] == 'grid' ? 'checked' : '' }}>Grid
                            View
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>