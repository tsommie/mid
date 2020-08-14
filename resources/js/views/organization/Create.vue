<template>
  <div class="row">
    <div class="col-12 my-3">
      <div class="row">
        <h1 class="h3">{{ $t('Add client') }}</h1>
      </div>
    </div>

    <div class="col-12">
      <form @submit.prevent="onSubmit" @keydown="form.onKeydown($event)">
        <div class="row">
          <div class="col-md-6">
            <div class="row mb-3">
              <div class="col-12">
                <fieldset>
                  <legend>{{ $t('Details') }}</legend>

                  <div class="mb-3">
                    <label for="name" class="form-label">{{ $t('Name') }}</label>
                    <input type="text"
                           v-model="form.name"
                           name="name"
                           class="form-control"
                           id="name"
                           :placeholder="$t('Name')"
                           :class="{ 'is-invalid': form.errors.has('name') }"
                           aria-describedby="nameHelp">
                    <has-error :form="form" field="name"></has-error>
                    <div id="nameHelp" class="form-text">{{ $t('Provide the name of your organization') }}. <small class="text-danger">*Required</small></div>
                  </div>

                  <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control"
                              v-model="form.description"
                              name="description"
                              id="description"
                              rows="3"
                              :class="{ 'is-invalid': form.errors.has('description') }"
                              aria-describedby="descriptionHelp"></textarea>
                    <has-error :form="form" field="description"></has-error>
                    <div id="descriptionHelp" class="form-text">{{ $t('Give a quick description of this organization')}}. <small class="text-danger">*Required</small></div>
                  </div>

                  <hr />
                </fieldset>
              </div>
            </div>

            <div class="row mb-3">
              <div class="col-12">
                <fieldset>
                  <legend>{{ $t('Address') }}</legend>

                  <div class="mb-3">
                    <label for="street" class="form-label">{{ $t('Street') }}</label>
                    <input type="text"
                           v-model="form.location.street"
                           name="location[street]"
                           class="form-control"
                           id="street"
                           :placeholder="$t('Street')"
                           :class="{ 'is-invalid': form.errors.has('location.street') }"
                           aria-describedby="streetHelp">
                    <has-error :form="form" field="location.street"></has-error>
                    <div id="streetHelp" class="form-text">{{ $t('Please provide the organization address') }}<small class="text-danger">*Required</small></div>
                  </div>

                  <div class="mb-3">
                    <label for="streetLine2" class="form-label">{{ $t('Street Line 2') }}</label>
                    <input type="text"
                           v-model="form.location.street_line_2"
                           name="location[street_line_2]"
                           class="form-control"
                           id="streetLine2"
                           :placeholder="$t('Street Line 2')"
                           :class="{ 'is-invalid': form.errors.has('location.street_line_2') }"
                           aria-describedby="streetLine2Help">
                    <has-error :form="form" field="location.street_line_2"></has-error>
                  </div>

                  <div class="row">
                    <div class="col-md-4">
                      <div class="mb-3">
                        <label for="City" class="form-label">{{ $t('City') }}</label>
                        <input type="text"
                               v-model="form.location.city"
                               name="location[city]"
                               class="form-control"
                               id="city"
                               :placeholder="$t('City')"
                               :class="{ 'is-invalid': form.errors.has('location.city') }"
                               aria-describedby="cityHelp">
                        <has-error :form="form" field="location.city"></has-error>
                        <div id="cityHelp" class="form-text">{{ $t('Which city is this organisation located?') }}<small class="text-danger">*Required</small></div>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="mb-3">
                        <label for="country" class="form-label">{{ $t('Country') }}</label>
                        <input type="text"
                               v-model="form.location.country"
                               name="location[country]"
                               class="form-control"
                               id="country"
                               disabled
                               :placeholder="$t('Country')"
                               :class="{ 'is-invalid': form.errors.has('location.country') }"
                               aria-describedby="countryHelp">
                        <has-error :form="form" field="location.country"></has-error>
                        <div id="countryHelp" class="form-text">{{ $t("Organization's location country") }}<small class="text-danger">*Required</small></div>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="mb-3">
                        <label for="postal" class="form-label">{{ $t('Postal') }}</label>
                        <input type="text"
                               v-model="form.location.postal"
                               name="location[postal]"
                               class="form-control"
                               id="postal"
                               :placeholder="$t('Postal')"
                               :class="{ 'is-invalid': form.errors.has('location.postal') }"
                               aria-describedby="postalHelp">
                        <has-error :form="form" field="location.postal"></has-error>
                        <div id="postalHelp" class="form-text">{{ $t("Organization's postal address") }}<small class="text-danger">*Required</small></div>
                      </div>
                    </div>
                  </div>
                </fieldset>
              </div>
            </div>
          </div>

          <div class="col-md-6">
            <div class="row mb-3">
              <div class="col-12">
                <fieldset>
                  <legend>{{ $t('Contact') }}</legend>

                  <div class="row g-1">
                    <div class="col-md-6">
                      <div class="mb-3">
                        <label for="email" class="form-label">{{ $t('Email Address') }}</label>
                        <input type="text"
                               v-model="form.email"
                               name="email"
                               class="form-control"
                               id="email"
                               :placeholder="$t('Name')"
                               :class="{ 'is-invalid': form.errors.has('email') }"
                               aria-describedby="emailHelp">
                        <has-error :form="form" field="email"></has-error>
                        <div id="emailHelp" class="form-text">{{ $t("Please provide an organization email") }}. <small class="text-danger">*Required</small></div>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="row g-1 mb-3">
                        <div class="col-2"></div>
                        <div class="col-10">
                          <label for="administratorPhoneNumber" class="form-label">{{ $t('Phone number') }}</label>
                          <input type="tel"
                                 v-model="form.phone_number"
                                 name="Phone number"
                                 class="form-control"
                                 id="administratorPhoneNumber"
                                 :placeholder="$t('Phone number')"
                                 :class="{ 'is-invalid': form.errors.has('phone_number') }"
                                 aria-describedby="administratorPhoneNumberHelp">
                          <has-error :form="form" field="phone_number"></has-error>
                          <div id="administratorPhoneNumberHelp" class="form-text">{{ $t("Please provide an organization phone number") }}. <small class="text-danger">*Required</small></div>
                        </div>
                      </div>
                    </div>

                    <div class="col-12">
                      <div class="mb-3">
                        <label for="administratorWebsite" class="form-label">{{ $t('Website') }}</label>
                        <input type="text"
                               v-model="form.website"
                               name="Phone number"
                               class="form-control"
                               id="administratorWebsite"
                               :placeholder="$t('Website')"
                               :class="{ 'is-invalid': form.errors.has('website') }"
                               aria-describedby="administratorWebsiteHelp">
                        <has-error :form="form" field="website"></has-error>
                        <div id="administratorWebsiteHelp" class="form-text">{{ $t("Please provide an organization website") }}.</div>
                      </div>
                    </div>
                  </div>

                  <hr />
                </fieldset>
              </div>
            </div>

            <div class="row mb-3">
              <div class="col-12">
                <fieldset>
                  <legend>{{ $t('Administrator') }}</legend>

                  <div class="row g-1">
                    <div class="col-12">
                      <div class="row mb-3">
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
                            <div id="administratorFirstNameHelp" class="form-text">{{ $t("The first name of the organization's administrator") }}. <small class="text-danger">*Required</small></div>
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
                            <div id="administratorLastNameHelp" class="form-text">{{ $t("The last name of the organization's administrator") }}. <small class="text-danger">*Required</small></div>
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
                            <div id="administratorOtherNamesHelp" class="form-text">{{ $t("The other names of the organization's administrator") }}.</div>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="mb-3">
                        <label for="administratorUsername" class="form-label">{{ $t('Username') }}</label>
                        <input type="text"
                               v-model="form.administrator.name"
                               name="administrator[name]"
                               class="form-control"
                               id="administratorUsername"
                               :placeholder="$t('Name')"
                               :class="{ 'is-invalid': form.errors.has('administrator.name') }"
                               aria-describedby="administratorUsernameHelp">
                        <has-error :form="form" field="administrator.name"></has-error>
                        <div id="administratorUsernameHelp" class="form-text">{{ $t("The name of the organization's administrator") }}. <small class="text-danger">*Required</small></div>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="mb-3">
                        <label for="administratorEmail" class="form-label">{{ $t('Email Address') }}</label>
                        <input type="text"
                               v-model="form.administrator.email"
                               name="administrator[email]"
                               class="form-control"
                               id="administratorEmail"
                               :placeholder="$t('Email Address')"
                               :class="{ 'is-invalid': form.errors.has('administrator.email') }"
                               aria-describedby="administratorEmailHelp">
                        <has-error :form="form" field="administrator.email"></has-error>
                        <div id="administratorEmailHelp" class="form-text">{{ $t("The email address of the organization's administrator") }}. <small class="text-danger">*Required</small></div>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="mb-3">
                        <label for="administratorPassword" class="form-label">{{ $t('Password') }}</label>
                        <input type="password"
                               v-model="form.administrator.password"
                               name="administrator[password]"
                               class="form-control"
                               id="administratorPassword"
                               :placeholder="$t('Password')"
                               :class="{ 'is-invalid': form.errors.has('administrator.password') }"
                               aria-describedby="administratorPasswordHelp">
                        <has-error :form="form" field="administrator.password"></has-error>
                        <div id="administratorPasswordHelp" class="form-text">{{ $t("The password that will be used to identify organization's administrator") }}. <small class="text-danger">*Required</small></div>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="mb-3">
                        <label for="administratorConfirmPassword" class="form-label">{{ $t('Confirm Password') }}</label>
                        <input type="password"
                               v-model="form.administrator.password_confirmation"
                               name="administrator[password_confirmation]"
                               class="form-control"
                               id="administratorConfirmPassword"
                               :placeholder="$t('Confirm Password')"
                               :class="{ 'is-invalid': form.errors.has('administrator.password_confirmation') }"
                               aria-describedby="administratorConfirmPasswordHelp">
                        <has-error :form="form" field="administrator.password_confirmation"></has-error>
                        <div id="administratorConfirmPasswordHelp" class="form-text">{{ $t("Please confirm password") }}. <small class="text-danger">*Required</small></div>
                      </div>
                    </div>
                  </div>

                </fieldset>
              </div>
            </div>
          </div>
        </div>

        <button type="submit" class="btn btn-success text-white">{{ $t('Add Client') }}</button>
        <button type="reset" class="btn btn-light">{{ $t('Reset') }}</button>
      </form>
    </div>
  </div>
</template>

<script>
import Form from 'vform'
import {passwordVerification} from "../../helpers";

export default {
  name: 'Create',

  data() {
    return {
      form: new Form({
        name: null,
        description: null,
        email: null,
        phone_number: null,
        website: null,

        // Profile details
        profile: {
          first_name: null,
          last_name: null,
          other_names: null,
        },

        // Administrator details
        administrator: {
          name: null,
          email: null,
          password: null,
          password_confirmation: null
        },

        // Location details
        location: {
          street: null,
          street_line_2: null,
          city: null,
          country: 'Burkina Faso',
          postal: null
        }
      })
    }
  },

  methods: {
    onSubmit: function(){
      passwordVerification((result) => {
        if (result.value) {
          this.form.post(`/organizations`).then(response => {
            this.sweetAlert().fire({
              text: response.data.message,
              icon: 'success',
              confirmButtonColor: '#3085d6',
              confirmButtonText: 'Continue'
            }).then((result) => {
              if (result.value) {
                this.$router.push({
                  name: 'organizations.show',
                  params: { organizationId: `${response.data.organization.id}` }
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
