<?php

namespace App\Controller;

use App\Entity\Payer;
use App\Form\PayerType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PayerController extends AbstractController
{
    #[Route('/pagamento', name: 'app_payer')]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        $payer = new Payer();
        $payer->getNome();
        $payer->getCognome();
        $payer->getPrezzo();

        $form = $this->createForm(PayerType::class, $payer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            
            $payer = $form->getData();

            $entityManager->persist($payer);
            $entityManager->flush();

            return $this->redirectToRoute('app_user');
        }



        
        return $this->render('payer/payer.html.twig', [
            'payerForm' => $form->createView(),
        ]);
    }
}
