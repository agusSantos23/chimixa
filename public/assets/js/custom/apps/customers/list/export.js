"use strict";

var KTCustomersExport = function() {
    var t, e, n, o, r, i, a;

    return {
        init: function() {
            t = document.querySelector("#kt_customers_export_modal");
            a = new bootstrap.Modal(t);
            i = document.querySelector("#kt_customers_export_form");
            e = i.querySelector("#kt_customers_export_submit");
            n = i.querySelector("#kt_customers_export_cancel");
            o = t.querySelector("#kt_customers_export_close");

            r = FormValidation.formValidation(i, {
                fields: {
                    date: {
                        validators: {
                            notEmpty: {
                                message: "Date range is required"
                            }
                        }
                    }
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    bootstrap: new FormValidation.plugins.Bootstrap5({
                        rowSelector: ".fv-row",
                        eleInvalidClass: "",
                        eleValidClass: ""
                    })
                }
            });

            e.addEventListener("click", function(t) {
                t.preventDefault();
                const n = i.querySelectorAll("input");

                n.forEach((t) => {
                    t.disabled = true;
                });

                if (r) {
                    r.validate().then(function(t) {
                        console.log("validated!");

                        if (t == "Valid") {
                            e.setAttribute("data-kt-indicator", "on");
                            e.disabled = true;

                            setTimeout(function() {
                                e.removeAttribute("data-kt-indicator");

                                Swal.fire({
                                    text: "Customer list has been successfully exported!",
                                    icon: "success",
                                    buttonsStyling: false,
                                    confirmButtonText: "Ok, got it!",
                                    customClass: {
                                        confirmButton: "btn btn-primary"
                                    }
                                }).then(function(t) {
                                    if (t.isConfirmed) {
                                        a.hide();
                                        e.disabled = false;
                                        n.forEach((t) => {
                                            t.disabled = false;
                                        });
                                    }
                                });
                            }, 2000);
                        } else {
                            Swal.fire({
                                text: "Sorry, looks like there are some errors detected, please try again.",
                                icon: "error",
                                buttonsStyling: false,
                                confirmButtonText: "Ok, got it!",
                                customClass: {
                                    confirmButton: "btn btn-primary"
                                }
                            }).then(function() {
                                n.forEach((t) => {
                                    t.disabled = false;
                                });
                            });
                        }
                    });
                }
            });

            n.addEventListener("click", function(t) {
                t.preventDefault();
                const e = i.querySelectorAll("input");

                e.forEach((t) => {
                    t.disabled = true;
                });

                Swal.fire({
                    text: "Are you sure you would like to cancel?",
                    icon: "warning",
                    showCancelButton: true,
                    buttonsStyling: false,
                    confirmButtonText: "Yes, cancel it!",
                    cancelButtonText: "No, return",
                    customClass: {
                        confirmButton: "btn btn-primary",
                        cancelButton: "btn btn-active-light"
                    }
                }).then(function(t) {
                    if (t.value) {
                        i.reset();
                        a.hide();
                        e.forEach((t) => {
                            t.disabled = false;
                        });
                    } else if (t.dismiss === "cancel") {
                        Swal.fire({
                            text: "Your form has not been cancelled!.",
                            icon: "error",
                            buttonsStyling: false,
                            confirmButtonText: "Ok, got it!",
                            customClass: {
                                confirmButton: "btn btn-primary"
                            }
                        }).then(function() {
                            e.forEach((t) => {
                                t.disabled = false;
                            });
                        });
                    }
                });
            });

            o.addEventListener("click", function(t) {
                t.preventDefault();
                const e = i.querySelectorAll("input");

                e.forEach((t) => {
                    t.disabled = true;
                });

                Swal.fire({
                    text: "Are you sure you would like to cancel?",
                    icon: "warning",
                    showCancelButton: true,
                    buttonsStyling: false,
                    confirmButtonText: "Yes, cancel it!",
                    cancelButtonText: "No, return",
                    customClass: {
                        confirmButton: "btn btn-primary",
                        cancelButton: "btn btn-active-light"
                    }
                }).then(function(t) {
                    if (t.value) {
                        i.reset();
                        a.hide();
                        e.forEach((t) => {
                            t.disabled = false;
                        });
                    } else if (t.dismiss === "cancel") {
                        Swal.fire({
                            text: "Your form has not been cancelled!.",
                            icon: "error",
                            buttonsStyling: false,
                            confirmButtonText: "Ok, got it!",
                            customClass: {
                                confirmButton: "btn btn-primary"
                            }
                        }).then(function() {
                            e.forEach((t) => {
                                t.disabled = false;
                            });
                        });
                    }
                });
            });

            (function() {
                const t = i.querySelector("[name=date]");
                $(t).flatpickr({
                    altInput: true,
                    altFormat: "F j, Y",
                    dateFormat: "Y-m-d",
                    mode: "range"
                });
            })();
        }
    };
}();

KTUtil.onDOMContentLoaded(function() {
    KTCustomersExport.init();
});
