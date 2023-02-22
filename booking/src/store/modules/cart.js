import { login, getInfo } from '@/api/user'

const state = {
  carts: [],
}

const mutations = {
  SET_CART: (state, p) => {
    state.carts.push(p);
  },
  DEL_CART: (state, p) => {
    state.carts.push(p);
  },
  CLEAN_CART: (state, p) => {
    state.carts.push(p);
  },
}

const actions = {

}

export default {
  namespaced: true,
  state,
  mutations,
  actions
}
