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
										<table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_customers_table" data-url="users">
											<!--begin::Table head-->
											<thead>
												<?php $route = 'users' ?>
												<!--begin::Table row-->
												<tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
													
													<th class="min-w-150px">
														Rol
													</th>

													<th class="min-w-150px">
														Name
													</th>

													<th class="min-w-100px">
														Email
													</th>

													<th class="min-w-125px">
														Phone
													</th>

													<th class="min-w-75px">
														Country
													</th>

													<th></th>

												</tr>
												<!--end::Table row-->
											</thead>
											<!--end::Table head-->
											<!--begin::Table body-->
											<tbody class="fw-bold text-gray-600">

												<?php if (empty($users)): ?>
													<tr>
														<td colspan="8" class="text-center">
															<p>No users found</p>
														</td>
													</tr>
												<?php else: ?>
													<?php foreach ($users as $user): ?>

														<tr>
															
															<td>
																<?= esc($user['role_name'])?>
															</td>
													

															<td>
																<?= esc($user['name']), " ", esc($user['last_name']) ?>
															</td>

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

															<td>
																<?php if ($user['disabled']): ?>
																	<div class="h-25px border border-5 rounded border-danger cursor-pointer" style="width: 0;" data-bs-toggle="tooltip" title="This user is disabled"></div>
																<?php endif; ?>
															</td>


												
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

									<!--end::Card footer-->
								</div>
							</div>
							<!--end::Card-->

							<!--begin::Modals-->
				

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
	<script src="./assets/js/custom/apps/customers/list/listUser.js"></script>
	<script src="./assets/js/custom/widgets.js"></script>
	<!--end::Page Custom Javascript-->
	<!--end::Javascript-->
</body>
<!--end::Body-->

</html>