<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bill; //Use the custom Bill class for Bill calculation
use Validator; //Use the Validator object to create custom error messages

class FormController extends Controller {
    
     /**
    *function to present the welcome page when a3 application is accesses
    */
    public function index() {
         return view('welcome');
    }


    /**
    *function to process the form submitted via POST
    */
    public function process(Request $request) {

        //define rules
        $rules = [

            'split' => 'required|integer|min:2',
            'tab' => 'required|numeric|min:1' ,
            'service' => 'required'

        ];
        //define custom error messages
        $messages = [

            'split.required' => 'Split # of ways field cannot be blank',
            'split.integer' => 'Split # of ways field can only accept whole numbers greater than 1',
            'split.min' => 'Split # of ways field should have value greater than 1',
            'tab.required' => 'Total Tab field cannot be blank',
            'tab.numeric' => 'Total Tab field can only accept numbers',
            'tab.min' => 'Total Tab field can only accept numbers greater than or equal to 1',

        ];
        
        /*create a validator instance manually and pass rules and custom error messages but still take advantage of the automatic redirection offered by the ValidatesRequest by calling the validate method */
        
        Validator::make($request->all(), $rules, $messages)->validate();

       
        # If the code makes it here, you can assume the validation passed
        $split = $request->input('split');
        $tab = $request->input('tab');
        $service = $request->input('service');
        $round = $request->has('round');
       
        $bill = new Bill($split,$tab,$service);//Use the instance of Bill class for Bill calculation
        
        $tabPerPersonPreRoundUp = $bill->getTabPerPerson();
        $tabPerPerson = $round ? number_format( ceil( $tabPerPersonPreRoundUp), 2, '.', '') : $tabPerPersonPreRoundUp ;

       
        # Pass the form values and results back to the view for the user to see the outcome:
      
        return view('welcome')->with([
                                    'split' => $split,
                                    'tab' => $tab,
                                    'service' => $service,
                                    'round' => $request->input('round'),
                                    'tabPerPerson'=> $tabPerPerson
                                ]);;
    }

   
    
}