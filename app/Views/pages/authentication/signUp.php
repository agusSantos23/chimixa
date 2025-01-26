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
	<link rel="icon" type="image/x-icon" href="../assets/media/logos/favicon.ico" />
	<!--begin::Fonts-->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
	<!--end::Fonts-->
	<!--begin::Page Vendor Stylesheets(used by this page)-->
	<link href="../assets/plugins/custom/fullcalendar/fullcalendar.bundle.css" rel="stylesheet" type="text/css" />
	<!--end::Page Vendor Stylesheets-->
	<!--begin::Global Stylesheets Bundle(used by all pages)-->
	<link href="../assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
	<link href="../assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
	<!--end::Global Stylesheets Bundle-->
</head>
<!--end::Head-->
<!--begin::Body-->

<body id="kt_body" class="bg-body">



	<!--begin::Main-->
	<div class="d-flex flex-column flex-root">
		<!--begin::Authentication - Sign-up -->
		<div class="d-flex flex-column flex-lg-row flex-column-fluid">



			<!--begin::Aside-->
			<div class="d-flex flex-column flex-lg-row-auto w-xl-600px position-xl-relative" style="background-color:rgb(51, 39, 21)">
				<!--begin::Wrapper-->
				<div class="d-flex flex-column position-xl-fixed top-0 bottom-0 w-xl-600px scroll-y">
					<!--begin::Content-->
					<div class="d-flex flex-row-fluid flex-column text-center p-10 pt-lg-20">
						<!--begin::Logo-->
						<a href="../../demo1/dist/index.html" class="py-9 mb-5">
							<img alt="Logo" src="../assets/media/logos/logo-letras.png" class="h-60px" />
						</a>
						<!--end::Logo-->
						<!--begin::Title-->
						<h1 class="fw-bolder fs-2qx pb-5 pb-md-10" style="color: #986923;">Welcome to Metronic</h1>
						<!--end::Title-->
						<!--begin::Description-->
						<p class="fw-bold fs-2" style="color: #986923;">Discover Amazing Metronic
							<br />with great build tools
						</p>
						<!--end::Description-->
					</div>
					<!--end::Content-->
					<!--begin::Illustration-->
					<div class="d-flex flex-row-auto bgi-no-repeat bgi-position-x-center bgi-size-contain bgi-position-y-bottom min-h-100px min-h-lg-350px" style="background-image: url(assets/media/illustrations/sketchy-1/13.png)"></div>
					<!--end::Illustration-->
				</div>
				<!--end::Wrapper-->
			</div>
			<!--end::Aside-->



			<!--begin::Body-->
			<div class="d-flex flex-column flex-lg-row-fluid py-10">
				<!--begin::Content-->
				<div class="d-flex flex-center flex-column flex-column-fluid">
					<!--begin::Wrapper-->
					<div class="w-lg-600px p-10 p-lg-15 mx-auto">
						<!--begin::Form-->
						<form class="form w-100" novalidate="novalidate" id="kt_sign_up_form" action="<?= base_url('auth/register') ?>" method="post">
							<!--begin::Heading-->
							<div class="mb-10 text-center">
								<h1 class="text-dark mb-3">Crear una Cuenta</h1>
								<div class="text-gray-400 fw-bold fs-4">
									Ya tienes una cuenta?
									<a href="<?= base_url('auth/login') ?>" class="link-primary fw-bolder">Inicia sesion aqui</a>
								</div>
							</div>
							<!--end::Heading-->


							<?php if (isset($validation)): ?>
								<div>
									<?= \Config\Services::validation()->listErrors(); ?>
								</div>
							<?php endif; ?>

							<!--begin::Input group-->
							<div class="row fv-row mb-7">
								<div class="col-xl-6">
									<label class="form-label fw-bolder text-dark fs-6" for="name">Nombre</label>
									<input class="form-control form-control-lg form-control-solid" type="text" name="name" id="name" autocomplete="off" />
								</div>
								<div class="col-xl-6">
									<label class="form-label fw-bolder text-dark fs-6" for="lastName">Apellidos</label>
									<input class="form-control form-control-lg form-control-solid" type="text" name="lastName" id="lastName" autocomplete="off" />
								</div>
							</div>
							<!--end::Input group-->

							<div class="fv-row mb-7">
								<label class="form-label fw-bolder text-dark fs-6" for="email">Correo Electronico</label>
								<input class="form-control form-control-lg form-control-solid" type="email" name="email" id="email" autocomplete="off" />
							</div>

							<div class="mb-7 fv-row" data-kt-password-meter="true">
								<label class="form-label fw-bolder text-dark fs-6" for="password">Contraseña</label>
								<div class="position-relative mb-3">
									<input class="form-control form-control-lg form-control-solid" type="password" name="password" id="password" autocomplete="off" />
									<span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2" data-kt-password-meter-control="visibility">
										<i class="bi bi-eye-slash fs-2"></i>
										<i class="bi bi-eye fs-2 d-none"></i>
									</span>
								</div>
								<div class="d-flex align-items-center mb-3" data-kt-password-meter-control="highlight">
									<div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
									<div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
									<div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
									<div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px"></div>
								</div>
								<div class="text-muted">Utilice 8 o más caracteres con una combinación de letras, números y símbolos.</div>
							</div>

							<div class="fv-row mb-7">
								<label class="form-label fw-bolder text-dark fs-6" for="confirmPassword">Confirmacion de Contraseña</label>
								<input class="form-control form-control-lg form-control-solid" type="password" name="confirmPassword" id="confirmPassword" autocomplete="off" />
							</div>

							<!--begin::Input group-->
							<div class="row fv-row mb-7">
								<!--begin::Col-->
								<div class="col-xl-6">
									<label class="form-label fw-bolder text-dark fs-6" for="role">Rol</label>
									<select class="form-select form-control form-control-lg form-control-solid" name="role" id="role">
										<option value="">Seleccione un rol</option>
										<?php foreach ($roles as $rol): ?>
											<option value="<?= $rol['id'] ?>"><?= $rol['name'] ?></option>
										<?php endforeach; ?>
									</select>
								</div>
								<!--end::Col-->

								<!--begin::Col-->
								<div class="col-xl-6">
									<label class="form-label fw-bolder text-dark fs-6" for="phone">Numero de Telefono</label>
									<div class="input-group">
										<select class="form-select form-control form-control-lg form-control-solid" name="prefix" id="prefix" style="max-width: 100px;">
											<option value="">Prefijo</option>
											<option value="+1">+1 (USA, Canada, etc.)</option>
											<option value="+20">+20 (Egypt)</option>
											<option value="+30">+30 (Greece)</option>
											<option value="+31">+31 (Netherlands)</option>
											<option value="+32">+32 (Belgium)</option>
											<option value="+33">+33 (France)</option>
											<option value="+34">+34 (Spain)</option>
											<option value="+36">+36 (Hungary)</option>
											<option value="+39">+39 (Italy)</option>
											<option value="+40">+40 (Romania)</option>
											<option value="+41">+41 (Switzerland)</option>
											<option value="+42">+42 (Czech Republic)</option>
											<option value="+43">+43 (Austria)</option>
											<option value="+44">+44 (UK)</option>
											<option value="+45">+45 (Denmark)</option>
											<option value="+46">+46 (Sweden)</option>
											<option value="+47">+47 (Norway)</option>
											<option value="+48">+48 (Poland)</option>
											<option value="+49">+49 (Germany)</option>
											<option value="+51">+51 (Peru)</option>
											<option value="+52">+52 (Mexico)</option>
											<option value="+53">+53 (Cuba)</option>
											<option value="+54">+54 (Argentina)</option>
											<option value="+55">+55 (Brazil)</option>
											<option value="+56">+56 (Chile)</option>
											<option value="+57">+57 (Colombia)</option>
											<option value="+58">+58 (Venezuela)</option>
											<option value="+60">+60 (Malaysia)</option>
											<option value="+61">+61 (Australia)</option>
											<option value="+62">+62 (Indonesia)</option>
											<option value="+63">+63 (Philippines)</option>
											<option value="+64">+64 (New Zealand)</option>
											<option value="+65">+65 (Singapore)</option>
											<option value="+66">+66 (Thailand)</option>
											<option value="+81">+81 (Japan)</option>
											<option value="+82">+82 (South Korea)</option>
											<option value="+84">+84 (Vietnam)</option>
											<option value="+86">+86 (China)</option>
											<option value="+90">+90 (Turkey)</option>
											<option value="+91">+91 (India)</option>
											<option value="+92">+92 (Pakistan)</option>
											<option value="+93">+93 (Afghanistan)</option>
											<option value="+94">+94 (Sri Lanka)</option>
											<option value="+95">+95 (Myanmar)</option>
											<option value="+98">+98 (Iran)</option>
											<option value="+212">+212 (Morocco)</option>
											<option value="+213">+213 (Algeria)</option>
											<option value="+216">+216 (Tunisia)</option>
											<option value="+218">+218 (Libya)</option>
											<option value="+220">+220 (Gambia)</option>
											<option value="+221">+221 (Senegal)</option>
											<option value="+222">+222 (Mauritania)</option>
											<option value="+223">+223 (Mali)</option>
											<option value="+224">+224 (Guinea)</option>
											<option value="+225">+225 (Ivory Coast)</option>
											<option value="+226">+226 (Burkina Faso)</option>
											<option value="+227">+227 (Niger)</option>
											<option value="+228">+228 (Togo)</option>
											<option value="+229">+229 (Benin)</option>
											<option value="+230">+230 (Mauritius)</option>
											<option value="+231">+231 (Liberia)</option>
											<option value="+232">+232 (Sierra Leone)</option>
											<option value="+233">+233 (Ghana)</option>
											<option value="+234">+234 (Nigeria)</option>
											<option value="+235">+235 (Chad)</option>
											<option value="+236">+236 (Central African Republic)</option>
											<option value="+237">+237 (Cameroon)</option>
											<option value="+238">+238 (Cape Verde)</option>
											<option value="+239">+239 (Sao Tome and Principe)</option>
											<option value="+240">+240 (Equatorial Guinea)</option>
											<option value="+241">+241 (Gabon)</option>
											<option value="+242">+242 (Republic of the Congo)</option>
											<option value="+243">+243 (Democratic Republic of Congo)</option>
											<option value="+244">+244 (Angola)</option>
											<option value="+245">+245 (Guinea-Bissau)</option>
											<option value="+246">+246 (British Indian Ocean Territory)</option>
											<option value="+247">+247 (Ascension Island)</option>
											<option value="+248">+248 (Seychelles)</option>
											<option value="+249">+249 (Sudan)</option>
											<option value="+250">+250 (Rwanda)</option>
											<option value="+251">+251 (Ethiopia)</option>
											<option value="+252">+252 (Somalia)</option>
											<option value="+253">+253 (Djibouti)</option>
											<option value="+254">+254 (Kenya)</option>
											<option value="+255">+255 (Tanzania)</option>
											<option value="+256">+256 (Uganda)</option>
											<option value="+257">+257 (Burundi)</option>
											<option value="+258">+258 (Mozambique)</option>
											<option value="+260">+260 (Zambia)</option>
											<option value="+261">+261 (Madagascar)</option>
											<option value="+262">+262 (Reunion, Mayotte)</option>
											<option value="+263">+263 (Zimbabwe)</option>
											<option value="+264">+264 (Namibia)</option>
											<option value="+265">+265 (Malawi)</option>
											<option value="+266">+266 (Lesotho)</option>
											<option value="+267">+267 (Botswana)</option>
											<option value="+268">+268 (Eswatini)</option>
											<option value="+269">+269 (Comoros)</option>
											<option value="+290">+290 (Saint Helena)</option>
											<option value="+291">+291 (Eritrea)</option>
											<option value="+297">+297 (Aruba)</option>
											<option value="+298">+298 (Faroe Islands)</option>
											<option value="+299">+299 (Greenland)</option>
											<option value="+350">+350 (Gibraltar)</option>
											<option value="+351">+351 (Portugal)</option>
											<option value="+352">+352 (Luxembourg)</option>
											<option value="+353">+353 (Ireland)</option>
											<option value="+354">+354 (Iceland)</option>
											<option value="+355">+355 (Albania)</option>
											<option value="+356">+356 (Malta)</option>
											<option value="+357">+357 (Cyprus)</option>
											<option value="+358">+358 (Finland)</option>
											<option value="+359">+359 (Bulgaria)</option>
											<option value="+370">+370 (Lithuania)</option>
											<option value="+371">+371 (Latvia)</option>
											<option value="+372">+372 (Estonia)</option>
											<option value="+373">+373 (Moldova)</option>
											<option value="+374">+374 (Armenia)</option>
											<option value="+375">+375 (Belarus)</option>
											<option value="+376">+376 (Andorra)</option>
											<option value="+377">+377 (Monaco)</option>
											<option value="+378">+378 (San Marino)</option>
											<option value="+379">+379 (Vatican City)</option>
											<option value="+380">+380 (Ukraine)</option>
											<option value="+381">+381 (Serbia)</option>
											<option value="+382">+382 (Montenegro)</option>
											<option value="+383">+383 (Kosovo)</option>
											<option value="+384">+384 (Macedonia)</option>
											<option value="+385">+385 (Croatia)</option>
											<option value="+386">+386 (Slovenia)</option>
											<option value="+387">+387 (Bosnia and Herzegovina)</option>
											<option value="+388">+388 (Yugoslavia)</option>
										</select>
										<input class="form-control form-control-lg form-control-solid" type="tel" name="phone" id="phone" placeholder="" autocomplete="off" />
									</div>
								</div>

								<!--end::Col-->
							</div>
							<!--end::Input group-->

							<!--begin::Input group-->
							<div class="fv-row mb-7">
								<label class="form-label fw-bolder text-dark fs-6" for="country">País</label>
								<select class="form-select form-control form-control-lg form-control-solid" name="country" id="country">
									<option value="">Seleccionar pais</option>
									<option value="USA">USA</option>
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
									<option value="UK">UK</option>
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
									<option value="Democratic Republic of Congo">Democratic Republic of Congo</option>
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
									<option value="Macedonia">Macedonia</option>
									<option value="Croatia">Croatia</option>
									<option value="Slovenia">Slovenia</option>
									<option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
								</select>
							</div>
							<!--end::Input group-->


							<div class="fv-row mb-10">
								<label class="form-check form-check-custom form-check-solid form-check-inline">
									<input class="form-check-input" type="checkbox" name="toc" value="1" />
									<span class="form-check-label fw-bold text-gray-700 fs-6">
										Acepto los
										<a href="#" class="ms-1 link-primary">Terminos y condiciones</a>.
									</span>
								</label>
							</div>

							<div class="text-center">
								<button type="submit" id="kt_sign_up_submit" class="btn btn-lg btn-primary">
									<span class="indicator-label">Enviar</span>
									<span class="indicator-progress">Por favor espere...
										<span class="spinner-border spinner-border-sm align-middle ms-2"></span>
									</span>
								</button>
							</div>
						</form>
						<!--end::Form-->
					</div>
					<!--end::Wrapper-->
				</div>
				<!--end::Content-->
				<!--begin::Footer-->
				<div class="d-flex flex-center flex-wrap fs-6 p-5 pb-0">
					<!--begin::Links-->
					<ul class="menu menu-gray-600 menu-hover-primary fw-bold order-1">
						<li class="menu-item">
							<a href="<?= base_url('about') ?>" class="menu-link px-2">About</a>
						</li>

						<li class="menu-item">
							<a href="https://x.com/CHIMIXACompany" target="_blank" class="menu-link px-2">X</a>
						</li>

						<li class="menu-item">
							<a href="https://www.facebook.com/profile.php?id=61572527069366" target="_blank" class="menu-link px-2">Facebook</a>
						</li>
					</ul>
					<!--end::Links-->
				</div>
				<!--end::Footer-->
			</div>
			<!--end::Body-->
		</div>
		<!--end::Authentication - Sign-up-->
	</div>
	<!--end::Main-->



	<script>
		var hostUrl = "assets/";
	</script>
	<!--begin::Javascript-->
	<!--begin::Global Javascript Bundle(used by all pages)-->
	<script src="../assets/plugins/global/plugins.bundle.js"></script>
	<script src="../assets/js/scripts.bundle.js"></script>
	<!--end::Global Javascript Bundle-->
	<!--begin::Page Custom Javascript(used by this page)-->
	<script src="../assets/js/custom/authentication/sign-up/general.js"></script>
	<!--end::Page Custom Javascript-->
	<!--end::Javascript-->
</body>
<!--end::Body-->

</html>