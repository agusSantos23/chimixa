"use strict";

let KTModalCustomersAdd = function () {

  let t, r, imgSelectable, selectedImage = '', userId = null;

  const baseURL = window.location.origin + '/chimixa/public/';

  return {
    init: function () {
      r = document.querySelector("#kt_account_profile_details_form");
      t = r.querySelector("#btnSubmit");
      imgSelectable = r.querySelectorAll('.select-image');
      selectedImage = document.querySelector("img[data-profile-img]").getAttribute('data-profile-img');
      userId = document.querySelector("a[data-user-id]").getAttribute('data-user-id');


      t.addEventListener("click", function (e) {
        e.preventDefault();


        t.disabled = true;

        if (selectedImage) {

          const formData = new FormData(r);
          formData.append("profileImg", selectedImage);


          $.ajax({
            url: baseURL + 'profile/update/' + userId,
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

              if (response.message) {

                for (const [field, messages] of Object.entries(response.message)) {
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


      });

      imgSelectable.forEach(image => {
        const imageFilename = image.getAttribute('data-image');

        if (imageFilename === selectedImage) {
          image.classList.add('border-primary');
        } else {
          image.classList.remove('border-primary');
        }

        image.addEventListener('click', function () {

          imgSelectable.forEach(img => img.classList.remove('border-primary'));

          this.classList.add('border-primary');

          selectedImage = this.getAttribute('data-image');
        });
      });





    },

  };
}();

KTUtil.onDOMContentLoaded(function () {
  KTModalCustomersAdd.init();
});
