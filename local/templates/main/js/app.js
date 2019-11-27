var app = function () {

    'use strict';

    var formsHandler = function () {
        $(document).on('click', '.register-form-submit', function () {
            console.log(12345);
            var form = $(this).closest('form');
            var errors = false;
            form.find('input[type="text"]').each(function () {
                if (!$(this).val()) {
                    console.log($(this).attr('name'));
                    $(this).addClass('has-error');
                    errors = true;
                } else {
                    $(this).removeClass('has-error')
                }
            });
            if (errors) {
                return false;
            }
            var submit = false;
            var login = form.find('input[name="REGISTER[LOGIN]"]').val();
            var errorsContainer = $('.register-errors-container');
            $.ajax({
                type: "GET",
                url: '/local/modules/seoexpert.smsru/tools/get_login_type.php?login=' + login,
                timeout: 30000,
                async: false,
                dataType : "json",
                error: function(request,error) {
                    if (error == "timeout") {
                        alert('timeout');
                    }
                    else {
                        alert('Error! Please try again!');
                    }
                },
                success: function(data) {
                    console.log(data);
                    if (data.state == 'success') {
                        errorsContainer.hide();
                        form.find('input[name="UF_LOGIN_TYPE"]').val(data.type);
                        submit = true;
                    } else {
                        errorsContainer.html(data.message);
                        errorsContainer.show();
                    }
                }
            });
            if (!submit) {
                return false;
            }
        });
        $(document).on('click', '.confirm_code_form_submit', function () {
            var form = $(this).closest('form');
            var errorsContainer = $('.confirm_code_form_errors');
            var successContainer = $('.confirm_code_container-success');
            $.ajax({
                type: "GET",
                url: '/local/modules/seoexpert.smsru/tools/code_compare.php',
                data: form.serialize(),
                timeout: 30000,
                dataType : "json",
                error: function(request,error) {
                    if (error == "timeout") {
                        alert('timeout');
                    }
                    else {
                        alert('Error! Please try again!');
                    }
                },
                success: function(data) {
                    console.log(data);
                    if (data.state == 'success') {
                        errorsContainer.hide();
                        successContainer.show();
                    } else {
                        errorsContainer.html(data.message);
                        errorsContainer.show();
                    }
                }
            });
            return false;
        });
        $(document).on('change', 'input[name="UF_USER_TYPE"]', function () {
            var gruppa = $(this).data('grup');
            console.log(gruppa);
            if ($(this).data('type') == 'company') {
                $('#regform').hide();
                $('#regform-company').show();
                $('#regform-company input[name="GRUP"]').val(gruppa);
                $('#' + $(this).data('id') + '-c').click();
            } else {
                $('#regform-company').hide();
                $('#regform').show();
                $('#regform input[name="GRUP"]').val(gruppa);
                $('#' + $(this).data('id')).click();
            }
        });
    };

    var resumeHelper = function() {
        console.log('resumeHelper');
        $(document).on('change', '.end-data-checkbox', function () {
            if ($(this).prop('checked')) {
                $(this).closest('.form-groups').find('.end-data-container').hide();
            } else {
                $(this).closest('.form-groups').find('.end-data-container').show();
            }
        });
        $(document).on('click', '.add-work-position', function () {
            var counter = parseInt($(this).data('counter'));
            var newCounter = counter + 1;
            $.ajax({
                type: "GET",
                url: '/local/ajax/work_position_item.php?counter=' + counter,
                timeout: 30000,
                error: function(request,error) {
                    if (error == "timeout") {
                        alert('timeout');
                    }
                    else {
                        alert('Error! Please try again!');
                    }
                },
                success: function(data) {
                    $('.add-work-container').append(data);
                    $(document).find('.add-work-position').data('counter', newCounter);
                    $(document).find('input[name="WORK_COUNT"]').val(newCounter)
                }
            });
            return false;
        });
        $(document).on('click', '.edu-add', function () {
            var counter = parseInt($(this).data('counter'));
            var newCounter = counter + 1;
            $.ajax({
                type: "GET",
                url: '/local/ajax/edu_item.php?counter=' + counter,
                timeout: 30000,
                error: function(request,error) {
                    if (error == "timeout") {
                        alert('timeout');
                    }
                    else {
                        alert('Error! Please try again!');
                    }
                },
                success: function(data) {
                    $('.add-edu-container').append(data);
                    $(document).find('.edu-add').data('counter', newCounter);
                    $(document).find('input[name="EDU_COUNT"]').val(newCounter)
                }
            });
            return false;
        });
        $(document).on('click', '.step-back-btn', function () {
            var errors = false;
            $(this).closest('.step-item').find('input[type="text"]').each(function () {
                if ($(this).data('req') && !$(this).val()) {
                    errors = true;
                    $(this).addClass('has-errors');
                } else {
                    $(this).removeClass('has-errors');
                }
            });
            if (errors) {
                return false;
            }
            var step = $(this).data('step');
            $(this).closest('.step-item').hide();
            $(this).closest('form').find('.step-item-' + step).show();
            $(document).find('.steps__item').each(function () {
                $(this).removeClass('steps__item-active');
                if ($(this).data('step') == step) {
                    $(this).addClass('steps__item-active');
                }
            });
            return false;
        });
        $(document).on('click', '.accept-step-btn', function () {
            var errors = false;
            $(this).closest('.step-item').find('input[type="text"]').each(function () {
                if ($(this).data('req') && !$(this).val()) {
                    errors = true;
                    $(this).addClass('has-errors');
                } else {
                    $(this).removeClass('has-errors');
                }
            });
            if (errors) {
                return false;
            }
            var step = $(this).data('step');
            $(this).closest('.step-item').hide();
            $(this).closest('form').find('.step-item-' + step).show();
            $(document).find('.steps__item').each(function () {
                $(this).removeClass('steps__item-active');
                if ($(this).data('step') == step) {
                    $(this).addClass('steps__item-active');
                }
            });
            return false;
        });
        $(document).on('click', '.resume-preview-btn', function () {
            $(this).closest('.form-bottom').find('input[type="submit"]').click();
        })
    };

    return {
        init: function () {
            formsHandler();
            resumeHelper();
        }
    };
}();

$(document).ready(function () {
    app.init();
});
