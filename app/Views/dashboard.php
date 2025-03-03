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
	<meta name="description" content="At Chimicha, we blend tradition and flavor to offer you a unique dining experience. Since our beginnings, we have worked with fresh ingredients and authentic recipes that make every dish an unforgettable delight." />
	<meta name="keywords" content="Chimixa, Metronic, php, codeigniter, gestion de restaurantes" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta charset="utf-8" />
	<link rel="icon" type="image/x-icon" href="<?= base_url('/assets/favicon.ico') ?>" />
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
						<div class="row gy-5 g-xl-8" id="container">

							<!--begin::Col-->
							<div class="col-xxl-4">
								<div class="section-1" data-swapy-slot="foo">
									<!--begin::Mixed Widget 2-->
									<div class="card card-xxl-stretch"  data-swapy-item="a">
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
							</div>
							<!--end::Col-->

							<!--begin::Col-->
							<div class="col-xxl-4">
								<div class="section-2" data-swapy-slot="bar">

									<!--begin::List Widget 5-->
									<div class="card card-xxl-stretch"  data-swapy-item="b">
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
							</div>
							<!--end::Col-->

							<!--begin::Col-->
							<div class="col-xxl-4">
								<div class="section-3" data-swapy-slot="baz">
									<div class="content-c" data-swapy-item="c">

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
												<div id="chartCircle" class="pb-5"></div>
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
								</div>
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
										<span class="card-label fw-bolder fs-3 mb-1">Quantity of Items Sold</span>
										<span class="text-muted mt-1 fw-bold fs-7">Between plates and menus</span>
									</h3>
									
								</div>
								<!--end::Header-->
								<!--begin::Body-->
								<div id="chartHeatMap" class="card-body py-3">
									
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
	<script src="https://unpkg.com/swapy/dist/swapy.min.js"></script>
	<script src="assets/js/custom/apps/chat/chatConfig.js"></script>

	<script src="assets/js/custom/apps/chat/swapy.js"></script>
	<!--end::Page Custom Javascript-->
	<!--end::Javascript-->
</body>
<!--end::Body-->

</html>