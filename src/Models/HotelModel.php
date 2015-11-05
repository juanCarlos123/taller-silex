<?php
/**
 * PHP 5.6
 * This source file is subject to the license that is bundled with this package in the file LICENSE.
 * */
namespace Models;

use Doctrine\DBAL\Driver\Connection;

Class HotelModel
{
    /**
     * db 
     * @var mixed
     * @access protected
     */
    protected $db;

    /**
     * __construct 
     * 
     * @param Connection $db 
     * @access public
     * @return void
     */
    public function __construct(Connection $db){
        $this->db = $db;
    }

    /**
     * updateHotel 
     * 
     * @param mixed $data 
     * @param mixed $id 
     * @access public
     * @return void
     */
    public function updateHotel($data, $id = null) {
        if(!is_null($id)){
            $result = $this->db->update($data,['id' => $id]);
            if($result < 1) {
                return false;
            }
            return true;
        }
        return false;
    }

    public function saveHotel(array $data){
        $this->db->insert('hotels',$data);
    }

    /**
     * getHotels 
     * 
     * @access public
     * @return void
     */
    public function getHotels() {
        $queryAllHotels = $this->db->createQueryBuilder();
        $queryAllHotels->select('*')
            ->from('hotels','h')
            ->orderBy('h.name','ASC')
            ;
        return $this->db->fetchAll($queryAllHotels->getSql(),$queryAllHotels->getParameters());
    }

    /**
     * getHotel 
     * 
     * @param mixed $id 
     * @access public
     * @return void
     */
    public function getHotel($id = null) {
        if(!is_null($id)) {
            $queryHotel = $this->db->createQueryBuilder();
            $queryHotel->select('*')
                ->from('hotels','h')
                ->where('id = :id')
                ->orderBy('h.name','ASC')
                ->setParameter('id',$id)
                ;

            return $this->db->fetchAll($queryHotel->getSql(),$queryHotel->getParameters());
        }
        return [];
    }
}
