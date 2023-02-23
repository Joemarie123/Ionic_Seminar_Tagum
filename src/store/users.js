import axios from 'axios';

axios.defaults.baseURL = process.env.VUE_APP_API_URL;

const state = () => ({
  users: [],
  auth: {},
})

const getters = {
  getUsers(state) {
    return state.users;
  },
  getAuth(state){
    return state.auth;
  }
}

const mutations = {
  setUsers(state, payload){
    state.users = payload;
  },
  setAuth(state, payload){
    state.auth = payload;
  }
}

const actions = {
  async fetchUsers({commit}){
    let res = await axios.get(`/users.php`);

    commit('setUsers', res.data);
  },
  async registration({commit}, payload){
    let res = await axios.post('/new_user.php', payload);

    localStorage.setItem('auth', JSON.stringify(res.data.user[0]));
    commit('setAuth', res.data.user[0]);
  },
  async login({commit}, payload){
    let res = await axios.post('/login.php', payload);

    if (res.data.users.length == 0)
      return res.data.users.length;

    localStorage.setItem('auth', JSON.stringify(res.data.users[0]));
    commit("setAuth", res.data.users[0]);

    return 1;
  }
}

export default {
  namespaced: true,
  state,
  actions,
  getters,
  mutations
}