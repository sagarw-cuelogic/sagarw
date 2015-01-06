<?php 
namespace Acme\TestBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;

use Doctrine\ORM\Mapping as ORM;
/**
* @ORM\Entity
* @ORM\Table(name="JoinUs")
*/
class JoinUs
{
/**
 * @ORM\Column(type="integer")
 * @ORM\Id
 * @ORM\GeneratedValue(strategy="AUTO")
 */
protected $emp_id;
 /**
  * @ORM\Column(type="string", length=100)
  */
protected $firstName;
/**
  * @ORM\Column(type="string", length=100)
  */
protected $lastName;
/**
  * @ORM\Column(type="string", length=100)
  */
protected $address;
/**
  * @ORM\Column(type="string", length=100)
  */
protected $email;
/**
  * @ORM\Column(type="datetime", length=100)
  */
protected $birthDate;
/**
  * @ORM\Column(type="string", length=11)
  */
protected $phone;

public function setFirstName($firstName)
{
	$this->firstName=$firstName;
}
public function getFirstName()
{
	return $this->firstName;
}

public function setLastName($lastName)
{
	$this->lastName=$lastName;
}
public function getLastName()
{
	return $this->lastName;
}

public function setAddress($address)
{
	$this->address=$address;
}
public function getAddress()
{
	return $this->address;
}

public function setEmail($email)
{
	$this->email=$email;
}
public function getEmail()
{
	return $this->email;
}
public function setBirthDate($birthDate)
{
	$this->birthDate=$birthDate;
}
public function getBirthDate()
{
	return $this->birthDate;
}
public function setPhone($phone)
{
	$this->phone=$phone;
}
public function getPhone()
{
	return $this->phone;
}

    /**
     * Get emp_id
     *
     * @return integer 
     */
    public function getEmpId()
    {
        return $this->emp_id;
    }
}