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
 * Pharagraf
 *
 * @Table(name="pharagraf", indexes={@Index(name="id_title", columns={"id_title"})})
 * @Entity
 */
class Pharagraf extends AbstractObject{
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
     * @Column(name="description", type="text", length=65535, nullable=false)
     */
    protected $description;

    /**
     * @var string
     *
     * @Column(name="code", type="text", length=65535, nullable=true)
     */
    protected $code;

    /**
     * @var integer
     *
     * @Column(name="active", type="integer", nullable=false)
     */
    protected $active;

    /**
     * @var \Title
     *
     * @ManyToOne(targetEntity="Title")
     * @JoinColumns({
     *   @JoinColumn(name="id_title", referencedColumnName="id")
     * })
     */
    protected $idTitle;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId(){
        return $this->id;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Pharagraf
     */
    public function setDescription($description){
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription(){
        return $this->description;
    }

    /**
     * Set code
     *
     * @param string $code
     *
     * @return Pharagraf
     */
    public function setCode($code){
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string
     */
    public function getCode(){
        return $this->code;
    }

    /**
     * Set active
     *
     * @param integer $active
     *
     * @return Pharagraf
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

    /**
     * Set idTitle
     *
     * @param $idTitle
     *
     * @return Pharagraf
     */
    public function setIdTitle($idTitle = null){
        $this->idTitle = $idTitle;

        return $this;
    }

    /**
     * Get idTitle
     *
     * @return \Title
     */
    public function getIdTitle(){
        return $this->idTitle;
    }

    public function getNameTable(){
        return 'pharagraf';
    } 
}

