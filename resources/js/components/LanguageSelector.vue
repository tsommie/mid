<template>
  <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
       data-toggle="dropdown" aria-expanded="false">

      <span v-if="form.busy" class="spinner-border spinner-border-sm text-dark small" role="status">
        <span class="sr-only">Loading...</span>
      </span>

      <span v-else>
        <span style="font-size: 20px">
          <i class="fas fa-language"></i>
        </span>
        <span class="text-uppercase">[{{ locale }}]</span>
      </span>
    </a>
    <ul class="dropdown-menu animate slideIn" aria-labelledby="navbarDropdown">
      <li>
        <a class="dropdown-item" href="#" :class="{' disabled' : locale === 'en'}" @click.prevent="onChange('en')">
            {{ $t('english') }}
        </a>
      </li>
      <li>
        <a class="dropdown-item" href="#" :class="{' disabled' : locale === 'fr'}" @click.prevent="onChange('fr')">
            {{ $t('french') }}
        </a>
      </li>
    </ul>
  </li>
</template>

<script>
import Form from 'vform'

export default {
	name: 'LanguageSelector',

  data() {
    return {
      form: new Form({
        language: window.locale
      })
    }
  },

  methods: {
    onChange: function (value) {
      if (value === window.locale) return;

      this.form.language = value

      this.form.post('/language').then(response => {
        this.sweetAlert().fire({
          text: response.data.message,
          icon: 'success',
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Ok'
        }).then((result) => {
          window.location.reload()
        })
      })
    }
  },

  computed: {
	  locale: function () {
	    return window.locale
    }
  }

}
</script>
