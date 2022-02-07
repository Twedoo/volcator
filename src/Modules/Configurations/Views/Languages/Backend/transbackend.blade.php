@extends('elements.layouts.app')
@section('content')

    <section id="middle">

        <!-- page title -->
        <header id="page-header">
            <h1>
                {{trans('Configurations::Configurations/Languages.translate_module')}}

                @if($getModuleName)
                    {{ trans('sidebar/sidebar.'.$getModuleName->im_name_modules_display.'')}}
                @else
                    {{ Input::get('file', false) }}
                @endif

            </h1>

            <ol class="breadcrumb">
                <li><a href="{{url(app('urlBack').'/')}}"><i class="glyphicon glyphicon-home" aria-hidden="true"></i></a>
                </li>
                <li>
                    <a href="{{ route(app('urlBack') . '.languages.cms.index')}}"> {{  trans('Configurations::Configurations/Languages.title_languages')}} </a>
                </li>
                <li class="active"> {{  trans('Configurations::Configurations/Languages.translate_module')   }}
                    @if($getModuleName)
                        {{ trans('sidebar/sidebar.'.$getModuleName->im_name_modules_display.'')  }}
                    @endif
                </li>
            </ol>

        </header>
        <!-- /page title -->

        <div id="content" class="padding-20">
            {!! Toastr::message() !!}

            <div class="panel panel-default">
                <div class="panel-heading panel-heading-transparent">
                    <strong> {{  trans('Configurations::Configurations/Languages.set_word') }} </strong>
                    <form class="pull-right">
                        <div class="col-lg-2" style="margin-top:8px;">
                            <label>{{ trans('Configurations::Configurations/Settings.languages') }}  </label>
                        </div>

                        <div class="col-lg-10 pull-right">

                            <div class="col-lg-6 @if ($errors->has('file_twedoo')) has-error @endif">
                                <select id="file" name="file" class="form-control">
                                    <option selected='false' value="">
                                        -- {{ trans('Configurations::Configurations/Languages.select_file') }} --
                                    </option>
                                    @foreach( $getFiles as $file)
                                        <option value="{{ $file }}"
                                                @if( $isFile == $file ) selected @endif>{{$file}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-lg-6 @if ($errors->has('lang_twedoo')) has-error @endif">
                                <select selected='false' id="lang" name="lang" class="form-control">
                                    <option value="">
                                        -- {{ trans('Configurations::Configurations/Languages.select_language') }} --
                                    </option>
                                    @foreach( $getLanguages as $language)
                                        <option value="{{ $language->code_lang }}"
                                                @if($isLanaguage == $language->code_lang) selected @endif>{{$language->languages}}</option>
                                    @endforeach
                                </select>
                            </div>

                        </div>
                    </form>
                </div>

                <div class="panel-body">

                    {!! Form::open(['method' => 'POST', 'route' => [app('urlBack').'.languages.translate.setword']]) !!}

                    <input type="hidden" name="module_twedoo" value="{{$moduleTranslate}}">
                    <input type="hidden" name="file_twedoo" value="{{$isFile}}">
                    <input type="hidden" name="lang_twedoo" value="{{$isLanaguage}}">

                    <div class="row">
                        <div class="col-md-12">
                            @foreach( $getKeyWord as $key => $keyWord)
                                <div class="form-group">
                                    <div class="col-md-12" style="margin-top: 15px;">
                                        <div class="col-md-6">
                                            <label>{{$keyWord}}</label>
                                        </div>

                                        <div class="col-md-6">
                                            @if (array_key_exists($key, $wordsToTrans))
                                                <input type="text" name="{{$key}}" value="{{$wordsToTrans[$key]}}"
                                                       class="form-control">
                                            @else
                                                <input type="text" name="{{$key}}" value="" class="form-control">
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach


                            <div class="form-group">
                                <div class="text-center col-md-4 col-md-offset-4"
                                     style="margin-top: 15px; margin-bottom: 20px">
                                    <div class="col-md-12">

                                        <a class="btn btn-default add_input">{{  trans('Configurations::Configurations/Languages.new_input')   }}
                                            <i class="fa fa-plus" aria-hidden="true"></i> </a>

                                    </div>
                                </div>
                            </div>

                            <div class="form-group field_wrapper" style="margin-bottom: 25px">

                            </div>

                            <div class="col-md-12">
                                <div class="pull-right" style="margin: 25px 25px 0 0">
                                    <button type="submit"
                                            class="btn btn-primary">{{  trans('Configurations::Configurations/Languages.save')   }}</button>
                                </div>
                            </div>


                        </div>
                    </div>

                    {!! Form::close() !!}

                </div>
            </div>

        </div>
    </section>

    <script>

        if ($("#file").val() === "") {
            $("#lang").attr('disabled', 'disabled');
        }
        else {
            $("#lang").removeAttr('disabled');
        }

        $('select').on('change', function () {
            var lang = $("#lang").val();
            var file = $("#file").val();
            location.href = "{{$currentPath}}" + '?moduleTranslate=' + "{{$moduleTranslate}}" + '&lang=' + lang + '&file=' + file;
        });

        var inputAjax = '  <div class="form-group" ><div class="col-md-6" style="margin-bottom:15px"><label >{{  trans("Configurations::Configurations/Languages.key")   }}</label><input type="text" class="form-control" name="keys_word[]"  placeholder="key" > </div><div class="col-md-6" style="margin-bottom:15px"><label > {{  trans("Configurations::Configurations/Languages.word")   }} </label><input type="text" class="form-control" name="value_word[]"  placeholder="word"> </div></div>'; //New input field html
        $(document).on('click', '.add_input', function (e) {
            $('.field_wrapper').append(inputAjax); // Add field html
            $("html, body").animate({scrollTop: $(document).height()}, "slow");
        });

    </script>

@endsection
