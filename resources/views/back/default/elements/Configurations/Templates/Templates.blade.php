@extends('elements.layouts.app')
@section('content')
    <section id="middle">
        <!-- page title -->
        <header id="page-header">
            <h1>   {!! PackagesHoolm::HoolmTRans('title','transconfigurations') !!}</h1>
            <ol class="breadcrumb">
                <li><a href="{{url(app('urlBack').'/')}}"><i class="glyphicon glyphicon-home" aria-hidden="true"></i></a>
                </li>
                <li class="active"> {!! PackagesHoolm::HoolmTRans('title','transconfigurations') !!} </li>
            </ol>
        </header>
        <!-- /page title -->
        <div id="content" class="padding-20">
            {!! Toastr::message() !!}

            <div class="panel panel-default">
                <div class="panel-heading panel-heading-transparent">
                    <strong> {!! PackagesHoolm::HoolmTRans('managment_languages','transconfigurations') !!} </strong>
                </div>

                <div class="panel-body">


                    <div class="col-md-6">
                        <a href="{{ route(app('urlBack').'.languages.cms.backlang') }}">
                    <span class="btn btn-3d btn-teal btn-xlg btn-block margin-top-30">
                      {!! PackagesHoolm::HoolmTRans('backend_lang','transconfigurations') !!}
                        <span class="block font-lato"> {!! PackagesHoolm::HoolmTRans('buttonback_lan','transconfigurations') !!}</span>
                    </span>
                        </a>
                    </div>

                    <div class="col-md-6">
                        <a href="{{ route(app('urlBack').'.languages.cms.frontlang') }}">
                   <span class="btn btn-3d btn-teal btn-xlg btn-block margin-top-30">
                     {!! PackagesHoolm::HoolmTRans('frontoffice_lang','transconfigurations') !!}
                       <span class="block font-lato"> {!! PackagesHoolm::HoolmTRans('buttonfront_lan','transconfigurations') !!} </span>
                   </span>
                        </a>
                    </div>

                </div>

            </div>
    </section>


@endsection
