<?php 
namespace Acme\TestBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
/**
* @ORM\Entity
* @ORM\Table(name="Photos")
*/
class Photos
{
/**
 * @ORM\Column(type="integer")
 * @ORM\Id
 * @ORM\GeneratedValue(strategy="AUTO")
 */
protected $photo_id;
 /**
  * @ORM\Column(type="string",length=100)
  */
protected $photo_name;

    /**
     * Get photo_id
     *
     * @return integer 
     */
    public function getPhotoId()
    {
        return $this->photo_id;
    }

    /**
     * Set photo_name
     *
     * @param string $photoName
     * @return Photos
     */
    public function setPhotoName(UploadedFile $photo_name = null)
    {
        $this->photo_name = $photo_name->getClientOriginalName();
    
        return $this;
    }

    /**
     * Get photo_name
     *
     * @return string 
     */
    public function getPhotoName()
    {
        return $this->photo_name;
    }

    public function getUploadRootDir()
    {
        // the absolute directory path where uploaded
        // documents should be saved
        return __DIR__.'/../../../../web/'.$this->getUploadDir();
    }
    public function getUploadDir()
    {
        // get rid of the __DIR__ so it doesn't screw up
        // when displaying uploaded doc/image in the view.
        return 'uploads/';
    }
}