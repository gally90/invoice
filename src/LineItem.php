<?php

namespace Gally90\Invoice;

class LineItem
{
    public $qty;
    public $name;
    public $price;
    public $line_total;

    public function __construct($qty, $name, $price)
    {
        $this->qty = $qty;
        $this->name = $name;
        $this->price = $price;
        $this->line_total = $this->qty * $this->price;
    }

}
