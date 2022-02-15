export default {
  state: {
    currentUser: null
  },
  mutations: {
    setCurrentUser(state, payload) {
      state.currentUser = payload;
    }
  }
}