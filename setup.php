<?php
define('PLUGIN_SIMPLETICKETPRICE_VERSION', '1.0.0');

function plugin_init_simpleticketprice()
{
    global $PLUGIN_HOOKS;

    $PLUGIN_HOOKS['csrf_compliant']['simpleticketprice'] = true;
    $PLUGIN_HOOKS['post_item_form']['simpleticketprice'] = 'plugin_simpleticketprice_item_form';
    $PLUGIN_HOOKS['item_update']['simpleticketprice'] = 'plugin_simpleticketprice_item_update';
    $PLUGIN_HOOKS['pre_item_add']['simpleticketprice'] = [
        'ITILSolution' => 'plugin_simpleticketprice_pre_item_add_itilsolution'
    ];
}

function plugin_version_simpleticketprice()
{
    return [
        'name'           => 'Ticket Price',
        'version'        => PLUGIN_SIMPLETICKETPRICE_VERSION,
        'author'         => 'Samuel Lopes',
        'license'        => 'GPLv2+',
        'homepage'       => 'https://www.linkedin.com/in/samuel-vitor-lopes/',
        'requirements'   => [
            'glpi' => [
                'min' => '10.0'
            ]
        ]
    ];
}

function plugin_simpleticketprice_check_prerequisites()
{
    if (version_compare(GLPI_VERSION, '10.0', 'lt')) {
        echo "Este plugin requer GLPI >= 10.0";
        return false;
    }
    return true;
}

function plugin_simpleticketprice_check_config()
{
    if (true) {
        return true;
    }
    if ($verbose) {
        echo 'Installed / not configured';
    }
    return false;
}