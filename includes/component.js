var showProgressAjax = true;

$(document).ready(function () {
//    datepicker function
    var date_input = $('input[class="datepickerx"]');
    var container = $('.bootstrap-iso form').length > 0 ? $('.bootstrap-iso form').parent() : "body";
    var options = {
        format: 'mm/dd/yyyy',
        container: container,
        todayHighlight: true,
        autoclose: true,
    };
    date_input.datepicker(options);

    $(function () {
        $('[data-provide="singledatepicker"]').daterangepicker({
            singleDatePicker: true,
            showDropdowns: true
        });
    });

})

var _loadingLogo = -1;
function ajaxindicatorstart(text) {
    if (!showProgressAjax)
        return;
    if (jQuery('body').find('#resultLoading').attr('id') !== 'resultLoading') {
        jQuery('body').append('<div id="resultLoading" style="display:none"><div><img id="loadingLogo" width="150px" src="assets/img/loading/load1.gif"><br>' + text + '</div><div class="bg"></div></div>');
    }

    jQuery('#resultLoading').css({
        'width': '100%',
        'height': '100%',
        'position': 'fixed',
        'z-index': '10000000',
        'top': '0',
        'left': '0',
        'right': '0',
        'bottom': '0',
        'margin': 'auto'
    });
    jQuery('#resultLoading .bg').css({
        'background': '#000000',
        'opacity': '0.7',
        'width': '100%',
        'height': '100%',
        'position': 'absolute',
        'top': '0'
    });
    jQuery('#resultLoading>div:first').css({
        'width': '250px',
        'height': '75px',
        'text-align': 'center',
        'position': 'fixed',
        'top': '0',
        'left': '0',
        'right': '0',
        'bottom': '0',
        'margin': 'auto',
        'font-size': '16px',
        'z-index': '10',
        'color': '#ffffff'
    });
    jQuery('#resultLoading .bg').height('100%');
    jQuery('#resultLoading').fadeIn(300);
    jQuery('body').css('cursor', 'wait');
    _loadingLogo = 0.0;
    setTimer();
}

var ubah = 0;
function setTimer() {
    setTimeout(function () {
        if (_loadingLogo == -1) {
            return false;
        }
        _loadingLogo += ubah;
        if (_loadingLogo >= 1.0) {
            ubah = -0.1;
        }
        if (_loadingLogo <= 0.0) {
            ubah = 0.1;
        }
        $("#loadingLogo").css("opacity", _loadingLogo);
        setTimer();
    }, 50);
}

function ajaxindicatorstop() {
    _loadingLogo = -1;
    if (!showProgressAjax)
        return;
    $('#resultLoading').remove();
    jQuery('#resultLoading .bg').height('100%');
    jQuery('#resultLoading').fadeOut(300);
    jQuery('body').css('cursor', 'default');
}


function updateData(url, id, tgtback) {
    location = url + '?id=' + id + '&tgtback=' + tgtback + '.php';
}

function deleteData(tgtAjax, id) {
    ajaxindicatorstart('Sila Tunggu');
    $.post(tgtAjax, {id: id, action: 'delete'}, function (result) {
        ajaxindicatorstop()
        if (result == 1) {
            bootbox.alert('Berjaya', function () {
                location.reload();
            });
        } else {
            bootbox.alert('Gagal');
        }
    })
}

var __count_getSelectOptionsCustom3 = 0;
function getSelectOptionsCustom3(id, tgtAjax, selectedValue, callback, template, template2) {
//request the JSON data and parse into the select element
    ajaxindicatorstart("Data sedang muat turun, Sila Tunggu");
    __count_getSelectOptionsCustom3++;
    $.ajax({
        url: tgtAjax,
        type: "GET",
        dataType: 'JSON',
        global: false,
        success: function (data) {
            __count_getSelectOptionsCustom3--;
            if (__count_getSelectOptionsCustom3 <= 0) {
                ajaxindicatorstop();
            }
            //clear the current content of the select
            $('#' + id).html('');
            $('#' + id).append('<option value="">SILA PILIH</option>');
            //iterate over the data and append a select option
            $.each(data, function (key, val) {
                //console.log(selectedValue+"=="+val.value);
                var isSelected = (val.value.toString() === selectedValue.toString()) ? "selected" : "";
                $('#' + id).append('<option value="' + val.value + '" ' + isSelected + '>' + val.name + '</option>');
            });
            if (template && template2) {
                $('#' + id).select2({
                    placeholder: "SILA PILIH",
                    allowClear: true,
                    templateSelection: template,
                    templateResult: template2,
                    escapeMarkup: function (text) {
                        return text;
                    }
                });
            } else if (template && !template2) {
                $('#' + id).select2({
                    placeholder: "SILA PILIH",
                    allowClear: true,
                    templateSelection: template,
                    escapeMarkup: function (text) {
                        return text;
                    }
                });
            } else {
                $('#' + id).select2({
                    placeholder: "SILA PILIH",
                    allowClear: true
                });
            }
            if (callback) {
                callback(id);
            }
        },
        error: function (e) {
            console.log(e);
            //if there is an error append a 'none available' option
            $('#' + id).html('<option id="-1">TIADA MAKLUMAT</option>');
            __count_getSelectOptionsCustom2--;
            if (__count_getSelectOptionsCustom2 <= 0) {
                ajaxindicatorstop();
            }
        }
    });
}

