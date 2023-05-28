{!! Form::open(array('route' => app('urlBack').'.super.modules.upload','method'=>'POST', 'enctype' => 'multipart/form-data')) !!}
<div class="col-md-11 col-sm-11 @if ($errors->has('filezipupload')) has-error @endif">
    <div class="fancy-file-upload fancy-file-success">
        <i class="fa fa-upload"></i>
        <input type="file" class="form-control" name="filezipupload"
               onchange="jQuery(this).next('input').val(this.value);">
        <input type="text" class="form-control"
               placeholder="{{ trans('Organizer::Organizer/Organizer.nofile_select')  }} "
               readonly="">
        <span class="button"> {{ trans('Organizer::Organizer/Organizer.choose_file')  }}  </span>
    </div>
    <p class="help-block">{{ $errors->first('filezipupload') }}</p>
</div>

<div class="col-md-1 col-sm-1">
    <div class="pull-right">
        <button type="submit"
                class="btn btn-primary">{{ trans('Organizer::Organizer/Organizer.btn_save')  }} </button>
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

                @if( VolcatorEngine::TestingModulesFolder($module) && VolcatorEngine::TestingModulesDB($module) )
                    <i class="glyphicon glyphicon-ok text-success size-25" aria-hidden="true"></i>
                    <br/>
                    {{ trans('Organizer::Organizer/Organizer.check_module_fullinstall')  }}
                @elseif(VolcatorEngine::TestingModulesFolder($module) && !VolcatorEngine::TestingModulesDB($module))
                    <a link="{{ route(app('urlBack').'.super.module.install',$module) }}"
                       class="Organizer">
                        <i class="glyphicon glyphicon-download text-info size-25"
                           aria-hidden="true"></i>
                    </a>
                    <br/>
                    {{ trans('Organizer::Organizer/Organizer.check_module_notactive')  }}
                @else
                    <a href="{{ route(app('urlBack').'.super.module.install',$module) }}">
                        <i class="glyphicon glyphicon-refresh text-warning size-25"
                           aria-hidden="true"></i>
                    </a>
                    <br/>
                {{ trans('Organizer::Organizer/Organizer.check_module_notinstall')  }}
            @endif

            <!-- updated -->
                <ul style="text-algin:center;" class="list-unstyled size-13">

                    <li class="text-black size-18">
                        <strong>
                            @if( VolcatorEngine::TestingModulesFolder($module) && VolcatorEngine::TestingModulesDB($module) )
                                @foreach($OrganizerDB as $onemodule)
                                    @if( $onemodule->im_name_modules == $module)
                                        {{ trans('sidebar/sidebar.'.$onemodule->im_name_modules_display.'')  }}
                                        {!! VolcatorEngine::getModulesParams($module,$onemodule->im_id, $onemodule->enable) !!}
                                    @endif
                                @endforeach
                            @else
                                {{ $module }}
                            @endif
                        </strong>
                    </li>

                </ul>
            </div>

        </section>
    </div>

@endforeach
