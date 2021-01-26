@extends('admin.layouts.app')

@section('content')
    <div class="col s12">
        <div class="container">
            <div class="section">
                    <div class="row">
                        <div class="col s12 m12 l12">
                            <div class="card animate fadeUp">
                                <div class="card-content">
                                    <h4 class="header mt-0">
                                        @if(!$edit)
                                            {{ __('customer.homepgmanage.add') }}
                                        @else
                                            {{ __('customer.homepgmanage.edit') }}
                                        @endif
                                    </h4>
                                    <div class="row">
                                        <div class="col s12">
                                            <form class="formValidate" id="formValidate" method="POST" action="{{ $route }}" >
                                                @csrf
                                                @if($edit)
                                                    @method('PUT')
                                                @endif
                                                <div class="row">
                                                    <div class="input-field col s12">
                                                        <label for="name">{{ __('customer.title') }}*</label>
                                                        <input id="name" name="name" value="{{ old('name',$homepagemanage->name) }}" type="text" data-error=".errorTxt1" required>
                                                        <small class="errorTxt1"></small>
                                                        @error('name')
                                                        <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                        @enderror
                                                    </div>

{{--                                                    <div class="input-field col s12">--}}
{{--                                                        <p class="mb-1">{{ __('customer.select_seasons') }}</p>--}}
{{--                                                        <select id="seasons" class="select2 browser-default" name="seasons">--}}
{{--                                                                <option value="0">none</option>--}}
{{--                                                            @foreach($all_seasons as $season)--}}
{{--                                                                <option value="{{$season->id}}" >{{$season->name}}</option>--}}
{{--                                                            @endforeach--}}
{{--                                                        </select>--}}
{{--                                                    </div>--}}

                                                    <div class="input-field col s12">
                                                        <p class="mb-1">{{ __('customer.select_players') }}</p>
                                                        <select class="max-length browser-default" multiple="multiple" name="players" id="players">
                                                            @foreach($all_players as $player)
                                                                <option value="{{$player->id}}" >{{$player->name_en}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="input-field col s12">
                                                        <p class="mb-1">{{ __('customer.select_clubs') }}</p>
                                                        <select class="max-length browser-default" multiple="multiple" name="clubs" id="clubs">
                                                            @foreach($all_clubs as $club)
                                                                <option value="{{$club->id}}" >{{$club->name_en}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="input-field col s12">
                                                        <p class="mb-1">{{ __('customer.select_videos') }}</p>
                                                        <select class="max-length browser-default" multiple="multiple" name="videos" id="videos">
                                                            @foreach($all_videos as $video)
                                                                <option value="{{$video->id}}" >{{$video->title_en}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="input-field col s12">

                                                        <p class="mb-1">
                                                            <label>
                                                                <input name="status" {{ $homepagemanage->status == '1' ? 'checked' : '' }}  @if(!$edit) checked="checked" @endif type="checkbox" />
                                                                <span>{{ __('customer.status') }}</span>
                                                            </label>
                                                        </p>
                                                    </div>

                                                    <div class="input-field col s12">
                                                        <button class="btn waves-effect waves-light right submit" type="submit" name="action">Submit
                                                            <i class="material-icons right">send</i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
        <div class="content-overlay"></div>
    </div>
@endsection
@section('scripts')
    <script src={{ asset('app-assets/vendors/jquery-validation/jquery.validate.min.js') }}></script>
    <script src={{ asset('app-assets/js/scripts/form-elements.js') }}></script>
<script>
    /*
 * Form Validation
 */

    $(function () {

        $("#players").select2({
            dropdownAutoWidth: true,
            width: '100%',
            maximumSelectionLength: 10,
            placeholder: "Select maximum 10 items"
        });

        $("#clubs").select2({
            dropdownAutoWidth: true,
            width: '100%',
            maximumSelectionLength: 10,
            placeholder: "Select maximum 10 items"
        });

        $("#videos").select2({
            dropdownAutoWidth: true,
            width: '100%',
            maximumSelectionLength: 10,
            placeholder: "Select maximum 10 items"
        });

        $('select[required]').css({
            position: 'absolute',
            display: 'inline',
            height: 0,
            padding: 0,
            border: '1px solid rgba(255,255,255,0)',
            width: 0
        });

        $("#formValidate").validate({
            rules: {
                discount_title: {
                    required: true,
                    minlength: 5,
                },

            },
            //For messages
            messages: {
                discount_title: {
                    required: "Enter Discount Title",
                },
                curl: "Enter your website",
            },
            errorElement: 'div',
            errorPlacement: function (error, element) {
                var placement = $(element).data('error');
                if (placement) {
                    $(placement).append(error)
                } else {
                    error.insertAfter(element);
                }
            }
        });
    });

</script>
@endsection
