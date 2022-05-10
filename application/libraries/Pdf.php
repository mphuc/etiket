<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * CodeIgniter DomPDF Library
 *
 * Generate PDF's from HTML in CodeIgniter
 *
 * @packge        CodeIgniter
 * @subpackage        Libraries
 * @category        Libraries
 * @author        Ardianta Pargo
 * @license        MIT License
 * @link        https://github.com/ardianta/codeigniter-dompdf
 */
// use Dompdf\Dompdf;
class Pdf{

    protected $ci;

    function __construct(){
        $this->ci = & get_instance();
    }

    function pdfGenerator($html, $filename, $paper, $orientation){
      $dompdf = new Dompdf\Dompdf();

      $dompdf->loadHtml($html);

      $dompdf->setPaper($paper, $orientation);

      $dompdf->render();

      $dompdf->stream($filename, array('Attachment' => 0));
    }
}