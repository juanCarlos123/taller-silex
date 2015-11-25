<?php
/**
 * PHP 5.6
 * * This source file is subject to the license that is bundled with this package in the file LICENSE.
 */

namespace Controllers;

use Twig_Environment as Twig;
use Models\RoomModel;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\FormFactory;

Class RoomTypeController
{
    /** @var Twig */
    protected $view;

    /** @var RoomModel */
    protected $roomModel;

    /**
     * @var formFactory 
     * @access protected
     */
    protected $formFactory;

    /**
     * __construct 
     * 
     * @param Twig $view 
     * @param RoomModel $roomModel 
     * @param FormFactory $formFactory 
     * @access public
     * @return void
     */
    public function __construct(Twig $view,RoomModel $roomModel,FormFactory $formFactory) {
        $this->view = $view;
        $this->roomModel = $roomModel; 
        $this->formFactory = $formFactory;
    }

    public function addRoom(Request $request) {

        $form = $this->generateForm();

        if($request->getMethod() == "POST"){
        
            $form->handleRequest($request);

            if($form->isValid()) {

                $data = $form->getData();
                
                $this->roomModel->saveRoom($data);

                return $this->view->render('index.html.twig',[
                    'message' => 'Registro de habitación salvada correctamente',
                    'title' => 'Registro de habitaciónes',
                    'rooms' => $this->roomModel->getRooms();
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
            'title' => 'Registrar habitación']
        );
    }

    public function editRoomType(Request $request) {

        if($request->getMethod() == "POST") {

            $form = $this->generateForm();
            $form->handleRequest($request);

            if($form->isValid()) {
                $data = $form->getData();
                $this->roomTypeModel->updateRoomType($data, $request->get('id'));
                return $this->view->render('index.html.twig',[
                    'message' => 'Tipo de habitación  actualizado correctamente',
                    'title' => 'Tipos de habitación',
                    'roomtypes' => $this->roomTypeModel->getRoomTypes()
                ]);
            }

            return $this->view->render('error.html.twig',[
                'title' => 'Error',
                'error' => "Formulario invalido",
            ]);
            
        }

        $id = $request->get('id');
        $roomType = $this->roomTypeModel->getRoomtype($id);

        if(!empty($roomType)) {
            return $this->view->render('add.html.twig',[
                'title' => 'Editar tipo de habitación',
                'form' => $this->generateForm($roomType)->createView(),
                'roomtype_id' => $id
            ]);
        }

        return $this->view->render('error.html.twig',[
            'title' => 'Error',
            'error' => "Tipo de habitación Invalido"
        ]);
    }

    public function indexRoomTypes() {
        return $this->view->render('index.html.twig',[
            'message' => '',
            'title' => 'Tipos de habitación',
            'roomtypes' => $this->roomTypeModel->getRoomTypes()
        ]);
    }

    protected function generateForm($data = null) {
        if(is_null($data)) {
             return $this->formFactory->createBuilder('form')
                ->add('name', 'text',['attr' => ['class' => 'form-control'],'label' => 'Nombre'])
                ->add('description','text',['attr' => ['class' => 'form-control'],'label' => 'Descripción'])
                ->add('cost','text',['attr' => ['class' => 'form-control'],'label' => 'Costo'])
                ->getForm()
                ;
        } else {
            return $this->formFactory->createBuilder('form')
                ->add('name', 'text',[
                    'attr' => [
                        'class' => 'form-control'
                    ],
                    'data' => $data[0]['name'],
                    'label' => 'Nombre'
                ])
                ->add('description','text',[
                    'attr' => [
                        'class' => 'form-control'
                    ],
                    'data' => $data[0]['description'],
                    'label' => 'Descripción'
                ])
                ->add('cost','text',[
                    'attr' => [
                        'class' => 'form-control'
                    ],
                    'data' => $data[0]['cost'],
                    'label' => 'Costo'
                ])
                ->getForm()
                ;
        }
    }

    public function viewRoomType($id) {
        if (!is_null($id)) {
            $roomType = $this->roomTypeModel->getRoomType($id);
            if (!is_null($roomType)) {
                return $this->view->render('view.html.twig',[
                    'title' => $roomType[0]['name'],
                    'roomtypes' => $roomType
                ]);
            }
        }
        return $this->view->render('error.html.twig', [
            'title' => 'Error',
            'error' => "el tipo de habitación no existe",
        ]);
    }

}
