<div class="card mb-5 mb-xl-10">
  <!--begin::Card header-->
  <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_profile_details" aria-expanded="true" aria-controls="kt_account_profile_details">
    <!--begin::Card title-->
    <div class="card-title m-0">
      <h3 class="fw-bolder m-0">Profile Details</h3>
    </div>
    <!--end::Card title-->
  </div>
  <!--begin::Card header-->
  <!--begin::Content-->
  <div id="kt_account_profile_details" class="collapse show">

    <!--begin::Form-->
    <form id="kt_account_profile_details_form" class="form">

      <!--begin::Card body-->
      <div class="card-body border-top p-9">
        <div id="validation-errors" class="alert alert-danger" style="display: none;"></div>

        <!--begin::Input group-->
        <div class="row mb-6">
          <!--begin::Label-->
          <label class="col-lg-4 col-form-label fw-bold fs-6">Avatar</label>
          <!--end::Label-->
          <!--begin::Col-->
          <div class="col-lg-8">

            <div class="d-flex justify-content-center align-items-center flex-wrap">
              <div class="image-option p-2">
                <img src="<?= base_url('assets/media/avatars/cactus') ?>" alt="Image cactus" width="115" data-image="cactus" class="cursor-pointer img-thumbnail select-image" />
              </div>
              <div class="image-option p-2">
                <img src="<?= base_url('assets/media/avatars/chilliPepper') ?>" alt="Image chilli pepper" width="115" data-image="chilliPepper" class="cursor-pointer img-thumbnail select-image" />
              </div>
              <div class="image-option p-2">
                <img src="<?= base_url('assets/media/avatars/fire') ?>" alt="Image fire" width="115" data-image="fire" class="cursor-pointer img-thumbnail select-image" />
              </div>
              <div class="image-option p-2">
                <img src="<?= base_url('assets/media/avatars/guitar') ?>" alt="Image guitar" width="115" data-image="guitar" class="cursor-pointer img-thumbnail select-image" />
              </div>
              <div class="image-option p-2">
                <img src="<?= base_url('assets/media/avatars/hat') ?>" alt="Image hat" width="115" data-image="hat" class="cursor-pointer img-thumbnail select-image" />
              </div>
              <div class="image-option p-2">
                <img src="<?= base_url('assets/media/avatars/wad') ?>" alt="Image wad" width="115" data-image="wad" class="cursor-pointer img-thumbnail select-image" />
              </div>
            </div>

          </div>
          <!--end::Col-->
        </div>
        <!--end::Input group-->

        <!--begin::Input group-->
        <div class="row mb-6">
          <!--begin::Label-->
          <label class="col-lg-4 col-form-label fw-bold fs-6">Full Name</label>
          <!--end::Label-->
          <!--begin::Col-->
          <div class="col-lg-8">
            <!--begin::Row-->
            <div class="row">
              <!--begin::Col-->
              <div class="col-lg-6 fv-row">
                <input type="text" name="fname" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="First name" value="<?= $userData->name ?>" />
              </div>
              <!--end::Col-->
              <!--begin::Col-->
              <div class="col-lg-6 fv-row">
                <input type="text" name="lname" class="form-control form-control-lg form-control-solid" placeholder="Last name" value="<?= $userData->last_name ?>" />
              </div>
              <!--end::Col-->
            </div>
            <!--end::Row-->
          </div>
          <!--end::Col-->
        </div>
        <!--end::Input group-->


        <!--begin::Input group-->
        <div class="row mb-6">
          <!--begin::Label-->
          <label class="col-lg-4 col-form-label fw-bold fs-6">
            <span>Email</span>
            <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="The email address must be active"></i>
          </label>
          <!--end::Label-->
          <!--begin::Col-->
          <div class="col-lg-8 fv-row">
            <input type="email" class="form-control form-control-solid" placeholder="Email" name="email" value="<?= $userData->email ?>" />
          </div>

          <!--end::Col-->
        </div>
        <!--end::Input group-->

        <!--begin::Input group-->
        <div class="row mb-6">
          <!--begin::Label-->
          <label class="col-lg-4 col-form-label fw-bold fs-6">Contact Phone</label>
          <!--end::Label-->
          <!--begin::Col-->


          <div class="col-lg-8">
            <!--begin::Row-->
            <div class="row">
              <div class="col-lg-6 fv-row">
                <select class="form-select form-select-solid fw-bolder" name="prefix">
                  <option value="">Select a Prefix...</option>
                  <option value="1" <?= $userData->prefix == '1' ? 'selected' : '' ?>>+1 --- (USA / Canada)</option>
                  <option value="30" <?= $userData->prefix == '30' ? 'selected' : '' ?>>+30 --- (Greece)</option>
                  <option value="31" <?= $userData->prefix == '31' ? 'selected' : '' ?>>+31 --- (Netherlands)</option>
                  <option value="32" <?= $userData->prefix == '32' ? 'selected' : '' ?>>+32 --- (Belgium)</option>
                  <option value="33" <?= $userData->prefix == '33' ? 'selected' : '' ?>>+33 --- (France)</option>
                  <option value="34" <?= $userData->prefix == '34' ? 'selected' : '' ?>>+34 --- (Spain)</option>
                  <option value="20" <?= $userData->prefix == '20' ? 'selected' : '' ?>>+20 --- (Egypt)</option>
                  <option value="36" <?= $userData->prefix == '36' ? 'selected' : '' ?>>+36 --- (Hungary)</option>
                  <option value="39" <?= $userData->prefix == '39' ? 'selected' : '' ?>>+39 --- (Italy)</option>
                  <option value="40" <?= $userData->prefix == '40' ? 'selected' : '' ?>>+40 --- (Romania)</option>
                  <option value="41" <?= $userData->prefix == '41' ? 'selected' : '' ?>>+41 --- (Switzerland)</option>
                  <option value="42" <?= $userData->prefix == '42' ? 'selected' : '' ?>>+42 --- (Czech Republic)</option>
                  <option value="43" <?= $userData->prefix == '43' ? 'selected' : '' ?>>+43 --- (Austria)</option>
                  <option value="44" <?= $userData->prefix == '44' ? 'selected' : '' ?>>+44 --- (United Kingdom)</option>
                  <option value="45" <?= $userData->prefix == '45' ? 'selected' : '' ?>>+45 --- (Denmark)</option>
                  <option value="46" <?= $userData->prefix == '46' ? 'selected' : '' ?>>+46 --- (Sweden)</option>
                  <option value="47" <?= $userData->prefix == '47' ? 'selected' : '' ?>>+47 --- (Norway)</option>
                  <option value="48" <?= $userData->prefix == '48' ? 'selected' : '' ?>>+48 --- (Poland)</option>
                  <option value="49" <?= $userData->prefix == '49' ? 'selected' : '' ?>>+49 --- (Germany)</option>
                  <option value="51" <?= $userData->prefix == '51' ? 'selected' : '' ?>>+51 --- (Peru)</option>
                  <option value="52" <?= $userData->prefix == '52' ? 'selected' : '' ?>>+52 --- (Mexico)</option>
                  <option value="53" <?= $userData->prefix == '53' ? 'selected' : '' ?>>+53 --- (Cuba)</option>
                  <option value="54" <?= $userData->prefix == '54' ? 'selected' : '' ?>>+54 --- (Argentina)</option>
                  <option value="55" <?= $userData->prefix == '55' ? 'selected' : '' ?>>+55 --- (Brazil)</option>
                  <option value="56" <?= $userData->prefix == '56' ? 'selected' : '' ?>>+56 --- (Chile)</option>
                  <option value="57" <?= $userData->prefix == '57' ? 'selected' : '' ?>>+57 --- (Colombia)</option>
                  <option value="58" <?= $userData->prefix == '58' ? 'selected' : '' ?>>+58 --- (Venezuela)</option>
                  <option value="60" <?= $userData->prefix == '60' ? 'selected' : '' ?>>+60 --- (Malaysia)</option>
                  <option value="61" <?= $userData->prefix == '61' ? 'selected' : '' ?>>+61 --- (Australia)</option>
                  <option value="62" <?= $userData->prefix == '62' ? 'selected' : '' ?>>+62 --- (Indonesia)</option>
                  <option value="63" <?= $userData->prefix == '63' ? 'selected' : '' ?>>+63 --- (Philippines)</option>
                  <option value="64" <?= $userData->prefix == '64' ? 'selected' : '' ?>>+64 --- (New Zealand)</option>
                  <option value="65" <?= $userData->prefix == '65' ? 'selected' : '' ?>>+65 --- (Singapore)</option>
                  <option value="66" <?= $userData->prefix == '66' ? 'selected' : '' ?>>+66 --- (Thailand)</option>
                  <option value="81" <?= $userData->prefix == '81' ? 'selected' : '' ?>>+81 --- (Japan)</option>
                  <option value="82" <?= $userData->prefix == '82' ? 'selected' : '' ?>>+82 --- (South Korea)</option>
                  <option value="84" <?= $userData->prefix == '84' ? 'selected' : '' ?>>+84 --- (Vietnam)</option>
                  <option value="86" <?= $userData->prefix == '86' ? 'selected' : '' ?>>+86 --- (China)</option>
                  <option value="90" <?= $userData->prefix == '90' ? 'selected' : '' ?>>+90 --- (Turkey)</option>
                  <option value="91" <?= $userData->prefix == '91' ? 'selected' : '' ?>>+91 --- (India)</option>
                  <option value="92" <?= $userData->prefix == '92' ? 'selected' : '' ?>>+92 --- (Pakistan)</option>
                  <option value="93" <?= $userData->prefix == '93' ? 'selected' : '' ?>>+93 --- (Afghanistan)</option>
                  <option value="94" <?= $userData->prefix == '94' ? 'selected' : '' ?>>+94 --- (Sri Lanka)</option>
                  <option value="95" <?= $userData->prefix == '95' ? 'selected' : '' ?>>+95 --- (Myanmar)</option>
                  <option value="98" <?= $userData->prefix == '98' ? 'selected' : '' ?>>+98 --- (Iran)</option>
                  <option value="212" <?= $userData->prefix == '212' ? 'selected' : '' ?>>+212 --- (Morocco)</option>
                  <option value="213" <?= $userData->prefix == '213' ? 'selected' : '' ?>>+213 --- (Algeria)</option>
                  <option value="216" <?= $userData->prefix == '216' ? 'selected' : '' ?>>+216 --- (Tunisia)</option>
                  <option value="218" <?= $userData->prefix == '218' ? 'selected' : '' ?>>+218 --- (Libya)</option>
                  <option value="220" <?= $userData->prefix == '220' ? 'selected' : '' ?>>+220 --- (Gambia)</option>
                  <option value="221" <?= $userData->prefix == '221' ? 'selected' : '' ?>>+221 --- (Senegal)</option>
                  <option value="222" <?= $userData->prefix == '222' ? 'selected' : '' ?>>+222 --- (Mauritania)</option>
                  <option value="223" <?= $userData->prefix == '223' ? 'selected' : '' ?>>+223 --- (Mali)</option>
                  <option value="224" <?= $userData->prefix == '224' ? 'selected' : '' ?>>+224 --- (Guinea)</option>
                  <option value="225" <?= $userData->prefix == '225' ? 'selected' : '' ?>>+225 --- (Costa de Marfil)</option>
                  <option value="226" <?= $userData->prefix == '226' ? 'selected' : '' ?>>+226 --- (Burkina Faso)</option>
                  <option value="227" <?= $userData->prefix == '227' ? 'selected' : '' ?>>+227 --- (Níger)</option>
                  <option value="228" <?= $userData->prefix == '228' ? 'selected' : '' ?>>+228 --- (Togo)</option>
                  <option value="229" <?= $userData->prefix == '229' ? 'selected' : '' ?>>+229 --- (Benín)</option>
                  <option value="230" <?= $userData->prefix == '230' ? 'selected' : '' ?>>+230 --- (Mauricio)</option>
                  <option value="231" <?= $userData->prefix == '231' ? 'selected' : '' ?>>+231 --- (Liberia)</option>
                  <option value="232" <?= $userData->prefix == '232' ? 'selected' : '' ?>>+232 --- (Sierra Leona)</option>
                  <option value="233" <?= $userData->prefix == '233' ? 'selected' : '' ?>>+233 --- (Ghana)</option>
                  <option value="234" <?= $userData->prefix == '234' ? 'selected' : '' ?>>+234 --- (Nigeria)</option>
                  <option value="235" <?= $userData->prefix == '235' ? 'selected' : '' ?>>+235 --- (Chad)</option>
                  <option value="236" <?= $userData->prefix == '236' ? 'selected' : '' ?>>+236 --- (República Centroafricana)</option>
                  <option value="237" <?= $userData->prefix == '237' ? 'selected' : '' ?>>+237 --- (Camerún)</option>
                  <option value="238" <?= $userData->prefix == '238' ? 'selected' : '' ?>>+238 --- (Cabo Verde)</option>
                  <option value="239" <?= $userData->prefix == '239' ? 'selected' : '' ?>>+239 --- (Santo Tomé y Príncipe)</option>
                  <option value="240" <?= $userData->prefix == '240' ? 'selected' : '' ?>>+240 --- (Guinea Ecuatorial)</option>
                  <option value="241" <?= $userData->prefix == '241' ? 'selected' : '' ?>>+241 --- (Gabón)</option>
                  <option value="242" <?= $userData->prefix == '242' ? 'selected' : '' ?>>+242 --- (República del Congo)</option>
                  <option value="243" <?= $userData->prefix == '243' ? 'selected' : '' ?>>+243 --- (República Democrática del Congo)</option>
                  <option value="244" <?= $userData->prefix == '244' ? 'selected' : '' ?>>+244 --- (Angola)</option>
                  <option value="245" <?= $userData->prefix == '245' ? 'selected' : '' ?>>+245 --- (Guinea-Bisáu)</option>
                  <option value="246" <?= $userData->prefix == '246' ? 'selected' : '' ?>>+246 --- (Territorio Británico del Océano Índico)</option>
                  <option value="247" <?= $userData->prefix == '247' ? 'selected' : '' ?>>+247 --- (Isla de Ascensión)</option>
                  <option value="248" <?= $userData->prefix == '248' ? 'selected' : '' ?>>+248 --- (Seychelles)</option>
                  <option value="249" <?= $userData->prefix == '249' ? 'selected' : '' ?>>+249 --- (Sudán)</option>
                  <option value="250" <?= $userData->prefix == '250' ? 'selected' : '' ?>>+250 --- (Ruanda)</option>
                  <option value="251" <?= $userData->prefix == '251' ? 'selected' : '' ?>>+251 --- (Etiopía)</option>
                  <option value="252" <?= $userData->prefix == '252' ? 'selected' : '' ?>>+252 --- (Somalia)</option>
                  <option value="253" <?= $userData->prefix == '253' ? 'selected' : '' ?>>+253 --- (Yibuti)</option>
                  <option value="254" <?= $userData->prefix == '254' ? 'selected' : '' ?>>+254 --- (Kenia)</option>
                  <option value="255" <?= $userData->prefix == '255' ? 'selected' : '' ?>>+255 --- (Tanzania)</option>
                  <option value="256" <?= $userData->prefix == '256' ? 'selected' : '' ?>>+256 --- (Uganda)</option>
                  <option value="257" <?= $userData->prefix == '257' ? 'selected' : '' ?>>+257 --- (Burundi)</option>
                  <option value="258" <?= $userData->prefix == '258' ? 'selected' : '' ?>>+258 --- (Mozambique)</option>
                  <option value="260" <?= $userData->prefix == '260' ? 'selected' : '' ?>>+260 --- (Zambia)</option>
                  <option value="261" <?= $userData->prefix == '261' ? 'selected' : '' ?>>+261 --- (Madagascar)</option>
                  <option value="262" <?= $userData->prefix == '262' ? 'selected' : '' ?>>+262 --- (Reunión, Mayotte)</option>
                  <option value="263" <?= $userData->prefix == '263' ? 'selected' : '' ?>>+263 --- (Zimbabue)</option>
                  <option value="264" <?= $userData->prefix == '264' ? 'selected' : '' ?>>+264 --- (Namibia)</option>
                  <option value="265" <?= $userData->prefix == '265' ? 'selected' : '' ?>>+265 --- (Malaui)</option>
                  <option value="266" <?= $userData->prefix == '266' ? 'selected' : '' ?>>+266 --- (Lesoto)</option>
                  <option value="267" <?= $userData->prefix == '267' ? 'selected' : '' ?>>+267 --- (Botsuana)</option>
                  <option value="268" <?= $userData->prefix == '268' ? 'selected' : '' ?>>+268 --- (Esuatini)</option>
                  <option value="269" <?= $userData->prefix == '269' ? 'selected' : '' ?>>+269 --- (Comoras)</option>
                  <option value="291" <?= $userData->prefix == '291' ? 'selected' : '' ?>>+291 --- (Eritrea)</option>
                  <option value="297" <?= $userData->prefix == '297' ? 'selected' : '' ?>>+297 --- (Aruba)</option>
                  <option value="298" <?= $userData->prefix == '298' ? 'selected' : '' ?>>+298 --- (Islas Feroe)</option>
                  <option value="299" <?= $userData->prefix == '299' ? 'selected' : '' ?>>+299 --- (Groenlandia)</option>
                  <option value="350" <?= $userData->prefix == '350' ? 'selected' : '' ?>>+350 --- (Gibraltar)</option>
                  <option value="351" <?= $userData->prefix == '351' ? 'selected' : '' ?>>+351 --- (Portugal)</option>
                  <option value="352" <?= $userData->prefix == '352' ? 'selected' : '' ?>>+352 --- (Luxemburgo)</option>
                  <option value="353" <?= $userData->prefix == '353' ? 'selected' : '' ?>>+353 --- (Irlanda)</option>
                  <option value="354" <?= $userData->prefix == '354' ? 'selected' : '' ?>>+354 --- (Islandia)</option>
                  <option value="355" <?= $userData->prefix == '355' ? 'selected' : '' ?>>+355 --- (Albania)</option>
                  <option value="356" <?= $userData->prefix == '356' ? 'selected' : '' ?>>+356 --- (Malta)</option>
                  <option value="357" <?= $userData->prefix == '357' ? 'selected' : '' ?>>+357 --- (Chipre)</option>
                  <option value="358" <?= $userData->prefix == '358' ? 'selected' : '' ?>>+358 --- (Finlandia)</option>
                  <option value="359" <?= $userData->prefix == '359' ? 'selected' : '' ?>>+359 --- (Bulgaria)</option>
                  <option value="370" <?= $userData->prefix == '370' ? 'selected' : '' ?>>+370 --- (Lituania)</option>
                  <option value="371" <?= $userData->prefix == '371' ? 'selected' : '' ?>>+371 --- (Letonia)</option>
                  <option value="372" <?= $userData->prefix == '372' ? 'selected' : '' ?>>+372 --- (Estonia)</option>
                  <option value="373" <?= $userData->prefix == '373' ? 'selected' : '' ?>>+373 --- (Moldavia)</option>
                  <option value="374" <?= $userData->prefix == '374' ? 'selected' : '' ?>>+374 --- (Armenia)</option>
                  <option value="375" <?= $userData->prefix == '375' ? 'selected' : '' ?>>+375 --- (Bielorrusia)</option>
                  <option value="376" <?= $userData->prefix == '376' ? 'selected' : '' ?>>+376 --- (Andorra)</option>
                  <option value="377" <?= $userData->prefix == '377' ? 'selected' : '' ?>>+377 --- (Mónaco)</option>
                  <option value="378" <?= $userData->prefix == '378' ? 'selected' : '' ?>>+378 --- (San Marino)</option>
                  <option value="379" <?= $userData->prefix == '379' ? 'selected' : '' ?>>+379 --- (Ciudad del Vaticano)</option>
                  <option value="380" <?= $userData->prefix == '380' ? 'selected' : '' ?>>+380 --- (Ucrania)</option>
                  <option value="381" <?= $userData->prefix == '381' ? 'selected' : '' ?>>+381 --- (Serbia)</option>
                  <option value="382" <?= $userData->prefix == '382' ? 'selected' : '' ?>>+382 --- (Montenegro)</option>
                  <option value="383" <?= $userData->prefix == '383' ? 'selected' : '' ?>>+383 --- (Kosovo)</option>
                  <option value="384" <?= $userData->prefix == '384' ? 'selected' : '' ?>>+384 --- (Macedonia)</option>
                  <option value="385" <?= $userData->prefix == '385' ? 'selected' : '' ?>>+385 --- (Croacia)</option>
                  <option value="386" <?= $userData->prefix == '386' ? 'selected' : '' ?>>+386 --- (Eslovenia)</option>
                  <option value="387" <?= $userData->prefix == '387' ? 'selected' : '' ?>>+387 --- (Bosnia y Herzegovina)</option>
                  <option value="388" <?= $userData->prefix == '388' ? 'selected' : '' ?>>+388 --- (Yugoslavia)</option>
                </select>
              </div>
              <!--end::Col-->
              <!--begin::Col-->
              <div class="col-lg-6 fv-row">
                <input type="tel" name="phone" class="form-control form-control-lg form-control-solid" placeholder="Phone number" value="<?= $userData->phone ?>" />
              </div>
              <!--end::Col-->
            </div>
          </div>
        </div>
        <!--end::Input group-->





        <!--begin::Input group-->
        <div class="row mb-6">
          <!--begin::Label-->
          <label class="col-lg-4 col-form-label fw-bold fs-6">
            <span>Country</span>
            <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Country of origination"></i>
          </label>
          <!--end::Label-->
          <!--begin::Col-->
          <div class="col-lg-8 fv-row">
            <select name="country" class="form-select form-select-solid fw-bolder">
              <option value="">Select a Country...</option>
              <option value="USA" <?= $userData->country == 'USA' ? 'selected' : '' ?>>United States</option>
              <option value="Canada" <?= $userData->country == 'Canada' ? 'selected' : '' ?>>Canada</option>
              <option value="Egypt" <?= $userData->country == 'Egypt' ? 'selected' : '' ?>>Egypt</option>
              <option value="Greece" <?= $userData->country == 'Greece' ? 'selected' : '' ?>>Greece</option>
              <option value="Netherlands" <?= $userData->country == 'Netherlands' ? 'selected' : '' ?>>Netherlands</option>
              <option value="Belgium" <?= $userData->country == 'Belgium' ? 'selected' : '' ?>>Belgium</option>
              <option value="France" <?= $userData->country == 'France' ? 'selected' : '' ?>>France</option>
              <option value="Spain" <?= $userData->country == 'Spain' ? 'selected' : '' ?>>Spain</option>
              <option value="Hungary" <?= $userData->country == 'Hungary' ? 'selected' : '' ?>>Hungary</option>
              <option value="Italy" <?= $userData->country == 'Italy' ? 'selected' : '' ?>>Italy</option>
              <option value="Romania" <?= $userData->country == 'Romania' ? 'selected' : '' ?>>Romania</option>
              <option value="Switzerland" <?= $userData->country == 'Switzerland' ? 'selected' : '' ?>>Switzerland</option>
              <option value="Czech Republic" <?= $userData->country == 'Czech Republic' ? 'selected' : '' ?>>Czech Republic</option>
              <option value="Austria" <?= $userData->country == 'Austria' ? 'selected' : '' ?>>Austria</option>
              <option value="UK" <?= $userData->country == 'UK' ? 'selected' : '' ?>>United Kingdom</option>
              <option value="Denmark" <?= $userData->country == 'Denmark' ? 'selected' : '' ?>>Denmark</option>
              <option value="Sweden" <?= $userData->country == 'Sweden' ? 'selected' : '' ?>>Sweden</option>
              <option value="Norway" <?= $userData->country == 'Norway' ? 'selected' : '' ?>>Norway</option>
              <option value="Poland" <?= $userData->country == 'Poland' ? 'selected' : '' ?>>Poland</option>
              <option value="Germany" <?= $userData->country == 'Germany' ? 'selected' : '' ?>>Germany</option>
              <option value="Peru" <?= $userData->country == 'Peru' ? 'selected' : '' ?>>Peru</option>
              <option value="Mexico" <?= $userData->country == 'Mexico' ? 'selected' : '' ?>>Mexico</option>
              <option value="Cuba" <?= $userData->country == 'Cuba' ? 'selected' : '' ?>>Cuba</option>
              <option value="Argentina" <?= $userData->country == 'Argentina' ? 'selected' : '' ?>>Argentina</option>
              <option value="Brazil" <?= $userData->country == 'Brazil' ? 'selected' : '' ?>>Brazil</option>
              <option value="Chile" <?= $userData->country == 'Chile' ? 'selected' : '' ?>>Chile</option>
              <option value="Colombia" <?= $userData->country == 'Colombia' ? 'selected' : '' ?>>Colombia</option>
              <option value="Venezuela" <?= $userData->country == 'Venezuela' ? 'selected' : '' ?>>Venezuela</option>
              <option value="Malaysia" <?= $userData->country == 'Malaysia' ? 'selected' : '' ?>>Malaysia</option>
              <option value="Australia" <?= $userData->country == 'Australia' ? 'selected' : '' ?>>Australia</option>
              <option value="Indonesia" <?= $userData->country == 'Indonesia' ? 'selected' : '' ?>>Indonesia</option>
              <option value="Philippines" <?= $userData->country == 'Philippines' ? 'selected' : '' ?>>Philippines</option>
              <option value="New Zealand" <?= $userData->country == 'New Zealand' ? 'selected' : '' ?>>New Zealand</option>
              <option value="Singapore" <?= $userData->country == 'Singapore' ? 'selected' : '' ?>>Singapore</option>
              <option value="Thailand" <?= $userData->country == 'Thailand' ? 'selected' : '' ?>>Thailand</option>
              <option value="Japan" <?= $userData->country == 'Japan' ? 'selected' : '' ?>>Japan</option>
              <option value="South Korea" <?= $userData->country == 'South Korea' ? 'selected' : '' ?>>South Korea</option>
              <option value="Vietnam" <?= $userData->country == 'Vietnam' ? 'selected' : '' ?>>Vietnam</option>
              <option value="China" <?= $userData->country == 'China' ? 'selected' : '' ?>>China</option>
              <option value="Turkey" <?= $userData->country == 'Turkey' ? 'selected' : '' ?>>Turkey</option>
              <option value="India" <?= $userData->country == 'India' ? 'selected' : '' ?>>India</option>
              <option value="Pakistan" <?= $userData->country == 'Pakistan' ? 'selected' : '' ?>>Pakistan</option>
              <option value="Afghanistan" <?= $userData->country == 'Afghanistan' ? 'selected' : '' ?>>Afghanistan</option>
              <option value="Sri Lanka" <?= $userData->country == 'Sri Lanka' ? 'selected' : '' ?>>Sri Lanka</option>
              <option value="Myanmar" <?= $userData->country == 'Myanmar' ? 'selected' : '' ?>>Myanmar</option>
              <option value="Iran" <?= $userData->country == 'Iran' ? 'selected' : '' ?>>Iran</option>
              <option value="Morocco" <?= $userData->country == 'Morocco' ? 'selected' : '' ?>>Morocco</option>
              <option value="Algeria" <?= $userData->country == 'Algeria' ? 'selected' : '' ?>>Algeria</option>
              <option value="Tunisia" <?= $userData->country == 'Tunisia' ? 'selected' : '' ?>>Tunisia</option>
              <option value="Libya" <?= $userData->country == 'Libya' ? 'selected' : '' ?>>Libya</option>
              <option value="Gambia" <?= $userData->country == 'Gambia' ? 'selected' : '' ?>>Gambia</option>
              <option value="Senegal" <?= $userData->country == 'Senegal' ? 'selected' : '' ?>>Senegal</option>
              <option value="Mauritania" <?= $userData->country == 'Mauritania' ? 'selected' : '' ?>>Mauritania</option>
              <option value="Mali" <?= $userData->country == 'Mali' ? 'selected' : '' ?>>Mali</option>
              <option value="Guinea" <?= $userData->country == 'Guinea' ? 'selected' : '' ?>>Guinea</option>
              <option value="Ivory Coast" <?= $userData->country == 'Ivory Coast' ? 'selected' : '' ?>>Ivory Coast</option>
              <option value="Burkina Faso" <?= $userData->country == 'Burkina Faso' ? 'selected' : '' ?>>Burkina Faso</option>
              <option value="Niger" <?= $userData->country == 'Niger' ? 'selected' : '' ?>>Niger</option>
              <option value="Togo" <?= $userData->country == 'Togo' ? 'selected' : '' ?>>Togo</option>
              <option value="Benin" <?= $userData->country == 'Benin' ? 'selected' : '' ?>>Benin</option>
              <option value="Mauritius" <?= $userData->country == 'Mauritius' ? 'selected' : '' ?>>Mauritius</option>
              <option value="Liberia" <?= $userData->country == 'Liberia' ? 'selected' : '' ?>>Liberia</option>
              <option value="Sierra Leone" <?= $userData->country == 'Sierra Leone' ? 'selected' : '' ?>>Sierra Leone</option>
              <option value="Ghana" <?= $userData->country == 'Ghana' ? 'selected' : '' ?>>Ghana</option>
              <option value="Nigeria" <?= $userData->country == 'Nigeria' ? 'selected' : '' ?>>Nigeria</option>
              <option value="Chad" <?= $userData->country == 'Chad' ? 'selected' : '' ?>>Chad</option>
              <option value="Cameroon" <?= $userData->country == 'Cameroon' ? 'selected' : '' ?>>Cameroon</option>
              <option value="Cape Verde" <?= $userData->country == 'Cape Verde' ? 'selected' : '' ?>>Cape Verde</option>
              <option value="Sao Tome and Principe" <?= $userData->country == 'Sao Tome and Principe' ? 'selected' : '' ?>>Sao Tome and Principe</option>
              <option value="Equatorial Guinea" <?= $userData->country == 'Equatorial Guinea' ? 'selected' : '' ?>>Equatorial Guinea</option>
              <option value="Gabon" <?= $userData->country == 'Gabon' ? 'selected' : '' ?>>Gabon</option>
              <option value="Republic of the Congo" <?= $userData->country == 'Republic of the Congo' ? 'selected' : '' ?>>Republic of the Congo</option>
              <option value="Democratic Republic of Congo" <?= $userData->country == 'Democratic Republic of Congo' ? 'selected' : '' ?>>Democratic Republic of the Congo</option>
              <option value="Angola" <?= $userData->country == 'Angola' ? 'selected' : '' ?>>Angola</option>
              <option value="Guinea-Bissau" <?= $userData->country == 'Guinea-Bissau' ? 'selected' : '' ?>>Guinea-Bissau</option>
              <option value="Sudan" <?= $userData->country == 'Sudan' ? 'selected' : '' ?>>Sudan</option>
              <option value="Rwanda" <?= $userData->country == 'Rwanda' ? 'selected' : '' ?>>Rwanda</option>
              <option value="Ethiopia" <?= $userData->country == 'Ethiopia' ? 'selected' : '' ?>>Ethiopia</option>
              <option value="Somalia" <?= $userData->country == 'Somalia' ? 'selected' : '' ?>>Somalia</option>
              <option value="Djibouti" <?= $userData->country == 'Djibouti' ? 'selected' : '' ?>>Djibouti</option>
              <option value="Kenya" <?= $userData->country == 'Kenya' ? 'selected' : '' ?>>Kenya</option>
              <option value="Tanzania" <?= $userData->country == 'Tanzania' ? 'selected' : '' ?>>Tanzania</option>
              <option value="Uganda" <?= $userData->country == 'Uganda' ? 'selected' : '' ?>>Uganda</option>
              <option value="Burundi" <?= $userData->country == 'Burundi' ? 'selected' : '' ?>>Burundi</option>
              <option value="Mozambique" <?= $userData->country == 'Mozambique' ? 'selected' : '' ?>>Mozambique</option>
              <option value="Zambia" <?= $userData->country == 'Zambia' ? 'selected' : '' ?>>Zambia</option>
              <option value="Madagascar" <?= $userData->country == 'Madagascar' ? 'selected' : '' ?>>Madagascar</option>
              <option value="Reunion" <?= $userData->country == 'Reunion' ? 'selected' : '' ?>>Reunion</option>
              <option value="Mayotte" <?= $userData->country == 'Mayotte' ? 'selected' : '' ?>>Mayotte</option>
              <option value="Zimbabwe" <?= $userData->country == 'Zimbabwe' ? 'selected' : '' ?>>Zimbabwe</option>
              <option value="Namibia" <?= $userData->country == 'Namibia' ? 'selected' : '' ?>>Namibia</option>
              <option value="Malawi" <?= $userData->country == 'Malawi' ? 'selected' : '' ?>>Malawi</option>
              <option value="Lesotho" <?= $userData->country == 'Lesotho' ? 'selected' : '' ?>>Lesotho</option>
              <option value="Botswana" <?= $userData->country == 'Botswana' ? 'selected' : '' ?>>Botswana</option>
              <option value="Eswatini" <?= $userData->country == 'Eswatini' ? 'selected' : '' ?>>Eswatini</option>
              <option value="Comoros" <?= $userData->country == 'Comoros' ? 'selected' : '' ?>>Comoros</option>
              <option value="Saint Helena" <?= $userData->country == 'Saint Helena' ? 'selected' : '' ?>>Saint Helena</option>
              <option value="Eritrea" <?= $userData->country == 'Eritrea' ? 'selected' : '' ?>>Eritrea</option>
              <option value="Aruba" <?= $userData->country == 'Aruba' ? 'selected' : '' ?>>Aruba</option>
              <option value="Faroe Islands" <?= $userData->country == 'Faroe Islands' ? 'selected' : '' ?>>Faroe Islands</option>
              <option value="Greenland" <?= $userData->country == 'Greenland' ? 'selected' : '' ?>>Greenland</option>
              <option value="Gibraltar" <?= $userData->country == 'Gibraltar' ? 'selected' : '' ?>>Gibraltar</option>
              <option value="Portugal" <?= $userData->country == 'Portugal' ? 'selected' : '' ?>>Portugal</option>
              <option value="Luxembourg" <?= $userData->country == 'Luxembourg' ? 'selected' : '' ?>>Luxembourg</option>
              <option value="Ireland" <?= $userData->country == 'Ireland' ? 'selected' : '' ?>>Ireland</option>
              <option value="Iceland" <?= $userData->country == 'Iceland' ? 'selected' : '' ?>>Iceland</option>
              <option value="Albania" <?= $userData->country == 'Albania' ? 'selected' : '' ?>>Albania</option>
              <option value="Malta" <?= $userData->country == 'Malta' ? 'selected' : '' ?>>Malta</option>
              <option value="Cyprus" <?= $userData->country == 'Cyprus' ? 'selected' : '' ?>>Cyprus</option>
              <option value="Finland" <?= $userData->country == 'Finland' ? 'selected' : '' ?>>Finland</option>
              <option value="Bulgaria" <?= $userData->country == 'Bulgaria' ? 'selected' : '' ?>>Bulgaria</option>
              <option value="Lithuania" <?= $userData->country == 'Lithuania' ? 'selected' : '' ?>>Lithuania</option>
              <option value="Latvia" <?= $userData->country == 'Latvia' ? 'selected' : '' ?>>Latvia</option>
              <option value="Estonia" <?= $userData->country == 'Estonia' ? 'selected' : '' ?>>Estonia</option>
              <option value="Moldova" <?= $userData->country == 'Moldova' ? 'selected' : '' ?>>Moldova</option>
              <option value="Armenia" <?= $userData->country == 'Armenia' ? 'selected' : '' ?>>Armenia</option>
              <option value="Belarus" <?= $userData->country == 'Belarus' ? 'selected' : '' ?>>Belarus</option>
              <option value="Andorra" <?= $userData->country == 'Andorra' ? 'selected' : '' ?>>Andorra</option>
              <option value="Monaco" <?= $userData->country == 'Monaco' ? 'selected' : '' ?>>Monaco</option>
              <option value="San Marino" <?= $userData->country == 'San Marino' ? 'selected' : '' ?>>San Marino</option>
              <option value="Vatican City" <?= $userData->country == 'Vatican City' ? 'selected' : '' ?>>Vatican City</option>
              <option value="Ukraine" <?= $userData->country == 'Ukraine' ? 'selected' : '' ?>>Ukraine</option>
              <option value="Serbia" <?= $userData->country == 'Serbia' ? 'selected' : '' ?>>Serbia</option>
              <option value="Montenegro" <?= $userData->country == 'Montenegro' ? 'selected' : '' ?>>Montenegro</option>
              <option value="Kosovo" <?= $userData->country == 'Kosovo' ? 'selected' : '' ?>>Kosovo</option>
              <option value="Macedonia" <?= $userData->country == 'Macedonia' ? 'selected' : '' ?>>North Macedonia</option>
              <option value="Croatia" <?= $userData->country == 'Croatia' ? 'selected' : '' ?>>Croatia</option>
              <option value="Slovenia" <?= $userData->country == 'Slovenia' ? 'selected' : '' ?>>Slovenia</option>
              <option value="Bosnia and Herzegovina" <?= $userData->country == 'Bosnia and Herzegovina' ? 'selected' : '' ?>>Bosnia and Herzegovina</option>
            </select>
          </div>
          <!--end::Col-->
        </div>
        <!--end::Input group-->

        <!--begin::Input group-->
        <div class="row mb-6">
          <!--begin::Label-->
          <label class="col-lg-4 col-form-label fw-bold fs-6">Old Password</label>
          <!--end::Label-->
          <!--begin::Col-->
          <div class="col-lg-8 fv-row">
            <input type="password" class="form-control form-control-solid" placeholder="Old Password" name="passwordOld" />
          </div>

          <!--end::Col-->
        </div>
        <!--end::Input group-->


        <!--begin::Input group-->
        <div class="row mb-6">
          <!--begin::Label-->
          <label class="col-lg-4 col-form-label fw-bold fs-6">New Password</label>
          <!--end::Label-->
          <!--begin::Col-->
          <div class="col-lg-8 fv-row">
            <input type="password" class="form-control form-control-solid" placeholder="New Password" name="password" />
          </div>

          <!--end::Col-->
        </div>
        <!--end::Input group-->

        <!--begin::Input group-->
        <div class="row mb-6">
          <!--begin::Label-->
          <label class="col-lg-4 col-form-label fw-bold fs-6">Confirmation New Password</label>
          <!--end::Label-->

          <!--begin::Col-->
          <div class="col-lg-8 fv-row">
            <input type="password" class="form-control form-control-solid" placeholder="Confirmation New Password" name="confirmPassword" value="" />
          </div>

          <!--end::Col-->
        </div>
        <!--end::Input group-->

      </div>
      <!--end::Card body-->
      <!--begin::Actions-->
      <div class="card-footer d-flex justify-content-end py-6 px-9">
        <a href="<?= base_url('profile') ?>" class="btn btn-light btn-active-light-primary me-2">Discard</a>
        <button class="btn btn-primary" id="btnSubmit">Save Changes</button>
      </div>
      <!--end::Actions-->
    </form>
    <!--end::Form-->
  </div>
  <!--end::Content-->
</div>