"use strict";

let KTModalCustomersAdd = function () {
  let t, e, o, n, r, i, userId = null, imgSelectable, selectedImage = '';

  const baseURL = window.location.origin + '/chimixa/public/';

  return {
    init: function () {
      i = new bootstrap.Modal(document.querySelector("#kt_modal_add_customer"));
      r = document.querySelector("#kt_modal_add_customer_form");
      t = r.querySelector("#kt_modal_add_customer_submit");
      e = r.querySelector("#kt_modal_add_customer_cancel");
      o = r.querySelector("#kt_modal_add_customer_close");
      imgSelectable = r.querySelectorAll('.select-image');


      n = FormValidation.formValidation(r, {
        fields: {
          name: {
            validators: {
              notEmpty: {
                message: "The user's name is required"
              }
            }
          },
          email: {
            validators: {
              notEmpty: {
                message: "The customer's email is required"
              }
            }
          },
          lastName: {
            validators: {
              notEmpty: {
                message: "The last name is required"
              }
            }
          },
          password: {
            validators: {
              callback: {
                message: 'The password is required',
                callback: function (input) {
                  if (userId === null) {
                    return input.value.length > 0;
                  } else {
                    return true;
                  }
                }
              }
            }
          },
          confirmPassword: {
            validators: {
              callback: {
                message: 'The password confirmation is required',
                callback: function (input) {
                  if (userId === null) {
                    return input.value === $(r).find('[name="password"]').val() && input.value.length > 0;
                  } else {
                    return true;
                  }
                }
              }
            }
          },
          prefix: {
            validators: {
              notEmpty: {
                message: "The phone prefix is required"
              }
            }
          },
          phone: {
            validators: {
              notEmpty: {
                message: "The phone number is required"
              }
            }
          },
          country: {
            validators: {
              notEmpty: {
                message: "The country is required"
              }
            }
          },
          role: {
            validators: {
              notEmpty: {
                message: "The rol of user is required"
              }
            }
          },

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

            if (selectedImage) {

              const formData = new FormData(r);
              formData.append("profileImg", selectedImage);

              const url = userId ? baseURL + 'users/update/' + userId : baseURL + 'users/save'

              $.ajax({
                url: url,
                type: 'POSTs',
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
                text: "You need to select one picture!",
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


      imgSelectable.forEach(image => {
        image.addEventListener('click', function () {

          imgSelectable.forEach(img => img.classList.remove('border-primary'));

          this.classList.add('border-primary');

          selectedImage = this.getAttribute('data-image');
        });
      });

      this.editEvent();


    },

    editEvent: function () {
      document.querySelectorAll('[data-kt-role-table-filter="edit_row"]').forEach((e) => {

        e.addEventListener("click", function (e) {

          e.preventDefault();

          userId = $(this).data('id');


          $.ajax({
            url: baseURL + 'users/get/' + userId,
            type: 'GET',
            success: function (response) {

              if (response.success) {
                const dataUser = response.success;                

                $('#kt_modal_add_customer_form #kt_modal_add_customer_header h2').text("Edit User");

                $('#kt_modal_add_customer_form input[name="name"]').val(dataUser.name);
                $('#kt_modal_add_customer_form input[name="lastName"]').val(dataUser.last_name);
                $('#kt_modal_add_customer_form input[name="email"]').val(dataUser.email);

                $('#kt_modal_add_customer_form select[name="prefix"]').val(dataUser.prefix);
                $('#kt_modal_add_customer_form input[name="phone"]').val(dataUser.phone);

                $('#kt_modal_add_customer_form select[name="role"]').val(dataUser.role_id);
                $('#kt_modal_add_customer_form select[name="country"]').val(dataUser.country);

                imgSelectable.forEach(image => {
                  const imageFilename = image.getAttribute('data-image');

                  if (imageFilename === dataUser.img) {
                    image.classList.add('border-primary');
                    selectedImage = dataUser.img;
                  } else {
                    image.classList.remove('border-primary'); 
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
    }
  };
}();

KTUtil.onDOMContentLoaded(function () {
  KTModalCustomersAdd.init();
});
