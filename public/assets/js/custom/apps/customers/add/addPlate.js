"use strict";

let KTModalCustomersAdd = function () {
  let t, e, o, n, r, i, plateId = null, ingredientCheckboxes, selectedIngredients = [];

  const baseURL = window.location.origin + '/chimixa/public/';

  return {
    init: function () {
      i = new bootstrap.Modal(document.querySelector("#kt_modal_add_customer"));
      r = document.querySelector("#kt_modal_add_customer_form");
      t = r.querySelector("#kt_modal_add_customer_submit");
      e = r.querySelector("#kt_modal_add_customer_cancel");
      o = r.querySelector("#kt_modal_add_customer_close");
      ingredientCheckboxes = r.querySelectorAll('.select-ingredient');

      
      n = FormValidation.formValidation(r, {
        fields: {
          name: {
            validators: {
              notEmpty: {
                message: "Name is required"
              }
            }
          },
          description: {
            validators: {
              notEmpty: {
                message: "Description is required"
              }
            }
          },
          price: {
            validators: {
              notEmpty: {
                message: "Price is required"
              }
            }
          },
          preparationTime: {
            validators: {
              notEmpty: {
                message: "Preparation time is required"
              }
            }
          },
          category: {
            validators: {
              notEmpty: {
                message: "Category is required"
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

            if (selectedIngredients.length > 0) {

              const formData = new FormData(r);
              formData.append("selectedIngredients", JSON.stringify(selectedIngredients));

              formData.forEach((value, key) => {
                console.log(key, value);
              });

              const url = plateId ? baseURL + 'plates/update/' + plateId : baseURL + 'plates/save';

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
              t.removeAttribute("data-kt-indicator");
              t.disabled = false;

              Swal.fire({
                text: "You need to select at least one Ingredient!",
                icon: "error",
                buttonsStyling: false,
                confirmButtonText: "OK, understood!",
                customClass: {
                  confirmButton: "btn btn-primary"
                }
              });
            }


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
      this.handleIngredientCheckboxes();
    },


    editEvent: function () {
      document.querySelectorAll('[data-kt-role-table-filter="edit_row"]').forEach((e) => {

        e.addEventListener("click", function (e) {

          e.preventDefault();

          plateId = $(this).data('id');

          $.ajax({
            url: baseURL + 'plates/get/' + plateId,
            type: 'GET',
            success: function (response) {
              console.log(response);
              
              if (response.success) {

                $('#kt_modal_add_customer_form #kt_modal_add_customer_header h2').text("Edit Plate");

                $('#kt_modal_add_customer_form input[name="name"]').val(response.plate.name);

                $('#kt_modal_add_customer_form input[name="price"]').val(response.plate.price);

                $('#kt_modal_add_customer_form input[name="description"]').val(response.plate.description);

                $('#kt_modal_add_customer_form input[name="preparationTime"]').val(response.plate.preparation_time);

                $('#kt_modal_add_customer_form select[name="category"]').val(response.plate.category);

                response.ingredientsSelect.forEach((ingredient) => {
                  const ingredientId = ingredient.id_ingredient
                  let checkbox = $(`#kt_modal_add_customer_form [value='${ingredientId}']`);

                  if (checkbox.length){

                    checkbox.prop("checked", true);
                    if (!selectedIngredients.includes(ingredientId)) {
                      selectedIngredients.push(ingredientId)
                    }
                  } 
                  
                });


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
            error: function () {
              Swal.fire({
                text: 'There was a problem loading role data',
                icon: 'error',
                confirmButtonText: 'OK',
                customClass: { confirmButton: 'btn btn-primary' }
              });
            }
          });
        });
      });
    },

    handleIngredientCheckboxes: function () {
      ingredientCheckboxes.forEach(checkbox => {
        
        checkbox.addEventListener('change', function() {

          const ingredientId = this.value;

          const existingIngredient = selectedIngredients.find(selectedIngredientId => selectedIngredientId === ingredientId);
  
          if ($(this).prop('checked') && !existingIngredient) {
  
            selectedIngredients.push(ingredientId);
  
          } else {
  
            selectedIngredients = selectedIngredients.filter(selectedIngredientId => selectedIngredientId !== ingredientId);
   
          }
          console.log(selectedIngredients);
          
        });
        
        
      });
      
    }


  };
}();

KTUtil.onDOMContentLoaded(function () {
  KTModalCustomersAdd.init();
});
