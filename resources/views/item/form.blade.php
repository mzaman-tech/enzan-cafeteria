@extends('layouts.app')

@section('title')
    @lang('web.menu')
@stop

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ $item->name ?? 'Create' }}
                    <div class="btn-group" role="group" aria-label="Basic example" style="float: right;">
                        <a class="btn btn-sm btn-primary" style="float: right; color: #fff" href="{{ ($isNew) ? action('Web\DashboardController@index') : action('Web\ItemController@show', $item->id) }}"><i class="fa fa-arrow-left"></i></a>

                    </div>
               </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <img src="{{ (isset($item) && !is_null($item->image)) ? asset('images/' . $item->image) : asset('images/default.jpg' ) }}" class="img-responsive" width="200px" />
                        </div>
                        <div class="col-md-8">
                            <form action="{{ ($isNew) ? action('Web\ItemController@store') : action('Web\ItemController@update', $item->id) }}" method="post" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                @if(!$isNew)
                                <input type="hidden" name="_method" value="PUT">
                                @endif

                                <div class="form-group">
                                    <label>{{ __('web.name') }} <span class="required">*</span></label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $item->name ?? '' }}">
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label>{{ __('web.price') }} <span class="required">*</span></label>
                                    <input type="number" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ $item->price ?? '' }}" min="0">
                                    @error('price')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('price') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label>{{ __('web.image') }}</label>
                                    <input type="file" class="form-control" name="image">
                                    @error('image')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('image') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="checkbox">
                                    <label><input type="checkbox" name="is_available" @if(isset($item) && $item->is_available) checked @endif > {{ __('web.available') }}</label>
                                </div>
                                <button type="submit" class="btn btn-primary btn-block">{{ __('web.save') }}</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
