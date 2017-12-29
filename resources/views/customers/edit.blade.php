@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="panel panel-default text-center" style="padding: 20px">
                    {!! Form::open(['route' => ['customers.upload.picture', $customer], 'method' => 'PUT', 'files' => true]) !!}
                        <img src="{{ $pictureUrl }}" class="img-circle center-block" style="margin-bottom: 15px">
                        <button id="js-upload" class="btn btn-success">Upload Picture</button>
                        <input type="file" id="picture" name="picture" class="hidden">
                    {!! Form::close() !!}
                </div>
            </div>
            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading">Edit Customer</div>
                    <div class="panel-body">
                        {!! Form::model($customer, ['route' => ['customers.update', $customer], 'method' => 'PUT', 'class' => 'form-horizontal', 'files' => true]) !!}
                        @include('common.user_form')
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Submit
                                </button>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(function () {
            $('#js-upload').click(function (e) {
                $('#picture').click();
                e.preventDefault();
            });

            $('#picture').change(function () {
                $(this).parents('form').submit();
            });
        });
    </script>
@endsection
