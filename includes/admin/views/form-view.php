<div class="wrap">
    <div id="poststuff">
        <div id="postbox-container" class="postbox-container">
            <div class="meta-box-sortables ui-sortable" id="normal-sortables">
                <div class="postbox " id="bubbles-settings-general">
                    <div title="Click to toggle" class="handlediv"><br></div>
                    <h3 class="hndle"><span>Bubble settings</span></h3>
                    <div style="float:left;background: white;width: 100%;">
                        <div style="background: white;float: left;width: 90%;padding-top: 10px;padding-left: 5%;">
                            <?php do_action('damses_bubbles_save_settings');?>

                            <?php do_action('damses_bubbles_get_values');?>                                                

                            <?php do_action('damses_bubbles_show_messages');?>

                            <?php do_action('damses_bubbles_generate_form');?>
                        </div>
                    </div>                        

                </div>

            </div>
        </div>
    </div>
</div>

 