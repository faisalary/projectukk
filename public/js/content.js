$('.breadcumbs-header-custom').each(function () {
    $(this).find('ol').find('li:last-child').addClass('active');
});

$(document).on("keydown", ":input:not(textarea)", function (event) {
    if (event.key == "Enter") {
        event.preventDefault();
    }
});

$(document).on('keyup change paste', '.default-form input, .default-form select, .default-form textarea', function () {
    if ($(this).attr('type') == 'radio' || $(this).attr('type') == 'checkbox') {
        let nameElement = $(this).attr('name');
        $(`[name="${nameElement}"]`).each(function () {
            $(this).removeClass('is-invalid');
        });
    } else {
        $(this).removeClass("is-invalid");
    }
    $(this).parents(".form-group").find(".invalid-feedback").html(null).removeClass("d-block");
});

$(document).ready(function () {
    initAllComponents();
});

function initAllComponents() {
    initSelect2();
    initPopOver();
    initTooltips();
}

function initSelect2() {
    $('.select2_custom').each(function () {
        $(this).wrap('<div class="position-relative"></div>');
        $(this).select2({
            tags: $(this).attr('data-tags') === 'true' ?? false,
            allowClear: true,
            placeholder: $(this).attr('data-placeholder') ?? null,
            dropdownAutoWidth: true,
            width: '100%',
            dropdownParent: $(this).parent(),
        });
    });
}

function initPopOver() {
    const popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
    const popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
        return new bootstrap.Popover(popoverTriggerEl);
    });
}

function initTooltips() {
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    const tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
}

function btnBlock(element, bool = true) {
    if (bool) {
        element.block({
            message: '<div class="spinner-border text-light" role="status"></div>',
            css: {
                backgroundColor: 'transparent',
                color: '#fff',
                border: '0'
            },
            overlayCSS: {
                opacity: 0.5
            }
        });
    } else {
        element.unblock();
    }
}

function pageBlock(bool = true) {
    if (bool) {
        $.blockUI({
            message: '<div class="d-flex justify-content-center"><p class="mb-0">Sedang memproses...</p> <div class="sk-wave m-0"><div class="sk-rect sk-wave-rect"></div> <div class="sk-rect sk-wave-rect"></div> <div class="sk-rect sk-wave-rect"></div> <div class="sk-rect sk-wave-rect"></div> <div class="sk-rect sk-wave-rect"></div></div> </div>',
            css: {
                backgroundColor: 'transparent',
                color: '#fff',
                border: '0'
            },
            overlayCSS: {
                opacity: 0.5
            }
        });
    } else {
        $.unblockUI();
    }
}

function sweetAlertConfirm(config, callback) {
    let title, text, icon, confirmButtonText, cancelButtonText;

    title = config.title ?? 'Are you sure?';
    text = config.text ?? "You won't be able to revert this!";
    icon = config.icon ?? 'warning';
    confirmButtonText = config.confirmButtonText ?? 'Yes, I do!';
    cancelButtonText = config.cancelButtonText ?? 'No, cancel!';

    return Swal.fire({
        html: '<h3>' + title + '</h3><p>' + text + '</p>',
        icon: icon,
        showCancelButton: true,
        confirmButtonText: confirmButtonText,
        customClass: {
            confirmButton: 'btn btn-primary me-3',
            cancelButton: 'btn btn-label-secondary'
        },
        buttonsStyling: false
    }).then(function (result) {
        if (result.isConfirmed) callback();
    });
}

function showSweetAlert(config) {
    let title, text, icon;

    title = config.title ?? '';
    text = config.text ?? 'The action was executed successfully.';
    icon = config.icon ?? 'success';

    return Swal.fire({
        html: '<h3>' + title + '</h3><p>' + text + '</p>',
        icon: icon,
        customClass: {
            confirmButton: 'btn btn-primary'
        }
    });
}

$(document).on("submit", ".default-form", function (event) {
    event.preventDefault();
    var button = $(this).find(":submit");
    btnBlock(button);
    store_data(this, button);
});

function store_data(content, button) {
    $("input").blur();

    $(content).find('.is-invalid').removeClass('is-invalid');
    $(content).find('.invalid-feedback').html(null).removeClass('d-block');

    let form_data = new FormData(content);
    let action = $(content).attr("action");
    let callback = $(content).attr("function-callback") ?? null;

    $.ajax({
        url: action,
        type: "POST",
        data: form_data,
        processData: false, // tell jQuery not to process the data
        contentType: false, // tell jQuery not to set contentType
        cache: false,
        success: function (response) {
            btnBlock(button, false);
            if (!response.error) {
                showSweetAlert({
                    title: 'Berhasil!',
                    text: response.message,
                    icon: 'success'
                });

                if (typeof window[callback] === "function") window[callback](response);
            } else {
                showSweetAlert({
                    title: 'Gagal!',
                    text: response.message,
                    icon: 'error'
                });
            }
        },
        error: (xhr, status, error) => {
            btnBlock(button, false);
            let res = xhr.responseJSON;
            if (res.errors) {
                $.each(res.errors, function (key, value) {
                    key = key.replace(/\.(\d+)\.(\w+)/g, "[$1][$2]");
                    // key = key.replace(/\./g, '[') + ']';
                    $(`[name="${key}"]`, content).addClass('is-invalid');
                    $(`[name="${key}"]`, content).parents('.form-group').find('.invalid-feedback').html(value[0]).addClass('d-block');
                });
            } else {
                showSweetAlert({
                    title: 'Gagal!',
                    text: "Terjadi kesalahan pada server, silahkan coba lagi nanti.",
                    icon: 'error'
                });
            }
        },
    }).always(function () {
        btnBlock(button, false);
    });
}

$('.modal').on('hide.bs.modal', function () {
    let form = $(this).find('form');

    form.trigger('reset');
    form.find('.select2').val(null).trigger('change');
    form.find('.select2_custom').val(null).trigger('change');
    form.find('.is-invalid').removeClass('is-invalid');
    form.find('.invalid-feedback').html(null).removeClass('d-block');
});

$('.update-status').on('click', function () {
    let id = $(this).data('id');
    let url = $(this).data('url');

    sweetAlertConfirm({
        title: 'Apakah anda yakin?',
        text: 'Anda akan mengubah status data ini.',
        icon: 'warning',
        confirmButtonText: 'Ya, saya yakin!',
        cancelButtonText: 'Batal'
    }, function () {
        $.ajax({
            url: url,
            type: "POST",
            data: {
                id: id,
            },
            success: function (response) {
                if (!response.error) {
                    showSweetAlert({
                        title: 'Berhasil!',
                        text: response.message,
                        icon: 'success'
                    });
                    setTimeout(function () {
                        location.reload();
                    }, 1000);
                } else {
                    showSweetAlert({
                        title: 'Gagal!',
                        text: response.message,
                        icon: 'error'
                    });
                }
            },
            error: function (xhr, status, error) {
                let res = xhr.responseJSON;
                showSweetAlert({
                    title: 'Gagal!',
                    text: res.message,
                    icon: 'error'
                });
            }
        });
    });
});