import axios from 'axios';

const state = () => ({
  posts: [],
  post: {}
});


const getters = {
  getPosts(state) {
    return state.posts;
  },
  getPost(state) {
    return state.post;
  }
}

const mutations = {
  setPosts(state, payload){
    state.posts = payload;
  },
  setPost(state, payload){
    state.post = payload;
  }
}

const actions = {
  async fetchPosts({ commit }){
    let res = await axios.get('https://jsonplaceholder.typicode.com/posts?_limit=10');
    commit('setPosts', res.data);
  }
}

export default {
  namespaced: true,
  state,
  getters,
  mutations,
  actions
}