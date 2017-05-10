<div class="modal fade gallery-modal-carousel" tabindex="-1" role="dialog" aria-labelledby="galleryDefaultModal"
     aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel">{{ $gallery->title }}</h4>
            </div>
            <div class="modal-body">
                <div id="carousel-gallery" class="carousel slide" data-ride="carousel" data-interval="false">
                    <ol class="carousel-indicators">
                        @forelse($_photos as $photo)
                            <li data-target="#carousel-gallery"
                                data-slide-to="{{ $photo->id }}"
                                class="{{ $loop->first ? 'active' : '' }}" id="{{ $photo->id }}"></li>
                        @empty
                        @endforelse
                    </ol>
                    <div class="carousel-inner" role="listbox">
                        @forelse($_photos as $photo)
                            <div class="item {{ $loop->first ? 'active' : '' }}" id="{{ $photo->id }}">
                                <div class="row">
                                    <div class="col-lg-10 col-sm-9">
                                        <img src="{{ url($photo->photo) }}" class="img-responsive"
                                             alt="{{ $photo->caption }}" id="{{ $photo->id }}">
                                    </div>
                                    <div class="col-lg-2 col-sm-3">
                                        <div class="box-all">
                                            <h3>{{ $photo->caption }}</h3>
                                            <p>{{ $photo->description }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                        @endforelse
                    </div>
                    <a class="left carousel-control" href="#carousel-gallery" role="button"
                       data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="right carousel-control" href="#carousel-gallery" role="button"
                       data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@section('scripts')
    <script>
        $(document).on('click', '.btn-gallery-show', function () {
            //this init
            $this = $(this);

            //href
            var $id = $this.attr('data-id');

            //assign data
            var $ind = $('#carousel-gallery').find('.carousel-indicators li#' + $id);
            var $item = $('#carousel-gallery').find('.carousel-inner .item#' + $id);

            //remove and assign
            $ind.addClass('active').siblings().removeClass('active');
            $item.addClass('active').siblings().removeClass('active');
        });
    </script>
@endsection