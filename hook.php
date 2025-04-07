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

/**
 * Função de instalação do plugin TicketPrice.
 * Cria a tabela necessária para armazenar preços associados aos tickets.
 *
 * @return bool true em caso de sucesso, false em caso contrário.
 */
function plugin_simpleticketprice_install()
{
    global $DB;

    if (!$DB->tableExists('glpi_plugin_ticketprice_tickets')) {
        $query = "CREATE TABLE `glpi_plugin_ticketprice_tickets` (
                    `id` INT AUTO_INCREMENT PRIMARY KEY,
                    `tickets_id` INT NOT NULL UNIQUE,
                    `price` DECIMAL(10,2) NOT NULL
                  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

        if (!$DB->query($query)) {
            return false;
        }
    }

    return true;
}

/**
 * Função de desinstalação do plugin TicketPrice.
 * Remove a tabela criada pelo plugin do banco de dados.
 *
 * @return bool true em caso de sucesso, false em caso contrário.
 */
function plugin_simpleticketprice_uninstall()
{
    global $DB;

    if ($DB->tableExists('glpi_plugin_ticketprice_tickets')) {
        if (!$DB->query("DROP TABLE `glpi_plugin_ticketprice_tickets`;")) {
            return false;
        }
    }

    return true;
}
