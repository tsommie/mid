<template>
  <div class="row">
    <div class="col-12 my-3">
      <div class="row">
        <div class="p-5 bg-white">
          <h1 class="h3">{{ $t('Add client') }}</h1>
        </div>
      </div>
    </div>

    <div class="col-12">
      <alert-errors :form="form" message="There were some problems with your input."></alert-errors>

      <form @submit.prevent="onSubmit" enctype="multipart/form-data" @keydown="form.onKeydown($event)">
        <div class="row">
          <div class="col-md-6">
            <div class="row mb-3">
              <div class="col-12">
                <fieldset>
                  <legend>{{ $t('Profile') }}</legend>
                  <div class="row mb-3">

                    <div class="col-md-6">
                      <passport-upload @image-selected="onPassportUpload"></passport-upload>
                    </div>

                    <div class="col-md-6">
                      <div class="mb-3">
                        <label for="administratorFirstName" class="form-label">{{ $t('First name') }}</label>
                        <input type="text"
                               v-model="form.first_name"
                               name="first_name"
                               class="form-control"
                               id="administratorFirstName"
                               :placeholder="$t('First name')"
                               :class="{ 'is-invalid': form.errors.has('first_name') }"
                               aria-describedby="administratorFirstNameHelp">
                        <has-error :form="form" field="first_name"></has-error>
                        <div id="administratorFirstNameHelp" class="form-text">{{ $t("The first name of the user") }}. <small class="text-danger">*Required</small></div>
                      </div>

                      <div class="mb-3">
                        <label for="administratorLastName" class="form-label">{{ $t('Last name') }}</label>
                        <input type="text"
                               v-model="form.last_name"
                               name="last_name"
                               class="form-control"
                               id="administratorLastName"
                               :placeholder="$t('Last name')"
                               :class="{ 'is-invalid': form.errors.has('last_name') }"
                               aria-describedby="administratorFirstNameHelp">
                        <has-error :form="form" field="last_name"></has-error>
                        <div id="administratorLastNameHelp" class="form-text">{{ $t("The last name of the user") }}. <small class="text-danger">*Required</small></div>
                      </div>

                      <div class="mb-3">
                        <label for="administratorOtherNames" class="form-label">{{ $t('Other names') }}</label>
                        <input type="text"
                               v-model="form.other_names"
                               name="other_names"
                               class="form-control"
                               id="administratorOtherNames"
                               :placeholder="$t('Other names')"
                               :class="{ 'is-invalid': form.errors.has('other_names') }"
                               aria-describedby="administratorFirstNameHelp">
                        <has-error :form="form" field="other_names"></has-error>
                        <div id="administratorOtherNamesHelp" class="form-text">{{ $t("The other names of the user") }}.</div>
                      </div>

                      <div class="mb-3">
                        <label for="dateOfBirth" class="form-label">{{ $t('Date of Birth') }}</label>
                        <input type="date"
                               v-model="form.first_name"
                               name="first_name"
                               class="form-control"
                               id="dateOfBirth"
                               :placeholder="$t('Date of Birth')"
                               :class="{ 'is-invalid': form.errors.has('first_name') }"
                               aria-describedby="dateOfBirthHelp">
                        <has-error :form="form" field="first_name"></has-error>
                        <div id="dateOfBirthHelp" class="form-text">{{ $t("The date of birth of the client") }}. <small class="text-danger">*Required</small></div>
                      </div>
                    </div>
                  </div>

                </fieldset>
                <hr />

                <fieldset>
                  <legend>{{ $t('Identification card') }}</legend>
                  <div class="row mb-3 g-1">
                    <div class="col-6">
                      <label class="form-label">{{ $t('Card type') }}</label>
                      <div class="input-group mb-3">
                        <label class="input-group-text" for="inputGroupSelect01">{{ $t('Card type') }}</label>
                        <select v-model="form.identification_card.type"
                                class="form-select"
                                id="inputGroupSelect01"
                                :class="{ 'is-invalid': form.errors.has('identification_card.type') }">
                          <option selected>Choose...</option>
                          <option :value="$t('International passport')">{{ $t('International passport') }}</option>
                          <option :value="$t('National identification')">{{ $t('National identification') }}</option>
                          <option :value="$t('Driver\'s licence')">{{ $t("Driver's licence") }}</option>
                        </select>
                        <has-error :form="form" field="identification_card.type"></has-error>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="mb-3">
                        <label for="cardNumber" class="form-label">{{ $t('Card Number') }}</label>
                        <input type="text"
                               v-model="form.identification_card.number"
                               name="identification_card[number]"
                               class="form-control"
                               id="cardNumber"
                               :placeholder="$t('Last name')"
                               :class="{ 'is-invalid': form.errors.has('identification_card.number') }"
                               aria-describedby="cardNumberHelp">
                        <has-error :form="form" field="identification_card.number"></has-error>
                        <div id="cardNumberHelp" class="form-text">{{ $t("The identification number on the card") }}. <small class="text-danger">*Required</small></div>
                      </div>
                    </div>
                  </div>
                </fieldset>
              </div>

              <div class="col-12">
                <div class="row">
                  <div class="col-12">
                    <fieldset>
                      <legend>{{ $t('Biometrics') }}</legend>

                      <finger-print-biometric-field @data-ready="onRightDataReady" :title="$t('Right hand')"></finger-print-biometric-field>

                      <finger-print-biometric-field @data-ready="onLeftDataReady" :title="$t('Left hand')"></finger-print-biometric-field>
                    </fieldset>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-md-6">
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
                           :placeholder="$t('Email Address')"
                           :class="{ 'is-invalid': form.errors.has('email') }"
                           aria-describedby="emailHelp">
                    <has-error :form="form" field="email"></has-error>
                    <div id="emailHelp" class="form-text">{{ $t("Please provide a client email") }}. <small class="text-danger">*Required</small></div>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="mb-3">
                    <label for="administratorPhoneNumber" class="form-label">{{ $t('Phone number') }}</label>
                    <input type="tel"
                           v-model="form.primary_phone_number"
                           name="primary_phone_number"
                           class="form-control"
                           id="administratorPhoneNumber"
                           :placeholder="$t('Phone number')"
                           :class="{ 'is-invalid': form.errors.has('primary_phone_number') }"
                           aria-describedby="administratorPhoneNumberHelp">
                    <has-error :form="form" field="primary_phone_number"></has-error>
                    <div id="administratorPhoneNumberHelp" class="form-text">{{ $t("Please provide an client phone number") }}. <small class="text-danger">*Required</small></div>
                  </div>
                </div>
              </div>

              <hr />
            </fieldset>

            <fieldset>
              <legend>{{ $t('Address') }}</legend>
              <div class="row mb-3 g-1">
                <div class="col-12">
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
                </div>
              </div>
            </fieldset>
          </div>
        </div>

        <button type="submit" class="btn btn-success text-white">{{ $t('Add client') }}</button>
        <button type="reset" class="btn btn-light">{{ $t('Reset') }}</button>
      </form>
    </div>
  </div>
</template>

<script>
import Form from 'vform'
import FingerImageUpload from "../../components/FingerImageUpload";
import FingerPrintBiometricField from "../../components/FingerPrintBiometricField";
import PassportUpload from "../../components/PassportUpload";
import {passwordVerification} from "../../helpers";

export default {
  name: 'Create',
  components: {PassportUpload, FingerPrintBiometricField, FingerImageUpload},
  data() {
    return {
      form: new Form({
        email: null,
        primary_phone_number: null,
        first_name: null,
        last_name: null,
        other_names: null,
        passport_photograph: null,
        dob: null,
        identification_card: {
          type: null,
          number: null
        },
        right_hand: null,
        left_hand: null,

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
          this.form.post(`/clients`).then(response => {
            this.sweetAlert().fire({
              text: response.data.message,
              icon: 'success',
              confirmButtonColor: '#3085d6',
              confirmButtonText: 'Continue'
            }).then((result) => {
              if (result.value) {
                this.$router.push({
                  name: 'clients.show',
                  params: { userId: `${response.data.client.id}` }
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
    },

    onPassportUpload: function({ image }) {
      this.form.passport_photograph = image
    },

    onRightDataReady: function ({ data }) {
      this.form.right_hand = data
    },

    onLeftDataReady: function ({ data }) {
      this.form.left_hand = data
    }
  }
}
</script>

<style scoped>

</style>
