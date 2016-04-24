<div class="form-group ">
    <label for="image">
        Картинка
    </label>
    <div class="imageUpload" data-target="{{asset('/admin/upload/image')}}" data-target-delete="{{asset('/admin/upload/delete/image')}}" data-token="{{csrf_token()}}" data-path="">
        <div>
            <div class="thumbnail">
                <img class="no-value hidden" src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" width="200px" height="150px">
                <img class="has-value " src="{{$user->avatar}}" width="200px" height="150px">
            </div>
        </div>
        <div>
            <div class="btn btn-primary imageBrowse flat"><i class="fa fa-times"></i> Select Image<input type="file" style="visibility: hidden; position: absolute;"></div>
            <div class="btn btn-danger imageRemove flat"><i class="fa fa-upload"></i> Remove Image</div>
        </div>
        <input name="{{$name}}" class="imageValue" type="hidden" value="{{$user->avatar}}">
        <div class="errors">
            <p class="help-block"></p>
        </div>
    </div>
</div>

@push('script')
<script type="text/javascript" src="/vendor/sleeping-owl/admin/default/plugins/flow/flow.min.js"></script>
<script type="text/javascript" src="/js/image_upload.js"></script>
@endpush