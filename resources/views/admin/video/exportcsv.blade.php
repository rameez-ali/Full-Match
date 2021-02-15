@extends('admin.layouts.app')

@section('content')
    <?php
    $c = array_combine($clubs, $players);
    print_r($c);
    ?>

@endsection
