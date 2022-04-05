<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PaymentMethodRepository")
 */
class PaymentMethod extends Method
{
  public function __construct(string $label, string $code, string $description, bool $active)
  {
      parent::__construct($label, $code, $description, $active);
  }
}
