@extends('layouts.app')

@section('title')
    @lang('web.dashboard')
@stop

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('web.menu') }}
                    <a class="btn btn-sm btn-info" style="float: right; color: #fff" href="{{ action('Web\ItemController@create') }}"><i class="fa fa-plus"></i></a>
                </div>

                <div class="card-body">
                    <div class="col-md-12 table-responsive">
                        <form style="margin-bottom: 20px;" method="GET" action="">
                            <div class="input-group">
                                 <input type="text" class="form-control" name="query" placeholder="{{ __('web.search_item') }}" value="{{ $query }}">
                                <div class="input-group-btn">
                                <button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </form>
                        <table class="table">
                            <tr>
                                <th colspan="2">{{ __('web.name') }}</th>
                                <th>{{ __('web.price') }}</th>
                                <th>{{ __('web.order') }}</th>
                            </tr>
                            @foreach ($items as $item)

                                <tr>
                                    <td style="width: 100px"><img src="{{ !is_null($item->image) ? asset('images/' . $item->image) : asset('images/default.jpg' ) }}" class="img-rounded" width="100px" /></td>
                                    <td style="vertical-align: middle;"><a style="color: #212529; font-size: 18px;" href="{{ action('Web\ItemController@show', [$item->id]) }}">{{ $item->name }} </a>@if(!$item->is_available) <sup style="font-size: 12px; color: red">Unavailable</sup> @endif</td>
                                    <td style="vertical-align: middle;">¥{{ $item->price }}</td>
                                    <td style="vertical-align: middle;">{{ $item->orders->count() }}</td>
                                </tr>
                            @endforeach
                        </table>

                    </div>
                    <div class="container">
                        {{ $items->appends(['query' => $query])->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
