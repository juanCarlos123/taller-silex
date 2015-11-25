<?php
/**
 * PHP 5.6
 * This source file is subject to the license that is bundled with this package in the file LICENSE.
 * */
namespace Models;

use Doctrine\DBAL\Driver\Connection;

Class RoomTypeModel
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
     * updateRoomType 
     * 
     * @param mixed $data 
     * @param mixed $id 
     * @access public
     * @return void
     */
    public function updateRoomType($data, $id = null) {
        if(!is_null($id)){
            $result = $this->db->update(
                'roomtypes',
                $data,
                ['roomtype_id' => $id]
            );
            if($result < 1) {
                return false;
            }
            return true;
        }
        return false;
    }

    /**
     * saveRoomType 
     * 
     * @param array $data 
     * @access public
     * @return void
     */
    public function saveRoomType(array $data){
        $this->db->insert('roomtypes',$data);
    }

    /**
     * getRoomTypes 
     * 
     * @access public
     * @return void
     */
    public function getRoomTypes() {
        $queryRoomTypes = $this->db->createQueryBuilder();
        $queryRoomTypes->select('*')
            ->from('roomtypes','rt')
            ->orderBy('rt.name','ASC')
            ;
        return $this->db->fetchAll($queryRoomTypes->getSql(),$queryRoomTypes->getParameters());
    }

    /**
     * getRoomType 
     * 
     * @param mixed $id 
     * @access public
     * @return void
     */
    public function getRoomType($id = null) {
        if(!is_null($id)) {
            $queryRoomTypes = $this->db->createQueryBuilder();
            $queryRoomTypes->select('*')
                ->from('roomtypes','rt')
                ->where('roomtype_id = :id')
                ->orderBy('rt.name','ASC')
                ->setParameter('id',$id)
                ;

            return $this->db->fetchAll($queryRoomTypes->getSql(),$queryRoomTypes->getParameters());
        }
        return [];
    }
}
