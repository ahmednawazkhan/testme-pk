<template>
  <div>
    <!-- Heading -->
    <h1 class="display-4 text-center mb-3">
      Sign in
    </h1>

    <!-- Subheading -->
    <p class="text-muted text-center mb-5">
      Free access to our dashboard.
    </p>

    <!-- Form -->
    <form
      @submit.prevent="login()"
      novalidate
    >
      <fieldset :disabled="loading">
        <!-- Email address -->
        <div class="form-group">
          <!-- Label -->
          <label>Email Address</label>

          <!-- Input -->
          <input
            type="email"
            class="form-control"
            :class="{'is-invalid': $v.email.$error}"
            placeholder="name@address.com"
            v-model.trim="$v.email.$model"
            required
          >
          <div class="invalid-feedback">
            Field is invalid
          </div>
        </div>

        <!-- Password -->
        <div class="form-group">
          <div class="row">
            <div class="col">
              <!-- Label -->
              <label>Password</label>
            </div>
            <div class="col-auto">
              <!-- Help text -->
              <a
                href="password-reset-illustration.html"
                class="form-text small text-muted"
              >
                Forgot password?
              </a>
            </div>
          </div> <!-- / .row -->

          <!-- Input group -->
          <div class="input-group input-group-merge">
            <!-- Input -->
            <input
              type="password"
              class="form-control form-control-appended"
              placeholder="Enter your password"
              :class="{'is-invalid': $v.password.$error}"
              v-model.trim="$v.password.$model"
              autocomplete="off"
            >

            <!-- Icon -->
            <div class="input-group-append">
              <span class="input-group-text">
                <i class="fal fa-eye" />
              </span>
            </div>
          </div>
          <div class="invalid-feedback">
            Field is invalid
          </div>
        </div>

        <!-- Submit -->
        <button
          type="submit"
          class="btn btn-lg btn-block btn-primary mb-3"
        >
          Sign in
          <span
            class="float-right"
            v-if="loading"
          >
            <i class="fal fa-spinner-third fa-spin" />
          </span>
        </button>
      </fieldset>

      <!-- Link -->
      <div class="text-center">
        <small class="text-muted text-center">
          Don't have an account yet? <a href="sign-up-illustration.html">
            Sign up
          </a>.
        </small>
      </div>
    </form>
  </div>
</template>

<script>
import { required, minLength, email } from 'vuelidate/lib/validators'

export default {
  name: 'AuthLogin',
  data () {
    return {
      email: '',
      password: '',
      loading: false,
      errors: []
    }
  },
  validations: {
    email: {
      required,
      email
    },
    password: {
      required,
      minLength: minLength(5)
    }
  },
  methods: {
    login () {
      this.$v.$touch()

      if (this.$v.$invalid) {
        console.log('Form invalid')
      } else {
        this.loading = true

        this.$auth
          .login({
            data: { email: this.email, password: this.password },
            success: (res) => {
              this.$auth.token(null, res.data.token)
              this.$auth.fetch()
              this.loading = false
            },
            error: (error) => {
              console.log('Login fail:', error)
              this.loading = false
              this.errors = error
            },
            redirect: '/',
            rememberMe: true,
            fetchUser: false
          })
      }
    }
  }
}
</script>

<style lang="scss" scoped>
  .input-group-text {
    font-size: .9375rem;
    font-weight: 400;
    line-height: 1.5;
    display: flex;
    margin-bottom: 0;
    padding: .5rem .75rem;
    text-align: center;
    white-space: nowrap;
    color: #95aac9;
    border: 1px solid #d2ddec;
    border-radius: .375rem;
    background-color: #fff;
    align-items: center;
  }
</style>
