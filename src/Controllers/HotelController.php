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

        $form = $this->generateForm();

        if($request->getMethod() == "POST"){
        
            $form->handleRequest($request);

            if($form->isValid()) {

                $data = $form->getData();
                $this->hotelModel->saveHotel($data);

                return $this->view->render('index.html.twig',[
                    'message' => 'hotel salvado correctamente',
                    'title' => 'Hoteles',
                    'hotels' => $this->hotelModel->getHotels()
                ]);
            }

            return $this->view->render('error.html.twig',[
                'title' => 'Error',
                'error' => 'Formulario no valido']
            );
        }

        return $this->view->render('add.html.twig', [
            'form' => $form->createView(),
            'message' => '',
            'title' => 'Agregar Hotel']
        );
    }

    public function editHotel(Request $request) {

        if($request->getMethod() == "POST") {

            $form = $this->generateForm();
            $form->handleRequest($request);

            if($form->isValid()) {
                $data = $form->getData();
                $this->hotelModel->updateHotel($data, $request->get('id'));
                return $this->view->render('index.html.twig',[
                    'message' => 'Hotel actualizado correctamente',
                    'title' => 'Hoteles',
                    'hotels' => $this->hotelModel->getHotels()
                ]);
            }

            return $this->view->render('error.html.twig',[
                'title' => 'Error',
                'error' => "Formulario invalido",
            ]);
            
        }

        $id = $request->get('id');
        $hotel = $this->hotelModel->getHotel($id);

        if(!empty($hotel)) {
            return $this->view->render('add.html.twig',[
                'title' => 'Editar Hotel',
                'form' => $this->generateForm($hotel)->createView(),
                'hotel_id' => $id
            ]);
        }

        return $this->view->render('error.html.twig',[
            'title' => 'Error',
            'error' => "Hotel Invalido"
        ]);
    }

    public function indexHotels() {
        return $this->view->render('index.html.twig',[
            'message' => '',
            'title' => 'Hoteles',
            'hotels' => $this->hotelModel->getHotels()
        ]);
    }

    protected function generateForm($data = null) {
        if(is_null($data)) {
             return $this->formFactory->createBuilder('form')
                 ->add('name','text',[
                     'attr' => [
                         'class' => 'form-control'
                     ],
                     'label' => 'Nombre'
                 ])
                 ->add('address','text',[
                     'attr' => [
                         'class' => 'form-control'
                     ],
                     'label' => 'Dirección'
                 ])
                 ->add('num_rooms','text',[
                     'attr' => [
                         'class' => 'form-control'
                     ],
                     'label' => 'Número de habitaciones'
                 ])
                 ->add('mobile','text',[
                     'attr' => [
                         'class' => 'form-control'
                     ],
                     'label' => 'Celular'
                 ])
                 ->add('phone','text',[
                     'attr' => [
                         'class' => 'form-control'
                     ],
                     'label' => 'Telefono'
                 ])
                ->getForm()
                ;
        } else {
            return $this->formFactory->createBuilder('form')
                ->add('name','text',[
                    'attr' => [
                        'class' => 'form-control'
                    ], 
                    'data' => $data[0]['name'],
                    'label' => 'Nombre'
                ])
                ->add('address','text',[
                    'attr' => [
                        'class' => 'form-control'
                    ],
                    'data' => $data[0]['address'],
                    'label' => 'Dirección'
                ])
                ->add('num_rooms','text',[
                    'attr' => [
                        'class' => 'form-control'
                    ],
                    'data' => $data[0]['num_rooms'],
                    'label' => 'Número de habitaciones',
                ])
                ->add('mobile','text',[
                    'attr' => [
                        'class' => 'form-control'
                    ],
                    'data' => $data[0]['mobile'],
                    'label' => 'Celular'
                ])
                ->add('phone','text',[
                    'attr' => [
                        'class' => 'form-control'
                    ],
                    'data' => $data[0]['phone'],
                    'label' => 'Telefono'
                ])
                ->getForm()
                ;
        }
    }

    public function viewHotel($id) {
        if (!is_null($id)) {
            $hotel = $this->hotelModel->getHotel($id);
            if (!is_null($hotel)) {
                return $this->view->render('view.html.twig',[
                    'title' => $hotel[0]['name'],
                    'hotels' => $hotel
                ]);
            }
        }
        return $this->view->render('error.html.twig', [
            'title' => 'Error',
            'error' => "hotel no encontrado verifica el id",
        ]);
    }

}
