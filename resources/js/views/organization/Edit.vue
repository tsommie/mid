<template>
  <div class="row">
    <div v-if="isLoading" class="col-12">
      <div class="spinner-border" role="status">
        <span class="sr-only">Loading...</span>
      </div>
    </div>

    <div v-else class="col-12">
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
                </fieldset>
              </div>
            </div>
          </div>
        </div>

        <button type="submit" class="btn btn-success text-white">{{ $t('Update organization') }}</button>
        <button type="reset" class="btn btn-light">{{ $t('Reset') }}</button>
      </form>
    </div>
  </div>
</template>

<script>
import {fetchData, passwordVerification} from '../../helpers'
import Form from "vform";

export default {
  name: "Edit",

  data() {
    return {
      form: new Form({
        name: null,
        description: null,
        email: null,
        phone_number: null,
        website: null,

        // Location details
        location: {
          street: null,
          street_line_2: null,
          city: null,
          country: 'Burkina Faso',
          postal: null
        }
      }),

      hasError: false,
      isLoading: true
    }
  },

  methods: {
    onSubmit: function(){
      passwordVerification((result) => {
        if (result.value) {
          this.form.put(`/organizations/${this.$route.params.organizationId}}`).then(response => {
            this.sweetAlert().fire({
              text: response.data.message,
              icon: 'success',
              confirmButtonColor: '#3085d6',
              confirmButtonText: 'Continue'
            }).then((result) => {
              if (result.value) {
                //
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
    },

    setData: function (organization, error) {
      if (error) {
        this.hasError = true
      }
      this.form.name = organization.name
      this.form.description = organization.description
      this.form.phone_number = organization.phone_number
      this.form.website = organization.website
      this.form.email = organization.email

      this.form.location.street = organization.address.street
      this.form.location.street_line_2 = organization.address.street_line_2
      this.form.location.city = organization.address.city
      this.form.location.country = organization.address.country
      this.form.location.postal = organization.address.postal

      this.isLoading = false
    },

    fetchOrganization: function () {
      fetchData(`/organizations/${this.$route.params.organizationId}`, (data, error) => {
        this.setData(data.organization, error)
      })
    }
  },

  beforeRouteEnter (to, from, next) {
    fetchData(`/organizations/${to.params.organizationId}`, (data, error) => {
      next(vm => {
        vm.isLoading = true
        vm.setData(data.organization, error)
      })
    })
  },

  // when route changes and this component is already rendered,
  // the logic will be slightly different.
  beforeRouteUpdate (to, from, next) {
    fetchData(`/Organizations/${to.params.organizationId}`, (data, error) => {
      this.isLoading = true
      this.setData(data.organization, error)
      next()
    })
  },

  watch: {
    // call again the method if the route changes
    '$route': 'fetchOrganization'
  },

  created() {
    this.fetchOrganization()
  }
}
</script>

<style scoped>

</style>
