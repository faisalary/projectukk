(function () {
    function store_data(content, button) {
        $("input").blur();
        let form_data = new FormData(content);
        let action = $(content).attr("action");
        $.ajax({
            url: action,
            type: "POST",
            data: form_data,
            processData: false, // tell jQuery not to process the data
            contentType: false, // tell jQuery not to set contentType
            cache: false,
            success: function (response) {
                if (response.error) {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Something went wrong!",
                        customClass: {
                            confirmButton: "btn btn-success",
                            cancelButton: "btn btn-danger",
                        },
                        buttonsStyling: false,
                    });
                } else {
                    Swal.fire({
                        // position: "top-end",
                        type: "success",
                        icon: "success",
                        title: "Succeed!",
                        text: response.message,
                        showConfirmButton: false,
                        timer: 2000,
                    }).then(() => {
                        if (response.modal) {
                            if (response.table)
                                setTimeout(function () {
                                    $(response.table).DataTable().ajax.reload();
                                }, 1000);
                            var reset_form = content;
                            // $(reset_form).removeClass('was-validated');
                            reset_form.reset();
                            $(response.modal).modal("hide");
                            if (typeof matrix === "function") matrix();
                        } else {
                            if (response.url) {
                                location = response.url;
                            } else {
                                location.reload();
                            }
                        }
                    });
                }
            },
            error: (xhr, status, error) => {
                // Swal.fire({
                //     icon: "error",
                //     title: "Oops... Some data are still missing! ",
                //     text: "Please fill out all required fields.",
                // });

                const { responseJSON: response } = xhr;

                if (response.errors) {
                    for (let form_data in response.errors) {
                        let form_name = form_data.replace(
                            /\.(\d+)\.(\w+)/g,
                            "[$1][$2]"
                        );

                        $(`[name^="${form_name}"]`, content).addClass(
                            "is-invalid"
                        );
                        $(`[name^="${form_name}"]`, content)
                            .parents(".form-input")
                            .find(".invalid-feedback")
                            .addClass("d-block");
                        $(`[name^="${form_name}"]`, content)
                            .parents(".form-input")
                            .find(".invalid-feedback")
                            .html(response.errors[form_data][0]);
                        $(`[name^="${form_name}"]`, content)
                            .parents(".form-input")
                            .find(".invalid-tooltip")
                            .html(response.errors[form_data][0]);
                    }
                } else {
                    Swal.fire({
                        title: "Error",
                        text: response.message,
                        icon: "error",
                        heightAuto: false,
                        customClass: {
                            confirmButton: "btn btn-success",
                            cancelButton: "btn btn-danger",
                        },
                        buttonsStyling: false,
                    });
                }
            },
        }).always(function () {
            button.prop("disabled", false);
            button.text("Save Data");
        });
    }

    function delete_data(content, args) {
        const { url, id } = args;
        const context = $(content).attr("context");
        let action = url + "/" + id;

        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            confirmButtonText: "Yes, delete it!",
            showCancelButton: true,
            showConfirmButton: true,
            customClass: {
                confirmButton: "btn btn-success",
                cancelButton: "btn btn-danger",
            },
            buttonsStyling: false,
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "DELETE",
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                            "content"
                        ),
                    },
                    url: action,
                    success: function (response) {
                        if (response.error) {
                            Swal.fire({
                                icon: "error",
                                title: "Oops...",
                                text: response.message,
                                customClass: {
                                    confirmButton: "btn btn-success",
                                    cancelButton: "btn btn-danger",
                                },
                                buttonsStyling: false,
                            });
                        } else {
                            Swal.fire({
                                title: response.table ? "Deleted!" : "Info",
                                text: response.message,
                                icon: "success",
                                showConfirmButton: false,
                                timer: 2000,
                            }).then(() => {
                                if (response.table) {
                                    setTimeout(function () {
                                        $(response.table)
                                            .DataTable()
                                            .ajax.reload();
                                    }, 1000);
                                }
                                if (typeof matrix === "function") matrix();
                            });
                        }
                    },
                });
            }
        });
    }

    function status(e, args) {
        const { url, id } = args;
        let action = url + "/" + id;
        var status = $(e).attr("data-status");
        var text = "";
        if (status == 0) {
            text = "Active";
        } else {
            text = "Inactive";
        }
        Swal.fire({
            title: "Are you sure?",
            text: "The selected data will be " + text,
            icon: "warning",
            confirmButtonText: "Yes, " + text + "!",
            showConfirmButton: true,
            showCancelButton: true,
            customClass: {
                confirmButton: "btn btn-success",
                cancelButton: "btn btn-danger",
            },
            buttonsStyling: false,
        }).then(function (result) {
            if (result.value) {
                var id = $(e).attr("data-id");
                let data = {
                    id: id,
                };
                jQuery.ajax({
                    method: "POST",
                    data: data,
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                            "content"
                        ),
                    },
                    url: action,
                    success: function (data) {
                        if (data.error) {
                            Swal.fire({
                                type: "error",
                                title: "Oops...",
                                text: data.message,
                                confirmButtonClass: "btn btn-success",
                            });
                        } else {
                            setTimeout(function () {
                                $(data.table).DataTable().ajax.reload();
                            }, 1000);

                            Swal.fire({
                                icon: "success",
                                title: "Succeed!",
                                text: data.message,
                                showConfirmButton: false,
                                timer: 2000,
                            });
                        }
                    },
                });
            }
        });
    }

    $(document).on("submit", ".default-form", function (event) {
        event.preventDefault();
        var button = $(this).find(":submit");
        button.prop("disabled", true);
        button.text("Saving...");
        store_data(this, button);
    });

    $(document).on("click", ".delete-data", function () {
        delete_data(this, {
            url: $(this).attr("data-url"),
            id: $(this).attr("data-id"),
        });
    });

    $(document).on("click", ".update-status", function () {
        status(this, {
            url: $(this).attr("data-url"),
            id: $(this).attr("data-id"),
        });
    });

    $("form input").on("keyup change paste", function () {
        $(this).removeClass("is-invalid");
        $(this)
            .parents(".form-input")
            .find(".invalid-feedback")
            .removeClass("d-block");
    });

    $("form textarea").on("keyup change paste", function () {
        $(this).removeClass("is-invalid");
        $(this)
            .parents(".form-input")
            .find(".invalid-feedback")
            .removeClass("d-block");
    });

    $("select").on("change", function () {
        $(this).removeClass("is-invalid");
        $(this)
            .parents(".form-input")
            .find(".invalid-feedback")
            .removeClass("d-block");
    });

    $("select").on("change", function () {
        $(this).removeClass("is-invalid");
        $(this)
            .parents(".form-input")
            .find(".invalid-feedback")
            .removeClass("d-block");
    });

    $(document).on("keydown", ":input:not(textarea)", function (event) {
        if (event.key == "Enter") {
            event.preventDefault();
        }
    });

    
   
})();
