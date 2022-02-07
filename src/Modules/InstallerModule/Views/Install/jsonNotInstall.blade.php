<div class="modal-dialog">
    <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
            <button type="button" class="close closea" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
            </button>
            <h4 class="modal-title"
                id="myModalLabel"> {{ trans('InstallerModule::InstallerModule/InstallerModule.error_modules_notinstall')  }}
                '{{ $module }}'</h4>
        </div>

        <!-- Modal Body -->
        <div class="modal-body">
            <h4>  {{ trans('InstallerModule::InstallerModule/InstallerModule.errors')  }} </h4>
            <p> {{ trans('InstallerModule::InstallerModule/InstallerModule.msgerrors_install_modules')  }} '{{ $module }}
                '</p>
        </div>

        <!-- Modal Footer -->
        <div class="modal-footer">
            <a class="btn btn-3d btn-danger closea"> <i class="glyphicon glyphicon-remove-circle"
                                                        aria-hidden="true"></i>{{ trans('InstallerModule::InstallerModule/InstallerModule.close')  }}
            </a>
        </div>

    </div>
</div>
