## Invoice package for Laravel

To get started simply use composer to require the package

    composer require gally90/laravel-invoice

## Configuration

To publish this packages assets use the following command

    php artisan vendor:publish --provider="Gally90\Invoice\InvoiceServiceProvider"

You can now set up your business information in the invoice.php configuration file.

## Usage

    use Gally90\Invoice\Invoice;

    $i = new Invoice($order->id); //You do not have to provide an invoice number on creation - it will default to 1
    $i->to('Test Business');
    $i->address('Test Line 1', 'Test City', 'AB1 2CD');
    $i->addItem(1, 'Random Item', 39.99);
    $i->addItem(5, 'Random Item 2', 10.00);
    $i->message('Thank you for your purchase!');
    //return $i->download('My Awesome Invoice!.pdf');
    return $i->stream('Invoice.pdf');

## Extra Features

Sometime you may want to use a different tax rate than the one set in your invoice.php configuration file. To do this simply use the following method

    $i->setTaxRate(5);

You can access all of the invoice totals using the following methods

    $i->getNetTotal();
    $i->getTaxTotal();
    $i->getGrossTotal();

You can also change the invoice number from the default '1' or from the number you provided on creation of the invoice using the following method

    $i->setInvoiceNumber(123456);