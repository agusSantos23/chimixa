<!--begin::details View-->
<div class="card mb-5 mb-xl-10" id="kt_profile_details_view">
  <!--begin::Card header-->
  <div class="card-header cursor-pointer">
    <!--begin::Card title-->
    <div class="card-title m-0">
      <h3 class="fw-bolder m-0">Profile Details</h3>
    </div>
    <!--end::Card title-->
    <!--begin::Action-->
    <a href="<?= base_url('profile?isEditing=true') ?>" class="btn btn-primary align-self-center">Edit Profile</a>
    <!--end::Action-->
  </div>
  <!--begin::Card header-->
  <!--begin::Card body-->
  <div class="card-body p-9">

    <!--begin::Row-->
    <div class="row mb-7">
      <!--begin::Label-->
      <label class="col-lg-4 fw-bold text-muted">Name</label>
      <!--end::Label-->
      <!--begin::Col-->
      <div class="col-lg-8">
        <span class="fw-bolder fs-6 text-gray-800"><?= session()->get('userName') ?></span>
      </div>
      <!--end::Col-->
    </div>
    <!--end::Row-->

    <!--begin::Input group-->
    <div class="row mb-7">
      <!--begin::Label-->
      <label class="col-lg-4 fw-bold text-muted">Last name</label>
      <!--end::Label-->
      <!--begin::Col-->
      <div class="col-lg-8 fv-row">
        <span class="fw-bold text-gray-800 fs-6"><?= session()->get('userLastName') ?></span>
      </div>
      <!--end::Col-->
    </div>
    <!--end::Input group-->

    <!--begin::Input group-->
    <div class="row mb-7">
      <!--begin::Label-->
      <label class="col-lg-4 fw-bold text-muted">Email</label>
      <!--end::Label-->
      <!--begin::Col-->
      <div class="col-lg-8 fv-row">
        <span class="fw-bold text-gray-800 fs-6"><?= session()->get('userEmail') ?></span>
      </div>
      <!--end::Col-->
    </div>
    <!--end::Input group-->

    <!--begin::Input group-->
    <div class="row mb-7">
      <!--begin::Label-->
      <label class="col-lg-4 fw-bold text-muted">Contact Phone</label>
      <!--end::Label-->
      <!--begin::Col-->
      <div class="col-lg-8 d-flex align-items-center">
        <span class="fw-bolder fs-6 text-gray-800 me-2">+<?= session()->get('userPhonePrefix') . ' ' . session()->get('userPhone') ?></span>
      </div>
      <!--end::Col-->
    </div>
    <!--end::Input group-->
    
    <!--begin::Input group-->
    <div class="row mb-7">
      <!--begin::Label-->
      <label class="col-lg-4 fw-bold text-muted">Country
        <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Country of origination"></i>
      </label>
      <!--end::Label-->
      <!--begin::Col-->
      <div class="col-lg-8">
        <span class="fw-bolder fs-6 text-gray-800"><?= session()->get('userCountry') ?></span>
      </div>
      <!--end::Col-->
    </div>
    <!--end::Input group-->

  </div>
  <!--end::Card body-->
</div>
<!--end::details View-->