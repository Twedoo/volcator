@foreach( $data as $key => $module)
    <div class="col-md-4 col-lg-3">
        <section class="panel">
            <div class="panel-body noradius padding-10">
                <figure class="margin-bottom-10">
                    <img class="img-responsive" src="{{ asset(app('backtheme')[0].'/assets/images/demo/9_full.jpg') }}"
                         alt="">
                </figure>
                <ul style="text-algin:center;" class="list-unstyled size-13">
                    @foreach( $module as $key2 => $moed)
                        <li class="text-gray"><i
                                    class="fa fa-circle"></i><strong>{!! PackagesHoolm::HoolmTRans($key2) !!}</strong>
                        </li>
                        <li> {{ $moed }}</li>
                        <br/>
                    @endforeach
                </ul>
                <hr class="half-margins">
                <!-- Social -->
                <h6>Developper Module : Houssem Maamria</h6>
                <a href="#" class="btn ico-only btn-facebook btn-xs" title="Facebook"><i class="fa fa-facebook"></i></a>
                <a href="#" class="btn ico-only btn-twitter btn-xs" title="Twitter"><i class="fa fa-twitter"></i></a>
                <a href="#" class="btn ico-only btn-google-plus btn-xs" title="Google plus"><i
                            class="fa fa-google-plus"></i></a>
                <a href="#" class="btn ico-only btn-rss btn-xs" title="Rss"><i class="fa fa-rss"></i></a>
            </div>
        </section>
    </div>
@endforeach
{!! $data0 !!}
