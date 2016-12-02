<?php

namespace KmBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Hackzilla\BarcodeBundle\Utility\Barcode;

class DefaultController extends Controller
{
    public function frontAction()
    {
        //when logout, goes to the login page
        //Get the authorization checker
        $authChecker = $this->get('security.authorization_checker');
        if(!$authChecker->isGranted("ROLE_SUPER_ADMIN")){
            return $this->redirect($this->generateUrl('fos_user_security_login'));
        }
        return new Response('FRONT OF THE APP');
    }

    public function dashboardAction()
    {
        //Get the statistic handler service
        $statisticHandler = $this->get('km.statisticHandler');
        //Get all the sale transaction amount for every month
        $stransactions = $statisticHandler->getSaleByMonth();
        return $this->render('/admin/vendor_dashboard.html.twig', array('stransactions' => $stransactions));
    }
    
    public function indexAction()
    {
        $code = '1751477849934';
        //return $this->getBarCodeAction($code);
        //return $this->barcodeZipAction($code);
        //$data = base64_decode($this->getImage($code));
        
        $im = imagecreatefromstring($this->getImage($code));
        imagepng($im, getcwd().'/barcode/1.png');
        
        //return new Response('<img src="/opt/lampp/htdocs/KINGMANAGER/web/barcode/1.png" />');
        return $this->render('TransactionBundle:Default:product_list.html.twig');
    }
    
    public function getBarCodeAction($code)
    {
        $barcode = $this->get('hackzilla_barcode');
        $barcode->setMode(Barcode::MODE_PNG);

        $headers = array(
            'Content-Type' => 'image/png',
            'Content-Disposition' => 'inline; filename="'.$code.'.png"'
        );
        
        //return new Response($code);
        return new Response($barcode->outputImage($code), 200, $headers);
    }
    
    /**
     * Return image in a zip
     */
    public function barcodeZipAction($code)
    {
        $isbns = array(
            '978085934063',
            '500015941539',
            '978085956063',
            '500015921539',
        );

        $zipDir = sys_get_temp_dir();

        if (substr($zipDir, -1) !== '/') {
            $zipDir .= '/';
        }

        $zip = new \ZipArchive();
        $zipName = 'barcodes-' . time() . ".zip";
        $zip->open($zipDir . $zipName, \ZipArchive::CREATE);

        foreach ($isbns as $i => $isbn) {
            $barcode = \trim($isbn);
            $zip->addFromString($barcode . '.png', $this->getImage($barcode));
        }

        $zip->close();

        $response = new Response();
        $response->setContent(readfile($zipDir . $zipName));
        $response->headers->set('Content-Type', 'application/zip');
        $response->headers->set('Content-disposition', 'attachment; filename="' . $zipName . '"');
        $response->headers->set('Content-Length', filesize($zipDir . $zipName));

        return $response;
    }

    private function getImage($ean)
    {
        ob_start();

        $barcodeGenerator = new Barcode();
        $barcodeGenerator->setMode(Barcode::MODE_PNG);
        $barcodeGenerator->outputImage($ean);

        $contents = ob_get_clean();

        return $contents;
    }
}
