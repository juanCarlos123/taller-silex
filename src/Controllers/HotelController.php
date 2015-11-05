<?php
/**
 * PHP 5.6
 * * This source file is subject to the license that is bundled with this package in the file LICENSE.
 */

namespace Controllers;

use Twig_Environment as Twig;
use Models\HotelModel;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\FormFactory;

Class HotelController
{
    /** @var Twig */
    protected $view;

    /** @var HotelModel */
    protected $hotelModel;

    /**
     * @var formFactory 
     * @access protected
     */
    protected $formFactory;

    /**
     * __contruct 
     * 
     * @param Twig $view 
     * @param HotelModel $hotelModel 
     * @access public
     * @return void
     */
    public function __construct(Twig $view,HotelModel $hotelModel,FormFactory $formFactory) {
        $this->view = $view;
        $this->hotelModel = $hotelModel; 
        $this->formFactory = $formFactory;
    }

    public function addHotel(Request $request) {
        $form = $this->formFactory->createBuilder('form')
            ->add('name','text',['attr' => ['class' => 'form-control']])
            ->add('address','text',['attr' => ['class' => 'form-control']])
            ->add('mobile','text',['attr' => ['class' => 'form-control']])
            ->add('phone','text',['attr' => ['class' => 'form-control']])
            ->getForm()
            ;

        $title = 'hoteles en el sistema';

        if($request->getMethod() == "POST"){
            $form->handleRequest($request);
            if($form->isValid()) {
                $data = $form->getData();
                $this->hotelModel->saveHotel($data);
                return $this->view->render('index.twig',[
                    'message' => 'hotel salvado correctamente',
                    'title' => $title,
                    'hotels' => $this->hotelModel->getHotels()
                ]);
            }

            return $this->view->render('index.twig',[
                'message' => 'Error al guardar el hotel',
                'title' => $title,
                'hotels' => $this->hotelModel->getHotels()
            ]);
        }

        return $this->view->render('edit.twig', ['form' => $form->createView(),'message' => '','title' => 'Editar Hotel']);
    }

    public function editHotel(Request $request) {
        $title = 'Hoteles en el sistema';
        if($request->getMethod() == "POST") {
            $form->handleRequest($request);
            if($form->isValid()) {
                $data = $form->getData();
                $this->hotelModel->updateHotel($data);
                return $this->view->render('index.twig',[
                    'message' => 'Hotel actualizado correctamente',
                    'title' => $title,
                    'hotels' => $this->hotelModel->getHotels()
                ]);
            }
            return $this->view->render('index.twig',[
                'message' => "error al actualizar el hotel",
                'title' => $title,
                'hotels' => $this->hotelModel->getHotels()
            ]);
            
        }
        $id = $request->get('id_hotel');
        $hotel = $this->HotelModel->getHotel($id);
        if(!empty($hotels)) {
            error_log(print_r($hotel,true));
            /*$form = $this->formFactory->createBuilder('form')
                ->add('name','text',['attr' => ['class' => 'form-control'], 'value' => ])
                ->add('address','text',['attr' => ['class' => 'form-control'],'value' => ])
                ->add('mobile','text',['attr' => ['class' => 'form-control'], 'value' => ])
                ->add('phone','text',['attr' => ['class' => 'form-control'], 'value' => ])
                ->getForm()
                ;*/
                return $this->view->render('index.twig',['form' => '']);
        }
        return $this->view->render('index.twig',[
            'message' => "Hotel Invalido",
            'title' => $title,
            'hotels' => $this->hotelModel->getHotels()
        ]);
    }
        
    public function indexHotels() {
        return $this->view->render('index.twig',[
            'message' => '',
            'title' => 'hoteles en el sistema',
            'hotels' => $this->hotelModel->getHotels()
        ]);
    }
}
