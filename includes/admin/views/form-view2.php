<div class="wrap">
    <div id="poststuff">
        <div id="postbox-container" class="postbox-container">
            <div class="meta-box-sortables ui-sortable" id="normal-sortables">
                <div class="postbox " id="bubbles-settings-general">
                    <div title="Click to toggle" class="handlediv"><br></div><h3 class="hndle"><span>Bubble settings</span></h3>
                    <div style="background: white;float: left;width: 100%;min-height: 500px;">
                        <div style="background: white;float: left;width: 50%;padding-top: 10px;padding-left: 30px;">
                        <?php do_action('damses_bubbles_save_settings');?>
                        
                        <?php do_action('damses_bubbles_get_values');?>                                                

                        <?php do_action('damses_bubbles_show_messages');?>                                                    

                        <?php do_action('damses_bubbles_input');?>
                            
                        <?php do_action('damses_bubbles_generate_form');?>
                        </div>    
                        <div style="float:left;background: white;height: 100%;width: 40%;">
                            <section class="bubble">
                                <figure id="ball" class="ball test bubble-link">
                                    <img id="dyanmic-bubble-image" style="width:100px;height: 100px;margin-left: 100px;margin-top: 50px;margin-bottom: 0;" src="<?php do_action('bubble_current_image')?>"/>'
                                    <p style="margin-top: 0;"><strong id="dynamic-title"><?php do_action('bubble_current_title')?></strong><br/><span id="dynamic-short-description"><?php do_action('bubble_current_short_description')?></span>

                                    <br/><strong id="dynamic-short-description2"><?php do_action('bubble_current_short_description2')?></strong>'
                                    </p>

                                </figure>
                            </section>
                        </div>                               
                        <?php do_action('bubble_current_styles')?>
                    </div>

                </div>

            </div>
        </div>
    </div>
</div>

 