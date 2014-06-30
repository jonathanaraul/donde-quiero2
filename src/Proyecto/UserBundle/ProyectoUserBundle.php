<?php

namespace Proyecto\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class ProyectoUserBundle extends Bundle
{
 public function getParent()
    {
        return 'FOSUserBundle';
    }
}
