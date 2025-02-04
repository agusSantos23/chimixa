"use strict";

var KTCustomersList = function () {
	var t, e, o, n;

	var c = () => {
		n.querySelectorAll('[data-kt-customer-table-filter="delete_row"]').forEach((e) => {
			e.addEventListener("click", function (e) {
				e.preventDefault();
				const o = e.target.closest("tr");
				const n = o.querySelectorAll("td")[1].innerText;

				Swal.fire({
					text: "Are you sure you want to delete " + n + "?",
					icon: "warning",
					showCancelButton: true,
					buttonsStyling: false,
					confirmButtonText: "Yes, delete!",
					cancelButtonText: "No, cancel",
					customClass: {
						confirmButton: "btn fw-bold btn-danger",
						cancelButton: "btn fw-bold btn-active-light-primary"
					}
				}).then(function (e) {
					if (e.value) {
						Swal.fire({
							text: "You have deleted " + n + "!",
							icon: "success",
							buttonsStyling: false,
							confirmButtonText: "Ok, got it!",
							customClass: {
								confirmButton: "btn fw-bold btn-primary"
							}
						}).then(function () {
							t.row($(o)).remove().draw();
						});
					} else if (e.dismiss === "cancel") {
						Swal.fire({
							text: n + " was not deleted.",
							icon: "error",
							buttonsStyling: false,
							confirmButtonText: "Ok, got it!",
							customClass: {
								confirmButton: "btn fw-bold btn-primary"
							}
						});
					}
				});
			});
		});
	};

	var r = () => {
		const e = n.querySelectorAll('[type="checkbox"]');
		const o = document.querySelector('[data-kt-customer-table-select="delete_selected"]');

		e.forEach((t) => {
			t.addEventListener("click", function () {
				setTimeout(function () {
					l();
				}, 50);
			});
		});

		o.addEventListener("click", function () {
			Swal.fire({
				text: "Are you sure you want to delete selected customers?",
				icon: "warning",
				showCancelButton: true,
				buttonsStyling: false,
				confirmButtonText: "Yes, delete!",
				cancelButtonText: "No, cancel",
				customClass: {
					confirmButton: "btn fw-bold btn-danger",
					cancelButton: "btn fw-bold btn-active-light-primary"
				}
			}).then(function (o) {
				if (o.value) {
					Swal.fire({
						text: "You have deleted all selected customers!",
						icon: "success",
						buttonsStyling: false,
						confirmButtonText: "Ok, got it!",
						customClass: {
							confirmButton: "btn fw-bold btn-primary"
						}
					}).then(function () {
						e.forEach((e) => {
							if (e.checked) {
								t.row($(e.closest("tbody tr"))).remove().draw();
							}
						});
						n.querySelectorAll('[type="checkbox"]')[0].checked = false;
					});
				} else if (o.dismiss === "cancel") {
					Swal.fire({
						text: "Selected customers were not deleted.",
						icon: "error",
						buttonsStyling: false,
						confirmButtonText: "Ok, got it!",
						customClass: {
							confirmButton: "btn fw-bold btn-primary"
						}
					});
				}
			});
		});
	};

	const l = () => {
		const t = document.querySelector('[data-kt-customer-table-toolbar="base"]');
		const e = document.querySelector('[data-kt-customer-table-toolbar="selected"]');
		const o = document.querySelector('[data-kt-customer-table-select="selected_count"]');
		const c = n.querySelectorAll('tbody [type="checkbox"]');

		let r = false;
		let l = 0;

		c.forEach((t) => {
			if (t.checked) {
				r = true;
				l++;
			}
		});

		if (r) {
			o.innerHTML = l;
			t.classList.add("d-none");
			e.classList.remove("d-none");
		} else {
			t.classList.remove("d-none");
			e.classList.add("d-none");
		}
	};

	return {
		init: function () {
			n = document.querySelector("#kt_customers_table");

			if (n) {
				n.querySelectorAll("tbody tr").forEach((t) => {
					const e = t.querySelectorAll("td");
					const o = moment(e[5].innerHTML, "DD MMM YYYY, LT").format();
					e[5].setAttribute("data-order", o);
				});

				t = $(n).DataTable({
					info: false,
					paging: false,
					order: [],
					columnDefs: [
						{ orderable: false, targets: 0 },
						{ orderable: false, targets: 6 }
					]
				});

				t.on("draw", function () {
					r();
					c();
					l();
				});

				r();

				document.querySelector('[data-kt-customer-table-filter="search"]')
					.addEventListener("keyup", function (e) {
						t.search(e.target.value).draw();
					});

				e = $('[data-kt-customer-table-filter="month"]');
				o = document.querySelectorAll('[data-kt-customer-table-filter="payment_type"] [name="payment_type"]');

				document.querySelector('[data-kt-customer-table-filter="filter"]')
					.addEventListener("click", function () {
						const n = e.val();
						let c = "";

						o.forEach((t) => {
							if (t.checked) {
								c = t.value;
							}
							if (c === "all") {
								c = "";
							}
						});

						const r = n + " " + c;
						t.search(r).draw();
					});

				c();

				document.querySelector('[data-kt-customer-table-filter="reset"]')
					.addEventListener("click", function () {
						e.val(null).trigger("change");
						o[0].checked = true;
						t.search("").draw();
					});
			}
		}
	};
}();

KTUtil.onDOMContentLoaded(function () {
	KTCustomersList.init();
});
