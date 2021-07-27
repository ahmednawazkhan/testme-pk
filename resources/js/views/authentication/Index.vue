<template>
  <div class="auth-page d-flex align-items-center bg-auth border-top border-top-2 border-primary">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-12 col-md-6 offset-xl-2 offset-md-1 order-md-2 mb-5 mb-md-0">
          <!-- Image -->
          <div class="text-center">
            <img
              src="../../assets/images/undraw_celebration_0jvk.svg"
              alt="illustration"
              class="img-fluid"
            >
          </div>
        </div>

        <div class="col-12 col-md-5 col-xl-4 order-md-1 my-5">
          <router-view />
        </div>
      </div>
    </div>
  </div>
</template>

<style lang="scss" scoped>
  .auth-page {
    margin-top: -3rem;
    font-family: Cerebri Sans,sans-serif;
    font-size: .9375rem;
    font-weight: 400;
    line-height: 1.5;
    text-align: left;
  }

  .border-top-2 {
    border-top-width: 2px!important;
  }

  .display-4 {
    font-size: 2rem;
    font-weight: 600;
    line-height: 1.1;
  }
</style>
