CodeIgniter Doctrine Library
============================

This is a [CodeIgniter](https://github.com/EllisLab/CodeIgniter) wrapper Library for the [Doctrine ORM](https://github.com/doctrine/doctrine2).

Installation
------------

If you use [Composer](http://getcomposer.org), add the following code to your composer.json file and run `composer install`.
```json
    {
      "require": {
        "camna/codeigniter-doctrine": "1.*@dev"
      }
    }
```
Usage
------------

Create a new folder called `entities` in `application/models`. This is where you will store all of your Doctrine entities. These entities are nearly identical to existing CodeIgniter Models, except for a few execptions.

Here is an example Entity:

`application/models/entities/rsvp.php`
```php
    <?php
    
    use Doctrine\ORM\Mapping as ORM;
    use Doctrine\Common\Collections\ArrayCollection;
    
    /**
     * RSVP
     *
     * @Table(name="rsvp")
     * @Entity
     */
    class RSVP extends Doctrine_entity {
        
        /**
         * @var integer
         *
         * @Column(name="rsvp_id", type="integer")
         * @Id
         * @GeneratedValue(strategy="AUTO")
         */
        private $id;
        
        /**
         * @var boolean
         *
         * @Column(name="attending", type="boolean")
         */
        private $attending;
        
        /**
         * @var string
         *
         * @Column(name="name", type="string", length=255)
         */
        private $name;
        
        
        function __construct()
        {
            
            parent::__construct();
                    
        }

        /**
         * Get id
         *
         * @return integer 
         */
        public function getID()
        {
            return $this->id;
        }
    
        /**
         * Set attending
         *
         * @param boolean $attending
         * @return RSVP
         */
        public function setAttending($attending)
        {
            $this->attending = $attending;
        
            return $this;
        }
    
        /**
         * Get attending
         *
         * @return boolean 
         */
        public function getAttending()
        {
            return $this->attending;
        }
        
        /**
         * Set name
         *
         * @param string $name
         * @return RSVP
         */
        public function setName($name)
        {
            $this->name = $name;
        
            return $this;
        }
    
        /**
         * Get name
         *
         * @return string 
         */
        public function getName()
        {
            return $this->name;
        }
        
    }
```
Firstly, the `use` statements need to be present in each entity. Secondly the class needs to extend `Doctrine_entity`. This will allow it to inherit all of the standard Doctrine functions.

You'll need to run the following command to generate the schema in the Database:

    php application/libraries/doctrine/console orm:schema-tool:create
    
Using `php application/libraries/doctrine/console` will load the CodeIgniter database configuaration before running any Doctrine CLI commands.

From your controller or model you can save data like so:
```php    
    // Load the required libraries.
    $this->load->library('doctrine');
    $this->load->library('doctrine/doctrine_entity');
    $this->load->model('entities/rsvp');
    
    // Create a generic RSVP object.
    $rsvp = new RSVP();
    $rsvp->setName('David Barratt');
    $rsvp->setAttending(FALSE);
    
    // Persist the object,
    $this->doctrine->em->persist($rsvp);
    
    // Flush Doctrine, this is where the SQL Insert is performed.
    $this->doctrine->em->flush();
```
You can query data like so:
```php
    // Load the required libraries.
    $this->load->library('doctrine');
    $this->load->library('doctrine/doctrine_entity');
    $this->load->model('entities/rsvp');
    
    // Load the RSVP Object with an ID of 3
    $rsvp = $this->rsvp->repository->find(3);
    
    // Get the Name
    $name = $rsvp->getName();
```
If you'd like to update the object (above), you can do this:
```php
    // Set the Name
    $name->setName('Jon Stewart');
    
    // Flush Doctrine, this is where the SQL Update is performed.
    $this->doctrine->em->flush();
```	  
For more information, please refer to the [Doctrine ORM Documentation](http://docs.doctrine-project.org/en/latest/)
