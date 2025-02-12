"use strict";

let KTModalCustomersAdd = function () {
  let t, e, o, r, orderId = null, isListMenu = true, elementCheckboxes, selectedElement = [];

  const baseURL = window.location.origin + '/chimixa/public/';

  return {
    init: function () {
      r = document.querySelector("#kt_modal_add_customer_form");
      t = r.querySelector("#kt_modal_add_customer_submit");
      e = r.querySelector("#kt_modal_add_customer_cancel");
      o = r.querySelector("#kt_modal_add_customer_close");
      elementCheckboxes = r.querySelectorAll('.select-element');




      t.addEventListener("click", function (e) {
        e.preventDefault();


        if ("Valid" === e) {

          t.setAttribute("data-kt-indicator", "on");
          t.disabled = true;

          if (selectedIngredients.length > 0) {

            const formData = new FormData(r);
            formData.append("selectedIngredients", JSON.stringify(selectedIngredients));

            formData.forEach((value, key) => {
              console.log(key, value);
            });

            const url = elementId ? baseURL + 'plates/update/' + elementId : baseURL + 'plates/save';

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
      this.viewItems();
      this.handlePlateCheckboxes();

    },


    editEvent: function () {
      document.querySelectorAll('[data-kt-role-table-filter="edit_row"]').forEach((e) => {

        e.addEventListener("click", function (e) {

          e.preventDefault();

          elementId = $(this).data('id');

          $.ajax({
            url: baseURL + 'plates/get/' + elementId,
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

                  if (checkbox.length) {

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

    viewItems: function(){

      $('#kt_modal_add_customer_form .btn-items').on("click", function(e) {

        e.preventDefault();
        isListMenu = !isListMenu

        if (isListMenu) {
          //Menu



        }else{
          //Plate



        }

      })
    },

    handlePlateCheckboxes: function () {

      elementCheckboxes.forEach(checkbox => {
        
        checkbox.addEventListener('change', function () {
          const elementId = this.value;

          const existingElement = selectedElement.find(element => element.id === elementId);

          if ($(this).prop('checked') && !existingElement) {

            selectedElement.push({ id: elementId, count: 1 });
            updatePlateCount(elementId, 1)
            toogleStrikethrough(false, elementId)

          } else {

            selectedElement = selectedElement.filter(element => element.id !== elementId);
            updatePlateCount(elementId, 0)
            toogleStrikethrough(true, elementId)
          }

        });
      });

      function updatePlateCount(elementId, count) {
        $(r).find(`[data-id="${elementId}"]`).closest('.card').find('.count').text(count)
      }

      function toogleStrikethrough(isStrike, elementId) {
        if (isStrike) {
          $(r).find(`[data-id="${elementId}"]`).closest('.card').find('.count').addClass('text-decoration-line-through')
        } else {
          $(r).find(`[data-id="${elementId}"]`).closest('.card').find('.count').removeClass('text-decoration-line-through')
        }
      }
      

      $(r).on('click', '.increment-btn', function () {

        const elementId = $(this).data('id');

        const element = selectedElement.find(element => element.id === elementId);

        if (element) {
          element.count++;
          $(this).siblings('.count').text(element.count);
        }
      });

      $(r).on('click', '.decrement-btn', function () {
        const elementId = $(this).data('id');
        const element = selectedElement.find(element => element.id === elementId);
        if (element && element.count > 1) {
          element.count--;
          $(this).siblings('.count').text(element.count);
        }
      });
    },



  };
}();

KTUtil.onDOMContentLoaded(function () {
  KTModalCustomersAdd.init();
});
