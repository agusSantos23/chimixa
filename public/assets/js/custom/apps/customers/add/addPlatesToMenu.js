"use strict";

let KTModalCustomersAdd = function () {
  let t, e, o, n, r, i, menuId, platesCheckboxes, selectedPlates = [];

  const baseURL = window.location.origin + '/chimixa/public/';

  return {
    init: function () {
      i = new bootstrap.Modal(document.querySelector("#kt_modal_add_customer"));
      r = document.querySelector("#kt_modal_add_customer_form");
      t = r.querySelector("#kt_modal_add_customer_submit");
      e = r.querySelector("#kt_modal_add_customer_cancel");
      o = r.querySelector("#kt_modal_add_customer_close");
      platesCheckboxes = r.querySelectorAll('.select-plate');
      menuId = $('#kt_modal_add_customer_form').data('id-menu')



      t.addEventListener("click", function (e) {
        e.preventDefault();


        t.setAttribute("data-kt-indicator", "on");
        t.disabled = true;


        if (selectedPlates.length > 0) {

          const formData = new FormData(r);
          formData.append("selectedPlates", JSON.stringify(selectedPlates));

          $.ajax({
            url: baseURL + 'menu_plates/update/' + menuId,
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

      this.handlePlateCheckboxes();

    },


    handlePlateCheckboxes: function () {
      platesCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function () {
          const plateId = this.value;

          const existingPlate = selectedPlates.find(plate => plate.id === plateId);

          if ($(this).prop('checked') && !existingPlate) {

            selectedPlates.push({ id: plateId, count: 1 });
            updatePlateCount(plateId, 1)
            toogleStrikethrough(false, plateId)
          } else {

            selectedPlates = selectedPlates.filter(plate => plate.id !== plateId);
            updatePlateCount(plateId, 0)
            toogleStrikethrough(true, plateId)
          }

        });
      });

      function updatePlateCount(plateId, count) {
        $(r).find(`[data-id="${plateId}"]`).closest('.card').find('.count').text(count)
      }

      function toogleStrikethrough(isStrike, plateId) {
        if (isStrike) {
          $(r).find(`[data-id="${plateId}"]`).closest('.card').find('.count').addClass('text-decoration-line-through')
        } else {
          $(r).find(`[data-id="${plateId}"]`).closest('.card').find('.count').removeClass('text-decoration-line-through')
        }
      }


      $(r).on('click', '.increment-btn', function () {

        const plateId = $(this).data('id');

        const plate = selectedPlates.find(plate => plate.id === plateId);

        if (plate) {
          plate.count++;
          $(this).siblings('.count').text(plate.count);
        }
      });

      $(r).on('click', '.decrement-btn', function () {
        const plateId = $(this).data('id');
        const plate = selectedPlates.find(plate => plate.id === plateId);
        if (plate && plate.count > 1) {
          plate.count--;
          $(this).siblings('.count').text(plate.count);
        }
      });
    },

    getPlates: function () {

      $.ajax({
        url: baseURL + 'menu_platess/get/' + menuId,
        type: 'GET',
        success: function (response) {

          if (response.success) {

            response.plates.forEach((plate) => {

              let checkbox = $(`#kt_modal_add_customer_form [value='${plate.id}']`);
              let amountInput = $(`#kt_modal_add_customer_form [data-id-plate='${plate.id}'] span`);

              if (checkbox) checkbox.prop("checked", true);
              if (amountInput) amountInput.text(plate.amount);

              selectedPlates.push({ id: plate.id, count: plate.amount })
              amountInput.removeClass('text-decoration-line-through')
            });


          } else {

            Swal.fire({
              text: 'Error loading plates data',
              icon: 'error',
              confirmButtonText: 'OK',
              customClass: { confirmButton: 'btn btn-primary' }
            });
          }
        },
        error: function () {
          Swal.fire({
            text: 'There was a problem loading plates data',
            icon: 'error',
            confirmButtonText: 'OK',
            customClass: { confirmButton: 'btn btn-primary' }
          });
        }
      });

    }



  };
}();

KTUtil.onDOMContentLoaded(function () {
  KTModalCustomersAdd.init();
});
