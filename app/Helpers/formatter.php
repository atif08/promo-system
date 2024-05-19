<?php

function format_amount($amount, $currency, $locale = 'en_US.utf8') {
	$formatter = new NumberFormatter($locale, NumberFormatter::CURRENCY);
	$formatter->setAttribute(NumberFormatter::MAX_FRACTION_DIGITS, 2);
	return str_replace("\xc2\xa0", '', $formatter->formatCurrency($amount, $currency));
}

function format_number($number, $precision = 2, $locale = 'en_US.utf8') {
	$number = $number ?: 0;
    $formatter = new NumberFormatter($locale, NumberFormatter::DECIMAL);
    $formatter->setAttribute(NumberFormatter::MAX_FRACTION_DIGITS, $precision);
	return $formatter->format($number);
}

function format_integer($number) {
    return format_number(($number ?: 0), 0);
}

function format_percent($number, $total = 1, $precision = 2): string {
    return ($total === 0) ? 'N/A' : (format_number(($number ?: 0) / $total * 100, $precision) . '%');
}

function currency_icon($currency, $locale = 'en_US.utf8') {
    // Create a NumberFormatter
    $formatter = new NumberFormatter($locale, NumberFormatter::CURRENCY);
    $formatter->setTextAttribute(NumberFormatter::CURRENCY_CODE, $currency);

    // amount with currency symbol $0.00
    $with_currency = $formatter->formatCurrency(0, $currency);

    // amount without currency symbol
    $formatter->setPattern(str_replace('¤', '', $formatter->getPattern()));
    $without_currency = $formatter->formatCurrency(0, $currency);

    // get the currency symbol from first string
    return str_replace($without_currency, '', $with_currency);
}
