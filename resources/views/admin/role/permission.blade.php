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
                                        {{ __('customer.permission') }}
                                    </h4>
                                    <div class="row">
                                        <div class="col s12">
                                            <form method="POST" action="{{ route('save.role.permission') }}" class="row" >
                                                @csrf
                                                <input type="hidden" value="{{ $role->name }}" name="role">

                                                    <table id="page-length-option" class="display">
                                                <thead>
                                                <tr>
                                                    <th>
                                                        <label>
                                                            <input type="checkbox" class="permissions-all" />
                                                            <span>All</span>
                                                        </label>
                                                    </th>
                                                    <th>{{ __('customer.title') }}</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($permissions as $permission)
                                                    <tr>
                                                        <td><label>
                                                                <input
                                                                    type="checkbox"
                                                                    class="permission"
                                                                    name="permission[]"
                                                                    value="{{ $permission->name }}"
                                                                    {{ in_array($permission->name,$assigned_permissions) ? 'checked' : '' }}
                                                                />
                                                                <span>&nbsp;</span>
                                                            </label></td>
                                                        <td>{{ $permission->title }}</td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>

                                                <div class="input-field col s12">
                                                    <button class="btn waves-effect waves-light right submit" type="submit" name="action">Submit
                                                        <i class="material-icons right">send</i>
                                                    </button>
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

    <script src={{ asset('app-assets/vendors/data-tables/js/jquery.dataTables.min.js') }}></script>
    <script src={{ asset('app-assets/vendors/data-tables/extensions/responsive/js/dataTables.responsive.min.js') }}></script>
    <script src={{ asset('app-assets/vendors/data-tables/js/dataTables.select.min.js') }}></script>

    <style type="text/css">
        div.dt-buttons {
            margin-bottom:20px;
        }

    </style>
    <script type="text/javascript">

        $(document).ready(function() {
            $('.permissions-all').change(function(){
                if($(this).is(':checked')){
                    $('.permission').prop('checked',true).trigger('change');
                }else{
                    $('.permission').prop('checked',false).trigger('change');
                }
            })
        });

    </script>
@endsection
