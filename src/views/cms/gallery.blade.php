{{--
  |  CMS About Page
  |
  |  @package resources/views/admin/cms
  |
  |  @author Vaibhav Yadav <vaibhav.yadav@surmountsoft.in>
  |
  |  @copyright 2021 SurmountSoft Pvt. Ltd. All rights reserved.
  |
--}}

@extends('view::layouts.app')
@section('content')
<!-- Content area -->
<div class="content">
    <!-- cms content -->
    <div class="row">
        <div class="col-xl-12">
            <!-- CMS About -->
            <div class="card user-wrapper">
                {!! Form::open(['route' => 'cms.create.gallery', 'method' => 'post', 'files' => true, 'id'=>'create-cms']) !!}
                @csrf
                <div class="card-header header-elements-inline">
                    <h5 class="card-title">{{trans('tran::views.gallery')}}</h5>
                    <div class="header-elements">
                        <div class="text-right add-btn-wrapper">
                            <button type="submit" class="btn btn-primary ml-2 btn-submit-cancel">{{trans('tran::views.submit')}}</button>
                        </div>
                    </div>        
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <label class="font-weight-semibold text-default">Gallery</label>
                            <div class="image-upload customBrowse ">
                                <input type="hidden" name="cms_id" value="{{ !is_null($cms) ? $cms->id : null }}">
                                {{ Form::file('gallery[]', ['class'=> 'file-input-ajax ', 'accept'=>'image/x-png,image/jpg,image/jpeg', 'multiple' => true]) }}
                                
                            </div>
                        </div>
                    </div>
                    <div class="row mt-5">
                        @if(!is_null($cms) && count($cms->uploads))
                        @foreach($cms->uploads()->whereFileType(1)->get() as $upload)
                            @if( $upload->file_type == 1 )
                            <div class="col-sm-2">
                                <a href="JavaScript:void(0);" data-destroy-route="{{route("cms.img-remove", ['id' => $upload->id])}}" data-upload-id="{{$upload->id}}" class="delete-gallery-image del-dutton-pro btn btn-link"><i class="fas fa-trash mr-3 action-icon-size"></i></a>
                                <img class="img-thumbnail custom-image-thumbnil" src="{{url('uploads').'/'.$upload->file_name}}" alt="Product">
                            </div>
                                @endif
                        @endforeach
                        @endif
                    </div>
                </div>    
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    <!-- /cms content -->
</div>
<!-- /content area -->
@endsection
@section('scripts')
@include('view::scripts.common')
@endsection