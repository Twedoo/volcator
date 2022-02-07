@extends('elements.layouts.app')
@section('content')
    <section id="middle">
        <header id="page-header">
            <h1> {{ trans('InstallerModule::InstallerModule/InstallerModule.title_InstallerModule')  }}  </h1>
            <ol class="breadcrumb">
                <li><a href="{{url(app('urlBack').'/')}}"><i class="glyphicon glyphicon-home" aria-hidden="true"></i></a>
                </li>
                <li class="active">{{ trans('InstallerModule::InstallerModule/InstallerModule.title_InstallerModule')  }}  </li>
            </ol>
        </header>
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
                    <strong>{{ trans('InstallerModule::InstallerModule/InstallerModule.module_managment')  }} </strong>
                </div>
                <div class="panel-body">

                </div>
            </div>
        </div>
    </section>
@endsection
