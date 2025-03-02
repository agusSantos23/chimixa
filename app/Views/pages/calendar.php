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
	<link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css" rel="stylesheet">

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
							<h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Calendar</h1>
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
								<li class="breadcrumb-item text-dark">Calendar</li>
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
				<div class="content d-flex flex-column flex-column-fluid" id="kt_content">

					<!--begin::Post-->
					<div class="post d-flex flex-column-fluid" id="kt_post">
						<!--begin::Container-->
						<div id="kt_content_container" class="container-xxl">


							<!--begin::Card-->
							<div class="card">
								<!--begin::Card header-->
								<div class="card-header">
									<h2 class="card-title fw-bolder">Calendar</h2>
									<div class="card-toolbar">
										<button class="btn btn-flex btn-primary" id="addOrderToday" data-bs-toggle="modal" data-bs-target="#kt_modal_add_customer">
											<!--begin::Svg Icon | path: icons/duotune/arrows/arr075.svg-->
											<span class="svg-icon svg-icon-2">
												<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
													<rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1" transform="rotate(-90 11.364 20.364)" fill="black" />
													<rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="black" />
												</svg>
											</span>
											<!--end::Svg Icon-->Add Order</button>
									</div>
								</div>
								<!--end::Card header-->
								<!--begin::Card body-->
								<div class="card-body">
									<!--begin::Calendar-->
									<div id="calendar"></div>
									<!--end::Calendar-->
								</div>
								<!--end::Card body-->
							</div>
							<!--end::Card-->


							<!--begin::Modals-->


							


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
												<h2 class="fw-bolder" id="headerModal">add a Order</h2>
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
	<!--end::Main-->

	<!--begin::Javascript-->
	<!--begin::Global Javascript Bundle(used by all pages)-->
	<script src="assets/plugins/global/plugins.bundle.js"></script>
	<script src="assets/js/scripts.bundle.js"></script>
	<script src="assets/js/custom/widgets.js"></script>

	<!--end::Global Javascript Bundle-->
	<!--begin::Page Vendors Javascript(used by this page)-->
	<script src="assets/plugins/custom/fullcalendar/fullcalendar.bundle.js" defer></script>
	<!--end::Page Vendors Javascript-->
	<script src="assets/js/custom/apps/calendar/calendar.js" defer></script>
	<script src="./assets/js/custom/apps/customers/add/addOrder.js"></script>

	<!--end::Page Custom Javascript-->
	<!--end::Javascript-->
</body>
<!--end::Body-->

</html>