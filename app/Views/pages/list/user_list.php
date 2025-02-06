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
							<h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">User List</h1>
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
								<li class="breadcrumb-item text-dark">User list</li>
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
				<div class="content d-flex flex-column flex-column-fluid pb-12" id="kt_content">

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
												<!--end::Svg Icon-->
												Filters
											</button>
											<!--end::Filter-->



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
												<form action="<?= base_url('users') ?>" method="get" class="px-7 py-5">


													<!--begin::SearchName-->
													<div class="d-flex align-items-center position-relative my-1">
														<!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
														<span class="svg-icon svg-icon-1 position-absolute ms-6">
															<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																<rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="black" />
																<path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="black" />
															</svg>
														</span>
														<!--end::Svg Icon-->

														<input type="text" name="searchParams[name]" id="searchName" class="form-control form-control-solid w-250px ps-15" placeholder="Name" value="<?= esc($searchParams['name'] ?? '') ?>" />
													</div>
													<!--end::Search-->

													<!--begin::SearchEmail-->
													<div class="d-flex align-items-center position-relative my-1">
														<!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
														<span class="svg-icon svg-icon-1 position-absolute ms-6">
															<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																<rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="black" />
																<path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="black" />
															</svg>
														</span>
														<!--end::Svg Icon-->

														<input type="text" name="searchParams[email]" id="searchEmail" class="form-control form-control-solid w-250px ps-15" placeholder="Email" value="<?= esc($searchParams['email'] ?? '') ?>" />
													</div>
													<!--end::Search-->

													<!--begin::SearchPhone-->
													<div class="d-flex align-items-center position-relative my-1">
														<!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
														<span class="svg-icon svg-icon-1 position-absolute ms-6">
															<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																<rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="black" />
																<path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="black" />
															</svg>
														</span>
														<!--end::Svg Icon-->

														<input type="text" name="searchParams[phone]" id="searchPhone" class="form-control form-control-solid w-250px ps-15" placeholder="Phone" value="<?= esc($searchParams['phone'] ?? '') ?>" />
													</div>
													<!--end::Search-->

													<!--begin::SearchCountry-->
													<div class="d-flex align-items-center position-relative my-1">
														<!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
														<span class="svg-icon svg-icon-1 position-absolute ms-6">
															<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																<rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="black" />
																<path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="black" />
															</svg>
														</span>
														<!--end::Svg Icon-->

														<input type="text" name="searchParams[country]" id="searchCountry" class="form-control form-control-solid w-250px ps-15" placeholder="Country" value="<?= esc($searchParams['country'] ?? '') ?>" />
													</div>
													<!--end::Search-->

													<!--begin::SearchCountry-->
													<div class="d-flex align-items-center position-relative my-1">
														<!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
														<span class="svg-icon svg-icon-1 position-absolute ms-6">
															<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																<rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="black" />
																<path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="black" />
															</svg>
														</span>
														<!--end::Svg Icon-->

														<input type="text" name="searchParams[role]" id="searchRole" class="form-control form-control-solid w-250px ps-15" placeholder="Rol" value="<?= esc($searchParams['role'] ?? '') ?>" />
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
													<div class="d-flex justify-content-end mt-5">
														<button type="button" onclick="window.location='<?= base_url('users') ?>'" class="btn btn-light btn-active-light-primary me-2" data-kt-menu-dismiss="true" data-kt-customer-table-filter="reset">Reset</button>
														<button type="submit" class="btn btn-primary" data-kt-menu-dismiss="true" data-kt-customer-table-filter="filter">Apply</button>
													</div>
													<!--end::Actions-->

												</form>
												<!--end::Content-->
											</div>
											<!--end::Menu 1-->









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
											<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_add_customer">Add Users</button>
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


								<div class="card-body pt-0">

									<!--begin::Card body-->
									<div>
										<!--begin::Table-->
										<table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_customers_table" data-url="users/delete">
											<!--begin::Table head-->
											<thead>
												<!--begin::Table row-->
												<tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
													<th class="w-10px pe-2">
														<div class="form-check form-check-sm form-check-custom form-check-solid me-3">
															<input class="form-check-input" type="checkbox" data-kt-check="true" data-kt-check-target="#kt_customers_table .form-check-input" value="1" />
														</div>
													</th>
													<th class="min-w-100px">Rol</th>
													<th class="min-w-150px">Name</th>
													<th class="min-w-100px">Email</th>
													<th class="min-w-125px">Phone</th>
													<th class="min-w-50px">Country</th>
													<th class="text-end min-w-100px">Actions</th>
												</tr>
												<!--end::Table row-->
											</thead>
											<!--end::Table head-->

											<!--begin::Table body-->
											<tbody class="fw-bold text-gray-600">
												<?php foreach ($users as $user): ?>

													<tr>
														<!--begin::Checkbox-->
														<td>
															<div class="form-check form-check-sm form-check-custom form-check-solid">
																<input class="form-check-input" type="checkbox" value="1" />
															</div>
														</td>
														<!--end::Checkbox-->


														<!--begin::Rol=-->
														<td>
															<?= esc($user['role_name']) ?>
														</td>
														<!--end::Rol=-->

														<!--begin::FullName=-->
														<td>
															<?= esc($user['name']), " ", esc($user['last_name']) ?>
														</td>
														<!--end::FullName=-->

														<!--begin::Email=-->
														<td>
															<?= esc($user['email']) ?>
														</td>
														<!--end::Email=-->

														<!--begin::Phone=-->
														<td>
															+<?= esc($user['prefix']), " ", esc($user['phone']) ?>
														</td>
														<!--end::Phone=-->

														<!--begin::Country=-->
														<td>
															<?= esc($user['country']) ?>
														</td>
														<!--end::Country=-->

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
																	<a href="../../demo1/dist/apps/customers/view.html" class="menu-link px-3">View</a>
																</div>
																<!--end::Menu item-->
																<!--begin::Menu item-->
																<div class="menu-item px-3">
																	<a href="#" class="menu-link px-3" data-id="<?= $user['id'] ?>" data-kt-customer-table-filter="delete_row">Delete</a>
																</div>
																<!--end::Menu item-->
															</div>
															<!--end::Menu-->
														</td>
														<!--end::Action=-->
													</tr>
												<?php endforeach; ?>
											</tbody>
											<!--end::Table body-->


										</table>
										<!--end::Table-->


									</div>
									<!--end::Card body-->
									<!--begin::Card footer-->
									<div class="d-flex align-items-center justify-content-between mt-5">
										<?php
											$urlParams = $_GET;
											unset($urlParams['perPage']); 
											$queryString = http_build_query($urlParams);
										?>

										<form action="<?= base_url('users') ?>" method="get" class="d-inline-block">
											<?php if (!empty($queryString)): ?>
												<input type="hidden" name="<?= $queryString ?>">
											<?php endif; ?>

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
							<div class="modal fade" id="kt_modal_add_customer" tabindex="-1" aria-hidden="true">
								<!--begin::Modal dialog-->
								<div class="modal-dialog modal-dialog-centered mw-650px">
									<!--begin::Modal content-->
									<div class="modal-content">


										<!--begin::Form-->
										<form class="form" id="kt_modal_add_customer_form">
											<!--begin::Modal header-->
											<div class="modal-header" id="kt_modal_add_customer_header">
												<!--begin::Modal title-->
												<h2 class="fw-bolder">Add User</h2>
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

												<div id="validation-errors" class="alert alert-danger" style="display: none;"></div>



												<!--begin::Scroll-->
												<div class="scroll-y me-n7 pe-7" id="kt_modal_add_customer_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_customer_header" data-kt-scroll-wrappers="#kt_modal_add_customer_scroll" data-kt-scroll-offset="300px">



													<!--begin::Input group for image selection-->
													<div class="fv-row mb-7">
														<label class="fs-6 fw-bold mb-2">
															<span class="required">Select Image</span>
														</label>

														<div class="d-flex flex-wrap">
															<div class="image-option p-2">
																<img src="<?= base_url('assets/media/avatars/150-1') ?>" alt="Image 1" data-image="150-1" class="cursor-pointer img-thumbnail select-image" />
															</div>
															<div class="image-option p-2">
																<img src="<?= base_url('assets/media/avatars/150-2') ?>" alt="Image 2" data-image="150-2" class="cursor-pointer img-thumbnail select-image" />
															</div>
															<div class="image-option p-2">
																<img src="<?= base_url('assets/media/avatars/150-3') ?>" alt="Image 3" data-image="150-3" class="cursor-pointer img-thumbnail select-image" />
															</div>
															<div class="image-option p-2">
																<img src="<?= base_url('assets/media/avatars/150-4') ?>" alt="Image 4" data-image="150-4" class="cursor-pointer img-thumbnail select-image" />
															</div>
															<div class="image-option p-2">
																<img src="<?= base_url('assets/media/avatars/150-5') ?>" alt="Image 5" data-image="150-5" class="cursor-pointer img-thumbnail select-image" />
															</div>
															<div class="image-option p-2">
																<img src="<?= base_url('assets/media/avatars/150-6') ?>" alt="Image 5" data-image="150-6" class="cursor-pointer img-thumbnail select-image" />
															</div>
														</div>
													</div>
													<!--end::Input group-->


													<!--begin::Input group-->
													<div class="row g-9 mb-7">
														<!--begin::Col-->
														<div class="col-md-6 fv-row">
															<!--begin::Label-->
															<label class="required fs-6 fw-bold mb-2">Name</label>
															<!--end::Label-->
															<!--begin::Input-->
															<input type="text" class="form-control form-control-solid" name="name" value="" />
															<!--end::Input-->
														</div>
														<!--end::Col-->

														<!--begin::Col-->
														<div class="col-md-6 fv-row">
															<!--begin::Label-->
															<label class="required fs-6 fw-bold mb-2">Last Name</label>
															<!--end::Label-->
															<!--begin::Input-->
															<input type="text" class="form-control form-control-solid" name="lastName" value="" />
															<!--end::Input-->
														</div>
														<!--end::Col-->
													</div>
													<!--end::Input group-->

													<!--begin::Input group-->
													<div class="fv-row mb-7">
														<!--begin::Label-->
														<label class="fs-6 fw-bold mb-2">
															<span class="required">Email</span>
															<i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="The email address must be active"></i>
														</label>
														<!--end::Label-->
														<!--begin::Input-->
														<input type="email" class="form-control form-control-solid" placeholder="" name="email" value="" />
														<!--end::Input-->
													</div>
													<!--end::Input group-->

													<!--begin::Input group-->
													<div class="fv-row mb-7">
														<!--begin::Label-->
														<label class="fs-6 fw-bold mb-2">
															<span class="required">Password</span>
														</label>
														<!--end::Label-->
														<!--begin::Input-->
														<input type="password" class="form-control form-control-solid" placeholder="" name="password" value="" />
														<!--end::Input-->
													</div>
													<!--end::Input group-->

													<!--begin::Input group-->
													<div class="fv-row mb-7">
														<!--begin::Label-->
														<label class="fs-6 fw-bold mb-2">
															<span class="required">Password Confirmation</span>
														</label>
														<!--end::Label-->
														<!--begin::Input-->
														<input type="password" class="form-control form-control-solid" placeholder="" name="confirmPassword" value="" />
														<!--end::Input-->
													</div>
													<!--end::Input group-->


													<!--begin::Input group-->
													<div class="row g-9 mb-7">

														<!--begin::Col-->
														<div class="col-md-6 fv-row">
															<!--begin::Label-->
															<label class="required fs-6 fw-bold mb-2">Telephone Prefix</label>
															<!--end::Label-->
															<!--begin::Input-->
															<div class="d-flex gap-3">

																<select class="form-select form-select-solid fw-bolder" name="prefix" aria-label="Select a Prefix" data-control="select2" data-placeholder="Select a Prefix..." data-dropdown-parent="#kt_modal_add_customer">
																	<option value=""></option>
																	<option value="1">+1 --- (USA / Canada)</option>
																	<option value="30">+30 --- (Greece)</option>
																	<option value="31">+31 --- (Netherlands)</option>
																	<option value="32">+32 --- (Belgium)</option>
																	<option value="33">+33 --- (France)</option>
																	<option value="34">+34 --- (Spain)</option>
																	<option value="20">+20 --- (Egypt)</option>
																	<option value="36">+36 --- (Hungary)</option>
																	<option value="39">+39 --- (Italy)</option>
																	<option value="40">+40 --- (Romania)</option>
																	<option value="41">+41 --- (Switzerland)</option>
																	<option value="42">+42 --- (Czech Republic)</option>
																	<option value="43">+43 --- (Austria)</option>
																	<option value="44">+44 --- (United Kingdom)</option>
																	<option value="45">+45 --- (Denmark)</option>
																	<option value="46">+46 --- (Sweden)</option>
																	<option value="47">+47 --- (Norway)</option>
																	<option value="48">+48 --- (Poland)</option>
																	<option value="49">+49 --- (Germany)</option>
																	<option value="51">+51 --- (Peru)</option>
																	<option value="52">+52 --- (Mexico)</option>
																	<option value="53">+53 --- (Cuba)</option>
																	<option value="54">+54 --- (Argentina)</option>
																	<option value="55">+55 --- (Brazil)</option>
																	<option value="56">+56 --- (Chile)</option>
																	<option value="57">+57 --- (Colombia)</option>
																	<option value="58">+58 --- (Venezuela)</option>
																	<option value="60">+60 --- (Malaysia)</option>
																	<option value="61">+61 --- (Australia)</option>
																	<option value="62">+62 --- (Indonesia)</option>
																	<option value="63">+63 --- (Philippines)</option>
																	<option value="64">+64 --- (New Zealand)</option>
																	<option value="65">+65 --- (Singapore)</option>
																	<option value="66">+66 --- (Thailand)</option>
																	<option value="81">+81 --- (Japan)</option>
																	<option value="82">+82 --- (South Korea)</option>
																	<option value="84">+84 --- (Vietnam)</option>
																	<option value="86">+86 --- (China)</option>
																	<option value="90">+90 --- (Turkey)</option>
																	<option value="91">+91 --- (India)</option>
																	<option value="92">+92 --- (Pakistan)</option>
																	<option value="93">+93 --- (Afghanistan)</option>
																	<option value="94">+94 --- (Sri Lanka)</option>
																	<option value="95">+95 --- (Myanmar)</option>
																	<option value="98">+98 --- (Iran)</option>
																	<option value="212">+212 --- (Morocco)</option>
																	<option value="213">+213 --- (Algeria)</option>
																	<option value="216">+216 --- (Tunisia)</option>
																	<option value="218">+218 --- (Libya)</option>
																	<option value="220">+220 --- (Gambia)</option>
																	<option value="221">+221 --- (Senegal)</option>
																	<option value="222">+222 --- (Mauritania)</option>
																	<option value="223">+223 --- (Mali)</option>
																	<option value="224">+224 --- (Guinea)</option>
																	<option value="225">+225 --- (Costa de Marfil)</option>
																	<option value="226">+226 --- (Burkina Faso)</option>
																	<option value="227">+227 --- (Níger)</option>
																	<option value="228">+228 --- (Togo)</option>
																	<option value="229">+229 --- (Benín)</option>
																	<option value="230">+230 --- (Mauricio)</option>
																	<option value="231">+231 --- (Liberia)</option>
																	<option value="232">+232 --- (Sierra Leona)</option>
																	<option value="233">+233 --- (Ghana)</option>
																	<option value="234">+234 --- (Nigeria)</option>
																	<option value="235">+235 --- (Chad)</option>
																	<option value="236">+236 --- (República Centroafricana)</option>
																	<option value="237">+237 --- (Camerún)</option>
																	<option value="238">+238 --- (Cabo Verde)</option>
																	<option value="239">+239 --- (Santo Tomé y Príncipe)</option>
																	<option value="240">+240 --- (Guinea Ecuatorial)</option>
																	<option value="241">+241 --- (Gabón)</option>
																	<option value="242">+242 --- (República del Congo)</option>
																	<option value="243">+243 --- (República Democrática del Congo)</option>
																	<option value="244">+244 --- (Angola)</option>
																	<option value="245">+245 --- (Guinea-Bisáu)</option>
																	<option value="246">+246 --- (Territorio Británico del Océano Índico)</option>
																	<option value="247">+247 --- (Isla de Ascensión)</option>
																	<option value="248">+248 --- (Seychelles)</option>
																	<option value="249">+249 --- (Sudán)</option>
																	<option value="250">+250 --- (Ruanda)</option>
																	<option value="251">+251 --- (Etiopía)</option>
																	<option value="252">+252 --- (Somalia)</option>
																	<option value="253">+253 --- (Yibuti)</option>
																	<option value="254">+254 --- (Kenia)</option>
																	<option value="255">+255 --- (Tanzania)</option>
																	<option value="256">+256 --- (Uganda)</option>
																	<option value="257">+257 --- (Burundi)</option>
																	<option value="258">+258 --- (Mozambique)</option>
																	<option value="260">+260 --- (Zambia)</option>
																	<option value="261">+261 --- (Madagascar)</option>
																	<option value="262">+262 --- (Reunión, Mayotte)</option>
																	<option value="263">+263 --- (Zimbabue)</option>
																	<option value="264">+264 --- (Namibia)</option>
																	<option value="265">+265 --- (Malaui)</option>
																	<option value="266">+266 --- (Lesoto)</option>
																	<option value="267">+267 --- (Botsuana)</option>
																	<option value="268">+268 --- (Esuatini)</option>
																	<option value="269">+269 --- (Comoras)</option>
																	<option value="291">+291 --- (Eritrea)</option>
																	<option value="297">+297 --- (Aruba)</option>
																	<option value="298">+298 --- (Islas Feroe)</option>
																	<option value="299">+299 --- (Groenlandia)</option>
																	<option value="350">+350 --- (Gibraltar)</option>
																	<option value="351">+351 --- (Portugal)</option>
																	<option value="352">+352 --- (Luxemburgo)</option>
																	<option value="353">+353 --- (Irlanda)</option>
																	<option value="354">+354 --- (Islandia)</option>
																	<option value="355">+355 --- (Albania)</option>
																	<option value="356">+356 --- (Malta)</option>
																	<option value="357">+357 --- (Chipre)</option>
																	<option value="358">+358 --- (Finlandia)</option>
																	<option value="359">+359 --- (Bulgaria)</option>
																	<option value="370">+370 --- (Lituania)</option>
																	<option value="371">+371 --- (Letonia)</option>
																	<option value="372">+372 --- (Estonia)</option>
																	<option value="373">+373 --- (Moldavia)</option>
																	<option value="374">+374 --- (Armenia)</option>
																	<option value="375">+375 --- (Bielorrusia)</option>
																	<option value="376">+376 --- (Andorra)</option>
																	<option value="377">+377 --- (Mónaco)</option>
																	<option value="378">+378 --- (San Marino)</option>
																	<option value="379">+379 --- (Ciudad del Vaticano)</option>
																	<option value="380">+380 --- (Ucrania)</option>
																	<option value="381">+381 --- (Serbia)</option>
																	<option value="382">+382 --- (Montenegro)</option>
																	<option value="383">+383 --- (Kosovo)</option>
																	<option value="384">+384 --- (Macedonia)</option>
																	<option value="385">+385 --- (Croacia)</option>
																	<option value="386">+386 --- (Eslovenia)</option>
																	<option value="387">+387 --- (Bosnia y Herzegovina)</option>
																	<option value="388">+388 --- (Yugoslavia)</option>

																</select>

															</div>
															<!--end::Input-->
														</div>
														<!--end::Col-->

														<!--begin::Col-->
														<div class="col-md-6 fv-row">
															<label class="required fs-6 fw-bold mb-2">Phone Number</label>

															<!--begin::Input-->
															<div class="d-flex gap-3">
																<input class="form-control form-control-solid" name="phone" type="tel" placeholder="" />
															</div>
															<!--end::Input-->
														</div>
														<!--end::Col-->

													</div>


													<!--begin::Input group-->
													<div class="row g-9 mb-7">

														<!--begin::Col-->
														<div class="col-xl-6">
															<!--begin::Label-->
															<label class="fs-6 fw-bold mb-2">
																<span>Rol</span>
																<i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="By default it will be Client"></i>
															</label>
															<!--end::Label-->
															<select name="role" aria-label="Select a Role" data-control="select2" data-placeholder="Select a Role..." data-dropdown-parent="#kt_modal_add_customer" class="form-select form-select-solid fw-bolder">
																<option value=""></option>
																<?php foreach ($roles as $rol): ?>
																	<option value="<?= $rol['id'] ?>"><?= $rol['name'] ?></option>
																<?php endforeach; ?>
															</select>
														</div>
														<!--end::Col-->

														<!--begin::Col-->
														<div class="col-md-6 fv-row">
															<!--begin::Label-->
															<label class="fs-6 fw-bold mb-2">
																<span class="required">Country</span>
																<i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Country of Origin"></i>
															</label>
															<!--end::Label-->

															<!--begin::Input-->
															<select name="country" aria-label="Select a Country" data-control="select2" data-placeholder="Select a Country..." data-dropdown-parent="#kt_modal_add_customer" class="form-select form-select-solid fw-bolder">
																<option value=""></option>
																<option value="USA">United States</option>
																<option value="Canada">Canada</option>
																<option value="Egypt">Egypt</option>
																<option value="Greece">Greece</option>
																<option value="Netherlands">Netherlands</option>
																<option value="Belgium">Belgium</option>
																<option value="France">France</option>
																<option value="Spain">Spain</option>
																<option value="Hungary">Hungary</option>
																<option value="Italy">Italy</option>
																<option value="Romania">Romania</option>
																<option value="Switzerland">Switzerland</option>
																<option value="Czech Republic">Czech Republic</option>
																<option value="Austria">Austria</option>
																<option value="UK">United Kingdom</option>
																<option value="Denmark">Denmark</option>
																<option value="Sweden">Sweden</option>
																<option value="Norway">Norway</option>
																<option value="Poland">Poland</option>
																<option value="Germany">Germany</option>
																<option value="Peru">Peru</option>
																<option value="Mexico">Mexico</option>
																<option value="Cuba">Cuba</option>
																<option value="Argentina">Argentina</option>
																<option value="Brazil">Brazil</option>
																<option value="Chile">Chile</option>
																<option value="Colombia">Colombia</option>
																<option value="Venezuela">Venezuela</option>
																<option value="Malaysia">Malaysia</option>
																<option value="Australia">Australia</option>
																<option value="Indonesia">Indonesia</option>
																<option value="Philippines">Philippines</option>
																<option value="New Zealand">New Zealand</option>
																<option value="Singapore">Singapore</option>
																<option value="Thailand">Thailand</option>
																<option value="Japan">Japan</option>
																<option value="South Korea">South Korea</option>
																<option value="Vietnam">Vietnam</option>
																<option value="China">China</option>
																<option value="Turkey">Turkey</option>
																<option value="India">India</option>
																<option value="Pakistan">Pakistan</option>
																<option value="Afghanistan">Afghanistan</option>
																<option value="Sri Lanka">Sri Lanka</option>
																<option value="Myanmar">Myanmar</option>
																<option value="Iran">Iran</option>
																<option value="Morocco">Morocco</option>
																<option value="Algeria">Algeria</option>
																<option value="Tunisia">Tunisia</option>
																<option value="Libya">Libya</option>
																<option value="Gambia">Gambia</option>
																<option value="Senegal">Senegal</option>
																<option value="Mauritania">Mauritania</option>
																<option value="Mali">Mali</option>
																<option value="Guinea">Guinea</option>
																<option value="Ivory Coast">Ivory Coast</option>
																<option value="Burkina Faso">Burkina Faso</option>
																<option value="Niger">Niger</option>
																<option value="Togo">Togo</option>
																<option value="Benin">Benin</option>
																<option value="Mauritius">Mauritius</option>
																<option value="Liberia">Liberia</option>
																<option value="Sierra Leone">Sierra Leone</option>
																<option value="Ghana">Ghana</option>
																<option value="Nigeria">Nigeria</option>
																<option value="Chad">Chad</option>
																<option value="Cameroon">Cameroon</option>
																<option value="Cape Verde">Cape Verde</option>
																<option value="Sao Tome and Principe">Sao Tome and Principe</option>
																<option value="Equatorial Guinea">Equatorial Guinea</option>
																<option value="Gabon">Gabon</option>
																<option value="Republic of the Congo">Republic of the Congo</option>
																<option value="Democratic Republic of Congo">Democratic Republic of the Congo</option>
																<option value="Angola">Angola</option>
																<option value="Guinea-Bissau">Guinea-Bissau</option>
																<option value="Sudan">Sudan</option>
																<option value="Rwanda">Rwanda</option>
																<option value="Ethiopia">Ethiopia</option>
																<option value="Somalia">Somalia</option>
																<option value="Djibouti">Djibouti</option>
																<option value="Kenya">Kenya</option>
																<option value="Tanzania">Tanzania</option>
																<option value="Uganda">Uganda</option>
																<option value="Burundi">Burundi</option>
																<option value="Mozambique">Mozambique</option>
																<option value="Zambia">Zambia</option>
																<option value="Madagascar">Madagascar</option>
																<option value="Reunion">Reunion</option>
																<option value="Mayotte">Mayotte</option>
																<option value="Zimbabwe">Zimbabwe</option>
																<option value="Namibia">Namibia</option>
																<option value="Malawi">Malawi</option>
																<option value="Lesotho">Lesotho</option>
																<option value="Botswana">Botswana</option>
																<option value="Eswatini">Eswatini</option>
																<option value="Comoros">Comoros</option>
																<option value="Saint Helena">Saint Helena</option>
																<option value="Eritrea">Eritrea</option>
																<option value="Aruba">Aruba</option>
																<option value="Faroe Islands">Faroe Islands</option>
																<option value="Greenland">Greenland</option>
																<option value="Gibraltar">Gibraltar</option>
																<option value="Portugal">Portugal</option>
																<option value="Luxembourg">Luxembourg</option>
																<option value="Ireland">Ireland</option>
																<option value="Iceland">Iceland</option>
																<option value="Albania">Albania</option>
																<option value="Malta">Malta</option>
																<option value="Cyprus">Cyprus</option>
																<option value="Finland">Finland</option>
																<option value="Bulgaria">Bulgaria</option>
																<option value="Lithuania">Lithuania</option>
																<option value="Latvia">Latvia</option>
																<option value="Estonia">Estonia</option>
																<option value="Moldova">Moldova</option>
																<option value="Armenia">Armenia</option>
																<option value="Belarus">Belarus</option>
																<option value="Andorra">Andorra</option>
																<option value="Monaco">Monaco</option>
																<option value="San Marino">San Marino</option>
																<option value="Vatican City">Vatican City</option>
																<option value="Ukraine">Ukraine</option>
																<option value="Serbia">Serbia</option>
																<option value="Montenegro">Montenegro</option>
																<option value="Kosovo">Kosovo</option>
																<option value="Macedonia">North Macedonia</option>
																<option value="Croatia">Croatia</option>
																<option value="Slovenia">Slovenia</option>
																<option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
															</select>
															<!--end::Input-->

														</div>
														<!--end::Col-->
													</div>
													<!--end::Input group-->

												</div>
												<!--end::Scroll-->
											</div>
											<!--end::Modal body-->

											<!--begin::Modal footer-->
											<div class="modal-footer flex-center">
												<!--begin::Button-->
												<button type="reset" id="kt_modal_add_customer_cancel" class="btn btn-light me-3">Descartar</button>
												<!--end::Button-->
												<!--begin::Button-->
												<button type="submit" id="kt_modal_add_customer_submit" class="btn btn-primary">
													<span class="indicator-label">Enviar</span>
													<span class="indicator-progress">Espere por favor...
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





							<!--begin::Modal - Adjust Balance-->
							<div class="modal fade" id="kt_customers_export_modal" tabindex="-1" aria-hidden="true">
								<!--begin::Modal dialog-->
								<div class="modal-dialog modal-dialog-centered mw-650px">
									<!--begin::Modal content-->
									<div class="modal-content">
										<!--begin::Modal header-->
										<div class="modal-header">
											<!--begin::Modal title-->
											<h2 class="fw-bolder">Export Customers</h2>
											<!--end::Modal title-->
											<!--begin::Close-->
											<div id="kt_customers_export_close" class="btn btn-icon btn-sm btn-active-icon-primary">
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
										<div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
											<!--begin::Form-->
											<form id="kt_customers_export_form" class="form" action="#">
												<!--begin::Input group-->
												<div class="fv-row mb-10">
													<!--begin::Label-->
													<label class="fs-5 fw-bold form-label mb-5">Select Date Range:</label>
													<!--end::Label-->
													<!--begin::Input-->
													<input class="form-control form-control-solid" placeholder="Pick a date" name="date" />
													<!--end::Input-->
												</div>
												<!--end::Input group-->
												<!--begin::Input group-->
												<div class="fv-row mb-10">
													<!--begin::Label-->
													<label class="fs-5 fw-bold form-label mb-5">Select Export Format:</label>
													<!--end::Label-->
													<!--begin::Input-->
													<select data-control="select2" data-placeholder="Select a format" data-hide-search="true" name="format" class="form-select form-select-solid">
														<option value="excell">Excel</option>
														<option value="pdf">PDF</option>
														<option value="cvs">CVS</option>
														<option value="zip">ZIP</option>
													</select>
													<!--end::Input-->
												</div>
												<!--end::Input group-->
												<!--begin::Row-->
												<div class="row fv-row mb-15">
													<!--begin::Label-->
													<label class="fs-5 fw-bold form-label mb-5">Payment Type:</label>
													<!--end::Label-->
													<!--begin::Radio group-->
													<div class="d-flex flex-column">
														<!--begin::Radio button-->
														<label class="form-check form-check-custom form-check-sm form-check-solid mb-3">
															<input class="form-check-input" type="checkbox" value="1" checked="checked" name="payment_type" />
															<span class="form-check-label text-gray-600 fw-bold">All</span>
														</label>
														<!--end::Radio button-->
														<!--begin::Radio button-->
														<label class="form-check form-check-custom form-check-sm form-check-solid mb-3">
															<input class="form-check-input" type="checkbox" value="2" checked="checked" name="payment_type" />
															<span class="form-check-label text-gray-600 fw-bold">Visa</span>
														</label>
														<!--end::Radio button-->
														<!--begin::Radio button-->
														<label class="form-check form-check-custom form-check-sm form-check-solid mb-3">
															<input class="form-check-input" type="checkbox" value="3" name="payment_type" />
															<span class="form-check-label text-gray-600 fw-bold">Mastercard</span>
														</label>
														<!--end::Radio button-->
														<!--begin::Radio button-->
														<label class="form-check form-check-custom form-check-sm form-check-solid">
															<input class="form-check-input" type="checkbox" value="4" name="payment_type" />
															<span class="form-check-label text-gray-600 fw-bold">American Express</span>
														</label>
														<!--end::Radio button-->
													</div>
													<!--end::Input group-->
												</div>
												<!--end::Row-->
												<!--begin::Actions-->
												<div class="text-center">
													<button type="reset" id="kt_customers_export_cancel" class="btn btn-light me-3">Discard</button>
													<button type="submit" id="kt_customers_export_submit" class="btn btn-primary">
														<span class="indicator-label">Submit</span>
														<span class="indicator-progress">Please wait...
															<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
													</button>
												</div>
												<!--end::Actions-->
											</form>
											<!--end::Form-->
										</div>
										<!--end::Modal body-->
									</div>
									<!--end::Modal content-->
								</div>
								<!--end::Modal dialog-->
							</div>
							<!--end::Modal - New Card-->

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



	<!--end::Drawers-->
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
	<!--end::Main-->

	<!--begin::Javascript-->
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
	<script src="./assets/js/custom/apps/customers/add.js"></script>
	<script src="./assets/js/custom/widgets.js"></script>
	<!--end::Page Custom Javascript-->
	<!--end::Javascript-->
</body>
<!--end::Body-->

</html>