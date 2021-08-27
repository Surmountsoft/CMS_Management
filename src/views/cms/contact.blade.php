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
                {!! Form::open(['route' => 'cms.create.contact', 'method' => 'post', 'files' => true, 'id'=>'create-cms']) !!}
                @csrf
                <div class="card-header header-elements-inline">
                    <h5 class="card-title">{{trans('tran::views.contact')}}</h5>
                    <div class="header-elements">
                        <div class="text-right add-btn-wrapper">
                            <button type="submit" class="btn btn-primary ml-2 btn-submit-cancel">{{trans('tran::views.submit')}}</button>
                        </div>
                    </div>        
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <input type="hidden" name="cms_id" value="{{ !is_null($cms) ? $cms->id : null }}">
                            {{ Form::textarea('content', !is_null($cms) && !is_null($cms->content) ? $cms->content : null, ['class'=>'ckeditor form-control'] ) }}
                        </div>
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