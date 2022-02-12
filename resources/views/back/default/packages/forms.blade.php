{!! Form::open(array('route' => app('urlBack').'InstallModules','method'=>'POST')) !!}
    <fieldset>
      <!-- required [php action request] -->
   {{ $text }}
      <div class="row">
        <div class="form-group">
          <div class="col-md-12 col-sm-12">
            <label>{{ trans('configuration.cms_conf_name') }}</label>
            {!! Form::text('name', null, array('placeholder' => trans('roles_managment.roles_create_name'),'class' => 'form-control')) !!}
          </div>
        </div>
      </div>
      <div class="row">
        <div class="form-group">
          <div class="col-md-12 col-sm-12">
            <label>{{ trans('roles_managment.roles_create_display_name') }}</label>
            {!! Form::text('display_name', null, array('placeholder' => trans('roles_managment.roles_create_display_name'),'class' => 'form-control')) !!}
          </div>
        </div>
      </div>
      <div class="row">
        <div class="form-group">
          <div class="col-md-12 col-sm-12">
            <label>{{ trans('roles_managment.roles_create_description') }}</label>
            {!! Form::textarea('description', null, array('placeholder' => trans('roles_managment.roles_create_description') ,'class' => 'form-control','style'=>'height:100px')) !!}
          </div>
        </div>
      </div>
    <div class="pull-right">
      <button type="submit" class="btn btn-primary">{{ trans('roles_managment.roles_create_create') }}</button>
    </div>
    </fieldset>
{!! Form::close() !!}
