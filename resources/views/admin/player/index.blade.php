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
                                    Players
                                    @can('add-player')
                                    <a href="{{ URL::route('player-form.create') }}" class="waves-effect waves-light btn gradient-45deg-purple-deep-orange gradient-shadow right">Add </a>
                                    @endcan
                                </h4>
                                <div class="row">
                                    <div class="col s12">
                                        @if ($playeraddsuccess = Session::get('playeraddsuccess'))
                                            <div class="card-alert card gradient-45deg-green-teal">
                                                <div class="card-content white-text">
                                                    <p>
                                                        <i class="material-icons"></i>{{ $playeraddsuccess }}</p>
                                                </div>
                                                <button type="button" class="close white-text" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                        @endif
                                        @if ($playereditsuccess = Session::get('playereditsuccess'))
                                            <div class="card-alert card gradient-45deg-green-teal">
                                                <div class="card-content white-text">
                                                    <p>
                                                        <i class="material-icons"></i>{{ $playereditsuccess }}</p>
                                                </div>
                                                <button type="button" class="close white-text" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                        @endif
                                        @if ($playerdelsuccess = Session::get('playerdelsuccess'))
                                            <div class="card-alert card gradient-45deg-green-teal">
                                                <div class="card-content white-text">
                                                    <p>
                                                        <i class="material-icons"></i>{{ $playerdelsuccess }}</p>
                                                </div>
                                                <button type="button" class="close white-text" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                        @endif
                                        <table id="page-length-option" class="display">
                                            <thead>
                                            <tr>
                                                <th width="10%">Name</th>
                                                <th width="10%">Banner</th>
                                                <th width="10%">Profile Image</th>
                                                <th width="10%">Description</th>
                                                <th width="10%">Sorting</th>
                                                <th width="15%">Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($player as $player)
                                                <tr>
                                                    <td>{{ $player->name_en }}</td>
                                                    <td><img src="{{ asset('app-assets/images/player/'.$player->player_banner)}}"  class="img-thumbnail" width="75" /></td>
                                                    <td><img src="{{ asset('app-assets/images/player/'.$player->player_profile_image)}}"  class="img-thumbnail" width="75" /></td>
                                                    <td>{{ $player->description_en }}</td>
                                                    <td>{{ $player->player_sorting }}</td>
                                                    <td><form action="{{ route('player-form.destroy', $player->id)}}" method="post">
                                                            @can('edit-player')
                                                            <a href="{{ route('player-form.edit',$player->id)}}" class="dt-button buttons-excel buttons-html5 waves-effect waves-light btn gradient-45deg-purple-deep-orange gradient-shadow">Edit</a>
                                                            @endcan
                                                                {{ csrf_field() }}
                                                                @can('delete-player')
                                                            @method('DELETE')
                                                            <button onclick="return window.confirm('Are you sure you want to delete this record?');" class="dt-button buttons-excel buttons-html5 waves-effect waves-light btn gradient-45deg-purple-deep-orange gradient-shadow" type="submit">Delete</button>
                                                            @endcan
                                                        </form></td>
                                            @endforeach
                                            </tbody>

                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
@section('scripts')
    <script src={{ asset('app-assets/vendors/data-tables/js/jquery.dataTables.min.js') }}></script>
    <script src={{ asset('app-assets/vendors/data-tables/extensions/responsive/js/dataTables.responsive.min.js') }}></script>
    <script src={{ asset('app-assets/vendors/data-tables/js/dataTables.select.min.js') }}></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.flash.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js"></script>
    <style type="text/css">
        div.dt-buttons {
            margin-bottom:20px;
        }

    </style>
    <script type="text/javascript">
        $(document).ready(function(){

            $('#page-length-option').DataTable({
                "responsive": true,
                "lengthMenu": [
                    [10, 25, 50, 75, 100, -1],
                    [10, 25, 50, 75, 100, "All"]
                ],
                "order":[[4,"asc"]],
                buttons: [
                    {
                        extend: 'excel',
                        text: '{{ __("customer.excel") }}',
                        className: 'waves-effect waves-light btn gradient-45deg-purple-deep-orange gradient-shadow',
                        filename : '{{ __("customer.excel") }}' ,
                        exportOptions: {
                            columns: [ 0,1,2,3,4,5 ]
                        },
                    },
                    {
                        extend: 'csv',
                        text: '{{ __("customer.csv") }}',
                        className: 'waves-effect waves-light btn gradient-45deg-purple-deep-orange gradient-shadow',
                        filename : '{{ __("customer.csv") }}' ,
                        exportOptions: {
                            columns: [ 0,1,2,3,4,5 ]
                        },
                    }
                ],
                dom: 'Blfrtip',
            });
        });
    </script>
@endsection
