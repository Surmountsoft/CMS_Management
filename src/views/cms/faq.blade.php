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
            <div class="card user-wrapper visits">
                {!! Form::open(['route' => 'cms.create.faq', 'method' => 'post', 'files' => true, 'id'=>'create-cms']) !!}
                @csrf
                <div class="card-header header-elements-inline">
                    <h5 class="card-title">{{trans('tran::views.faq')}}</h5>
                    <div class="header-elements">
                        <div class="text-right add-btn-wrapper">
                            <button type="submit" class="btn btn-primary ml-2 btn-submit-cancel">{{trans('tran::views.submit')}}</button>
                        </div>
                    </div>        
                </div>

                @if(count($cms) <= 0)
                  <input type="hidden" name="total_children" class="total-children" value="2">
                  <div id="field">
                    <div class="clone-row" style="display: none;">
                        <div  class="card card-margin first-child m-3"> 
                          <span class="remove-visit delete-faq"><i class="far addmore-remove-icon fa-times-circle error  pointer"></i></span>
                            <div class="row card-body">
                                <div class="col-md-12 visits-row">
                                    <fieldset>                            
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label class="font-weight-semibold text-default">{{trans('tran::views.question')}}<sup class="error">*</sup></label>
                                                <input type="text" placeholder="{{trans('tran::views.question')}}" class="form-control question" name="">
                                            </div>                              
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-md-12 custom-form-width">
                                                <label class="font-weight-semibold text-default">{{trans('tran::views.answer')}}<sup class="error">*</sup></label>
                                                <div class="form-group">
                                                    {{ Form::textarea('answer', null, ['class'=>'form-control answer'] ) }}
                                                </div>
                                          </div>                               
                                        </div>
                                    </fieldset>                     
                                </div>
                            </div>                
                        </div>
                    </div>
                    <div class="card card-margin first-child m-3">
                      <div class="row card-body ">
                            <div class="col-md-12 visits-row">
                                <fieldset>                            
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label class="font-weight-semibold text-default">{{trans('tran::views.question')}}<sup class="error">*</sup></label>
                                            <input type="text" placeholder="{{trans('tran::views.question')}}" class="form-control" name="faq[1][question]">
                                        </div>                               
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-md-12 custom-form-width">
                                            <label class="font-weight-semibold text-default">{{trans('tran::views.answer')}}<sup class="error">*</sup></label>
                                            <div class="form-group">
                                                {{ Form::textarea('faq[1][answer]', null, ['class'=>'form-control'] ) }}
                                            </div>
                                        </div>                               
                                    </div>
                                </fieldset>
                            </div>
                        </div>
                    </div>
                  </div>                   
                  <div class="form-group">
                      <div class="col-md-12">
                          <button id="add-more" name="add-more"
                                  class="btn btn-primary float-right m-2">{{trans('tran::views.add_attribute', ['attribute' => 'More'])}}</button>
                      </div>
                  </div>
                  @else
                  <div id="field">
                    <div class="clone-row" style="display: none;">
                        <div  class="card card-margin first-child m-3"> 
                          <span class="remove-visit delete-faq"><i class="far addmore-remove-icon fa-times-circle error  pointer"></i></span>
                            <div class="row card-body">
                                <div class="col-md-12 visits-row">
                                    <fieldset>                            
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label class="font-weight-semibold text-default">{{trans('tran::views.question')}}<sup class="error">*</sup></label>
                                                <input type="text" placeholder="{{trans('tran::views.question')}}" class="form-control question" name="">
                                            </div>                              
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-md-12 custom-form-width">
                                                <label class="font-weight-semibold text-default">{{trans('tran::views.answer')}}<sup class="error">*</sup></label>
                                                <div class="form-group">
                                                    {{ Form::textarea('answer', null, ['class'=>'form-control answer'] ) }}
                                                </div>
                                          </div>                               
                                        </div>
                                    </fieldset>                     
                                </div>
                            </div>                
                        </div>
                    </div>
                  <input type="hidden" name="total_children" class="total-children" value="{{count($cms)+1}}">
                  @foreach($cms as $faq)
                  <input type="hidden" name="faq[{{$loop->iteration}}][cms_id]" value="{{$faq->id}}">
                  <div class="card card-margin first-child m-3">
                    <span class="delete-faq remove-faq" data-destroy-route="{{route('cms.delete.faq',['id'=>$faq->id])}}" ><i class="far addmore-remove-icon fa-times-circle error  pointer"></i></span>
                      <div class="row card-body ">
                            <div class="col-md-12 visits-row">
                                <fieldset> 
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label class="font-weight-semibold text-default">{{trans('tran::views.question')}}<sup class="error">*</sup></label>
                                            <input type="text" placeholder="{{trans('tran::views.question')}}" class="form-control question" name="faq[{{$loop->iteration}}][question]" value="{{!is_null($faq->question) ? $faq->question : null}}">
                                        </div>                              
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-md-12 custom-form-width">
                                            <label class="font-weight-semibold text-default">{{trans('tran::views.answer')}}<sup class="error">*</sup></label>
                                            <div class="form-group">
                                                {{ Form::textarea('faq['.$loop->iteration.'][answer]', !is_null($faq) && !is_null($faq->content) ? $faq->content : null, ['class'=>'form-control answer'] ) }}
                                            </div>
                                        </div>                               
                                    </div>                           
                                </fieldset>
                            </div>
                        </div>
                    </div>
                    @endforeach
                  </div>
                  <div class="form-group">
                      <div class="col-md-12">
                          <button id="add-more" name="add-more"
                                  class="btn btn-primary float-right m-2">{{trans('tran::views.add_attribute', ['attribute' => 'More'])}}</button>
                      </div>
                  </div>
                  @endif    
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