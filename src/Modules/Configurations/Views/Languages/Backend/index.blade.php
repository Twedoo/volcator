@extends('elements.layouts.app')
@section('content')

    <section id="middle">

        <!-- page title -->
        <header id="page-header">
            <h1> {!! PackagesHoolm::HoolmTRans('title','transconfigurations') !!}   </h1>

            <ol class="breadcrumb">
                <li><a href="{{url(app('urlBack').'/')}}"><i class="glyphicon glyphicon-home" aria-hidden="true"></i></a>
                </li>
                <li>
                    <a href="{{ route(app('urlBack').'.languages.cms.index') }}"> {!! PackagesHoolm::HoolmTRans('title','transconfigurations') !!}</a>
                </li>
                <li>
                    <a href="{{ route(app('urlBack').'.languages.cms.backlang') }}"> {!! PackagesHoolm::HoolmTRans('backendtranslate','transconfigurations') !!}</a>
                </li>
                <li class="active"> {!! PackagesHoolm::HoolmTRans($table,'transglobals') !!} </li>

            </ol>

        </header>
        <!-- /page title -->


        <div class="placemsg"
             @if(Session::has('message') || Session::has('messageErr'))style="height:50px;margin-top:15px;" @endif>
            <div class="col-lg-12">
                <div class="showmsg">
                    @if(Session::has('message'))
                        <div class="alert alert-success alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                        aria-hidden="true">&times;</span></button>
                            {{ Session::get('message') }}
                        </div>
                    @endif


                    @if(Session::has('messageErr'))
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                        aria-hidden="true">&times;</span></button>
                            {{ Session::get('messageErr') }}
                        </div>
                    @endif


                </div>
            </div>
        </div>

        <div id="content" class="padding-20">
            {!! Toastr::message() !!}


            <div class="panel panel-default">
                <div class="panel-heading panel-heading-transparent">
                    <strong> {!! PackagesHoolm::HoolmTRans($table,'transglobals') !!}  </strong>
                </div>

                <div class="panel-body">


                    {!! Form::model($table, ['method' => 'PATCH','route' => [app('urlBack').'.languages.cms.intranlate', $table, $lang]]) !!}

                    <div class="row">

                        <input type="hidden" name="nametable" value="{{ $table }}" class="form-control"/>

                        <input type="hidden" name="lang" value="{{ $lang }}" class="form-control"/>


                        @foreach( $Rowtrans as $key => $word)

                            <div class="col-lg-6">
                                {{ $word->word_english}}
                            </div>

                            <div class="form-group">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <input type="text" name="{{ $word->title_trans }}" value="{{ $word->$lang }}"
                                               class="form-control"/>
                                    </div>


                                </div>
                            </div>



                        @endforeach
                    </div>
                    <div class="pull-right">
                        <button type="submit"
                                class="btn btn-primary">{!! PackagesHoolm::HoolmTRans('btn_create','transglobals') !!}</button>
                    </div>

                    {!! Form::close() !!}


                </div>

            </div>
    </section>


@endsection
