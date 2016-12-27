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
        
        return $this->render('KmBundle:Default:front.html.twig');
    }

    public function dashboardAction()
    {
        //Get the statistic handler service
        $statisticHandler = $this->get('km.statisticHandler');
        //Get all the sale transaction amount for every month
        $stransactions = $statisticHandler->getSaleByMonth();
        //return $this->render('/gentelella/media_gallery.html.twig');
        //return $this->render('/pages/form_buttons.html.twig');
        //return $this->render('/pages/icons.html.twig');
        //return $this->render('/pages/general_elements.html.twig');
        return $this->render('/admin/vendor_dashboard.html.twig', array('stransactions' => $stransactions));
    }
    
    public function settingAction()
    {
        return $this->render('/pages/setting.html.twig');
    }
    
    public function BarcodeTestAction()
    {
        //Get the product from the DB in order to send it to the view
        $em = $this->getDoctrine()->getManager();
        //Get all the products
        $products = $em->getRepository('TransactionBundle:Product')->findBy(array('locked' => false));
        
        return $this->render('TransactionBundle:Default:barecode_test.html.twig', array('products' => $products));
    }
    
    public function indexAction($barcode)
    {
        //Get the product from the DB in order to send it to the view
        $em = $this->getDoctrine()->getManager();
        
        $product = $em->getRepository('TransactionBundle:Product')->findOneBy(array('barcode' => $barcode));
        
        $im = imagecreatefromstring($this->getImage($barcode));
        
        imagepng($im, getcwd().'/barcode/'.$barcode.'.png');
        
        return $this->render('TransactionBundle:Default:barecode_list.html.twig', array('barecode' => $barcode,
                                                                                        'product' => $product));  
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
