<div class="modal-dialog">
    <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
            <button type="button" class="close closea" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
            </button>
            <h4 class="modal-title"
                id="myModalLabel"> {{ trans('InstallerModule::InstallerModule/InstallerModule.success_modules_install')  }}
                "{{ $model}}"</h4>
        </div>

        <!-- Modal Body -->
        <div class="modal-body">
            <h4>{{ trans('InstallerModule::InstallerModule/InstallerModule.install')  }} </h4>
            <p>{{ trans('InstallerModule::InstallerModule/InstallerModule.msgesuccess_install_modules')  }} </p>
        </div>

        <!-- Modal Footer -->
        <div class="modal-footer">
            <a link="{{ route( app('urlBack').'.'.strtolower($model).'.module.building',$model) }}"
               class="btn btn-3d btn-green installnow"><i class="glyphicon glyphicon-download-alt"
                                                          aria-hidden="true"></i>{{ trans('InstallerModule::InstallerModule/InstallerModule.installnow')  }}
            </a>
        </div>

    </div>
</div>
