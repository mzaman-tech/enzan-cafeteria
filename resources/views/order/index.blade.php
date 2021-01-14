@extends('layouts.app')

@section('title')
    @lang('web.orders')
@stop

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('web.orders') }}</div>

                <div class="card-body">
                    <div class="col-md-12 table-responsive">
                        <form style="margin-bottom: 20px;" method="GET" action="">
                            <div class="input-group">
                                <input type="text" class="form-control" name="query" placeholder="{{ __('web.search_customer') }}" value="{{ $query }}">
                                <div class="input-group-btn">
                                <button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </form>

                        <table class="table">
                            <tr>
                                <th colspan="2">{{ __('web.item') }}</th>
                                <th>{{ __('web.quantity') }}</th>
                                <th>{{ __('web.total_price') }}</th>
                                <th>{{ __('web.customer') }}</th>
                                <th>{{ __('web.delivery_time') }}</th>
                                <th>{{ __('web.action') }}</th>
                            </tr>
                            @foreach ($orders as $order)
                                <tr>
                                    <td style="vertical-align: middle;"><img src="{{ !is_null($order->item->image) ? asset('images/' . $order->item->image) : asset('images/default.jpg' ) }}" class="img-rounded" width="50px" /></td>
                                    <td style="vertical-align: middle;"><a style="color: #212529;" href="{{ action('Web\ItemController@show', [$order->item->id]) }}">{{ $order->item->name }} </a></td>
                                    <td style="vertical-align: middle;">{{ $order->quantity }}</td>
                                    <td style="vertical-align: middle;">{{ $order->total_price }}</td>
                                    <td>{!! $order->customer_name .'<br />'. $order->customer_addess !!}</td>
                                    <td style="vertical-align: middle;">{{ date('Y/m/d', $order->delivery_time) }}</td>
                                    <td style="vertical-align: middle;">@if(!$order->is_delivered)<button class="btn btn-primary btn-confirm" data-url="{{ action('Web\OrderController@confirmDelivery', [$order->id]) }}">{{ __('web.confirm_delivery') }}</button>@endif</td>
                                </tr>
                            @endforeach
                        </table>

                    </div>
                    <div class="container">
                        {{ $orders->appends(['query' => $query])->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script>
        $('.btn-confirm').click(function(e){
            e.preventDefault();
            if (window.confirm("{{ __('web.are_you_sure') }}") === true) {
                $.ajax({
                    type: 'POST',
                    url: $(this).data('url'),
                    data: {
                        "_token": "{{ csrf_token() }}",
                    },
                    success: function(res) {
                        window.location.reload();
                    }
                });
            }
        });
    </script>
@endpush
