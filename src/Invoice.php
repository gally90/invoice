<?php

namespace Gally90\Invoice;

use Barryvdh\DomPDF\Facade as PDF;

class Invoice
{
    public $items = [];
    public $tax_rate = 20;
    public $number = 1;
    public $customer_ref;
    public $start_date;
    public $to;
    public $address1;
    public $city;
    public $postcode;
    public $message = null;
    public $status = 'Paid';

    public function __construct($number = null)
    {
        $this->tax_rate = config('invoice.tax_rate');
        $this->start_date = now()->format('M d, Y');
        $this->number = $number ?? time();
        PDF::setOptions([
            'fontDir' => storage_path('fonts/'),
            'defaultFont' => 'sans-serif',
        ]);
    }

    public function stream()
    {
        return PDF::loadView('invoice::invoice', ['invoice' => $this])->stream();
    }

    public function download($filename = 'invoice.pdf')
    {
        return PDF::loadView('invoice::invoice', ['invoice' => $this])->download($filename);
    }

    public function addItem($qty, $name, $price)
    {
        array_push($this->items, new LineItem($qty, $name, $price));
    }

    public function message($msg)
    {
        $this->message = $msg;
    }

    public function status($status)
    {
        $this->status = $status;
    }

    public function setTaxRate($rate)
    {
        $this->tax_rate = $rate;
    }

    public function setInvoiceNumber($number)
    {
        $this->number = $number;
    }

    public function to($to)
    {
        $this->to = $to;
    }

    public function address($address1, $city, $postcode)
    {
        $this->address1 = $address1;
        $this->city = $city;
        $this->postcode = $postcode;
    }

    public function getNetTotal()
    {
        $t = 0;
        foreach ($this->items as $i) {
            $t += $i->line_total;
        }
        return $t;
    }

    public function getTaxTotal()
    {
        return ($this->getNetTotal() / 100) * $this->tax_rate;
    }

    public function getGrossTotal()
    {
        return $this->getNetTotal() + $this->getTaxTotal();
    }

}
