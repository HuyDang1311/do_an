import { login, logout, getInfo } from '@/api/auth';
import { getToken, setToken, removeToken } from '@/utils/auth';

const state = {
  token: getToken(),
  avatar: '',
  email: '',
  username: '',
  name: '',
  roleId: '',
  roleName: '',
};

const mutations = {
  SET_TOKEN: (state, token) => {
    state.token = token;
  },
  SET_AVATAR: (state, avatar) => {
    state.avatar = avatar;
  },
  SET_EMAIL: (state, email) => {
    state.email = email;
  },
  SET_USERNAME: (state, username) => {
    state.username = username;
  },
  SET_NAME: (state, name) => {
    state.name = name;
  },
  SET_ROLE_ID: (state, roleId) => {
    state.roleId = roleId;
  },
  SET_ROLE_NAME: (state, roleName) => {
    state.roleName = roleName;
  },
};

const actions = {
  // user login
  login({ commit }, userInfo) {
    const { username, password } = userInfo;
    return new Promise((resolve, reject) => {
      login({ username: username.trim(), password: password })
        .then(response => {
          commit('SET_TOKEN', response.token);
          setToken(response.token);
          resolve();
        })
        .catch(error => {
          reject(error);
        });
    });
  },

  // get user info
  getInfo({ commit, state }) {
    return new Promise((resolve, reject) => {
      getInfo(state.token)
        .then(response => {
          const { data } = response;

          if (!data) {
            reject('Verification failed, please Login again.');
          }

          const { role, name, avatar, email, username } = data;
          // roles must be a non-empty array
          if (!role || role.length <= 0) {
            reject('getInfo: roles must be a non-null array!');
          }

          commit('SET_ROLES', roles);
          commit('SET_AVATAR', avatar);
          commit('SET_EMAIL', email);
          commit('SET_USERNAME', username);
          commit('SET_NAME', name);
          commit('SET_ROLE_ID', role.value !== undefined ? role.value : '');
          commit('SET_ROLE_NAME', role.value !== undefined ? role.text : '');
          resolve(data);
        })
        .catch(error => {
          reject(error);
        });
    });
  },

  // user logout
  logout({ commit, state }) {
    return new Promise((resolve, reject) => {
      logout(state.token)
        .then(() => {
          commit('SET_TOKEN', '');
          commit('SET_ROLE_ID', '');
          commit('SET_ROLE_NAME', '');
          removeToken();
          resolve();
        })
        .catch(error => {
          reject(error);
        });
    });
  },

  // remove token
  resetToken({ commit }) {
    return new Promise(resolve => {
      commit('SET_TOKEN', '');
      commit('SET_ROLE_ID', '');
      commit('SET_ROLE_NAME', '');
      removeToken();
      resolve();
    });
  },
};

export default {
  namespaced: true,
  state,
  mutations,
  actions,
};
