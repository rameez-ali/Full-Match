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
                                        test
                                        <a class="waves-effect waves-light btn gradient-45deg-purple-deep-orange gradient-shadow right">Details</a>
                                    </h4>
                                    <div class="row">
                                        <div class="col s12">
                                            <h2>textt</h2>
                                            <form class="formValidate" id="formValidate" method="get">
                                                <div class="row">
                                                    <div class="input-field col s12">
                                                        <label for="uname">Username*</label>
                                                        <input id="uname" name="uname" type="text" data-error=".errorTxt1">
                                                        <small class="errorTxt1"></small>
                                                    </div>
                                                    <div class="input-field col s12">
                                                        <label for="cemail">E-Mail *</label>
                                                        <input id="cemail" type="email" name="cemail" data-error=".errorTxt2">
                                                        <small class="errorTxt2"></small>
                                                    </div>
                                                    <div class="input-field col s12">
                                                        <label for="password">Password *</label>
                                                        <input id="password" type="password" name="password" data-error=".errorTxt3">
                                                        <small class="errorTxt3"></small>
                                                    </div>
                                                    <div class="input-field col s12">
                                                        <label for="cpassword">Confirm Password *</label>
                                                        <input id="cpassword" type="password" name="cpassword" data-error=".errorTxt4">
                                                        <small class="errorTxt4"></small>
                                                    </div>
                                                    <div class="input-field col s12">
                                                        <label for="curl">URL *</label>
                                                        <input id="curl" type="url" name="curl" data-error=".errorTxt5">
                                                        <small class="errorTxt5"></small>
                                                    </div>
                                                    <div class="col s12">
                                                        <label for="crole">Role *</label>
                                                        <div class="input-field">
                                                            <select class="error" id="crole" name="crole" data-error=".errorTxt6" required>
                                                                <option value="">Choose your profile</option>
                                                                <option value="1">Manager</option>
                                                                <option value="2">Developer</option>
                                                                <option value="3">Business</option>
                                                            </select>
                                                            <small class="errorTxt6"></small>
                                                        </div>
                                                    </div>
                                                    <div class="input-field col s12">
                                                        <textarea id="ccomment" name="ccomment" class="materialize-textarea validate" data-error=".errorTxt7"></textarea>
                                                        <label for="ccomment">Your comment *</label>
                                                        <small class="errorTxt7"></small>
                                                    </div>
                                                    <div class="col s12">
                                                        <p>Gender </p>
                                                        <p>
                                                            <label>
                                                                <input name="gender" type="radio" checked />
                                                                <span>Male</span>
                                                            </label>
                                                        </p>

                                                        <label>
                                                            <input name="gender" type="radio" />
                                                            <span>Female</span>
                                                        </label>
                                                        <div class="input-field">
                                                            <small class="errorTxt8"></small>
                                                        </div>
                                                    </div>
                                                    <div class="col s12">
                                                        <label for="tnc_select">T&C *</label>
                                                        <p>
                                                            <label>
                                                                <input type="checkbox" id="tnc_select" />
                                                                <span>Please agree to our policies</span>
                                                            </label>
                                                        </p>
                                                        <div class="input-field">
                                                            <small class="errorTxt6"></small>
                                                        </div>
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
<script>
    /*
 * Form Validation
 */
    $(function () {

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
                uname: {
                    required: true,
                    minlength: 5
                },
                cemail: {
                    required: true,
                    email: true
                },
                password: {
                    required: true,
                    minlength: 5
                },
                cpassword: {
                    required: true,
                    minlength: 5,
                    equalTo: "#password"
                },
                crole: {
                    required: true,
                },
                curl: {
                    required: true,
                    url: true
                },
                ccomment: {
                    required: true,
                    minlength: 15
                },
                tnc_select: "required",
            },
            //For custom messages
            messages: {
                uname: {
                    required: "Enter a username",
                    minlength: "Enter at least 5 characters"
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
