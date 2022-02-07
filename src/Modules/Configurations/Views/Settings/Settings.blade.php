@extends('elements.layouts.app')
@section('content')

    <script>

    </script>

    <section id="middle">

        <!-- page title -->
        <header id="page-header">
            <h1>   {{ trans('Configurations::Configurations/Settings.title_settings') }} </h1>

            <ol class="breadcrumb">
                <li><a href="{{url(app('urlBack').'/')}}"><i class="glyphicon glyphicon-home" aria-hidden="true"></i></a>
                </li>
                <li class="active"> {{ trans('Configurations::Configurations/Settings.title_settings') }} </li>
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

            <div class="panel panel-default ">
                <div class="panel-heading panel-heading-transparent" style="height:60px;">
                    <strong> {{ trans('Configurations::Configurations/Settings.title_settings') }} </strong>
                    <form class="pull-right">
                        <div class="col-md-5" style="margin-top:8px;">
                            <label>{{ trans('Configurations::Configurations/Settings.languages') }}  </label>
                        </div>

                        <div class="col-md-7">
                            <select id="mySelect" class="form-control">
                                <option value="">{{ trans('Configurations::Configurations/Settings.selctoption_lan') }}</option>
                                <option value="0" @if(App::getLocale() == 'en') selected @endif>English</option>
                                <option value="1" @if(App::getLocale() == 'ar') selected @endif>العربية</option>
                                <option value="2" @if(App::getLocale() == 'de') selected @endif>Deutsche</option>
                                <option value="3" @if(App::getLocale() == 'fr') selected @endif>Français</option>
                                <option value="4" @if(App::getLocale() == 'it') selected @endif>Italiano</option>
                                <option value="5" @if(App::getLocale() == 'es') selected @endif>Español</option>
                                <option value="6" @if(App::getLocale() == 'ru') selected @endif>Русский</option>
                                <option value="7" @if(App::getLocale() == 'cn') selected @endif>中文(简体)</option>
                                <option value="8" @if(App::getLocale() == 'ja') selected @endif>日本語</option>
                                <option value="9" @if(App::getLocale() == 'pt') selected @endif>Português</option>
                                <option value="10" @if(App::getLocale() == 'tr') selected @endif>Türkçe</option>
                                <option value="11" @if(App::getLocale() == 'in') selected @endif>हिन्दी</option>
                                <option value="12" @if(App::getLocale() == 'id') selected @endif>Bahasa Indonesia
                                </option>
                                <option value="13" @if(App::getLocale() == 'bn') selected @endif>বাংলা</option>
                                <option value="14" @if(App::getLocale() == 'fa') selected @endif>‏فارسی‏</option>
                                <option value="15" @if(App::getLocale() == 'uk') selected @endif>Українська</option>
                                <option value="16" @if(App::getLocale() == 'ur') selected @endif>‏اردو‏</option>
                                <option value="17" @if(App::getLocale() == 'vi') selected @endif>Tiếng Việt</option>
                                <option value="18" @if(App::getLocale() == 'sv') selected @endif>Svenska</option>
                            </select>
                        </div>
                    </form>
                </div>

                <div class="panel-body">
                    <div id="panel-ui-tan-l4" class="panel panel-default" style="margin-top:-15px;">
                        <div>
                            <!-- tabs nav -->
                            <ul class="nav nav-tabs pull-left hidden" id="myTab">
                                <li class="langtab"><!-- TAB 1 -->
                                    <a href="#English">English </a>
                                </li>
                                <li class=""><!-- TAB 2 -->
                                    <a href="#العربية">العربية</a>
                                </li>
                                <li class=""><!-- TAB 2 -->
                                    <a href="#Deutsche">Deutsche</a>
                                </li>
                                <li class=""><!-- TAB 2 -->
                                    <a href="#Français">Français</a>
                                </li>
                                <li class=""><!-- TAB 2 -->
                                    <a href="#Italiano">Italiano</a>
                                </li>
                                <li class=""><!-- TAB 2 -->
                                    <a href="#Español">Español</a>
                                </li>
                                <li class=""><!-- TAB 2 -->
                                    <a href="#Русский">Русский</a>
                                </li>
                                <li class=""><!-- TAB 2 -->
                                    <a href="#中文(简体)">中文(简体)</a>
                                </li>
                                <li class=""><!-- TAB 2 -->
                                    <a href="#日本語">日本語</a>
                                </li>
                                <li class=""><!-- TAB 2 -->
                                    <a href="#Português">Português</a>
                                </li>
                                <li class=""><!-- TAB 2 -->
                                    <a href="#Türkçe">Türkçe</a>
                                </li>
                                <li class=""><!-- TAB 2 -->
                                    <a href="#हिन्दी">हिन्दी</a>
                                </li>
                                <li class=""><!-- TAB 2 -->
                                    <a href="#Bahasa Indonesia">Bahasa Indonesia</a>
                                </li>
                                <li class=""><!-- TAB 2 -->
                                    <a href="#বাংলা">বাংলা</a>
                                </li>
                                <li class=""><!-- TAB 2 -->
                                    <a href="#‏فارسی‏">‏فارسی‏</a>
                                </li>
                                <li class=""><!-- TAB 2 -->
                                    <a href="#Українська">Українська</a>
                                </li>
                                <li class=""><!-- TAB 2 -->
                                    <a href="#‏اردو‏">‏اردو‏</a>
                                </li>
                                <li class=""><!-- TAB 2 -->
                                    <a href="#Tiếng Việt">Tiếng Việt</a>
                                </li>
                                <li class=""><!-- TAB 2 -->
                                    <a href="#Svenska">Svenska</a>
                                </li>
                            </ul>
                            <!-- /tabs nav -->
                        </div>

                        <!-- panel content -->
                        <div class="panel-body">

                            <!-- tabs content -->

                            {!! Form::model($setbase, ['method' => 'post','files'=>true, 'route' => [app('urlBack').'.config.settings.index', $setbase]]) !!}

                            <div class="tab-content">

                                @foreach($langues as $lang)

                                    <div id="{{$lang->languages}}"
                                         class="tab-pane @if(App::getLocale() == $lang->code_lang) active @endif ">
                                        <!-- TAB 1 CONTENT -->

                                        @if(App::getLocale() == $lang->code_lang)

                                            <div class="row">
                                                <div class="form-group ">
                                                    <div class="col-md-6 col-sm-6 @if ($errors->has('sitename'.'_'.$lang->code_lang)) has-error @endif">
                                                        <label>{{ trans('Configurations::Configurations/Settings.sitename') }}    </label>
                                                        {!! Form::text('sitename'.'_'.$lang->code_lang,   StoneTranslation::transDynTable('sitename','confsettings_langs',$lang->code_lang) , array('placeholder' =>  trans('Configurations::Configurations/Settings.sitename') ,'class' => 'form-control', 'value' =>old('sitename'.'_'.$lang->code_lang) )) !!}
                                                        <p class="help-block">{{$errors->first('sitename'.'_'.$lang->code_lang)}}  </p>
                                                    </div>
                                                    <div class="col-md-6 col-sm-6 @if ($errors->has('keyword'.'_'.$lang->code_lang)) has-error @endif">
                                                        <label>{{ trans('Configurations::Configurations/Settings.keyword') }}  </label>
                                                        {!! Form::text('keyword'.'_'.$lang->code_lang, StoneTranslation::transDynTable('keyword','confsettings_langs',$lang->code_lang)  , array('placeholder' => trans('Configurations::Configurations/Settings.keyword') ,'class' => 'form-control', 'value' =>old('keyword'.'_'.$lang->code_lang) )) !!}
                                                        <p class="help-block">{{$errors->first('keyword'.'_'.$lang->code_lang)}}  </p>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="form-group">
                                                    <div class="col-md-12 col-sm-12 @if ($errors->has('descriptionweb'.'_'.$lang->code_lang)) has-error @endif">
                                                        <label>{{ trans('Configurations::Configurations/Settings.descriptionweb') }} </label>
                                                        {!! Form::textarea('descriptionweb'.'_'.$lang->code_lang, StoneTranslation::transDynTable('descriptionweb','confsettings_langs',$lang->code_lang)   , array('placeholder' => trans('Configurations::Configurations/Settings.descriptionweb')  ,'rows' => '4', 'class' => 'form-control', 'value' =>old('description'.'_'.$lang->code_lang) )) !!}
                                                        <p class="help-block">{{$errors->first('descriptionweb'.'_'.$lang->code_lang)}}  </p>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="form-group">
                                                    <div class="col-md-6 col-sm-6 @if ($errors->has('logo')) has-error @endif">
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

                                                    <div class="col-md-6 col-sm-6 @if ($errors->has('languages')) has-error @endif">
                                                        <label>{{ trans('Configurations::Configurations/Settings.languages') }} </label>
                                                        <select name="languages"
                                                                class="form-control pointer @if ($errors->has('choose_file')) has-error @endif">
                                                            <option value="">{{ trans('Configurations::Configurations/Settings.selctoption_lan') }} </option>
                                                            @foreach($langues as $lang2)
                                                                <option value="{{ $lang2->code_lang }}"
                                                                        @if( $lang2->code_lang == $setbase->languages) selected @endif>{{$lang2->languages}}</option>
                                                            @endforeach
                                                        </select>
                                                        <p class="help-block">{{$errors->first('languages')}}  </p>
                                                    </div>

                                                </div>
                                            </div>


                                            <div class="row">
                                                <div class="form-group">
                                                    <div class="col-md-6 col-sm-6 @if ($errors->has('email')) has-error @endif">
                                                        <label>{{ trans('Configurations::Configurations/Settings.email') }} </label>
                                                        {!! Form::text('email', null, array('placeholder' => trans('Configurations::Configurations/Settings.email') ,'class' => 'form-control', 'value' =>old('email') )) !!}
                                                        <p class="help-block">{{$errors->first('email')}}  </p>
                                                    </div>

                                                    <div class="col-md-6 col-sm-6" style="margin-top:25px;">
                                                        <label class="switch switch switch-round">
                                                            <span style="margin-right:25px;">{{ trans('Configurations::Configurations/Settings.maintenanceweb') }}    </span>
                                                            <input type="checkbox" name="maintenanceweb"
                                                                   class="check_maint"
                                                                   @if( old('maintenanceweb') == 'on' || $setbase->maintenanceweb == 'on' ) checked @endif>
                                                            <span class="switch-label" data-on="YES"
                                                                  data-off="NO"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row maintenance">
                                                <div class="form-group ">
                                                    <div class="col-md-12 col-sm-12 @if ($errors->has('msgmaintenance'.'_'.$lang->code_lang)) has-error @endif">
                                                        <label>{{ trans('Configurations::Configurations/Settings.msgmaintenance') }}   </label>
                                                        {!! Form::textarea('msgmaintenance'.'_'.$lang->code_lang, StoneTranslation::transDynTable('msgmaintenance','confsettings_langs',$lang->code_lang)  , array('placeholder' =>  trans('Configurations::Configurations/Settings.msgmaintenance') ,'rows' => '4', 'class' => 'form-control', 'value' =>old('msgmaintenance'.'_'.$lang->code_lang) )) !!}
                                                        <p class="help-block">{{$errors->first('msgmaintenance'.'_'.$lang->code_lang)}}  </p>
                                                    </div>
                                                </div>
                                            </div>

                                        @else

                                            <div class="row">
                                                <div class="form-group">
                                                    <div class="col-md-6 col-sm-6 @if ($errors->has('sitename'.'_'.$lang->code_lang)) has-error @endif">
                                                        <label>{{ trans('Configurations::Configurations/Settings.sitename') }}    </label>
                                                        {!! Form::text('sitename'.'_'.$lang->code_lang, StoneTranslation::transDynTable('sitename','confsettings_langs',$lang->code_lang), array('placeholder' => trans('Configurations::Configurations/Settings.sitename') ,'class' => 'form-control', 'value' =>old('sitename'.'_'.$lang->code_lang) )) !!}
                                                        <p class="help-block">{{ $errors->first('sitename'.'_'.$lang->code_lang) }}</p>
                                                    </div>
                                                    <div class="col-md-6 col-sm-6 @if ($errors->has('keyword'.'_'.$lang->code_lang)) has-error @endif">
                                                        <label>{{ trans('Configurations::Configurations/Settings.keyword') }}   </label>
                                                        {!! Form::text('keyword'.'_'.$lang->code_lang, StoneTranslation::transDynTable('keyword','confsettings_langs',$lang->code_lang), array('placeholder' => trans('Configurations::Configurations/Settings.keyword') ,'class' => 'form-control', 'value' =>old('keyword'.'_'.$lang->code_lang) )) !!}
                                                        <p class="help-block">{{$errors->first('keyword'.'_'.$lang->code_lang)}}  </p>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="form-group">
                                                    <div class="col-md-12 col-sm-12 @if ($errors->has('descriptionweb'.'_'.$lang->code_lang)) has-error @endif">
                                                        <label>{{ trans('Configurations::Configurations/Settings.descriptionweb') }}  </label>
                                                        {!! Form::textarea('descriptionweb'.'_'.$lang->code_lang, StoneTranslation::transDynTable('descriptionweb','confsettings_langs',$lang->code_lang), array('placeholder' => trans('Configurations::Configurations/Settings.descriptionweb') ,'rows' => '4', 'class' => 'form-control', 'value' =>old('descriptionweb'.'_'.$lang->code_lang) )) !!}
                                                        <p class="help-block">{{$errors->first('descriptionweb'.'_'.$lang->code_lang)}}  </p>
                                                    </div>
                                                </div>
                                            </div>



                                            <div class="row maintenance">
                                                <div class="form-group">
                                                    <div class="col-md-12 col-sm-12 @if ($errors->has('msgmaintenance'.'_'.$lang->code_lang)) has-error @endif">
                                                        <label>{{ trans('Configurations::Configurations/Settings.msgmaintenance') }}   </label>
                                                        {!! Form::textarea('msgmaintenance'.'_'.$lang->code_lang, StoneTranslation::transDynTable('msgmaintenance','confsettings_langs',$lang->code_lang), array('placeholder' => trans('Configurations::Configurations/Settings.msgmaintenance') ,'rows' => '4', 'class' => 'form-control', 'value' =>old('msgmaintenance'.'_'.$lang->code_lang) )) !!}
                                                        <p class="help-block">{{$errors->first('msgmaintenance'.'_'.$lang->code_lang)}}  </p>
                                                    </div>
                                                </div>
                                            </div>

                                        @endif


                                    </div><!-- /TAB 1 CONTENT -->

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
                        <!-- /panel content -->

                    </div>


                </div>

            </div>
        </div>
    </section>


@endsection
