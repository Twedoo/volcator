@extends('elements.layouts.app')
@section('content')
    <section id="middle">
        <div class="cui__layout__content">
            <div class="cui__breadcrumbs">
                <div class="cui__breadcrumbs__path">
                    <a href="javascript: void(0);">Stone</a>
                    <span>
                        <span class="cui__breadcrumbs__arrow"></span>
                        <strong>{{ trans('Configurations::Configurations/Settings.title_settings') }}</strong>
                    </span>
                    <span>
                        <span class="cui__breadcrumbs__arrow"></span>
                        <strong
                            class="cui__breadcrumbs__current"> [TODO : name application]</strong>
                    </span>
                </div>
            </div>
            <div class="cui__utils__content">
                <div class="kit__utils__heading">
                    <h5>
                        <span class="mr-3">{{ trans('Configurations::Configurations/Settings.title_settings') }}</span>
                    </h5>
                </div>



                {{-- Content here --}}
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="h-50">
                                        <div class="row">
                                            <div class="col-md-10">
                                                <span class="mr-3">{{ trans('Configurations::Configurations/Settings.title_settings') }}</span>
                                            </div>
                                            <div class="col-md-2">
                                                <select id="stone-cl" class="form-control">
                                                    <option value="">{{ trans('Configurations::Configurations/Settings.selctoption_lan') }}</option>
                                                    @foreach($languages as $key => $language)
                                                        <option value="{{ $key }}" @if(App::getLocale() == $language->code_lang) selected @endif>
                                                            {{$language->languages}}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row p-3">
                                        <div>
                                            <ul class="nav nav-tabs pull-left hidden-stone" id="switch-language">
                                                @foreach($languages as $key => $language)
                                                    <li class="nav-item">
                                                        <a class="nav-link
                                                           @if(App::getLocale() == $language->code_lang) active @endif"
                                                           href="#{{ $language->languages}}"
                                                           data-toggle="tab">
                                                            {{ $language->languages }}
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>

                                        {!! Form::model($setbase, ['method' => 'post', 'files'=>true, 'route' => [app('urlBack').'.config.settings.index', $setbase]]) !!}
                                        <div class="tab-content">
                                                @foreach($languages as $lang)
                                                <div id="{{$lang->languages}}" class="tab-pane @if(App::getLocale() == $lang->code_lang) active @endif ">
                                                    <div class="row">
                                                        @if(App::getLocale() == $lang->code_lang)
                                                            <div class="col-lg-6 mb-5 @if ($errors->has('sitename'.'_'.$lang->code_lang)) has-error @endif">
                                                                <label>{{ trans('Configurations::Configurations/Settings.sitename') }}   </label>
                                                                {!! Form::text('sitename'.'_'.$lang->code_lang,   StoneTranslation::transDynTable('sitename','confsettings_langs',$lang->code_lang) , array('placeholder' =>  trans('Configurations::Configurations/Settings.sitename') ,'class' => 'form-control', 'value' =>old('sitename'.'_'.$lang->code_lang) )) !!}
                                                                <p class="help-block">{{$errors->first('sitename'.'_'.$lang->code_lang)}}  </p>
                                                            </div>
                                                            <div class="col-lg-6 mb-5 @if ($errors->has('keyword'.'_'.$lang->code_lang)) has-error @endif">
                                                                <label>{{ trans('Configurations::Configurations/Settings.keyword') }}  </label>
                                                                {!! Form::text('keyword'.'_'.$lang->code_lang, StoneTranslation::transDynTable('keyword','confsettings_langs',$lang->code_lang)  , array('placeholder' => trans('Configurations::Configurations/Settings.keyword') ,'class' => 'form-control', 'value' =>old('keyword'.'_'.$lang->code_lang) )) !!}
                                                                <p class="help-block">{{$errors->first('keyword'.'_'.$lang->code_lang)}}  </p>
                                                            </div>
                                                            <div class="col-md-12 @if ($errors->has('descriptionweb'.'_'.$lang->code_lang)) has-error @endif">
                                                                <label>{{ trans('Configurations::Configurations/Settings.descriptionweb') }} </label>
                                                                {!! Form::textarea('descriptionweb'.'_'.$lang->code_lang, StoneTranslation::transDynTable('descriptionweb','confsettings_langs',$lang->code_lang)   , array('placeholder' => trans('Configurations::Configurations/Settings.descriptionweb')  ,'rows' => '4', 'class' => 'form-control', 'value' =>old('description'.'_'.$lang->code_lang) )) !!}
                                                                <p class="help-block">{{$errors->first('descriptionweb'.'_'.$lang->code_lang)}}  </p>
                                                            </div>
                                                            <div class="col-md-6  @if ($errors->has('logo')) has-error @endif">
                                                                <label>
                                                                    {{ trans('Configurations::Configurations/Settings.logo') }}
                                                                </label>

                                                                <img src="{{ asset('public/images/upload/img/'.$setbase->logo )}}"
                                                                     width="5%"/>

                                                                <!-- custom file upload -->
                                                                <div class="fancy-file-upload fancy-file-primary @if ($errors->has('choose_file')) has-error @endif">
                                                                    <i class="fa fa-upload"></i>
                                                                    <input type="file" class="form-control" name="logo"
                                                                           onchange="jQuery(this).next('input').val(this.value);">
                                                                    <input type="text" class="form-control"
                                                                           placeholder="{{ trans('Configurations::Configurations/Settings.nofile_select') }} "
                                                                           readonly="">
                                                                    <span class="button">{{ trans('Configurations::Configurations/Settings.choose_file') }}  </span>
                                                                </div>
                                                                <p class="help-block">{{$errors->first('logo')}}  </p>
                                                            </div>

                                                            <div class="col-md-6  @if ($errors->has('languages')) has-error @endif">
                                                                <label>{{ trans('Configurations::Configurations/Settings.languages') }} </label>
                                                                <select name="languages"
                                                                        class="form-control pointer @if ($errors->has('choose_file')) has-error @endif">
                                                                    <option value="">{{ trans('Configurations::Configurations/Settings.selctoption_lan') }} </option>
                                                                    @foreach($languages as $lang2)
                                                                        <option value="{{ $lang2->code_lang }}"
                                                                                @if( $lang2->code_lang == $setbase->languages) selected @endif>{{$lang2->languages}}</option>
                                                                    @endforeach
                                                                </select>
                                                                <p class="help-block">{{$errors->first('languages')}}  </p>
                                                            </div>

                                                            <div class="col-md-6 @if ($errors->has('email')) has-error @endif">
                                                                <label>{{ trans('Configurations::Configurations/Settings.email') }} </label>
                                                                {!! Form::text('email', null, array('placeholder' => trans('Configurations::Configurations/Settings.email') ,'class' => 'form-control', 'value' =>old('email') )) !!}
                                                                <p class="help-block">{{$errors->first('email')}}  </p>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <label class="switch switch switch-round">
                                                                    <span >{{ trans('Configurations::Configurations/Settings.maintenanceweb') }}    </span>
                                                                    <input type="checkbox" name="maintenanceweb"
                                                                           class="check_maint"
                                                                           @if( old('maintenanceweb') == 'on' || $setbase->maintenanceweb == 'on' ) checked @endif>
                                                                    <span class="switch-label" data-on="YES"
                                                                          data-off="NO"></span>
                                                                </label>
                                                            </div>

                                                            <div class="col-md-12  @if ($errors->has('msgmaintenance'.'_'.$lang->code_lang)) has-error @endif">
                                                                <label>{{ trans('Configurations::Configurations/Settings.msgmaintenance') }}   </label>
                                                                {!! Form::textarea('msgmaintenance'.'_'.$lang->code_lang, StoneTranslation::transDynTable('msgmaintenance','confsettings_langs',$lang->code_lang)  , array('placeholder' =>  trans('Configurations::Configurations/Settings.msgmaintenance') ,'rows' => '4', 'class' => 'form-control', 'value' =>old('msgmaintenance'.'_'.$lang->code_lang) )) !!}
                                                                <p class="help-block">{{$errors->first('msgmaintenance'.'_'.$lang->code_lang)}}  </p>
                                                            </div>
                                                        @else
                                                            <div class="col-md-6 @if ($errors->has('sitename'.'_'.$lang->code_lang)) has-error @endif">
                                                                <label>{{ trans('Configurations::Configurations/Settings.sitename') }}    </label>
                                                                {!! Form::text('sitename'.'_'.$lang->code_lang, StoneTranslation::transDynTable('sitename','confsettings_langs',$lang->code_lang), array('placeholder' => trans('Configurations::Configurations/Settings.sitename') ,'class' => 'form-control', 'value' =>old('sitename'.'_'.$lang->code_lang) )) !!}
                                                                <p class="help-block">{{ $errors->first('sitename'.'_'.$lang->code_lang) }}</p>
                                                            </div>
                                                            <div class="col-md-6  @if ($errors->has('keyword'.'_'.$lang->code_lang)) has-error @endif">
                                                                <label>{{ trans('Configurations::Configurations/Settings.keyword') }}   </label>
                                                                {!! Form::text('keyword'.'_'.$lang->code_lang, StoneTranslation::transDynTable('keyword','confsettings_langs',$lang->code_lang), array('placeholder' => trans('Configurations::Configurations/Settings.keyword') ,'class' => 'form-control', 'value' =>old('keyword'.'_'.$lang->code_lang) )) !!}
                                                                <p class="help-block">{{$errors->first('keyword'.'_'.$lang->code_lang)}}  </p>
                                                            </div>

                                                            <div class="col-md-12  @if ($errors->has('descriptionweb'.'_'.$lang->code_lang)) has-error @endif">
                                                                <label>{{ trans('Configurations::Configurations/Settings.descriptionweb') }}  </label>
                                                                {!! Form::textarea('descriptionweb'.'_'.$lang->code_lang, StoneTranslation::transDynTable('descriptionweb','confsettings_langs',$lang->code_lang), array('placeholder' => trans('Configurations::Configurations/Settings.descriptionweb') ,'rows' => '4', 'class' => 'form-control', 'value' =>old('descriptionweb'.'_'.$lang->code_lang) )) !!}
                                                                <p class="help-block">{{$errors->first('descriptionweb'.'_'.$lang->code_lang)}}  </p>
                                                            </div>

                                                            <div class="col-md-12  @if ($errors->has('msgmaintenance'.'_'.$lang->code_lang)) has-error @endif">
                                                                <label>{{ trans('Configurations::Configurations/Settings.msgmaintenance') }}   </label>
                                                                {!! Form::textarea('msgmaintenance'.'_'.$lang->code_lang, StoneTranslation::transDynTable('msgmaintenance','confsettings_langs',$lang->code_lang), array('placeholder' => trans('Configurations::Configurations/Settings.msgmaintenance') ,'rows' => '4', 'class' => 'form-control', 'value' =>old('msgmaintenance'.'_'.$lang->code_lang) )) !!}
                                                                <p class="help-block">{{$errors->first('msgmaintenance'.'_'.$lang->code_lang)}}  </p>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                        <!-- /tabs content -->
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="pull-right" style="margin-top:15px;">
                                                    <button type="submit"
                                                            class="btn btn-primary">{{ trans('Configurations::Configurations/Settings.btn_create') }}   </button>
                                                </div>
                                            </div>
                                        </div>
                                        {!! Form::close() !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </section>

@endsection
