<?php

require_once BASEPATH.'core/model.php';

use Doctrine\Common\ClassLoader;
use Doctrine\ORM\Configuration;
use Doctrine\ORM\EntityManager;
use Doctrine\Common\Cache\ArrayCache;
use Doctrine\DBAL\Logging\EchoSQLLogger;

class Doctrine_entity extends CI_Model {

    public $repository;
        
    function __construct() {
            
      if (get_called_class() != __CLASS__)
      {
        $this->repository = $this->doctrine->em->getRepository(get_called_class());
      }
      
      parent::__construct();
      
    }
    
}
