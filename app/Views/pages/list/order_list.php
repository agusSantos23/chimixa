<!DOCTYPE html>
<!--
Author: Keenthemes
Product Name: Metronic
License: For each use you must have a valid license purchased only from above link in order to legally use the theme for your project
-->
<html lang="es">
<!--begin::Head-->

<head>
	<title>CHIMIXA</title>
	<meta name="description" content="Herramienta digital personalizada para gestionar de manera eficiente todas las operaciones del restaurante Chimixa. Optimiza la administración de menus, inventarios y reportes, todo diseñado exclusivamente para destacar la esencia y calidad de la auténtica comida mexicana que ofrece este restaurante." />
	<meta name="keywords" content="Chimixa, Metronic, php, codeigniter, gestion de restaurantes" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta charset="utf-8" />
	<link rel="icon" type="image/x-icon" href="./assets/media/logos/favicon.ico" />
	<!--begin::Fonts-->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
	<!--end::Fonts-->
	<!--begin::Page Vendor Stylesheets(used by this page)-->
	<link href="./assets/plugins/custom/fullcalendar/fullcalendar.bundle.css" rel="stylesheet" type="text/css" />
	<!--end::Page Vendor Stylesheets-->
	<!--begin::Global Stylesheets Bundle(used by all pages)-->
	<link href="./assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
	<link href="./assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
	<!--end::Global Stylesheets Bundle-->
</head>
<!--end::Head-->
<!--begin::Body-->

<body id="kt_body" class="header-fixed header-tablet-and-mobile-fixed toolbar-enabled toolbar-fixed aside-enabled aside-fixed" style="--kt-toolbar-height:55px;--kt-toolbar-height-tablet-and-mobile:55px">
	<!--begin::Main-->
	<!--begin::Root-->
	<div class="d-flex flex-column flex-root">
		<!--begin::Page-->
		<div class="page d-flex flex-row flex-column-fluid">


			<?php include APPPATH . 'Views/templates/aside.php' ?>


			<!--begin::Wrapper-->
			<div class="wrapper d-flex flex-column flex-row-fluid pt-12 mt-12" id="kt_wrapper">
				<!--begin::Header-->
				<div id="kt_header" class="header align-items-stretch">

					<!--begin::Container-->
					<div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
						<!--begin::Page title-->
						<div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
							<!--begin::Title-->
							<h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Order List</h1>
							<!--end::Title-->
							<!--begin::Separator-->
							<span class="h-20px border-gray-200 border-start mx-4"></span>
							<!--end::Separator-->
							<!--begin::Breadcrumb-->
							<ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
								<!--begin::Item-->
								<li class="breadcrumb-item text-muted">
									<a href="<?= base_url('/') ?>" class="text-muted text-hover-primary">Home</a>
								</li>
								<!--end::Item-->
								<!--begin::Item-->
								<li class="breadcrumb-item">
									<span class="bullet bg-gray-200 w-5px h-2px"></span>
								</li>
								<!--end::Item-->
								<!--begin::Item-->
								<li class="breadcrumb-item text-dark">Orders</li>
								<!--end::Item-->
							</ul>
							<!--end::Breadcrumb-->
						</div>
						<!--end::Page title-->

					</div>
					<!--end::Container-->


				</div>
				<!--end::Header-->

				<!--begin::Content-->
				<div class="content d-flex flex-column flex-column-fluid p-0" id="kt_content">

					<!--begin::Post-->
					<div class="post d-flex flex-column-fluid" id="kt_post">
						<!--begin::Container-->
						<div id="kt_content_container" class="container-xxl">
							<!--begin::Card-->
							<div class="card">
								<!--begin::Card header-->
								<div class="d-flex justify-content-end card-header border-0 pt-6">

									<!--begin::Card toolbar-->
									<div class="card-toolbar">
										<!--begin::Toolbar-->
										<div class="d-flex justify-content-end" data-kt-customer-table-toolbar="base">
											<!--begin::Filter-->
											<button type="button" class="btn btn-light-primary me-3" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
												<!--begin::Svg Icon | path: icons/duotune/general/gen031.svg-->
												<span class="svg-icon svg-icon-2">
													<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
														<path d="M19.0759 3H4.72777C3.95892 3 3.47768 3.83148 3.86067 4.49814L8.56967 12.6949C9.17923 13.7559 9.5 14.9582 9.5 16.1819V19.5072C9.5 20.2189 10.2223 20.7028 10.8805 20.432L13.8805 19.1977C14.2553 19.0435 14.5 18.6783 14.5 18.273V13.8372C14.5 12.8089 14.8171 11.8056 15.408 10.964L19.8943 4.57465C20.3596 3.912 19.8856 3 19.0759 3Z" fill="black" />
													</svg>
												</span>
												<!--end::Svg Icon-->Filter</button>
											<!--begin::Menu 1-->
											<div class="menu menu-sub menu-sub-dropdown w-300px w-md-325px" data-kt-menu="true" id="kt-toolbar-filter">

												<!--begin::Header-->
												<div class="px-7 py-5">
													<div class="fs-4 text-dark fw-bolder">Filter Options</div>
												</div>
												<!--end::Header-->
												<!--begin::Separator-->
												<div class="separator border-gray-200"></div>
												<!--end::Separator-->
												<!--begin::Content-->
												<form action="<?= base_url('orders') ?>" method="get" class="px-7 py-5">
													<!--begin::Search-->
													<div class="d-flex align-items-center position-relative my-1">
														<!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
														<span class="svg-icon svg-icon-1 position-absolute ms-6">
															<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																<rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="black" />
																<path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="black" />
															</svg>
														</span>
														<!--end::Svg Icon-->

														<input type="text" name="searchParams[id]" id="searchName" class="form-control form-control-solid w-250px ps-15" placeholder="Code" value="<?= esc($searchParams['id'] ?? '') ?>" />
													</div>
													<!--end::Search-->

													<!--begin::Search-->
													<div class="d-flex align-items-center position-relative my-1">
														<!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
														<span class="svg-icon svg-icon-1 position-absolute ms-6">
															<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																<rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="black" />
																<path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="black" />
															</svg>
														</span>
														<!--end::Svg Icon-->

														<input type="text" name="searchParams[date]" id="searchName" class="form-control form-control-solid w-250px ps-15" placeholder="Date" value="<?= esc($searchParams['date'] ?? '') ?>" />
													</div>
													<!--end::Search-->



													<!--begin::Search-->
													<div class="d-flex align-items-center position-relative my-1">
														<!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
														<span class="svg-icon svg-icon-1 position-absolute ms-6">
															<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																<rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="black" />
																<path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="black" />
															</svg>
														</span>
														<!--end::Svg Icon-->

														<input type="text" name="searchParams[price]" id="searchName" class="form-control form-control-solid w-250px ps-15" placeholder="Price" value="<?= esc($searchParams['price'] ?? '') ?>" />
													</div>
													<!--end::Search-->



													<!--begin::DisabledFilter-->
													<div class="d-flex align-items-center position-relative my-1">
														<span class="svg-icon svg-icon-1 position-absolute ms-6">
															<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																<path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="black" />
															</svg>
														</span>

														<select name="searchParams[disabledFilter]" id="disabledFilter" class="form-control form-control-solid w-250px ps-15 cursor-pointer">

															<option value="">All</option>
															<option value="false" <?= (isset($searchParams['disabledFilter']) && $searchParams['disabledFilter'] === 'false') ? 'selected' : '' ?>>Active</option>
															<option value="true" <?= (isset($searchParams['disabledFilter']) && $searchParams['disabledFilter'] === 'true') ? 'selected' : '' ?>>Disabled</option>

														</select>
													</div>
													<!--end::DisabledFilter-->

													<!--begin::Actions-->
													<div class="d-flex justify-content-end">
														<button type="button" onclick="window.location='<?= base_url('orders') ?>'" class="btn btn-light btn-active-light-primary me-2" data-kt-menu-dismiss="true" data-kt-customer-table-filter="reset">Reset</button>
														<button type="submit" class="btn btn-primary" data-kt-menu-dismiss="true" data-kt-customer-table-filter="filter">Apply</button>
													</div>
													<!--end::Actions-->
												</form>
												<!--end::Content-->
											</div>
											<!--end::Menu 1-->
											<!--end::Filter-->
											<!--begin::Export-->
											<button type="button" class="btn btn-light-primary me-3" data-bs-toggle="modal" data-bs-target="#kt_customers_export_modal">
												<!--begin::Svg Icon | path: icons/duotune/arrows/arr078.svg-->
												<span class="svg-icon svg-icon-2">
													<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
														<rect opacity="0.3" x="12.75" y="4.25" width="12" height="2" rx="1" transform="rotate(90 12.75 4.25)" fill="black" />
														<path d="M12.0573 6.11875L13.5203 7.87435C13.9121 8.34457 14.6232 8.37683 15.056 7.94401C15.4457 7.5543 15.4641 6.92836 15.0979 6.51643L12.4974 3.59084C12.0996 3.14332 11.4004 3.14332 11.0026 3.59084L8.40206 6.51643C8.0359 6.92836 8.0543 7.5543 8.44401 7.94401C8.87683 8.37683 9.58785 8.34458 9.9797 7.87435L11.4427 6.11875C11.6026 5.92684 11.8974 5.92684 12.0573 6.11875Z" fill="black" />
														<path d="M18.75 8.25H17.75C17.1977 8.25 16.75 8.69772 16.75 9.25C16.75 9.80228 17.1977 10.25 17.75 10.25C18.3023 10.25 18.75 10.6977 18.75 11.25V18.25C18.75 18.8023 18.3023 19.25 17.75 19.25H5.75C5.19772 19.25 4.75 18.8023 4.75 18.25V11.25C4.75 10.6977 5.19771 10.25 5.75 10.25C6.30229 10.25 6.75 9.80228 6.75 9.25C6.75 8.69772 6.30229 8.25 5.75 8.25H4.75C3.64543 8.25 2.75 9.14543 2.75 10.25V19.25C2.75 20.3546 3.64543 21.25 4.75 21.25H18.75C19.8546 21.25 20.75 20.3546 20.75 19.25V10.25C20.75 9.14543 19.8546 8.25 18.75 8.25Z" fill="#C4C4C4" />
													</svg>
												</span>
												<!--end::Svg Icon-->Export</button>
											<!--end::Export-->
											<!--begin::Add customer-->
											<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_add_customer">Add Order</button>
											<!--end::Add customer-->
										</div>
										<!--end::Toolbar-->
										<!--begin::Group actions-->
										<div class="d-flex justify-content-end align-items-center d-none" data-kt-customer-table-toolbar="selected">
											<div class="fw-bolder me-5">
												<span class="me-2" data-kt-customer-table-select="selected_count"></span>Selected
											</div>
											<button type="button" class="btn btn-danger" data-kt-customer-table-select="delete_selected">Delete Selected</button>
										</div>
										<!--end::Group actions-->
									</div>
									<!--end::Card toolbar-->
								</div>
								<!--end::Card header-->
								<div class="card-body">

									<!--begin::Card body-->
									<div class=" pt-0">
										<!--begin::Table-->
										<table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_customers_table" data-url="orders/delete">
											<!--begin::Table head-->
											<thead>
												<!--begin::Table row-->
												<tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
													<th class="w-10px pe-2">
														<div class="form-check form-check-sm form-check-custom form-check-solid me-3">
															<input class="form-check-input" type="checkbox" data-kt-check="true" data-kt-check-target="#kt_customers_table .form-check-input" value="1" />
														</div>
													</th>
													<th></th>
													<th class="min-w-125px">Code</th>
													<th class="min-w-125px">Order Date</th>
													<th class="min-w-125px">Price</th>
													<th class="text-end min-w-70px">Actions</th>
												</tr>
												<!--end::Table row-->
											</thead>
											<!--end::Table head-->
											<!--begin::Table body-->
											<tbody class="fw-bold text-gray-600">
												<?php if (empty($orders)): ?>
													<tr>
														<td colspan="6" class="text-center">
															<p>No orders found</p>
														</td>
													</tr>
												<?php else: ?>

													<?php foreach ($orders as $order): ?>

														<tr>

															<!--begin::Checkbox-->
															<td>
																<div class="form-check form-check-sm form-check-custom form-check-solid">
																	<input class="form-check-input" type="checkbox" value="1" />
																</div>
															</td>
															<!--end::Checkbox-->

															<td>
																<?php if ($order['disabled']): ?>
																	<div class="h-25px border border-5 rounded border-danger" style="width: 0;" data-bs-toggle="tooltip" title="This Order is disabled"></div>
																<?php endif; ?>
															</td>

															<td>
																<?= $order['id'] ?>
															</td>

															<td>
																<?= date("d/m/Y H:i", strtotime($order['created_at'])) ?>
															</td>

															<td>
																<?= $order['price'] ?> $
															</td>


															<!--begin::Action=-->
															<td class="text-end">
																<a href="#" class="btn btn-sm btn-light btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
																	<!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->
																	<span class="svg-icon svg-icon-5 m-0">
																		<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																			<path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="black" />
																		</svg>
																	</span>
																	<!--end::Svg Icon--></a>
																<!--begin::Menu-->
																<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4" data-kt-menu="true">
																	<!--begin::Menu item-->
																	<div class="menu-item px-3">
																		<a class="menu-link px-3" data-id="<?= $order['id'] ?>" data-bs-toggle="modal" data-kt-customer-table-filter="view_row">View</a>
																	</div>
																	<!--end::Menu item-->
																	<!--begin::Menu item-->
																	<div class="menu-item px-3">
																		<a href="#" class="menu-link px-3" data-id="<?= $order['id'] ?>" data-kt-customer-table-filter="delete_row">
																			<!--begin::Svg Icon | path: assets/media/icons/duotune/abstract/abs012.svg-->
																			<span class="svg-icon svg-icon-muted me-1">
																				<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																					<path opacity="0.3" d="M6.7 19.4L5.3 18C4.9 17.6 4.9 17 5.3 16.6L16.6 5.3C17 4.9 17.6 4.9 18 5.3L19.4 6.7C19.8 7.1 19.8 7.7 19.4 8.1L8.1 19.4C7.8 19.8 7.1 19.8 6.7 19.4Z" fill="black" />
																					<path d="M19.5 18L18.1 19.4C17.7 19.8 17.1 19.8 16.7 19.4L5.40001 8.1C5.00001 7.7 5.00001 7.1 5.40001 6.7L6.80001 5.3C7.20001 4.9 7.80001 4.9 8.20001 5.3L19.5 16.6C19.9 16.9 19.9 17.6 19.5 18Z" fill="black" />
																				</svg>
																			</span>
																			<!--end::Svg Icon-->
																			Delete
																		</a>
																	</div>
																	<!--end::Menu item-->
																</div>
																<!--end::Menu-->
															</td>
															<!--end::Action=-->
														</tr>

													<?php endforeach; ?>
												<?php endif; ?>

											</tbody>
											<!--end::Table body-->
										</table>
										<!--end::Table-->
									</div>
									<!--end::Card body-->

									<!--begin::Card footer-->
									<div class="d-flex align-items-center justify-content-between mt-5">
										<form action="<?= base_url('orders') ?>" method="get" class="d-inline-block">

											<select name="perPage" id="perPage" onchange="this.form.submit()" class="form-select form-select-sm">
												<option value="5" <?= ($perPage == 5) ? 'selected' : '' ?>>5</option>
												<option value="10" <?= ($perPage == 10) ? 'selected' : '' ?>>10</option>
												<option value="25" <?= ($perPage == 25) ? 'selected' : '' ?>>25</option>
												<option value="50" <?= ($perPage == 50) ? 'selected' : '' ?>>50</option>
											</select>

										</form>

										<span class="ms-3">
											<?= $pager->links('default', 'bootstrap_pager') ?>
										</span>
									</div>
									<!--end::Card footer-->


								</div>




							</div>
							<!--end::Card-->

							<!--begin::Modals-->

							<!--begin::Modal - Customers - Add-->
							<div class="modal fade" id="kt_modal_view_order" tabindex="-1" aria-hidden="true">
								<!--begin::Modal dialog-->
								<div class="modal-dialog modal-dialog-centered mw-750px">
									<!--begin::Modal content-->
									<div class="modal-content">
										<!--begin::Form-->
										<div class="m-5 p-5 rounded" style="background-color:#FAF9DF;">
											<header class="">
												<h3 class="m-0">
													<!--begin::Svg Icon | path: assets/media/icons/duotune/arrows/arr072.svg-->
													<span class="svg-icon svg-icon-dark svg-icon-2hx">
														<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
															<path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="black" />
														</svg>
													</span>
													<!--end::Svg Icon-->
													RECEIPT
												</h3>

											</header>
											<main class="mt-5" id="main-view">

												<section class="mb-5 ms-5">

												</section>

												<section class="mb-5 ms-5">

												</section>

												<h4 class="text-end"></h4>

											</main>

										</div>
										<!--end::Form-->
									</div>
								</div>
							</div>
							<!--end::Modal - Customers - Add-->





							<!--begin::Modal - Customers - Add-->
							<div class="modal fade" id="kt_modal_add_customer" tabindex="-1" aria-hidden="true">
								<!--begin::Modal dialog-->
								<div class="modal-dialog modal-dialog-centered mw-750px">
									<!--begin::Modal content-->
									<div class="modal-content">
										<!--begin::Form-->
										<form class="form" action="#" id="kt_modal_add_customer_form">
											<!--begin::Modal header-->
											<div class="modal-header" id="kt_modal_add_customer_header">
												<!--begin::Modal title-->
												<h2 class="fw-bolder">Add a Order</h2>
												<!--end::Modal title-->
												<!--begin::Close-->
												<div id="kt_modal_add_customer_close" class="btn btn-icon btn-sm btn-active-icon-primary">
													<!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
													<span class="svg-icon svg-icon-1">
														<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
															<rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="black" />
															<rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black" />
														</svg>
													</span>
													<!--end::Svg Icon-->
												</div>
												<!--end::Close-->
											</div>
											<!--end::Modal header-->
											<!--begin::Modal body-->
											<div class="modal-body py-10 px-lg-17">
												<!--begin::Scroll-->
												<div class="scroll-y me-n7 pe-4" id="kt_modal_add_customer_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_customer_header" data-kt-scroll-wrappers="#kt_modal_add_customer_scroll" data-kt-scroll-offset="300px">

													<div class="mb-7 card-body bg-light form-control form-control-solid ">

														<header class="d-flex justify-content-between align-items-center mb-5">
															<span id="title-list" class="fs-2">List of Menus</span>

															<button class="btn btn-primary me-3 active btn-items">Plates</button>

														</header>

														<main id="content-list-menus" class=" bg-light form-control-solid" style="border-radius: 10px; display: grid; grid-template-columns: repeat(2, 1fr); gap: 10px;">

															<?php foreach ($menus as $menu): ?>


																<div class="card form-control">
																	<header class="mb-5">
																		<div class="mb-1 d-flex align-items-center">
																			<input class="form-check-input me-2 select-element cursor-pointer" type="checkbox" value="<?= $menu['idMenu'] ?>" data-id="<?= $menu['idMenu'] ?>" data-name-menu="<?= $menu['nameMenu'] ?>" data-price="<?= $menu['priceMenu'] ?>">
																			<label style="text-overflow: ellipsis; overflow: hidden; white-space: nowrap;" class="form-check-label fs-4" for=""><?= $menu['nameMenu'] ?></label>
																		</div>
																		<div>
																			<?php
																			$uniqueAllergensOfMenu = [];
																			foreach ($menu['plates'] as $plate) {
																				if (!empty($plate['ingredientsAllergens'])) {
																					foreach ($plate['ingredientsAllergens'] as $allergens) {
																						if (!in_array($allergens, $uniqueAllergensOfMenu)) {
																							$uniqueAllergensOfMenu[] = $allergens;
																						}
																					}
																				}
																			}

																			if (!empty($uniqueAllergensOfMenu)) {
																				foreach ($uniqueAllergensOfMenu as $allergen):
																			?>
																					<span class="badge badge-pill badge-primary m-1"><?= htmlspecialchars($allergen) ?></span>
																			<?php
																				endforeach;
																			}
																			?>

																		</div>
																	</header>

																	<div class="h-100 d-flex flex-column justify-content-between gap-5">
																		<ul>
																			<?php foreach ($menu['plates'] as $plate): ?>
																				<li class="d-flex justify-content-between align-items-center">

																					<span style="text-overflow: ellipsis; overflow: hidden; white-space: nowrap;" class="pe-5"><?= $plate['namePlate'] ?></span>
																					<span><?= $plate['amountPlate'] ?></span>

																				</li>
																			<?php endforeach; ?>
																		</ul>

																		<footer class="d-flex justify-content-between align-items-center">
																			<span><?= $menu['priceMenu'] ?></span>

																			<div class="d-flex align-items-center ms-3" data-id-plate="">
																				<button type="button" class="decrement-btn btn btn-sm btn-outline-secondary p-1" data-id="<?= $menu['idMenu'] ?>">-</button>
																				<span class="count mx-2 text-decoration-line-through">0</span>
																				<button type="button" class="increment-btn btn btn-sm btn-outline-secondary p-1" data-id="<?= $menu['idMenu'] ?>">+</button>
																			</div>
																		</footer>

																	</div>

																</div>

															<?php endforeach; ?>


														</main>

														<main id="content-list-plates" class="bg-light form-control-solid" style="border-radius: 10px; display: grid; grid-template-columns: repeat(2, 1fr); gap: 10px;">
															<?php foreach ($plates as $plate): ?>

																<div class="card form-control">
																	<header class="mb-5">
																		<div class="mb-1 d-flex align-items-center">
																			<input class="form-check-input me-2 select-element" type="checkbox" value="<?= $plate['idPlate'] ?>" data-id="<?= $plate['idPlate'] ?>" data-name-plate="<?= $plate['namePlate'] ?>" data-price="<?= $plate['pricePlate'] ?>">
																			<label style="text-overflow: ellipsis; overflow: hidden; white-space: nowrap;" class="form-check-label fs-4" for=""><?= $plate['namePlate'] ?></label>
																		</div>
																		<div>
																			<?php
																			$uniqueAllergensOfMenu = [];
																			if (!empty($plate['ingredientsAllergens'])) {
																				foreach ($plate['ingredientsAllergens'] as $allergens) {

																					if (!in_array($allergens, $uniqueAllergensOfMenu)) {
																						$uniqueAllergensOfMenu[] = $allergens;
																					}
																				}
																			}


																			if (!empty($uniqueAllergensOfMenu)) {
																				foreach ($uniqueAllergensOfMenu as $allergen):
																			?>
																					<span class="badge badge-pill badge-primary m-1"><?= htmlspecialchars($allergen) ?></span>
																			<?php
																				endforeach;
																			}
																			?>

																		</div>
																	</header>


																	<footer class="d-flex justify-content-between align-items-center">
																		<span><?= $plate['pricePlate'] ?></span>

																		<div class="d-flex align-items-center ms-3" data-id-plate="">
																			<button type="button" class="decrement-btn btn btn-sm btn-outline-secondary p-1" data-id="<?= $plate['idPlate'] ?>">-</button>
																			<span class="count mx-2 text-decoration-line-through">0</span>
																			<button type="button" class="increment-btn btn btn-sm btn-outline-secondary p-1" data-id="<?= $plate['idPlate'] ?>">+</button>
																		</div>
																	</footer>

																</div>

															<?php endforeach; ?>


														</main>

													</div>

													<div class="m-5 p-5 rounded" style="background-color:#FAF9DF;">
														<header id="dropdown" class=" cursor-pointer">
															<h3 class="m-0">
																<!--begin::Svg Icon | path: assets/media/icons/duotune/arrows/arr072.svg-->
																<span class="svg-icon svg-icon-dark svg-icon-2hx">
																	<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																		<path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="black" />
																	</svg>
																</span>
																<!--end::Svg Icon-->
																RECEIPT
															</h3>

														</header>
														<main id="body-receipt" class="mt-5">

															<section class="mb-5 ms-5" id="menu-receipt-container">

															</section>

															<section class="mb-5 ms-5" id="plate-receipt-container">

															</section>

															<h4 class="text-end" id="totalPrice">Precio Total</h4>

														</main>

													</div>
												</div>
												<!--end::Scroll-->
											</div>
											<!--end::Modal body-->

											<!--begin::Modal footer-->
											<div class="modal-footer flex-center ">


												<!--begin::Button-->
												<button type="reset" id="kt_modal_add_customer_cancel" class="btn btn-light me-3">Discard</button>
												<!--end::Button-->
												<!--begin::Button-->
												<button type="submit" id="kt_modal_add_customer_submit" class="btn btn-primary">
													<span class="indicator-label">Submit</span>
													<span class="indicator-progress">Please wait...
														<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
												</button>
												<!--end::Button-->


											</div>
											<!--end::Modal footer-->
										</form>
										<!--end::Form-->
									</div>
								</div>
							</div>
							<!--end::Modal - Customers - Add-->

							<!--end::Modals-->
						</div>
						<!--end::Container-->
					</div>
					<!--end::Post-->
				</div>
				<!--end::Content-->

				<?php include APPPATH . 'Views/templates/footer.php' ?>

			</div>
			<!--end::Wrapper-->
		</div>
		<!--end::Page-->
	</div>
	<!--end::Root-->





	<!--begin::Scrolltop-->
	<div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
		<!--begin::Svg Icon | path: icons/duotune/arrows/arr066.svg-->
		<span class="svg-icon">
			<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
				<rect opacity="0.5" x="13" y="6" width="13" height="2" rx="1" transform="rotate(90 13 6)" fill="black" />
				<path d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z" fill="black" />
			</svg>
		</span>
		<!--end::Svg Icon-->
	</div>
	<!--end::Scrolltop-->

	<!--begin::Global Javascript Bundle(used by all pages)-->
	<script src="./assets/plugins/global/plugins.bundle.js"></script>
	<script src="./assets/js/scripts.bundle.js"></script>
	<!--end::Global Javascript Bundle-->
	<!--begin::Page Vendors Javascript(used by this page)-->
	<script src="./assets/plugins/custom/datatables/datatables.bundle.js"></script>
	<!--end::Page Vendors Javascript-->
	<!--begin::Page Custom Javascript(used by this page)-->
	<script src="./assets/js/custom/apps/customers/list/export.js"></script>
	<script src="./assets/js/custom/apps/customers/list/list.js"></script>
	<script src="./assets/js/custom/apps/customers/add/addOrder.js"></script>
	<script src="./assets/js/custom/widgets.js"></script>
	<script src="./assets/js/custom/apps/chat/chat.js"></script>
	<script src="./assets/js/custom/modals/create-app.js"></script>
	<script src="./assets/js/custom/modals/upgrade-plan.js"></script>
	<!--end::Page Custom Javascript-->
	<!--end::Javascript-->
</body>
<!--end::Body-->

</html>