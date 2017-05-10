<div class="modal fade gallery-modal-default" tabindex="-1" role="dialog" aria-labelledby="galleryDefaultModal"
     aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel"></h4>
            </div>
            <div class="modal-body">
                <div class="thumbnail">
                    <div class="row">
                        <div class="col-lg-10 col-sm-9">
                            <div class="photo-wrapper"></div>
                        </div>
                        <div class="col-lg-2 col-sm-3">
                            <div class="photo-details-wrapper"></div>
                        </div>
                    </div>
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
            var $img = $this.attr('data-link');
            var $id = $this.attr('data-id');
            var $caption = $('.album').find('.thumbnail#' + $id).find('.caption>h3').text();
            var $details = $('.album').find('.thumbnail#' + $id).find('.caption>p.details').attr('data-desc');

            //image
            var $image = '<img src="' + $img + '" class="img-responsive" alt="' + $caption + '">';

            //assign data
            $('.gallery-modal-default').find('.modal-title').html($caption);
            $('.gallery-modal-default').find('.modal-body .photo-wrapper').html($image);
            $('.gallery-modal-default').find('.modal-body .photo-details-wrapper').html($details);
        });
    </script>
@endsection