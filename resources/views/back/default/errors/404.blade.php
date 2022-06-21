@extends('../elements.layouts.app')



@section('content')



    <div class="container">
        <div class="row">

            <div class="panel panel-default">
                <div class="panel-body">

                    <p class="lead">
                        <span class="e404">404</span>
                        {{ trans('BaseErrors.error404') }}<br/>
                        {{ trans('BaseErrors.error404_description') }}
                    </p>


                </div>
            </div>

        </div>
    </div>

@endsection
