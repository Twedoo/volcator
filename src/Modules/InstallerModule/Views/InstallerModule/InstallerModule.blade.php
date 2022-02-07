@extends('elements.layouts.app')
@section('content')

    <section id="middle">

        <!-- page title -->
        <header id="page-header">
            <h1> {{ trans('InstallerModule::InstallerModule/InstallerModule.title_InstallerModule')  }}  </h1>

            <ol class="breadcrumb">
                <li><a href="{{url(app('urlBack').'/')}}"><i class="glyphicon glyphicon-home" aria-hidden="true"></i></a>
                </li>
                <li class="active">{{ trans('InstallerModule::InstallerModule/InstallerModule.title_InstallerModule')  }}  </li>
            </ol>

        </header>
        <!-- /page title -->


        <div class="placemsg"
             @if( (Session::has('message') || Session::has('messageErr')) && Session::has('warning'))
             style="height:140px;margin-top:15px;"
             @elseif(Session::has('message') || Session::has('messageErr'))
             style="height:50px;margin-top:15px;"
                @endif>
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

                    @if(Session::has('warning'))
                        <div class="alert alert-warning alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                        aria-hidden="true">&times;</span></button>
                            {{ Session::get('warning') }}
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

                    {!! Form::open(array('route' => app('urlBack').'.super.modules.upload','method'=>'POST', 'enctype' => 'multipart/form-data')) !!}
                    <div class="col-md-11 col-sm-11 @if ($errors->has('filezipupload')) has-error @endif">
                        <div class="fancy-file-upload fancy-file-success">
                            <i class="fa fa-upload"></i>
                            <input type="file" class="form-control" name="filezipupload"
                                   onchange="jQuery(this).next('input').val(this.value);">
                            <input type="text" class="form-control"
                                   placeholder="{{ trans('InstallerModule::InstallerModule/InstallerModule.nofile_select')  }} "
                                   readonly="">
                            <span class="button"> {{ trans('InstallerModule::InstallerModule/InstallerModule.choose_file')  }}  </span>
                        </div>
                        <p class="help-block">{{ $errors->first('filezipupload') }}</p>
                    </div>

                    <div class="col-md-1 col-sm-1">
                        <div class="pull-right">
                            <button type="submit"
                                    class="btn btn-primary">{{ trans('InstallerModule::InstallerModule/InstallerModule.btn_save')  }} </button>
                        </div>
                    </div>

                    {!! Form::close() !!}

                    <hr class="half-margins">
                    <hr class="half-margins">

                    @foreach( $GetArrayModules as $key => $module)
                        <div class="col-md-4 col-lg-3">
                            <section class="panel">
                                <div class="panel-body text-center noradius padding-10">
                                    <figure class="margin-bottom-10"><!-- image -->

                                        <img class="img-responsive" style="height:150px; width:210px"
                                             src="{{ asset('app/Modules/'.$module.'/screenshot.jpg') }}" alt="">
                                    </figure><!-- /image -->

                                    @if( StoneEngine::isInstallModule($module) )

                                        @if(StoneEngine::getStatusModule($module))
                                            <i class="glyphicon glyphicon-ok text-success size-25"
                                               aria-hidden="true"></i>
                                        @else
                                            <i class="glyphicon glyphicon-eye-close text-danger size-25"
                                               aria-hidden="true"></i>
                                        @endif

                                        <br/>
                                        {{ trans('InstallerModule::InstallerModule/InstallerModule.check_module_fullinstall')  }}
                                    @else
                                        <a href="{{ route(app('urlBack').'.pre.module.building',$module) }}">
                                            <i class="glyphicon glyphicon-download text-info size-25"
                                               aria-hidden="true"></i>
                                        </a>
                                        <br/>
                                    {{ trans('InstallerModule::InstallerModule/InstallerModule.check_module_notactive')  }}
                                @endif

                                <!-- updated -->
                                    <ul style="text-algin:center;" class="list-unstyled size-13">

                                        <li class="text-black size-18">
                                            <strong>

                                            @if( StoneEngine::isInstallModule($module) )
                                                    @foreach($modules as $onemodule)
                                                        @if( $onemodule->im_name_modules == $module)
                                                            {{ trans('sidebar/sidebar.'.$onemodule->im_name_modules_display.'')  }}
                                                            {!! StoneEngine::getModulesParams($module, $onemodule->im_id, $onemodule->im_status) !!}

                                                        @endif
                                                    @endforeach
                                                @else
                                                    {{ $module }}
                                                    {!! StoneEngine::displayRemove($module) !!}
                                                @endif
                                            </strong>
                                        </li>

                                    </ul>
                                </div>

                            </section>
                        </div>

                    @endforeach

                </div>
            </div>

        </div>

    </section>


@endsection
