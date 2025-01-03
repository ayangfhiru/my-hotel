<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Invoice extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->helper('convert_date');
    }

    public function index()
    {
        $this->load->view('invoice');
    }

    public function generate_invoice($reservationId)
    {
        $this->load->model('reservation_model');
        $invoice = $this->reservation_model->to_invoice($reservationId);
        $invoice->check_in = to_human($invoice->check_in);
        $invoice->check_out = to_human($invoice->check_out);
        $data = [
            'invoice' => $invoice
        ];

        $date = date('d-M-Y');
        $fileName = "$invoice->full_name-$date.pdf";
        $this->pdf->load_view('invoice', $data, $fileName, true);
    }
}
