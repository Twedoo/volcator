<div class="modal-dialog">
    <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
            <button type="button" class="close closea" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
            </button>
            <h4 class="modal-title"
                id="myModalLabel"> {{ trans('Organizer::Organizer/Organizer.success_modules_install')  }}
                "{{ $model}}"</h4>
        </div>

        <!-- Modal Body -->
        <div class="modal-body">
            <h4>{{ trans('Organizer::Organizer/Organizer.install')  }} </h4>
            <p>{{ trans('Organizer::Organizer/Organizer.msgesuccess_install_modules')  }} </p>
        </div>

        <!-- Modal Footer -->
        <div class="modal-footer">
            <a link="{{ route( app('urlBack').'.'.strtolower($model).'.module.building',$model) }}"
               class="btn btn-3d btn-green installnow"><i class="glyphicon glyphicon-download-alt"
                                                          aria-hidden="true"></i>{{ trans('Organizer::Organizer/Organizer.installnow')  }}
            </a>
        </div>

    </div>
</div>
