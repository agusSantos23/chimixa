"use strict";

let KTModalCustomersAdd = function () {
  let t, e, o, r, isListMenu = true, elementCheckboxes, selectedElements = [];

  const baseURL = window.location.origin + '/chimixa/public/';

  return {
    init: function () {
      r = document.querySelector("#kt_modal_add_customer_form");
      t = r.querySelector("#kt_modal_add_customer_submit");
      e = r.querySelector("#kt_modal_add_customer_cancel");
      o = r.querySelector("#kt_modal_add_customer_close");
      elementCheckboxes = r.querySelectorAll('.select-element');
      const headerDropdown = $('#dropdown')




      t.addEventListener("click", function (e) {
        e.preventDefault();



        t.setAttribute("data-kt-indicator", "on");
        t.disabled = true;

        if (selectedElements.length > 0) {

          const formattedOrderData = selectedElements.map(({ id, type, price, count }) => ({
            id,
            type,
            price: parseFloat(price),
            count
          }));

          console.log(formattedOrderData);

          const formData = new FormData(r);
          formData.append("selectedElements", JSON.stringify(formattedOrderData));



          $.ajax({
            url: baseURL + 'orders/save',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {

              console.log(response);
              
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
            text: "You need to select at least one Element!",
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
      $('#body-receipt').hide();

      headerDropdown.on("click", () => {
        $('#body-receipt').toggle();
      })

      this.receiptData();
      this.viewElements();
      this.handlePlateCheckboxes();
    },

    receiptData: function () {
      const menuContainer = $('#menu-receipt-container');
      const plateContainer = $('#plate-receipt-container');
      const totalPriceText = $('#totalPrice');
      let totalPrice = 0;
      let menuTableContent = '';
      let plateTableContent = '';




      menuContainer.empty();
      plateContainer.empty();

      selectedElements.forEach(data => {
        const totalPriceElement = data.price * data.count;
        totalPrice += totalPriceElement;

        const rowContent = `
          <tr>
            <td class="col-1">
              <div class="w-8px h-8px rounded-circle bg-dark mx-auto"></div>
            </td>
            <td class="col-6">${data.name}</td>
            <td class="col-3 text-center">${data.count} x ${data.price} $</td>
            <td class="col-2 text-center">${totalPriceElement} $</td>
          </tr>
        `;

        if (data.type === 'Menu') {
          menuTableContent += rowContent;
        } else if (data.type === 'Plate') {
          plateTableContent += rowContent;
        }
      });

      if (menuTableContent) {
        menuContainer.append(`
          <section class="mb-5 ms-5">
            <h4>Menus</h4>
            <table class="col-12" id="menu-table">
              ${menuTableContent}
            </table>
          </section>
        `);
      }

      if (plateTableContent) {
        plateContainer.append(`
          <section class="mb-5 ms-5">
            <h4>Plates</h4>
            <table class="col-12" id="plate-table">
              ${plateTableContent}
            </table>
          </section>
        `);
      }

      totalPriceText.text(`${totalPrice} $`);
    },

   

    viewElements: function () {
      $('#kt_modal_add_customer_form #content-list-plates').hide();

      $('#kt_modal_add_customer_form .btn-items').on("click", function (e) {

        e.preventDefault();
        isListMenu = !isListMenu

        if (isListMenu) {
          $('#kt_modal_add_customer_form #content-list-menus').show();
          $('#kt_modal_add_customer_form #content-list-plates').hide();
          $('#kt_modal_add_customer_form .btn-items').text('Plates');
          $('#kt_modal_add_customer_form #title-list').text('List of Menus');

        } else {
          $('#kt_modal_add_customer_form #content-list-menus').hide();
          $('#kt_modal_add_customer_form #content-list-plates').show();
          $('#kt_modal_add_customer_form .btn-items').text('Menus');
          $('#kt_modal_add_customer_form #title-list').text('List of Plates');

        }

      })
    },

    handlePlateCheckboxes: function () {

      elementCheckboxes.forEach(checkbox => {

        checkbox.addEventListener('change', () => {

          const idElement = checkbox.value;
          const nameMenu = checkbox.getAttribute('data-name-menu');
          const namePlate = checkbox.getAttribute('data-name-plate');
          const priceElement = checkbox.getAttribute('data-price')


          const existingElement = selectedElements.find(element => element.id === idElement);

          if (checkbox.checked && !existingElement) {

            selectedElements.push(
              {
                id: idElement,
                type: nameMenu ? 'Menu' : 'Plate',
                name: nameMenu ? nameMenu : namePlate,
                price: priceElement,
                count: 1
              }
            );
            updateElementCount(idElement, 1)
            toogleStrikethrough(false, idElement)

            this.receiptData();

          } else {

            selectedElements = selectedElements.filter(element => element.id !== idElement);
            updateElementCount(idElement, 0)
            toogleStrikethrough(true, idElement)
            this.receiptData();

          }



        });
      });

      function updateElementCount(idElement, count) {
        $(r).find(`[data-id="${idElement}"]`).closest('.card').find('.count').text(count)
      }

      function toogleStrikethrough(isStrike, idElement) {
        if (isStrike) {
          $(r).find(`[data-id="${idElement}"]`).closest('.card').find('.count').addClass('text-decoration-line-through')
        } else {
          $(r).find(`[data-id="${idElement}"]`).closest('.card').find('.count').removeClass('text-decoration-line-through')
        }
      }


      r.addEventListener('click', (event) => {
        if (event.target.classList.contains('increment-btn')) {
          const idElement = event.target.getAttribute('data-id');

          const element = selectedElements.find(element => element.id === idElement);

          if (element.count < 15) {
            element.count++;
            event.target.parentElement.querySelector('.count').textContent = element.count;
            this.receiptData();
          }

        }
      });

      r.addEventListener('click', (event) => {
        if (event.target.classList.contains('decrement-btn')) {
          const idElement = event.target.getAttribute('data-id');

          const element = selectedElements.find(element => element.id === idElement);

          if (element.count > 1) {

            element.count--;
            event.target.parentElement.querySelector('.count').textContent = element.count;
            this.receiptData();
          }

        }
      });


    },



  };
}();

KTUtil.onDOMContentLoaded(function () {
  KTModalCustomersAdd.init();
});
