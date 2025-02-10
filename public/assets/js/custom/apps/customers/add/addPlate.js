"use strict";

let KTModalCustomersAdd = function () {
  let t, e, o, n, r, i, menuId = null, ingredientCheckboxes, selectedIngredients = [];

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
                console.log(value, key);
              });

              const url = menuId ? baseURL + 'plates/update/' + menuId : baseURL + 'plates/save';

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


          menuId = $(this).data('id');

          $.ajax({
            url: baseURL + 'menus/get/' + menuId,
            type: 'GET',
            success: function (response) {

              if (response.success) {

                $('#kt_modal_add_customer_form #kt_modal_add_customer_header h2').text("Edit Menu");

                $('#kt_modal_add_customer_form input[name="name"]').val(response.menu.name);

                $('#kt_modal_add_customer_form input[name="price"]').val(response.menu.price);

                $('#kt_modal_add_customer_form input[name="description"]').val(response.menu.description);

                response.plates.forEach((plate) => {

                  let checkbox = $(`#kt_modal_add_customer_form [value='${plate.id}']`);
                  let amountInput = $(`#kt_modal_add_customer_form [data-id-plate='${plate.id}'] span`);

                  if (checkbox) checkbox.prop("checked", true);
                  if (amountInput) amountInput.text(plate.amount);
                  /*
                  selectedIngredients.push({ id: plate.id, count: plate.amount })
                  amountInput.removeClass('text-decoration-line-through')
                  */
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

        checkbox.addEventListener('change', function () {
          const ingredientId = this.value;
          const inputField = r.querySelector(`input[data-ingredient-id="${ingredientId}"]`);
          const selectField = r.querySelector(`select[data-ingredient-id="${ingredientId}"]`);
          const ingredientName = r.querySelector(`label[for="ingredient_${ingredientId}"]`).textContent.trim();


          if ($(this).prop('checked')) {

            inputField.removeAttribute('disabled');
            selectField.removeAttribute('disabled');

          } else {

            inputField.setAttribute('disabled', 'true');
            selectField.setAttribute('disabled', 'true');
            inputField.value = '';
            selectField.selectedIndex = 0;

            selectedIngredients = selectedIngredients.filter(ingredient => ingredient.id !== ingredientId);
          }


          inputField.addEventListener('input', function () {


            if ($(checkbox).prop('checked')) {

              const existingIngredient = selectedIngredients.find(ingredient => ingredient.id === ingredientId);

              if (existingIngredient) {

                existingIngredient.quantity = inputField.value;

              } else {

                selectedIngredients.push({
                  id: ingredientId,
                  name: ingredientName,
                  quantity: inputField.value || 1,
                  unit: selectField.value || 'kg'
                });
              }
            }
          });

          selectField.addEventListener('change', function () {
            if ($(checkbox).prop('checked')) {

              const existingIngredient = selectedIngredients.find(ingredient => ingredient.id === ingredientId);

              if (existingIngredient) {

                existingIngredient.quantity = inputField.value;

              } else {

                selectedIngredients.push({
                  id: ingredientId,
                  name: ingredientName,
                  quantity: inputField.value || 1,
                  unit: selectField.value || 'kg'
                });
              }
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
