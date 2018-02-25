<?php

namespace GrapheBundle\Controller;

use CMEN\GoogleChartsBundle\GoogleCharts\Charts\PieChart;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use MainBundle\Entity\Etablissement;

class DefaultController extends Controller
{
    public function TypeAction()
    {

            $pieChart = new PieChart();
            $em= $this->getDoctrine()->getManager();
            $etablissements = $em->getRepository("MainBundle:Etablissement")->findAll();
            $totalEtab=count($etablissements);
            $types=array('Resto_Café','Shops','hotels','Autres');

            $data= array();
            $stat=['type', 'nb'];
            $nb=0;
            array_push($data,$stat);
            foreach($types as $type) {
                $stat=array();
                array_push($stat,$type,$em->getRepository("MainBundle:Etablissement")->NbrParType($type)*100/$totalEtab);
                $nb=$em->getRepository("MainBundle:Etablissement")->NbrParType($type)*100/$totalEtab;
                $stat=[$type,$nb];
                array_push($data,$stat);
            }
            $pieChart->getData()->setArrayToDataTable(
                $data
            );
            $pieChart->getOptions()->setTitle('Pourcentages des établissements par type');
            $pieChart->getOptions()->setHeight(500);
            $pieChart->getOptions()->setWidth(900);
            $pieChart->getOptions()->getTitleTextStyle()->setBold(true);
            $pieChart->getOptions()->getTitleTextStyle()->setColor('#009900');
            $pieChart->getOptions()->getTitleTextStyle()->setItalic(true);
            $pieChart->getOptions()->getTitleTextStyle()->setFontName('Arial');
            $pieChart->getOptions()->getTitleTextStyle()->setFontSize(20);
        return $this->render('GrapheBundle:Default:index.html.twig',array('piechart' => $pieChart));
    }
}
