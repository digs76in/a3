<?php

namespace App;

class Bill{
    /**
	* Properties
	*/
   
    private $split;
    private $tab;
    private $service;
    private $tip;
    private $tabWithTip;
    private $tabPerPerson;
    
    /**
	*Constructor
	*/
    public function __construct($split,$tab,$service) {
        $this->split = $split;
        $this->tab = $tab;
        $this->service = $service;
                
    }
    /**
	* CALCULATE TAB PER PERSON
	*/
    public function getTabPerPerson() {
        
        $this->tip = floatVal($this->tab) * floatVal( $this->service) ;
        $this->tabWithTip = floatVal($this->tab) + floatVal( $this->tip) ;
        $this->tabPerPerson = floatVal( $this->tabWithTip) / floatVal( $this->split) ;
        $this->tabPerPerson = number_format( $this->tabPerPerson, 2, '.', '');
        return $this->tabPerPerson;
    }
    
	
} # end of class