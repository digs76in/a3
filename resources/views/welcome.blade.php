@extends('layouts.master')


@section('title')
    Bill Splitter Application
@endsection


@push('head')
    <link href="/css/main.css" type='text/css' rel='stylesheet'>
@endpush

@section('content')

    <div class='page-header'>
        <h1>Bill Splitter</h1>   
    </div>

    <form id="myForm" method='GET' action='/formSubmit' class="form-horizontal">
        
        <div class="form-group">    
            <label for='split' class='control-label col-sm-2'>Split # of ways? <span class="asterisk">*</span></label>
            <div class='col-sm-10'>
                <input type='text' name='split' required id='split' value='{{ $split or old('split') }}'>
            </div>
        </div>
        <div class="form-group">
            <label for='tab' class='control-label col-sm-2'>Total Tab? <span class="asterisk">*</span> </label>
            <div class='col-sm-10'>
                <input type='text' name='tab' required id='tab' value='{{ $tab or old('tab') }}'>
            </div>
        </div>
        <div class="form-group">
            <label for='service' class='control-label col-sm-2'>How is the service? </span>  </label>
            <div class='col-sm-10'>
                <select name="service" id="service">

                    <option value='0.2' {{((isset($service)) && ($service=="0.2"))?"selected":""}} @if (old('service') == "0.2") selected="selected" @endif>Good -> 20% Tip
                    </option>
                    <option value='0.15'  {{((isset($service)) && ($service=="0.15"))?"selected":""}} @if (old('service') == "0.15") selected="selected" @endif>Satisfactory -> 15% Tip
                    </option>
                    <option value='0.10'  {{((isset($service)) && ($service=="0.10"))?"selected":""}} @if (old('service') == "0.10") selected="selected" @endif>Poor -> 10% Tip
                    </option>
                </select> 
            </div>
        </div>

        <div class='form-group'>
            <div class='col-sm-offset-2 col-sm-10'>
                <div class='checkbox'>
                    <label><input type='checkbox' name='round' {{(isset($round))|| old('round')=='on' ? "checked":"" }}> Round up</label>
                </div>
            </div>
        </div>
        <div class="form-group"> 
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-primary btn-small">Calculate</button>
            </div>
        </div>      

    </form>

    <div class='row'>               


            @if(count($errors) > 0)
                <div class='alert alert-danger'>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @else
                @if(isset($tabPerPerson))

                    <div class="alert alert-success">

                        Everybody owes: {{ $tabPerPerson or '' }}

                    </div>
                @endif

            @endif  

    </div>

@endsection
   
   
