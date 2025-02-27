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
							<h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Dashboard</h1>
							<!--end::Title-->
						</div>
						<!--end::Page title-->
					</div>
					<!--end::Container-->
				</div>
				<!--end::Header-->
				<!--begin::Content-->
				<div class="post d-flex flex-column-fluid" id="kt_post">
					<!--begin::Container-->
					<div id="kt_content_container" class="container-xxl">
						<!--begin::Row-->
						<div class="row gy-5 g-xl-8">

							<!--begin::Col-->
							<div class="col-xxl-4">
								<!--begin::Mixed Widget 2-->
								<div class="card card-xxl-stretch">
									<!--begin::Header-->
									<div class="card-header border-0 bg-danger py-5">
										<h3 class="card-title fw-bolder text-white">Latest Orders</h3>
									</div>
									<!--end::Header-->
									<!--begin::Body-->
									<div class="card-body p-0">
										<!--begin::Chart-->
										<div class="mixed-widget-2-chart card-rounded-bottom bg-danger" data-kt-color="danger" style="height: 200px"></div>
										<!--end::Chart-->
										<!--begin::Stats-->

										<div class="card-p mt-n20 position-relative">

											<?php
											$today = new DateTime();
											$today->setTime(0, 0);

											$countToday = 0;
											$countWeek = 0;
											$countMonth = 0;
											$countYear = 0;

											foreach ($orderUser as $order) {
												$date = new DateTime($order["date"]);

												if (is_null($order['disabled'])) {
													if ($date->format('Y-m-d') == $today->format('Y-m-d')) {
														$countToday++;
													}

													if ($date > (clone $today)->modify('-7 days')) {
														$countWeek++;
													}

													if ($date > (clone $today)->modify('-1 month')) {
														$countMonth++;
													}

													if ($date > (clone $today)->modify('-1 year')) {
														$countYear++;
													}
												}
											}
											?>
											<!--begin::Row-->
											<div class="row g-0">
												<!--begin::Col-->
												<div class="col bg-light-warning px-6 py-8 rounded-2 me-7 mb-7">
													<div class="d-flex align-items-center">
														<!--begin::Svg Icon-->
														<span class="svg-icon svg-icon-3x svg-icon-warning my-2">
															<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																<rect x="8" y="9" width="3" height="10" rx="1.5" fill="black" />
																<rect opacity="0.5" x="13" y="5" width="3" height="14" rx="1.5" fill="black" />
																<rect x="18" y="11" width="3" height="8" rx="1.5" fill="black" />
																<rect x="3" y="13" width="3" height="6" rx="1.5" fill="black" />
															</svg>
														</span>
														<!--end::Svg Icon-->
														<span class="fs-3 fw-bold text-warning ms-3"><?= $countToday ?></span>
													</div>
													<a href="#" class="text-warning fw-bold fs-6">Today</a>
												</div>
												<!--end::Col-->
												<!--begin::Col-->
												<div class="col bg-light-primary px-6 py-8 rounded-2 mb-7">
													<div class="d-flex align-items-center">
														<span class="svg-icon svg-icon-3x svg-icon-primary my-2">
															<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																<rect x="8" y="9" width="3" height="10" rx="1.5" fill="black" />
																<rect opacity="0.5" x="13" y="5" width="3" height="14" rx="1.5" fill="black" />
																<rect x="18" y="11" width="3" height="8" rx="1.5" fill="black" />
																<rect x="3" y="13" width="3" height="6" rx="1.5" fill="black" />
															</svg>
														</span>
														<span class="fs-3 fw-bold text-primary ms-3"><?= $countWeek ?></span>
													</div>
													<a href="#" class="text-primary fw-bold fs-6">Last Week</a>
												</div>
												<!--end::Col-->
											</div>
											<!--end::Row-->
											<!--begin::Row-->
											<div class="row g-0">
												<!--begin::Col-->
												<div class="col bg-light-danger px-6 py-8 rounded-2 me-7">
													<div class="d-flex align-items-center">
														<span class="svg-icon svg-icon-3x svg-icon-danger my-2">
															<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																<rect x="8" y="9" width="3" height="10" rx="1.5" fill="black" />
																<rect opacity="0.5" x="13" y="5" width="3" height="14" rx="1.5" fill="black" />
																<rect x="18" y="11" width="3" height="8" rx="1.5" fill="black" />
																<rect x="3" y="13" width="3" height="6" rx="1.5" fill="black" />
															</svg>
														</span>
														<span class="fs-3 fw-bold text-danger ms-3"><?= $countMonth ?></span>
													</div>
													<a href="#" class="text-danger fw-bold fs-6 mt-2">Last Month</a>
												</div>
												<!--end::Col-->
												<!--begin::Col-->
												<div class="col bg-light-success px-6 py-8 rounded-2">
													<div class="d-flex align-items-center">
														<span class="svg-icon svg-icon-3x svg-icon-success my-2">
															<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																<rect x="8" y="9" width="3" height="10" rx="1.5" fill="black" />
																<rect opacity="0.5" x="13" y="5" width="3" height="14" rx="1.5" fill="black" />
																<rect x="18" y="11" width="3" height="8" rx="1.5" fill="black" />
																<rect x="3" y="13" width="3" height="6" rx="1.5" fill="black" />
															</svg>
														</span>
														<span class="fs-3 fw-bold text-success ms-3"><?= $countYear ?></span>
													</div>
													<a href="#" class="text-success fw-bold fs-6 mt-2">Last Year</a>
												</div>
												<!--end::Col-->
											</div>
											<!--end::Row-->
										</div>

										<!--end::Stats-->
									</div>
									<!--end::Body-->
								</div>
								<!--end::Mixed Widget 2-->
							</div>
							<!--end::Col-->

							<!--begin::Col-->
							<div class="col-xxl-4">
								<!--begin::List Widget 5-->
								<div class="card card-xxl-stretch">
									<!--begin::Header-->
									<div class="card-header align-items-center border-0 mt-4">
										<h3 class="card-title align-items-start flex-column">
											<span class="fw-bolder mb-2 text-dark">Latest Orders</span>
											<span class="text-muted fw-bold fs-7"><?php !empty($orderUser) && count($orderUser) ?> Orders</span>
										</h3>
									</div>
									<!--end::Header-->

									<!--begin::Body-->
									<!--begin::Timeline-->
									<?php if (empty($orderUser)): ?>
										<div class="card-body pt-5 overflow-auto d-flex flex-column justify-content-center align-items-center" style="min-height: 200px;">
											<div class=" w-100">
												<div class=" alert alert-warning text-center w-100">
													You have not placed any order
												</div>
											</div>
										</div>
									<?php else: ?>
										<div class="card-body pt-5 ">
											<div class="timeline-label w-100">
												<?php foreach (array_slice($orderUser, 0, 7) as $order): ?>
													<!--begin::Item-->
													<div class="timeline-item">
														<!--begin::Label-->
														<div class="timeline-label fw-bolder text-gray-800 fs-6">
															<?= date("d/m", strtotime($order['date'])) ?>
														</div>
														<!--end::Label-->
														<!--begin::Badge-->
														<div class="timeline-badge" data-bs-toggle="tooltip" style="cursor:pointer;">
															<i class="fa fa-genderless text-primary fs-1"></i>
														</div>
														<!--end::Badge-->
														<!--begin::Text-->
														<div class="fw-mormal timeline-content text-muted ps-3">
															<span class="fw-bolder text-gray-800"><?= $order['id'] ?>:</span> Total Price <?= $order['price'] ?> $

														</div>
														<!--end::Text-->
													</div>

													<!--end::Item-->
												<?php endforeach; ?>
											</div>
										</div>
									<?php endif; ?>
									<!--end::Timeline-->


									<!--end: Card Body-->

									<!--end: Card Body-->
								</div>
								<!--end: List Widget 5-->
							</div>
							<!--end::Col-->

							<!--begin::Col-->
							<div class="col-xxl-4">
								<!--begin::Mixed Widget 7-->
								<div class="card card-xxl-stretch-50 mb-10 mb-xl-8">
									<!--begin::Body-->
									<div class="card-body d-flex flex-column justify-content-center align-items-center p-0">
										<!--begin::Stats-->
										<div class="flex-grow-1 card-p pb-0 w-100">
											<div class="d-flex flex-stack flex-wrap">
												<div class="me-2">
													<a class="text-dark text-hover-primary fw-bolder fs-3">Top seller</a>
												</div>
											</div>
										</div>
										<!--end::Stats-->
										<!--begin::Chart-->
										<div id="chartCircle" class="pb-10"></div>
										<!--end::Chart-->
									</div>
									<!--end::Body-->
								</div>
								<!--end::Mixed Widget 7-->
								<!--begin::Mixed Widget 10-->
								<div class="card card-xxl-stretch-50 mb-5 mb-xl-8">
									<!--begin::Body-->
									<div class="card-body p-0 d-flex justify-content-between flex-column overflow-hidden">
										<!--begin::Hidden-->
										<div class="d-flex flex-stack flex-wrap flex-grow-1 px-9 pt-9 ">
											<div class="me-2">
												<span class="fw-bolder text-gray-800 d-block fs-3">
													<?php
													switch (session()->get('userRole')) {
														case 'Customer':
															echo 'Shopping';
															break;
														case 'Chef':
															echo 'Orders';
															break;
														case 'Administrator':
															echo 'Earnings';
															break;
														default:
															echo 'Not Found';
															break;
													}
													?>

												</span>
												<?php
												$dateNow = new DateTime();
												$dateEightMonth = new DateTime();
												$dateEightMonth->modify('-8 months');

												?>
												<span class="text-gray-400 fw-bold">Last 8 months <?= $dateEightMonth->format('M y'), ' - ', $dateNow->format('M y') ?></span>
											</div>

											<div id="totalMoneyLastMonths" class="fw-bolder fs-3 text-primary"></div>
										</div>
										<!--end::Hidden-->
										<!--begin::Chart-->
										<div id="chartDuoColumns" class="px-10"></div>
										<!--end::Chart-->
									</div>
								</div>
								<!--end::Mixed Widget 10-->
							</div>
							<!--end::Col-->

						</div>
						<!--end::Row-->


						<!--begin::Row-->
						<div class="row gy-5 g-xl-8">

							<!--begin::Tables Widget 9-->
							<div class="card card-xl-stretch mb-5 mb-xl-8">
								<!--begin::Header-->
								<div class="card-header border-0 pt-5">
									<h3 class="card-title align-items-start flex-column">
										<span class="card-label fw-bolder fs-3 mb-1">Members Statistics</span>
										<span class="text-muted mt-1 fw-bold fs-7">Over 500 members</span>
									</h3>
									<div class="card-toolbar" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover" title="Click to add a user">
										<a href="#" class="btn btn-sm btn-light btn-active-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_invite_friends">
											<!--begin::Svg Icon | path: icons/duotune/arrows/arr075.svg-->
											<span class="svg-icon svg-icon-3">
												<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
													<rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1" transform="rotate(-90 11.364 20.364)" fill="black" />
													<rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="black" />
												</svg>
											</span>
											<!--end::Svg Icon-->New Member</a>
									</div>
								</div>
								<!--end::Header-->
								<!--begin::Body-->
								<div class="card-body py-3">
									<!--begin::Table container-->
									<div class="table-responsive">
										<!--begin::Table-->
										<table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
											<!--begin::Table head-->
											<thead>
												<tr class="fw-bolder text-muted">
													<th class="w-25px">
														<div class="form-check form-check-sm form-check-custom form-check-solid">
															<input class="form-check-input" type="checkbox" value="1" data-kt-check="true" data-kt-check-target=".widget-9-check" />
														</div>
													</th>
													<th class="min-w-150px">Authors</th>
													<th class="min-w-140px">Company</th>
													<th class="min-w-120px">Progress</th>
													<th class="min-w-100px text-end">Actions</th>
												</tr>
											</thead>
											<!--end::Table head-->
											<!--begin::Table body-->
											<tbody>
												<tr>
													<td>
														<div class="form-check form-check-sm form-check-custom form-check-solid">
															<input class="form-check-input widget-9-check" type="checkbox" value="1" />
														</div>
													</td>
													<td>
														<div class="d-flex align-items-center">
															<div class="symbol symbol-45px me-5">
																<img src="assets/media/avatars/150-11.jpg" alt="" />
															</div>
															<div class="d-flex justify-content-start flex-column">
																<a href="#" class="text-dark fw-bolder text-hover-primary fs-6">Ana Simmons</a>
																<span class="text-muted fw-bold text-muted d-block fs-7">HTML, JS, ReactJS</span>
															</div>
														</div>
													</td>
													<td>
														<a href="#" class="text-dark fw-bolder text-hover-primary d-block fs-6">Intertico</a>
														<span class="text-muted fw-bold text-muted d-block fs-7">Web, UI/UX Design</span>
													</td>
													<td class="text-end">
														<div class="d-flex flex-column w-100 me-2">
															<div class="d-flex flex-stack mb-2">
																<span class="text-muted me-2 fs-7 fw-bold">50%</span>
															</div>
															<div class="progress h-6px w-100">
																<div class="progress-bar bg-primary" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
															</div>
														</div>
													</td>
													<td>
														<div class="d-flex justify-content-end flex-shrink-0">
															<a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
																<!--begin::Svg Icon | path: icons/duotune/general/gen019.svg-->
																<span class="svg-icon svg-icon-3">
																	<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																		<path d="M17.5 11H6.5C4 11 2 9 2 6.5C2 4 4 2 6.5 2H17.5C20 2 22 4 22 6.5C22 9 20 11 17.5 11ZM15 6.5C15 7.9 16.1 9 17.5 9C18.9 9 20 7.9 20 6.5C20 5.1 18.9 4 17.5 4C16.1 4 15 5.1 15 6.5Z" fill="black" />
																		<path opacity="0.3" d="M17.5 22H6.5C4 22 2 20 2 17.5C2 15 4 13 6.5 13H17.5C20 13 22 15 22 17.5C22 20 20 22 17.5 22ZM4 17.5C4 18.9 5.1 20 6.5 20C7.9 20 9 18.9 9 17.5C9 16.1 7.9 15 6.5 15C5.1 15 4 16.1 4 17.5Z" fill="black" />
																	</svg>
																</span>
																<!--end::Svg Icon-->
															</a>
															<a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
																<!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
																<span class="svg-icon svg-icon-3">
																	<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																		<path opacity="0.3" d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z" fill="black" />
																		<path d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z" fill="black" />
																	</svg>
																</span>
																<!--end::Svg Icon-->
															</a>
															<a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm">
																<!--begin::Svg Icon | path: icons/duotune/general/gen027.svg-->
																<span class="svg-icon svg-icon-3">
																	<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																		<path d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z" fill="black" />
																		<path opacity="0.5" d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z" fill="black" />
																		<path opacity="0.5" d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z" fill="black" />
																	</svg>
																</span>
																<!--end::Svg Icon-->
															</a>
														</div>
													</td>
												</tr>
												<tr>
													<td>
														<div class="form-check form-check-sm form-check-custom form-check-solid">
															<input class="form-check-input widget-9-check" type="checkbox" value="1" />
														</div>
													</td>
													<td>
														<div class="d-flex align-items-center">
															<div class="symbol symbol-45px me-5">
																<img src="assets/media/avatars/150-3.jpg" alt="" />
															</div>
															<div class="d-flex justify-content-start flex-column">
																<a href="#" class="text-dark fw-bolder text-hover-primary fs-6">Jessie Clarcson</a>
																<span class="text-muted fw-bold text-muted d-block fs-7">C#, ASP.NET, MS SQL</span>
															</div>
														</div>
													</td>
													<td>
														<a href="#" class="text-dark fw-bolder text-hover-primary d-block fs-6">Agoda</a>
														<span class="text-muted fw-bold text-muted d-block fs-7">Houses &amp; Hotels</span>
													</td>
													<td class="text-end">
														<div class="d-flex flex-column w-100 me-2">
															<div class="d-flex flex-stack mb-2">
																<span class="text-muted me-2 fs-7 fw-bold">70%</span>
															</div>
															<div class="progress h-6px w-100">
																<div class="progress-bar bg-danger" role="progressbar" style="width: 70%" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
															</div>
														</div>
													</td>
													<td>
														<div class="d-flex justify-content-end flex-shrink-0">
															<a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
																<!--begin::Svg Icon | path: icons/duotune/general/gen019.svg-->
																<span class="svg-icon svg-icon-3">
																	<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																		<path d="M17.5 11H6.5C4 11 2 9 2 6.5C2 4 4 2 6.5 2H17.5C20 2 22 4 22 6.5C22 9 20 11 17.5 11ZM15 6.5C15 7.9 16.1 9 17.5 9C18.9 9 20 7.9 20 6.5C20 5.1 18.9 4 17.5 4C16.1 4 15 5.1 15 6.5Z" fill="black" />
																		<path opacity="0.3" d="M17.5 22H6.5C4 22 2 20 2 17.5C2 15 4 13 6.5 13H17.5C20 13 22 15 22 17.5C22 20 20 22 17.5 22ZM4 17.5C4 18.9 5.1 20 6.5 20C7.9 20 9 18.9 9 17.5C9 16.1 7.9 15 6.5 15C5.1 15 4 16.1 4 17.5Z" fill="black" />
																	</svg>
																</span>
																<!--end::Svg Icon-->
															</a>
															<a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
																<!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
																<span class="svg-icon svg-icon-3">
																	<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																		<path opacity="0.3" d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z" fill="black" />
																		<path d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z" fill="black" />
																	</svg>
																</span>
																<!--end::Svg Icon-->
															</a>
															<a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm">
																<!--begin::Svg Icon | path: icons/duotune/general/gen027.svg-->
																<span class="svg-icon svg-icon-3">
																	<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																		<path d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z" fill="black" />
																		<path opacity="0.5" d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z" fill="black" />
																		<path opacity="0.5" d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z" fill="black" />
																	</svg>
																</span>
																<!--end::Svg Icon-->
															</a>
														</div>
													</td>
												</tr>
												<tr>
													<td>
														<div class="form-check form-check-sm form-check-custom form-check-solid">
															<input class="form-check-input widget-9-check" type="checkbox" value="1" />
														</div>
													</td>
													<td>
														<div class="d-flex align-items-center">
															<div class="symbol symbol-45px me-5">
																<img src="assets/media/avatars/150-4.jpg" alt="" />
															</div>
															<div class="d-flex justify-content-start flex-column">
																<a href="#" class="text-dark fw-bolder text-hover-primary fs-6">Lebron Wayde</a>
																<span class="text-muted fw-bold text-muted d-block fs-7">PHP, Laravel, VueJS</span>
															</div>
														</div>
													</td>
													<td>
														<a href="#" class="text-dark fw-bolder text-hover-primary d-block fs-6">RoadGee</a>
														<span class="text-muted fw-bold text-muted d-block fs-7">Transportation</span>
													</td>
													<td class="text-end">
														<div class="d-flex flex-column w-100 me-2">
															<div class="d-flex flex-stack mb-2">
																<span class="text-muted me-2 fs-7 fw-bold">60%</span>
															</div>
															<div class="progress h-6px w-100">
																<div class="progress-bar bg-success" role="progressbar" style="width: 60%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
															</div>
														</div>
													</td>
													<td>
														<div class="d-flex justify-content-end flex-shrink-0">
															<a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
																<!--begin::Svg Icon | path: icons/duotune/general/gen019.svg-->
																<span class="svg-icon svg-icon-3">
																	<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																		<path d="M17.5 11H6.5C4 11 2 9 2 6.5C2 4 4 2 6.5 2H17.5C20 2 22 4 22 6.5C22 9 20 11 17.5 11ZM15 6.5C15 7.9 16.1 9 17.5 9C18.9 9 20 7.9 20 6.5C20 5.1 18.9 4 17.5 4C16.1 4 15 5.1 15 6.5Z" fill="black" />
																		<path opacity="0.3" d="M17.5 22H6.5C4 22 2 20 2 17.5C2 15 4 13 6.5 13H17.5C20 13 22 15 22 17.5C22 20 20 22 17.5 22ZM4 17.5C4 18.9 5.1 20 6.5 20C7.9 20 9 18.9 9 17.5C9 16.1 7.9 15 6.5 15C5.1 15 4 16.1 4 17.5Z" fill="black" />
																	</svg>
																</span>
																<!--end::Svg Icon-->
															</a>
															<a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
																<!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
																<span class="svg-icon svg-icon-3">
																	<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																		<path opacity="0.3" d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z" fill="black" />
																		<path d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z" fill="black" />
																	</svg>
																</span>
																<!--end::Svg Icon-->
															</a>
															<a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm">
																<!--begin::Svg Icon | path: icons/duotune/general/gen027.svg-->
																<span class="svg-icon svg-icon-3">
																	<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																		<path d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z" fill="black" />
																		<path opacity="0.5" d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z" fill="black" />
																		<path opacity="0.5" d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z" fill="black" />
																	</svg>
																</span>
																<!--end::Svg Icon-->
															</a>
														</div>
													</td>
												</tr>
												<tr>
													<td>
														<div class="form-check form-check-sm form-check-custom form-check-solid">
															<input class="form-check-input widget-9-check" type="checkbox" value="1" />
														</div>
													</td>
													<td>
														<div class="d-flex align-items-center">
															<div class="symbol symbol-45px me-5">
																<img src="assets/media/avatars/150-5.jpg" alt="" />
															</div>
															<div class="d-flex justify-content-start flex-column">
																<a href="#" class="text-dark fw-bolder text-hover-primary fs-6">Natali Goodwin</a>
																<span class="text-muted fw-bold text-muted d-block fs-7">Python, PostgreSQL, ReactJS</span>
															</div>
														</div>
													</td>
													<td>
														<a href="#" class="text-dark fw-bolder text-hover-primary d-block fs-6">The Hill</a>
														<span class="text-muted fw-bold text-muted d-block fs-7">Insurance</span>
													</td>
													<td class="text-end">
														<div class="d-flex flex-column w-100 me-2">
															<div class="d-flex flex-stack mb-2">
																<span class="text-muted me-2 fs-7 fw-bold">50%</span>
															</div>
															<div class="progress h-6px w-100">
																<div class="progress-bar bg-warning" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
															</div>
														</div>
													</td>
													<td>
														<div class="d-flex justify-content-end flex-shrink-0">
															<a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
																<!--begin::Svg Icon | path: icons/duotune/general/gen019.svg-->
																<span class="svg-icon svg-icon-3">
																	<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																		<path d="M17.5 11H6.5C4 11 2 9 2 6.5C2 4 4 2 6.5 2H17.5C20 2 22 4 22 6.5C22 9 20 11 17.5 11ZM15 6.5C15 7.9 16.1 9 17.5 9C18.9 9 20 7.9 20 6.5C20 5.1 18.9 4 17.5 4C16.1 4 15 5.1 15 6.5Z" fill="black" />
																		<path opacity="0.3" d="M17.5 22H6.5C4 22 2 20 2 17.5C2 15 4 13 6.5 13H17.5C20 13 22 15 22 17.5C22 20 20 22 17.5 22ZM4 17.5C4 18.9 5.1 20 6.5 20C7.9 20 9 18.9 9 17.5C9 16.1 7.9 15 6.5 15C5.1 15 4 16.1 4 17.5Z" fill="black" />
																	</svg>
																</span>
																<!--end::Svg Icon-->
															</a>
															<a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
																<!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
																<span class="svg-icon svg-icon-3">
																	<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																		<path opacity="0.3" d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z" fill="black" />
																		<path d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z" fill="black" />
																	</svg>
																</span>
																<!--end::Svg Icon-->
															</a>
															<a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm">
																<!--begin::Svg Icon | path: icons/duotune/general/gen027.svg-->
																<span class="svg-icon svg-icon-3">
																	<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																		<path d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z" fill="black" />
																		<path opacity="0.5" d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z" fill="black" />
																		<path opacity="0.5" d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z" fill="black" />
																	</svg>
																</span>
																<!--end::Svg Icon-->
															</a>
														</div>
													</td>
												</tr>
												<tr>
													<td>
														<div class="form-check form-check-sm form-check-custom form-check-solid">
															<input class="form-check-input widget-9-check" type="checkbox" value="1" />
														</div>
													</td>
													<td>
														<div class="d-flex align-items-center">
															<div class="symbol symbol-45px me-5">
																<img src="assets/media/avatars/150-6.jpg" alt="" />
															</div>
															<div class="d-flex justify-content-start flex-column">
																<a href="#" class="text-dark fw-bolder text-hover-primary fs-6">Kevin Leonard</a>
																<span class="text-muted fw-bold text-muted d-block fs-7">HTML, JS, ReactJS</span>
															</div>
														</div>
													</td>
													<td>
														<a href="#" class="text-dark fw-bolder text-hover-primary d-block fs-6">RoadGee</a>
														<span class="text-muted fw-bold text-muted d-block fs-7">Art Director</span>
													</td>
													<td class="text-end">
														<div class="d-flex flex-column w-100 me-2">
															<div class="d-flex flex-stack mb-2">
																<span class="text-muted me-2 fs-7 fw-bold">90%</span>
															</div>
															<div class="progress h-6px w-100">
																<div class="progress-bar bg-info" role="progressbar" style="width: 90%" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
															</div>
														</div>
													</td>
													<td>
														<div class="d-flex justify-content-end flex-shrink-0">
															<a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
																<!--begin::Svg Icon | path: icons/duotune/general/gen019.svg-->
																<span class="svg-icon svg-icon-3">
																	<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																		<path d="M17.5 11H6.5C4 11 2 9 2 6.5C2 4 4 2 6.5 2H17.5C20 2 22 4 22 6.5C22 9 20 11 17.5 11ZM15 6.5C15 7.9 16.1 9 17.5 9C18.9 9 20 7.9 20 6.5C20 5.1 18.9 4 17.5 4C16.1 4 15 5.1 15 6.5Z" fill="black" />
																		<path opacity="0.3" d="M17.5 22H6.5C4 22 2 20 2 17.5C2 15 4 13 6.5 13H17.5C20 13 22 15 22 17.5C22 20 20 22 17.5 22ZM4 17.5C4 18.9 5.1 20 6.5 20C7.9 20 9 18.9 9 17.5C9 16.1 7.9 15 6.5 15C5.1 15 4 16.1 4 17.5Z" fill="black" />
																	</svg>
																</span>
																<!--end::Svg Icon-->
															</a>
															<a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
																<!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
																<span class="svg-icon svg-icon-3">
																	<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																		<path opacity="0.3" d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z" fill="black" />
																		<path d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z" fill="black" />
																	</svg>
																</span>
																<!--end::Svg Icon-->
															</a>
															<a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm">
																<!--begin::Svg Icon | path: icons/duotune/general/gen027.svg-->
																<span class="svg-icon svg-icon-3">
																	<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																		<path d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z" fill="black" />
																		<path opacity="0.5" d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z" fill="black" />
																		<path opacity="0.5" d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z" fill="black" />
																	</svg>
																</span>
																<!--end::Svg Icon-->
															</a>
														</div>
													</td>
												</tr>
											</tbody>
											<!--end::Table body-->
										</table>
										<!--end::Table-->
									</div>
									<!--end::Table container-->
								</div>
								<!--begin::Body-->
							</div>
							<!--end::Tables Widget 9-->
						</div>
						<!--end::Row-->


						<!--end::Row-->
					</div>
					<!--end::Container-->
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
	<!--end::Main-->
	<script>
		const ordersData = <?= json_encode($orderElements) ?? '[]' ?>;
	</script>

	<!--begin::Javascript-->
	<!--begin::Global Javascript Bundle(used by all pages)-->
	<script src="assets/plugins/global/plugins.bundle.js"></script>
	<script src="assets/js/scripts.bundle.js"></script>
	<!--end::Global Javascript Bundle-->
	<!--begin::Page Vendors Javascript(used by this page)-->
	<script src="assets/plugins/custom/fullcalendar/fullcalendar.bundle.js"></script>
	<!--end::Page Vendors Javascript-->
	<!--begin::Page Custom Javascript(used by this page)-->
	<script src="assets/js/custom/widgets.js"></script>
	<script src="assets/js/custom/apps/chat/chatConfig.js"></script>
	<!--end::Page Custom Javascript-->
	<!--end::Javascript-->
</body>
<!--end::Body-->

</html>