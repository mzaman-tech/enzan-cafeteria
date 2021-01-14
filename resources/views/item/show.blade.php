@extends('layouts.app')

@section('title')
    @lang('web.menu')
@stop

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ $item->name }}
                    <div class="btn-group" role="group" aria-label="Basic example" style="float: right;">
                        <a class="btn btn-sm btn-primary" style="float: right; color: #fff" href="{{ action('Web\ItemController@edit', $item->id) }}"><i class="fa fa-edit"></i></a>
                        @if($orderCount == 0)
                        <a class="btn btn-sm btn-danger" style="float: right; color: #fff" href="javascript:void(0)" onclick="event.preventDefault(); document.getElementById('delete-form').submit();"><i class="fa fa-trash"></i></a>

                        <form id="delete-form" action="{{ action('Web\ItemController@destroy', $item->id) }}" method="POST" style="display: none;">
                            @csrf
                            <input type="hidden" name="_method" value="DELETE">
                        </form>
                        @endif
                    </div>
               </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <img src="{{ !is_null($item->image) ? asset('images/' . $item->image) : asset('images/default.jpg' ) }}" class="img-responsive" width="200px" />
                        </div>
                        <div class="col-md-8">
                            <table class="table">
                                <tr>
                                    <th>{{ __('web.price') }}</th>
                                    <td>{{ $item->price}}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('web.order') }}</th>
                                    <td>{{ $orderCount }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('web.availability') }}</th>
                                    <td>{{ $item->is_available ? "Yes" : "No" }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
