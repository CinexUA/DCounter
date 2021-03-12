import axios from 'axios'
import Cookies from 'js-cookie'
import Swal from 'sweetalert2'
import * as types from '../mutation-types'

// state
export const state = {
    clients: [],
    tokens: Cookies.get('tokens') ? JSON.parse(Cookies.get('tokens')) : []
}

// getters
export const getters = {
    clients: state => state.clients,
    tokens: state => state.tokens,
    isTokenExist: state => token => state.tokens.includes(token),
}

// mutations
export const mutations = {
    [types.SAVE_TOKEN] (state, { token })
    {
        const tokensArray = state.tokens;
        tokensArray.push(token)
        state.tokens = tokensArray
        Cookies.set('tokens', JSON.stringify(tokensArray), 1825)
    },
    [types.REMOVE_TOKENS] (state)
    {
        state.tokens = []
        Cookies.remove('tokens')
    },
    [types.STORE_CLIENTS] (state, clients)
    {
        state.clients = clients
    },
    [types.REMOVE_CLIENTS] (state)
    {
        state.clients = []
    }
}

// actions
export const actions = {
    async saveToken ({ commit, getters }, payload)
    {
        if(!getters.isTokenExist(payload.token)){
            commit(types.SAVE_TOKEN, payload)
        } else {
            Swal.fire({
                type: 'warning',
                title: this.$t('client.client_already_added'),
                reverseButtons: true,
                confirmButtonText: this.$t('ok'),
                cancelButtonText: this.$t('cancel')
            })
        }
    },
    removeTokens({ commit })
    {
        commit(types.REMOVE_TOKENS)
        commit(types.REMOVE_CLIENTS)
    },
    async fetchClients({ commit, getters })
    {
        if(getters.tokens.length > 0){
            const { data } = await axios.post('/api/client/clients', {tokens: getters.tokens})
            commit(types.STORE_CLIENTS, data.data)
        }
    },
    async fetchClientPaymentHistory({}, {rememberToken, page})
    {
        const result = await axios.post(`/api/client/${rememberToken}/payment-history?page=${page}`, {})
        return result.data
    }
}
