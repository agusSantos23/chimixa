"use strict";

var KTCustomersList = function () {
	var n, url, fatherId;
	const baseURL = window.location.origin + '/chimixa/public/';

	var c = () => {
		n.querySelectorAll('[data-kt-customer-table-filter="delete_row"]').forEach((e) => {
			e.addEventListener("click", function (e) {
				e.preventDefault();
				fatherId = $('#kt_customers_table').data('id-father');
				url = fatherId ? $('#kt_customers_table').data('url') + '/' + fatherId : $('#kt_customers_table').data('url');
				const idToDelete = $(this).data('id');

				Swal.fire({
					text: "Are you sure you want to delete ?",
					icon: "warning",
					showCancelButton: true,
					buttonsStyling: false,
					confirmButtonText: "Yes, delete!",
					cancelButtonText: "No, cancel",
					customClass: {
						confirmButton: "btn fw-bold btn-danger",
						cancelButton: "btn fw-bold btn-active-light-primary"
					}
				}).then(function (result) {
					if (result.value) {
						$.ajax({
							url: baseURL + url,
							type: 'POST',
							data: { ids: [idToDelete] },
							success: function (response) {
								if (response.success) {
									Swal.fire({
										text: "Element deleted successfully!",
										icon: "success",
										buttonsStyling: false,
										confirmButtonText: "Ok, got it!",
										customClass: { confirmButton: "btn fw-bold btn-primary" }
									}).then(function () { location.reload(); });
								} else {
									Swal.fire({
										text: "Error deleting element!",
										icon: "error",
										buttonsStyling: false,
										confirmButtonText: "Ok, got it!",
										customClass: { confirmButton: "btn fw-bold btn-primary" }
									});
								}
							},
							error: function () {
								Swal.fire({
									text: "There was an error processing the request.",
									icon: "error",
									buttonsStyling: false,
									confirmButtonText: "Ok, got it!",
									customClass: { confirmButton: "btn fw-bold btn-primary" }
								});
							}
						});
					}
				});
			});
		});
	};

	var v = () => {
		n.querySelectorAll('[data-kt-customer-table-filter="view_row"]').forEach((e) => {
			e.addEventListener("click", function (e) {
				e.preventDefault();
				const codeToView = $(this).data('id');

				$.ajax({
					url: baseURL + 'orders/get/' + codeToView,
					type: 'GET',
					success: function (response) {
						if (response.success) {
							const order = response.data;

							const mainContainer = $('#main-view');
							mainContainer.empty();

							let totalPrice = 0;
							let menuTableContent = '';
							let plateTableContent = '';

							order.forEach(item => {
								const totalPriceElement = item.price * item.amount;
								totalPrice += totalPriceElement;

								const rowContent = `
                                <tr>
                                    <td class="col-1">
                                        <div class="w-8px h-8px rounded-circle bg-dark mx-auto"></div>
                                    </td>
                                    <td class="col-6">${item.id_element}</td> <!-- Muestra el ID del elemento -->
                                    <td class="col-3 text-center">${item.amount} x ${item.price} $</td>
                                    <td class="col-2 text-center">${totalPriceElement} $</td>
                                </tr>
                            `;

								if (item.type_element === 'Menu') {
									menuTableContent += rowContent;
								} else if (item.type_element === 'Plate') {
									plateTableContent += rowContent;
								}
							});

							if (menuTableContent) {
								mainContainer.append(`
                                <section class="mb-5 ms-5">
                                    <h4>Menus</h4>
                                    <table class="col-12">
                                        <tbody>
                                            ${menuTableContent}
                                        </tbody>
                                    </table>
                                </section>
                            `);
							}

							if (plateTableContent) {
								mainContainer.append(`
                                <section class="mb-5 ms-5">
                                    <h4>Plates</h4>
                                    <table class="col-12">
                                        <tbody>
                                            ${plateTableContent}
                                        </tbody>
                                    </table>
                                </section>
                            `);
							}

							mainContainer.append(`
                            <h4 class="text-end">${totalPrice} $</h4>
                        `);

							$('#kt_modal_view_order').modal('show');
						} else {
							Swal.fire({
								text: "Error retrieving element details!",
								icon: "error",
								buttonsStyling: false,
								confirmButtonText: "Ok, got it!",
								customClass: { confirmButton: "btn fw-bold btn-primary" }
							});
						}
					},
					error: function () {
						Swal.fire({
							text: "There was an error processing the request.",
							icon: "error",
							buttonsStyling: false,
							confirmButtonText: "Ok, got it!",
							customClass: { confirmButton: "btn fw-bold btn-primary" }
						});
					}
				});
			});
		});
	};


	return {
		init: function () {
			n = document.querySelector("#kt_customers_table");
			if (n) {
				c();
				v();
			}
		}
	};
}();

KTUtil.onDOMContentLoaded(function () {
	KTCustomersList.init();
});
