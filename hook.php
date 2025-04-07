<?php
function plugin_simpleticketprice_install(): bool 
{
    global $DB;

    if (!$DB->fieldExists('glpi_tickets', 'price')) {
        $DB->query("ALTER TABLE glpi_tickets ADD COLUMN price DECIMAL(10,2) NOT NULL DEFAULT '0.00'") or die($DB->error());
    }

    return true;
}

function plugin_simpleticketprice_uninstall(): bool 
{
    global $DB;

    if ($DB->fieldExists('glpi_tickets', 'price')) {
        $DB->query("ALTER TABLE glpi_tickets DROP COLUMN price");
    }

    return true;
}

function plugin_simpleticketprice_item_form(array $params): void
{
    if ($params['item'] instanceof Ticket) {
        global $CFG_GLPI;

        $price = isset($params['item']->fields['price']) ? $params['item']->fields['price'] : '0.00';
        $is_new_ticket = !$params['item']->getID();
        $formatted_price = $is_new_ticket
            ? htmlentities($price)
            : htmlentities(number_format($price, 2, ',', '.'));

        $label = __('Preço R$', 'simpleticketprice');

        $html = <<<HTML
        <div class="form-field row col-12">
            <label class="col-form-label col-xxl-4 text-xxl-end" for="price">{$label}</label>
            <div class="col-xxl-8 field-container">
                <input type="string" name="price" id="price" class="form-control" value="{$formatted_price}" required />
            </div>
        </div>
        <script>
        document.getElementById('price').addEventListener('keyup', function (e) {
            const input = e.target;
            let value = input.value;
            value = value.replace(/\D/g, '');
            value = (value / 100).toFixed(2) + '';
            value = value.replace('.', ',');
            value = value.replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.');
            input.value = value;
        });

        document.getElementById('price').addEventListener('focusout', function (e) {
            const input = e.target;
            let value = input.value;
            value = value.replace('R$ ', '').replace(/\./g, '').replace(',', '.');
            const numericValue = parseFloat(value);
            if (!isNaN(numericValue)) {
                input.value = numericValue.toFixed(2);
            } else {
                input.value = (0).toFixed(2);
            }
        });
        </script>
        HTML;

        echo $html;
    }
}



function plugin_simpleticketprice_pre_item_add_itilsolution(ITILSolution $solution) 
{
    if (!empty($solution->input['content'])) {
        $ticket = new Ticket();
        if ($ticket->getFromDB($solution->fields['items_id'])) {
            $price = $ticket->fields['price'] ?? null;
            
            if ($price !== null) {
                $formattedPrice = 'R$ ' . number_format($price, 2, ',', '.');
                $solution->input['content'] .= "\n\n💰 Preço: " . $formattedPrice;
            } else {
                $solution->input['content'] .= "\n\n⚠️ Preço não definido";
            }
        }
    }
}


function plugin_simpleticketprice_item_update($item)
{
    if (get_class($item) === 'Ticket' && isset($_POST['price'])) {
        $price = str_replace(['R$', '.', ','], ['', '', '.'], $_POST['price']);
        $price = filter_var($price, FILTER_VALIDATE_FLOAT);

        if ($price !== false) {
            $item->fields['price'] = $price;
            $item->update([
                'id'    => $item->getID(),
                'price' => $price
            ]);
        }
    }
}

