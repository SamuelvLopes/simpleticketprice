<?php

/**
 * -------------------------------------------------------------------------
 * SimpleTicketPrice plugin for GLPI
 * Copyright (C) 2025 by the SimpleTicketPrice Development Team.
 * -------------------------------------------------------------------------
 *
 * MIT License
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 *
 * --------------------------------------------------------------------------
 */

define('PLUGIN_SIMPLETICKETPRICE_VERSION', '0.0.1');

// Minimal GLPI version, inclusive
define("PLUGIN_SIMPLETICKETPRICE_MIN_GLPI_VERSION", "10.0.0");
// Maximum GLPI version, exclusive
define("PLUGIN_SIMPLETICKETPRICE_MAX_GLPI_VERSION", "10.0.99");

/**
 * Init hooks of the plugin.
 * REQUIRED
 *
 * @phpmd suppress CamelCaseVariableName
 * @return void
 */
function plugin_init_simpleticketprice()
{
    global $PLUGIN_HOOKS;

    $PLUGIN_HOOKS['csrf_compliant']['simpleticketprice'] = true;
}


/**
 * Get the name and the version of the plugin
 * REQUIRED
 *
 * @return array<string, mixed>
 */
function plugin_version_simpleticketprice()
{
    return [
        'name'           => 'SimpleTicketPrice',
        'version'        => PLUGIN_SIMPLETICKETPRICE_VERSION,
        'author'         => '<a href="https://www.linkedin.com/in/samuel-vitor-lopes/">Samuel Lopes</a>',
        'license'        => '',
        'homepage'       => '',
        'requirements'   => [
            'glpi' => [
                'min' => PLUGIN_SIMPLETICKETPRICE_MIN_GLPI_VERSION,
                'max' => PLUGIN_SIMPLETICKETPRICE_MAX_GLPI_VERSION,
            ]
        ]
    ];
}

/**
 * Check pre-requisites before install
 * OPTIONNAL, but recommanded
 *
 * @return boolean
 */
function plugin_simpleticketprice_check_prerequisites()
{
    return true;
}

/**
 * Check configuration process
 *
 * @param boolean $verbose Whether to display message on failure. Defaults to false
 *
 * @return boolean
 *
 * @phpmd suppress BooleanArgumentFlag
 */
function plugin_simpleticketprice_check_config($verbose = false)
{
    return $verbose?true:!false;
}
