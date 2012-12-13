<?php

namespace Application\Form;

use Zend\Form\Form as ZendForm;
use Zend\Form\Element\Text as TextElement;

class Match extends ZendForm
{

    public function __construct()
    {
        parent::__construct('Match');

        $p1g1 = new TextElement('p1g1');
        $p1g1->setAttribute('maxlength', 2);
        $this->add($p1g1);

        $p2g1 = new TextElement('p2g1');
        $p2g1->setAttribute('maxlength', 2);
        $this->add($p2g1);

        $p1g2 = new TextElement('p1g2');
        $p1g2->setAttribute('maxlength', 2);
        $this->add($p1g2);

        $p2g2 = new TextElement('p2g2');
        $p2g2->setAttribute('maxlength', 2);
        $this->add($p2g2);
    }


}