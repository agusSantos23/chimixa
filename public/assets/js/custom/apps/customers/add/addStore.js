"use strict";

let KTModalCustomersAdd = function () {
  let t, e, o, r, i, plateId, ingredientCheckboxes, selectedIngredients = [];

  const baseURL = window.location.origin + '/chimixa/public/';

  return {
    init: function () {
      i = new bootstrap.Modal(document.querySelector("#kt_modal_add_customer"));
      r = document.querySelector("#kt_modal_add_customer_form");
      t = r.querySelector("#kt_modal_add_customer_submit");
      e = r.querySelector("#kt_modal_add_customer_cancel");
      o = r.querySelector("#kt_modal_add_customer_close");
      ingredientCheckboxes = r.querySelectorAll('.select-ingredient');
      plateId = $('#kt_modal_add_customer_form').data('id-plate')



      t.addEventListener("click", function (e) {
        e.preventDefault();


        t.setAttribute("data-kt-indicator", "on");
        t.disabled = true;


        if (selectedIngredients.length > 0) {

          const formData = new FormData(r);
          formData.append("selectedIngredients", JSON.stringify(selectedIngredients));

          $.ajax({
            url: baseURL + 'store/update/' + plateId,
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
            text: "You need to select at least one plate!",
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


      this.getPlates();

      this.handleIngredientCheckboxes();

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
          
        });
        
        
      });
      
    },


    getPlates: function () {

      $.ajax({
        url: baseURL + 'storer/get/' + plateId,
        type: 'GET',
        success: function (response) {

          if (response.success) {
            
            response.plates.forEach((ingredientId) => {
              
              let checkbox = $(`#kt_modal_add_customer_form [value='${ingredientId}']`);

              if (checkbox.length){
                
                checkbox.prop("checked", true);
                if (!selectedIngredients.includes(ingredientId)) {
                  selectedIngredients.push(ingredientId)
                }
              } 
            });


          } else {

            Swal.fire({
              text: 'Error loading plates data',
              icon: 'error',
              confirmButtonText: 'OK',
              customClass: { confirmButton: 'btn btn-primary' }
            });
          }
        }
      });

    }



  };
}();

KTUtil.onDOMContentLoaded(function () {
  KTModalCustomersAdd.init();
});
