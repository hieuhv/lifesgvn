<?php
function lifesg_plugin_activation() {
 
        // Declare plugin to install
        $plugins = array(
                array(
                        'name' => 'SGCO Media Framework',
                        'slug' => 'redux-framework',
                        'required' => true
                )
        );
 
        // Establish TGM
        $configs = array(
                'menu' => 'tp_plugin_install',
                'has_notice' => true,
                'dismissable' => false,
                'is_automatic' => true
        );
        tgmpa( $plugins, $configs );
 
}
add_action('tgmpa_register', 'lifesg_plugin_activation');

?>