<script type="text/javascript">
     $(document).ready(function(){

            $("#create-cms").validate(
            {
                ignore: [],
                debug: false,
                rules: { 
                    content:{
                        required: function() 
                        {
                         CKEDITOR.instances.content.updateElement();
                        },
                    }
                },
                messages:
                    {

                    content:{
                        required:"This field is required.",
                    }
                }
            });
        });

    	$(function () {
        // Defaults
	        var swalInit = swal.mixin({
	            buttonsStyling: false,
	            confirmButtonClass: 'btn btn-primary',
	            cancelButtonClass: 'btn btn-light'
	        });
            $('.fileinput-remove-button').hide();
            $('.fileinput-upload-button').hide();
            $('.file-upload-indicator').hide();
            $('.kv-file-upload').hide();
	        var message = '';
            var url = window.location.href;
            var lastPart = url.split("/").pop();
	        var cards = null;
	        var chart = null;
	        var amountChart = null;
	        var app = {
	            init: function () {
                    app.handleResponse();
                    app.deleteGalleryImage();
                    app.addVisiting();
                    app.deleteFaq();
	            },

            /*
             * add more visiting detail
             * */   
            addVisiting: function () {
                $(document).on('click', '#add-more', function (e) {
                    e.preventDefault();

                    let visitLocationLength = $('.total-children').val();
                    var str = $(this).parents('.visits').find('.clone-row').children().first().clone();
                    console.log(str);
                    str.find('.question').attr('name','faq['+visitLocationLength+'][question]');
                    str.find('.answer').attr('name','faq['+visitLocationLength+'][answer]');
                   
                    $('#field').append(str);
                    $('.total-children').val(parseInt(visitLocationLength)+1);
                });

                $(document).on('click', '.remove-visit', function (e) {
                    e.preventDefault();
                    $(this).parent().remove();

                });
            },

	        /**
             * Handle status response
             * */
            handleResponse: function (response, message, statusCode) {
                let notification = {};
                switch (statusCode) {
                    case 200:
                        notification.title = 'Success';
                        notification.text = message;
                        notification.addclass = 'bg-success border-success';
                        break;
                    case 201:
                        notification.title = 'Success';
                        notification.text = message;
                        notification.addclass = 'bg-success border-success';
                        break;
                    case 204:
                        notification.title = 'Success';
                        notification.text = message;
                        notification.addclass = 'bg-success border-success';
                        break;
                    case 404:
                        notification.title = 'Error';
                        notification.text = response.responseJSON.error;
                        notification.addclass = 'bg-danger border-danger';
                        break;
                    case 409:
                        notification.title = 'Error';
                        notification.text = message;
                        notification.addclass = 'bg-danger border-danger';
                        break;
                    case 422:
                        notification.title = 'Error';
                        notification.text = response.responseJSON.error;
                        notification.addclass = 'bg-danger border-danger';
                        break;
                    case 500:
                        notification.title = 'Error';
                        notification.text = response.responseJSON.error;
                        notification.addclass = 'bg-danger border-danger';
                        break;
                    case 598: // Network read timeout error
                        notification.title = 'Error';
                        notification.text = 'Please check your internet connection';
                        notification.addclass = 'bg-danger border-danger';
                        break;
                    default:

                }
                if (!$.isEmptyObject(notification)) {
                    notification.delay = 1500;
                    new PNotify(notification);
                }
            },

             /**
             * delete gallery image
             * */

             deleteGalleryImage: function (id) {
                $(document).on('click', '.delete-gallery-image', function (e) {
                    var parent = $(this).parent();
                    var id = $(this).data("upload-id");
                    var destroyRoute = $(this).data("destroy-route");
                    var message = '';
                    swalInit({
                        title: '{{trans('tran::messages.are_you_sure')}}',
                        text: '{{trans('tran::messages.you_are_going_to_action_this_attribute', ['action' => 'delete', 'attribute' => 'gallery image'])}}',
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonClass: 'btn btn-danger',
                        confirmButtonText: '{{trans('tran::views.delete')}}',
                        showLoaderOnConfirm: true,
                        preConfirm: function () {
                            $.ajax({
                                url: destroyRoute,
                                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                                processData: false,
                                contentType: false,
                                type: 'DELETE',
                                statusCode: {
                                    204: function (data) {
                                        parent.remove();
                                        message = '{{trans('tran::messages.attribute_action_successfully',['attribute' => trans('tran::views.image'), 'action' => 'deleted'])}}';
                                        app.handleResponse(data, message, 204);
                                    },
                                    404: function (data) {
                                        app.handleResponse(data, message, 404);
                                    },
                                    500: function (data) {
                                        app.handleResponse(data, message, 500);
                                    }
                                }
                            });
                        }
                    })
                });
            },

            /**
             * delete faq
             * */

            deleteFaq: function (id) {
                $(document).on('click', '.remove-faq', function (e) {
                    e.preventDefault();
                    var parent = $(this).parent();
                    var destroyRoute = $(this).data("destroy-route");
                    var message = '';
                    swalInit({
                        title: '{{trans('tran::messages.are_you_sure')}}',
                        text: '{{trans('tran::messages.you_are_going_to_action_this_attribute', ['action' => 'delete', 'attribute' => 'faq'])}}',
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonClass: 'btn btn-danger',
                        confirmButtonText: '{{trans('tran::views.delete')}}',
                        showLoaderOnConfirm: true,
                        preConfirm: function () {
                            $.ajax({
                                url: destroyRoute,
                                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                                processData: false,
                                contentType: false,
                                type: 'DELETE',
                                statusCode: {
                                    204: function (data) {
                                        parent.remove();
                                        message = '{{trans('tran::messages.attribute_action_successfully',['attribute' => trans('tran::views.faq'), 'action' => 'deleted'])}}';
                                        app.handleResponse(data, message, 204);
                                    },
                                    404: function (data) {
                                        app.handleResponse(data, message, 404);
                                    },
                                    500: function (data) {
                                        app.handleResponse(data, message, 500);
                                    }
                                }
                            });
                        }
                    })
                });
            },

	    };
        app.init();
    });

</script>