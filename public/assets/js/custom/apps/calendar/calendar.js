const calendarEl = document.getElementById('calendar');
const baseURL = window.location.origin + '/chimixa/public/';

const calendar = new FullCalendar.Calendar(calendarEl, {
  initialView: 'dayGridMonth',
  selectable: true,

  events: function (fetchInfo, successCallback, failureCallback) {

    $.ajax({
      url: baseURL + 'calendar/ajax',
      dataType: 'json',
      success: function (response) {
        
        const events = response.data.orders.map(order => {
          return {
            id: order.id,
            title: `${order.id} - Price: ${order.price}`,
            start: order.date,
          };
        });

        successCallback(events);
      },
      error: function () {
        alert("There was an error loading events. Please try again later.");
        failureCallback();
      }
    });
  },

  eventDidMount: function (info) {
    var eventElement = info.el;

    var tooltipContent = `<b>Code:</b> ${info.event.id} <br> <b>Price:</b> ${info.event.title.split('- Price: ')[1]} $`;

    $(eventElement).attr('data-toggle', 'tooltip');
    $(eventElement).attr('data-html', 'true');
    $(eventElement).attr('title', tooltipContent);

    $(eventElement).tooltip({
      trigger: 'hover',
      html: true
    });
  },


  select: function (info) {
    const dateParts = info.startStr.split('-');

    $('#headerModal').html(`add a Order on the Day: <span id="orderDate">${`${dateParts[2]}/${dateParts[1]}/${dateParts[0]}`}</span>`);

    $('#kt_modal_add_customer').modal('show');
  },

  eventClick: function (info) {
    Swal.fire({
      text: "Are you sure you want to delete selected?",
      icon: "warning",
      showCancelButton: true,
      buttonsStyling: false,
      confirmButtonText: "Yes, delete!",
      cancelButtonText: "No, cancel",
      customClass: {
        confirmButton: "btn fw-bold btn-danger",
        cancelButton: "btn fw-bold btn-active-light-primary",
      },
    }).then((result) => {

      if (result.value) {
                
   
        $.ajax({
          url: baseURL + "calendar/delete/" + info.event._def.publicId,
          type: "GET",
          success: function (response) {

            if (response.success) {
              Swal.fire({
                text: "Selected item have been deleted successfully!",
                icon: "success",
                buttonsStyling: false,
                confirmButtonText: "Ok, got it!",
                customClass: { confirmButton: "btn fw-bold btn-primary" },
              }).then(() => {
                location.reload();
              });

            } else {

              Swal.fire({
                text: response.message || "Error deleting element!",
                icon: "error",
                buttonsStyling: false,
                confirmButtonText: "Ok, got it!",
                customClass: { confirmButton: "btn fw-bold btn-primary" },
              });
            }
          },
          error: function () {
            Swal.fire({
              text: "There was an error processing the request.",
              icon: "error",
              buttonsStyling: false,
              confirmButtonText: "Ok, got it!",
              customClass: { confirmButton: "btn fw-bold btn-primary" },
            });
          },
        });
      }
    });
  }
});


$('#addOrderToday').click(function () {
  $('#headerModal').html("add a Order"); 
  $('#kt_modal_add_order').modal('show');
});


calendar.render();