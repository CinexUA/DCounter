import Vue from 'vue'
import store from '../store'
import VueI18n from 'vue-i18n'

Vue.use(VueI18n)

const i18n = new VueI18n({
    locale: 'uk',
    fallback: 'en',
    silentTranslationWarn: true,
    messages: {},
    pluralizationRules: {
        /**
         * @param choice {number} a choice index given by the input to $tc: `$tc('path.to.rule', choiceIndex)`
         * @param choicesLength {number} an overall amount of available choices
         * @returns a final choice index to select plural word by
         */
        'uk': function(choice, choicesLength) {
            // this === VueI18n instance, so the locale property also exists here
            if (choice === 0) {
                return 0;
            }

            const teen = choice > 10 && choice < 20;
            const endsWithOne = choice % 10 === 1;

            if (choicesLength < 4) {
                return (!teen && endsWithOne) ? 1 : 2;
            }
            if (!teen && endsWithOne) {
                return 1;
            }
            if (!teen && choice % 10 >= 2 && choice % 10 <= 4) {
                return 2;
            }

            return (choicesLength < 4) ? 2 : 3;
        }
    }
})

/**
 * @param {String} locale
 */
export async function loadMessages (locale) {
    if (Object.keys(i18n.getLocaleMessage(locale)).length === 0) {
        const messages = await import(/* webpackChunkName: '' */ `../locales/${locale}`)
        i18n.setLocaleMessage(locale, messages)
    }

    if (i18n.locale !== locale) {
        i18n.locale = locale
    }
}

;(async function () {
    await loadMessages(store.getters['lang/locale'])
})()

export default i18n
