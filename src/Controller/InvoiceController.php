<?php

namespace App\Controller;

use App\Entity\BudgetCode;
use App\Entity\Invoice;
use App\Entity\InvoiceItem;
use App\Entity\ProjectName;
use App\Entity\Vendor;
use App\Form\BudgetCodeType;
use App\Form\InvoiceType;
use App\Form\ProjectNameType;
use App\Form\VendorType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Debug\Debug;
use Symfony\Component\HttpFoundation\Request;

class InvoiceController extends Controller
{
    /**
     * @Route("/invoice", name="invoice")
     */
    public function index()
    {
        return $this->render('invoice/index.html.twig', [
            'controller_name' => 'InvoiceController',
        ]);
    }

    /**
     * @Route("/invoice/create_budget_code", name="createBGCode")
     */
    public function createBGCode( Request $request)
    {
        Debug::enable();
        $bgcode = new BudgetCode();
        $form = $this->createForm(BudgetCodeType::class,$bgcode);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            dump($bgcode);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($bgcode);
            $entityManager->flush();

            return $this->redirectToRoute('listBGCode');
        }

        return $this->render('invoice/createBGCode.html.twig', [
            'controller_name' => 'UserController',
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/invoice/list_budget_code", name="listBGCode")
     */
    public function listBGCode()
    {
        $listBGCode = $this->getDoctrine()
            ->getRepository(BudgetCode::class)
            ->findAll();

        if(!$listBGCode){
            return $this->redirectToRoute('createBGCode');
        }else{
            return $this->render('invoice/listBGCode.html.twig', [
                'controller_name' => 'UserController',
                'dataBGCode' => $listBGCode
            ]);

        }
    }

    /**
     * @Route("/invoice/delete/BGCode/{idBGCode}", name="deleteBGCode", requirements={"idBGCode"="\d+"})
     */
    public function deleteBGCode($idBGCode)
    {
        $listBGCode = $this->getDoctrine()
            ->getRepository(BudgetCode::class)
            ->find($idBGCode);

        if(!$listBGCode){
            throw $this->createNotFoundException(
                'No BGCode has been registered by the administrator'
            );
        }else {
            $entityManager = $this->getDoctrine()->getManager();
            $removeBGCode = $entityManager->getRepository(BudgetCode::class)->find($idBGCode);
            if (!$removeBGCode) {
                throw $this->createNotFoundException(
                    'No BGCode found for id '.$idBGCode
                );
            }
            $entityManager->remove($removeBGCode);
            $entityManager->flush();

            return $this->redirectToRoute('listBGCode');
        }
    }

    /**
     * @Route("/invoice/create_project_name", name="createPname")
     */
    public function createProjectName( Request $request)
    {
        Debug::enable();
        $pname = new ProjectName();
        $form = $this->createForm(ProjectNameType::class,$pname);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            dump($pname);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($pname);
            $entityManager->flush();

            return $this->redirectToRoute('listPname');
        }

        return $this->render('invoice/createPname.html.twig', [
            'controller_name' => 'UserController',
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/invoice/list_pname", name="listPname")
     */
    public function listProjectName()
    {
        $listPname = $this->getDoctrine()
            ->getRepository(ProjectName::class)
            ->findAll();

        if(!$listPname){
            return $this->redirectToRoute('createPname');
        }else{
            return $this->render('invoice/listPname.html.twig', [
                'controller_name' => 'UserController',
                'dataPname' => $listPname
            ]);

        }
    }

    /**
     * @Route("/invoice/delete/Pname/{idPname}", name="deletePname", requirements={"idPname"="\d+"})
     */
    public function deleteProjectName($idPname)
    {
        $listPname = $this->getDoctrine()
            ->getRepository(ProjectName::class)
            ->find($idPname);

        if(!$listPname){
            throw $this->createNotFoundException(
                'No Project Name has been registered by the administrator'
            );
        }else {
            $entityManager = $this->getDoctrine()->getManager();
            $removePname = $entityManager->getRepository(ProjectName::class)->find($idPname);
            if (!$removePname) {
                throw $this->createNotFoundException(
                    'No Project Name found for id '.$idPname
                );
            }
            $entityManager->remove($removePname);
            $entityManager->flush();

            return $this->redirectToRoute('listPname');
        }
    }

    /**
     * @Route("/invoice/create_vendor", name="createVendor")
     */
    public function createVendor( Request $request)
    {
        $vendor = new Vendor();
        $form = $this->createForm(VendorType::class,$vendor);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($vendor);
            $entityManager->flush();

            return $this->redirectToRoute('listVendor');
        }

        return $this->render('invoice/createVendor.html.twig', [
            'controller_name' => 'UserController',
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/invoice/list_vendor", name="listVendor")
     */
    public function listVendor()
    {
        $listVendor = $this->getDoctrine()
            ->getRepository(Vendor::class)
            ->findAll();

        if(!$listVendor){
            return $this->redirectToRoute('createVendor');
        }else{
            return $this->render('invoice/listVendor.html.twig', [
                'controller_name' => 'UserController',
                'dataVendor' => $listVendor
            ]);

        }
    }

    /**
     * @Route("/invoice/delete/vendor/{idVendor}", name="deleteVendor", requirements={"idVendor"="\d+"})
     */
    public function deleteVendor($idVendor)
    {
        $listVendor = $this->getDoctrine()
            ->getRepository(Vendor::class)
            ->find($idVendor);

        if(!$listVendor){
            throw $this->createNotFoundException(
                'No Vendor has been registered by the administrator'
            );
        }else {
            $entityManager = $this->getDoctrine()->getManager();
            $removeVendor = $entityManager->getRepository(Vendor::class)->find($idVendor);
            if (!$removeVendor) {
                throw $this->createNotFoundException(
                    'No Vendor found for id '.$idVendor
                );
            }
            $entityManager->remove($removeVendor);
            $entityManager->flush();

            return $this->redirectToRoute('listVendor');
        }
    }

    /**
     * @Route("/invoice/update/vendor/{idVendor}", name="updateVendor", requirements={"idVendor"="\d+"})
     */
    public function updateVendor($idVendor, Request $request)
    {
        $listVendors = $this->getDoctrine()
            ->getRepository(Vendor::class)
            ->find($idVendor);

        if(!$listVendors){
            throw $this->createNotFoundException(
                'No user has been registered by the administrator'
            );
        }else {

            $form = $this->createForm(VendorType::class, $listVendors, array(
                'set_button_label' => "Update Vendor"
            ));
            $form->handleRequest($request);

            if($form->isSubmitted() && $form->isValid())
            {
                $entityManager = $this->getDoctrine()->getManager();
                $updateVendor = $entityManager->getRepository(Vendor::class)->find($idVendor);
                if (!$updateVendor) {
                    throw $this->createNotFoundException(
                        'No Vendor found for id '.$idVendor
                    );
                }
                //$entityManager->persist($listUsers);
                $entityManager->flush();

                return $this->redirectToRoute('listVendor');
            }
            return $this->render('invoice/updateVendor.html.twig', [
                'controller_name' => 'UserController',
                'form' => $form->createView()
            ]);
        }
    }


    /**
     * @Route("/invoice/create", name="createInvoice")
     */
    public function createInvoice( Request $request)
    {
        Debug::enable();
        $invoice = new Invoice();

//        dummy data
//        $item1 = new InvoiceItem();
//        $item1->setBudgetCode('OHD010');
//        $item1->setCurrency('IDR');
//        $item1->setDescription('Test description');
//        $item1->setPrice('1000');
//        $item1->setProjectCode('IIW 2017');
//        $item1->setQuantity('1');
//        end dummy data
        $form = $this->createForm(InvoiceType::class,$invoice);
        //dump($invoice);

        $form->handleRequest($request);
        if($form->isSubmitted())
        {
            $time = date('Y-m-d H:i');
            $invoice->setCreateDate(\DateTime::createFromFormat('Y-m-d H:i',$time));
            $invoice->setStatus("Created"); //there are 4 status : Created, Reviewed, Confirmed, Rejected
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($invoice);
            $entityManager->flush();

            return $this->redirectToRoute('user');
        }

        return $this->render('invoice/createInvoice.html.twig', [
            'controller_name' => 'UserController',
            'form' => $form->createView()
        ]);
    }

}
