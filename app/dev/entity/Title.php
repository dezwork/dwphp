<?php
/***********************************
     ##               ##
     ##               ##
   #### ## # ## ####  ####  ####
  ## ## ####### ## ## ## ## ## ##
   ####  # # #  ####  ## ## ####
                ##          ##
                ##          ##
** Gerado em: 10-01-2018 14:48:15 **/
namespace App\Entity;
use DwPhp\Library\models\AbstractObject;
use Doctrine\ORM\Mapping as ORM;

/**
 * Title
 *
 * @Table(name="title")
 * @Entity
 */
class Title extends AbstractObject{
    /**
     * @var integer
     *
     * @Column(name="id", type="integer", nullable=false)
     * @Id
     * @GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @var string
     *
     * @Column(name="title", type="string", length=255, nullable=false)
     */
    protected $title;

    /**
     * @var integer
     *
     * @Column(name="active", type="integer", nullable=false)
     */
    protected $active;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId(){
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Title
     */
    public function setTitle($title){
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle(){
        return $this->title;
    }

    /**
     * Set active
     *
     * @param integer $active
     *
     * @return Title
     */
    public function setActive($active){
        $this->active = $active;

        return $this;
    }

    /**
     * Get active
     *
     * @return integer
     */
    public function getActive(){
        return $this->active;
    }

    public function getNameTable(){
        return 'title';
    } 
}

