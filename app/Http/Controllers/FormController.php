<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bill;

class FormController extends Controller {
    
     /**
    *function to present the welcome pge when a3 application is accesses
    */
    public function index() {
         return view('welcome');
    }


    /**
    *function to process the form submitted via POST
    */
    public function process(Request $request) {

        # Validate the request data
        $this->validate($request, [
            'split' => 'required|integer|min:1',
            'tab' => 'numeric|min:1' ,
            'service' => 'required'
        ]);
        
       
        # If the code makes it here, you can assume the validation passed
        $split = $request->input('split');
        $tab = $request->input('tab');
        $service = $request->input('service');
        $round = $request->has('round');
       
        $bill = new Bill($split,$tab,$service);
        
        $tabPerPersonPreRoundUp = $bill->getTabPerPerson();
        $tabPerPerson = $round ? number_format( ceil( $tabPerPersonPreRoundUp), 2, '.', '') : $tabPerPersonPreRoundUp ;

       
        # Then you'd give the user some sort of confirmation:
      
        return view('welcome')->with([
                                    'split' => $split,
                                    'tab' => $tab,
                                    'service' => $service,
                                    'round' => $request->input('round'),
                                    'tabPerPerson'=> $tabPerPerson
                                ]);;
    }

   
    
}