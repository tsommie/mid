<template>
  <div class="row">
    <div class="col-12 my-3">
      <div class="row">
        <h1 class="h3">{{ $t('Add user account') }}</h1>
      </div>
    </div>

    <div class="col-12">
      <form @submit.prevent="onSubmit" @keydown="form.onKeydown($event)">
        <div class="row">
          <div class="col-md-6">
            <div class="row mb-3 g-1">
              <div class="col-md-4">
                <div class="mb-3">
                  <label for="administratorFirstName" class="form-label">{{ $t('First name') }}</label>
                  <input type="text"
                         v-model="form.profile.first_name"
                         name="profile[first_name]"
                         class="form-control"
                         id="administratorFirstName"
                         :placeholder="$t('First name')"
                         :class="{ 'is-invalid': form.errors.has('profile.first_name') }"
                         aria-describedby="administratorFirstNameHelp">
                  <has-error :form="form" field="profile.first_name"></has-error>
                  <div id="administratorFirstNameHelp" class="form-text">{{ $t("The first name of the user") }}. <small class="text-danger">*Required</small></div>
                </div>
              </div>

              <div class="col-md-4">
                <div class="mb-3">
                  <label for="administratorLastName" class="form-label">{{ $t('Last name') }}</label>
                  <input type="text"
                         v-model="form.profile.last_name"
                         name="profile[last_name]"
                         class="form-control"
                         id="administratorLastName"
                         :placeholder="$t('Last name')"
                         :class="{ 'is-invalid': form.errors.has('profile.last_name') }"
                         aria-describedby="administratorFirstNameHelp">
                  <has-error :form="form" field="profile.last_name"></has-error>
                  <div id="administratorLastNameHelp" class="form-text">{{ $t("The last name of the user") }}. <small class="text-danger">*Required</small></div>
                </div>
              </div>

              <div class="col-md-4">
                <div class="mb-3">
                  <label for="administratorOtherNames" class="form-label">{{ $t('Other names') }}</label>
                  <input type="text"
                         v-model="form.profile.other_names"
                         name="profile[other_names]"
                         class="form-control"
                         id="administratorOtherNames"
                         :placeholder="$t('Other names')"
                         :class="{ 'is-invalid': form.errors.has('profile.other_names') }"
                         aria-describedby="administratorFirstNameHelp">
                  <has-error :form="form" field="profile.other_names"></has-error>
                  <div id="administratorOtherNamesHelp" class="form-text">{{ $t("The other names of the user") }}.</div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-md-6">
            <div class="row g-1">

              <div class="col-md-6">
                <div class="mb-3">
                  <label for="username" class="form-label">{{ $t('Username') }}</label>
                  <input type="text"
                         v-model="form.name"
                         name="name"
                         class="form-control"
                         id="username"
                         :placeholder="$t('Name')"
                         :class="{ 'is-invalid': form.errors.has('name') }"
                         aria-describedby="usernameHelp">
                  <has-error :form="form" field="name"></has-error>
                  <div id="usernameHelp" class="form-text">{{ $t("The name of the user") }}. <small class="text-danger">*Required</small></div>
                </div>
              </div>

              <div class="col-md-6">
                <div class="mb-3">
                  <label for="email" class="form-label">{{ $t('Email Address') }}</label>
                  <input type="text"
                         v-model="form.email"
                         name="email"
                         class="form-control"
                         id="email"
                         :placeholder="$t('Email Address')"
                         :class="{ 'is-invalid': form.errors.has('email') }"
                         aria-describedby="emailHelp">
                  <has-error :form="form" field="email"></has-error>
                  <div id="emailHelp" class="form-text">{{ $t("The email address of the user") }}. <small class="text-danger">*Required</small></div>
                </div>
              </div>

              <div class="col-md-6">
                <div class="mb-3">
                  <label for="password" class="form-label">{{ $t('Password') }}</label>
                  <input type="password"
                         v-model="form.password"
                         name="password"
                         class="form-control"
                         id="password"
                         :placeholder="$t('Password')"
                         :class="{ 'is-invalid': form.errors.has('password') }"
                         aria-describedby="passwordHelp">
                  <has-error :form="form" field="password"></has-error>
                  <div id="passwordHelp" class="form-text">{{ $t("The password that will be used to identify the user") }}. <small class="text-danger">*Required</small></div>
                </div>
              </div>

              <div class="col-md-6">
                <div class="mb-3">
                  <label for="confirmPassword" class="form-label">{{ $t('Confirm Password') }}</label>
                  <input type="password"
                         v-model="form.password_confirmation"
                         name="password_confirmation"
                         class="form-control"
                         id="confirmPassword"
                         :placeholder="$t('Confirm Password')"
                         :class="{ 'is-invalid': form.errors.has('password_confirmation') }"
                         aria-describedby="confirmPasswordHelp">
                  <has-error :form="form" field="password_confirmation"></has-error>
                  <div id="confirmPasswordHelp" class="form-text">{{ $t("Please confirm password") }}. <small class="text-danger">*Required</small></div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <button type="submit" class="btn btn-success text-white">{{ $t('Add user') }}</button>
        <button type="reset" class="btn btn-light">{{ $t('Reset') }}</button>
      </form>
    </div>
  </div>
</template>

<script>
import Form from 'vform'
import {passwordVerification} from "../../helpers";

export default {
  name: "Create",
  data() {
    return {
      form: new Form({
        name: null,
        email: null,
        password: null,
        password_confirmation: null,

        // Profile details
        profile: {
          first_name: null,
          last_name: null,
          other_names: null,
        },
      })
    }
  },
  methods: {
    onSubmit: function(){
      passwordVerification((result) => {
        if (result.value) {
          this.form.post(`/users`).then(response => {
            this.sweetAlert().fire({
              text: response.data.message,
              icon: 'success',
              confirmButtonColor: '#3085d6',
              confirmButtonText: 'Continue'
            }).then((result) => {
              if (result.value) {
                this.$router.push({
                  name: 'users.show',
                  params: { userId: `${response.data.user.id}` }
                })
              }
            }).finally(() => {
              //
            })
          }).catch(error => {
            this.sweetAlert().fire({
              text: error.message,
              icon: 'error',
            })
          })
        }
      })
    }
  }
}
</script>

<style scoped>

</style>
