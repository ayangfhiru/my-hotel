<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH . 'libraries/dompdf/autoload.inc.php';

use Dompdf\Dompdf;
use Dompdf\Options;

class Pdf
{
    public $dompdf;

    public function __construct()
    {
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);

        $this->dompdf = new Dompdf($options);
    }

    public function load_view($view, $data = [], $filename = 'document.pdf', $stream = true)
    {
        $CI = &get_instance();
        $html = $CI->load->view($view, $data, TRUE);

        $this->dompdf->loadHtml($html);

        $this->dompdf->setPaper('A4', 'landscape');

        $this->dompdf->render();

        if ($stream) {
            $this->dompdf->stream($filename, ["Attachment" => 1]);
        } else {
            return $this->dompdf->output();
        }
    }
}
