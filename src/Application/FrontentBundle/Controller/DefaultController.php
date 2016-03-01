<?php

namespace Application\FrontentBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Google_Client;
use Google_Service_Customsearch_ResultImage;
use Google_Service_Customsearch;
class DefaultController extends Controller
{
    /**
     * @Route("/")
     * @Template()
     */
    public function homeAction()
    {

        $client = new Google_Client();
        $client->setApplicationName("citope.com");
        $client->setDeveloperKey("AIzaSyAobgKimEctoeGN1esZ-W_enHX-Y_VOISQ");

        $service = new Google_Service_Customsearch($client);
        $optParams = array();
        $results = $service->cse->listCse('boobs', $optParams);
        var_dump($service);
        die;

        foreach ($results as $item) {
            echo $item['volumeInfo']['title'], "<br /> \n";
        }


die;


        $section = 'home';

        return array('section' => $section);
    }
}
