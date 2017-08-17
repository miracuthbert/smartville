<div class="box-min">
    <form method="post" action="" id="property-layout-settings">
        <div class="form-group clearfix">
            <div class="row">
                <div class="col-md-4">
                    <span class="lead"><i class="fa fa-home"></i> Properties View Layout</span>
                </div>
                <div class="col-md-8">
                    <div class="pull-right">
                        <label class="radio-inline">
                            <input type="radio" name="properties_layout" id="prop_list"
                                   value="list" {{ array_has($settings, 'layouts.properties') ? $settings['layouts']['properties'] == 'list' ? 'checked' : '' : $default_settings['layouts']['properties'] == 'list' ? 'checked' : '' }}>List
                            View
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="properties_layout" id="prop_grid"
                                   value="grid" {{ array_has($settings, 'layouts.properties') ? $settings['layouts']['properties'] == 'grid' ? 'checked' : '' : $default_settings['layouts']['properties'] == 'grid' ? 'checked' : '' }}>Grid
                            View
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>