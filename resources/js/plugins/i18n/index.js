import Vue from 'vue'
import VueI18n from 'vue-i18n'
import en from './en'
import fr from './fr'

Vue.use(VueI18n)

const messages = {
    en,
    fr
}

// register with `formatter` option
export const i18n = new VueI18n({
    locale: window.locale,
    messages
})

export default i18n
