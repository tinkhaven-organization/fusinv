<!DOCTYPE HTML>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/default/css/style.css">
        
        <style>
            * {
                font-family: 'Open Sans', sans-serif;
                margin:0px;
                padding:5px;
                background: #8ba644;
            }
            body {
                color: #000 !important;
            }
            table {
                width:100%;
            }
            #header table {
                width:100%;
                padding: 0px;
            }
            #header table td, .amount-summary td {
                vertical-align: text-top;
                padding: 5px;
            }
            #company-name{
                color:#5e8bc0;
                font-size: 12px;
            }
            #invoice-to td {
                text-align: left
            }
            #invoice-to {
                margin-bottom: 14px;
            }
            #invoice-to-right-table td {
                padding-right: 5px;
                padding-left: 5px;
                text-align: right;
            }
            .seperator {
                height: 25px
            }
            .top-border {
                border-top: none;
            }
            .no-bottom-border {
                border:none !important;
                background-color: white !important;
            }
        </style>
        
	</head>
	<body>
        <div id="header">
            <table>
                <tr>
                    <td id="company-name">
                        <?php echo invoice_logo_pdf(); ?>
                        <h3><?php echo $quote->user_name; ?></h3>
                <br>
                        <p>
                            <?php if ($quote->user_name) { echo $quote->user_name . ' ' . $quote->user_custom_legal_form . '<br>'; } ?>
                            <?php if ($quote->user_address_1) { echo $quote->user_address_1 . '<br>'; } ?>
                            <?php if ($quote->user_address_2) { echo $quote->user_address_2 . '<br>'; } ?>
                            <?php if ($quote->user_zip) { echo $quote->user_zip . ' '; } ?>
                            <?php if ($quote->user_city) { echo $quote->user_city . ' '; } ?>
                            <?php if ($quote->user_state) { echo $quote->user_state . ' '; } ?>
                <br>
                            <?php if ($quote->user_phone) { echo $quote->user_phone; ?><br><?php } ?>
                            <?php if ($quote->user_fax) { ?><abbr>F:</abbr><?php echo $quote->user_fax; ?><?php } ?>
                <br>
                            <?php if ($quote->user_custom_vat_number) { echo lang('tax') . ': ' . $quote->user_custom_vat_number . '<br>'; } ?>
                            RPR: <?php if ($quote->user_custom_rpr) { echo $quote->user_custom_rpr . '<br>'; } ?>
                            IBAN: <?php if ($quote->user_custom_iban) { echo $quote->user_custom_iban . '<br>'; } ?>
                            BIC: <?php if ($quote->user_custom_bic) { echo $quote->user_custom_bic . '<br>'; } ?>
                        </p>
                    </td>
                    <td style="text-align: right;"><h2><?php echo lang('quote'); ?> <?php echo $quote->quote_number; ?></h2></td>
                </tr>
            </table>
        </div>
        <div id="invoice-to">
            <table style="width: 100%;">
                <tr>
                    <td style="padding-left: 5px;">
                        <p><?php echo lang('quote_to'); ?>:</p>
                        <p><?php echo $quote->client_name; ?><br>
                            <?php if ($quote->client_address_1) { echo $quote->client_address_1 . '<br>'; } ?>
                            <?php if ($quote->client_address_2) { echo $quote->client_address_2 . '<br>'; } ?>
                            <?php if ($quote->client_city) { echo $quote->client_city . ' '; } ?>
                            <?php if ($quote->client_state) { echo $quote->client_state . ' '; } ?>
                            <?php if ($quote->client_zip) { echo $quote->client_zip . '<br>'; } ?>
                            <?php if ($quote->client_phone) { ?><abbr>T:</abbr><?php echo $quote->client_phone; ?><br><?php } ?>
                            <?php if ($quote->client_custom_vat_number) { echo lang('tax') . ': ' . $quote->client_custom_vat_number . ' '; } ?>
                        </p>
                    </td>
                    <td style="width:40%;"></td>
                    <td style="text-align: right;">
                        <table id="invoice-to-right-table">
                            <tbody>
                                <tr>
                                    <td><?php echo lang('quote_number'); ?>: </td>
                                    <td><?php echo $quote->quote_number; ?></td>
                                </tr>
                                <tr>
                                    <td><?php echo lang('quote_date'); ?>: </td>
                                    <td><?php echo date_from_mysql($quote->quote_date_created, TRUE); ?></td>
                                </tr>
                                <tr>
                                    <td><?php echo lang('due_date'); ?>: </td>
                                    <td><?php echo date_from_mysql($quote->quote_date_expires, TRUE); ?></td>
                                </tr>
                                <tr>
                                    <td><?php echo lang('quote_amount_due'); ?>: </td>
                                    <td><?php echo format_currency($quote->quote_total); ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </table>
        </div>
        <div id="invoice-items">
            <table class="table table-striped" style="width: 100%;">
                <thead>
                    <tr>
                        <th><?php echo lang('item'); ?></th>
                        <th><?php echo lang('description'); ?></th>
                        <th style="text-align: right;"><?php echo lang('qty'); ?></th>
                        <th style="text-align: right;"><?php echo lang('price'); ?></th>
                        <th style="text-align: right;"><?php echo lang('total'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($items as $item) { ?>
                        <tr>
                            <td><?php echo $item->item_name; ?></td>
                            <td><?php echo nl2br($item->item_description); ?></td>
                            <td style="text-align: right;"><?php echo format_amount($item->item_quantity); ?></td>
                            <td style="text-align: right;"><?php echo format_currency($item->item_price); ?></td>
                            <td style="text-align: right;"><?php echo format_currency($item->item_subtotal); ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <table>
                <tr>
                    <td style="text-align: right;">
                        <table class="amount-summary">
                            <tr>
                                <td style="text-align: right;"><?php echo lang('subtotal'); ?>:</td>
                                <td style="text-align: right;"><?php echo format_currency($quote->quote_item_subtotal); ?></td>
                            </tr>
                            <?php if ($quote->quote_item_tax_total > 0) { ?>
                            <tr>
                                <td style="text-align: right;"><?php echo lang('item_tax'); ?></td>
                                <td style="text-align: right;"><?php echo format_currency($quote->quote_item_tax_total); ?></td>
                            </tr>
                            <?php } ?>
                            <?php foreach ($quote_tax_rates as $quote_tax_rate) : ?>
                                <tr>    
                                    <td style="text-align: right;"><?php echo $quote_tax_rate->quote_tax_rate_name . ' ' . $quote_tax_rate->quote_tax_rate_percent; ?>%</td>
                                    <td style="text-align: right;"><?php echo format_currency($quote_tax_rate->quote_tax_rate_amount); ?></td>
                                </tr>
                            <?php endforeach ?>
                            <tr>
                                <td style="text-align: right;"><?php echo lang('total'); ?>:</td>
                                <td style="text-align: right;"><?php echo format_currency($quote->quote_total); ?></td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
            
        </div>
	</body>
</html>