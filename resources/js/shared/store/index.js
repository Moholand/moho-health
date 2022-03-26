import { createStore } from 'vuex';
import { isLoggedIn, logOut } from "../helpers/auth";
import axios from "axios";

const store = createStore({
  state: {
    isLoggedIn: false,
    user: {}
  },
  mutations: {
    setUser(state, payload) {
      state.user = payload;
    },
    setLoggedIn(state, payload) {
      state.isLoggedIn = payload;
    }
  },
  actions: {
    async loadUser({ commit, dispatch }) {
      if(isLoggedIn()) {
        try {
          window.axios.defaults.headers.common['Authorization'] = `Bearer ${localStorage.getItem('token')}`;
          const user = (await axios.get('/api/user')).data;
          commit('setUser', user);
          commit('setLoggedIn', true);
        } catch(error) {
          dispatch('logout');
        }
      }
    },
    logout({ commit }) {
      commit('setUser', {});
      commit('setLoggedIn', false);
      localStorage.removeItem('token');
      logOut();
    }
  }
});

export default store;
