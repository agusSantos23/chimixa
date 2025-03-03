"use strict";

let KTModalCustomersAdd = function () {
  let t, e, o, n, r, i, ingredientId = null, tagifyInstance = null;

  const baseURL = window.location.origin + '/chimixa/public/';

  return {
    init: function () {
      i = new bootstrap.Modal(document.querySelector("#kt_modal_add_customer"));
      r = document.querySelector("#kt_modal_add_customer_form");
      t = r.querySelector("#kt_modal_add_customer_submit");
      e = r.querySelector("#kt_modal_add_customer_cancel");
      o = r.querySelector("#kt_modal_add_customer_close");


      n = FormValidation.formValidation(r, {
        fields: {
          name: {
            validators: {
              notEmpty: {
                message: "Name is required"
              }
            }
          },
          quantityAvailabe: {
            validators: {
              notEmpty: {
                message: "A minimum amount is required"
              }
            }
          },
          measure: {
            validators: {
              notEmpty: {
                message: "Required to indicate a measure"
              }
            }
          },
          price: {
            validators: {
              notEmpty: {
                message: "Price is required"
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



      t.addEventListener("click", function (e) {
        e.preventDefault();

        n && n.validate().then(function (e) {

          if ("Valid" === e) {

            t.setAttribute("data-kt-indicator", "on");
            t.disabled = true;


            const formData = new FormData(r);

            const url = ingredientId ? baseURL + 'ingredients/update/' + ingredientId : baseURL + 'ingredients/save';

            $.ajax({
              url: url,
              type: 'POST',
              data: formData,
              contentType: false,
              processData: false,
              success: function (response) {

                t.removeAttribute("data-kt-indicator");
                $('#validation-errors').hide().empty();


                Swal.fire({
                  text: response.message,
                  icon: "success",
                  buttonsStyling: false,
                  confirmButtonText: "OK, understood!",
                  customClass: {
                    confirmButton: "btn btn-primary"
                  }

                }).then(function (e) {

                  if (e.isConfirmed) location.reload();

                });
              },
              error: function (xhr) {
                t.removeAttribute("data-kt-indicator");
                t.disabled = false;

                let response = xhr.responseJSON;
                let errorMessages = '';

                if (response && response.errors) {
                  for (const [field, messages] of Object.entries(response.errors)) {
                    errorMessages += `<p>${messages}</p>`;
                  }
                } else {
                  errorMessages = 'Sorry, there were some errors. Please try again.';
                }

                $('#validation-errors').html(errorMessages).show();
              }
            });



          } else {


            Swal.fire({
              text: "Sorry, there were some errors. Please try again.",
              icon: "error",
              buttonsStyling: false,
              confirmButtonText: "OK, understood!",
              customClass: {
                confirmButton: "btn btn-primary"
              }
            });
          }
        });



      });

      e.addEventListener("click", function (t) {
        t.preventDefault();
        Swal.fire({
          text: "Are you sure you want to cancel?",
          icon: "warning",
          showCancelButton: true,
          buttonsStyling: false,
          confirmButtonText: "Yes, cancel it!",
          cancelButtonText: "No, go back",
          customClass: {
            confirmButton: "btn btn-primary",
            cancelButton: "btn btn-active-light"
          }
        }).then(function (t) {
          if (t.value) {

            location.reload();

          } else if ("cancel" === t.dismiss) {
            Swal.fire({
              text: "Your form has not been canceled!",
              icon: "error",
              buttonsStyling: false,
              confirmButtonText: "OK, understood!",
              customClass: {
                confirmButton: "btn btn-primary"
              }
            });
          }
        });
      });

      o.addEventListener("click", function (t) {
        t.preventDefault();
        Swal.fire({
          text: "Are you sure you want to cancel?",
          icon: "warning",
          showCancelButton: true,
          buttonsStyling: false,
          confirmButtonText: "Yes, cancel it!",
          cancelButtonText: "No, go back",
          customClass: {
            confirmButton: "btn btn-primary",
            cancelButton: "btn btn-active-light"
          }
        }).then(function (t) {
          if (t.value) {

            location.reload();

          } else if ("cancel" === t.dismiss) {
            Swal.fire({
              text: "Your form has not been canceled!",
              icon: "error",
              buttonsStyling: false,
              confirmButtonText: "OK, understood!",
              customClass: {
                confirmButton: "btn btn-primary"
              }
            });
          }
        });
      });



      this.editEvent();
      this.configurationInputs();

    },

    configurationInputs: function () {

      if (!tagifyInstance) {
        tagifyInstance = new Tagify(document.querySelector("#kt_tagify"), {
          whitelist: ["gluten", "crustaceans", "eggs", "fish", "peanuts", "soy", "milk", "tree nuts", "celery", "mustard", "sesame",
            "sulfites", "lupins", "mollusks", "corn", "coconut", "legumes", "seeds", "fruit", "vegetables", "bee products", "red meat",
            "chicken", "gelatin", "yeast", "food additives"],
          maxTags: 10,
          dropdown: {
            maxItems: 26,
            classname: "tagify__inline__suggestions",
            enabled: 0,
            closeOnSelect: false
          }
        });
      }

      $("#kt_flatpickr").flatpickr(
        {
          dateFormat: "d/m/Y",
        }
      );


    },
    editEvent: function () {
      document.querySelectorAll('[data-kt-role-table-filter="edit_row"]').forEach((e) => {

        e.addEventListener("click", function (e) {

          e.preventDefault();

          ingredientId = $(this).data('id');

          $.ajax({
            url: baseURL + 'ingredients/get/' + ingredientId,
            type: 'GET',
            success: function (response) {

              if (response.success) {

                $('#kt_modal_add_customer_form #kt_modal_add_customer_header h2').text("Edit Menu");

                $('#kt_modal_add_customer_form input[name="name"]').val(response.success.name);

                $('#kt_modal_add_customer_form input[name="price"]').val(response.success.price);

                $('#kt_modal_add_customer_form input[name="quantityAvailabe"]').val(response.success.quantity_available);

                $('#kt_modal_add_customer_form select[name="measure"]').val(response.success.measure);

                if (response.success.allergens && response.success.allergens.length > 0 && tagifyInstance) {
                  
                  tagifyInstance.addTags(JSON.parse(response.success.allergens));
                  
                }

                if (response.success.expiration_date) {
                  $("#kt_flatpickr").flatpickr({
                    dateFormat: "d/m/Y",
                    defaultDate: response.success.expiration_date,  
                  });

                } else {
                  
                  $("#kt_flatpickr").flatpickr({
                    dateFormat: "d/m/Y",
                  });
                }


                i.show();
              } else {

                Swal.fire({
                  text: 'Error loading role data',
                  icon: 'error',
                  confirmButtonText: 'OK',
                  customClass: { confirmButton: 'btn btn-primary' }
                });
              }
            },
            error: function (response) {
              Swal.fire({
                text: response.responseJSON.errors || 'There was a problem loading ingredient data',
                icon: 'error',
                confirmButtonText: 'OK',
                customClass: { confirmButton: 'btn btn-primary' }
              });
            }
          });
        });
      });
    }





  };
}();

KTUtil.onDOMContentLoaded(function () {
  KTModalCustomersAdd.init();
});
