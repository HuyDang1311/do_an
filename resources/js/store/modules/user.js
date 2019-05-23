import { login, logout, getInfo } from '@/api/auth';
import { getToken, setToken, removeToken } from '@/utils/auth';
import router, { resetRouter } from '@/router';
import store from '@/store';

const state = {
  id: null,
  token: getToken(),
  username: '',
  name: '',
  avatar: '',
  roles: [],
  email: '',
  address: '',
};

const mutations = {
  SET_ID: (state, id) => {
    state.id = id;
  },
  SET_TOKEN: (state, token) => {
    state.token = token;
  },
  SET_USERNAME: (state, username) => {
    state.username = username;
  },
  SET_NAME: (state, name) => {
    state.name = name;
  },
  SET_AVATAR: (state, avatar) => {
    state.avatar = avatar;
  },
  SET_ROLES: (state, roles) => {
    state.roles = roles;
  },
  SET_EMAIL: (state, email) => {
    state.email = email;
  },
  SET_ADDRESS: (state, address) => {
    state.address = address;
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
          const { role, name, avatar, username, address, id, email } = response.data;
          commit('SET_ID', id);
          commit('SET_USERNAME', username);
          commit('SET_NAME', name);
          commit('SET_AVATAR', avatar);
          commit('SET_ROLES', role);
          commit('SET_EMAIL', email);
          commit('SET_ADDRESS', address);
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

          const { role, name, avatar, username, address, id, email } = data;
          // roles must be a non-empty array
          if (!role || role.length <= 0) {
            reject('getInfo: roles must be a non-null array!');
          }

          commit('SET_ID', id);
          commit('SET_USERNAME', username);
          commit('SET_NAME', name === undefined ? name : '');
          commit('SET_AVATAR', avatar === undefined ? avatar : '');
          commit('SET_ROLES', role);
          commit('SET_EMAIL', email === undefined ? email : '');
          commit('SET_ADDRESS', address === undefined ? address : '');

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
          commit('SET_ROLES', []);
          removeToken();
          resetRouter();
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
      commit('SET_ROLES', []);
      removeToken();
      resolve();
    });
  },

  // Dynamically modify permissions
  changeRoles({ commit, dispatch }, role) {
    return new Promise(async resolve => {
      // const token = role + '-token';

      // commit('SET_TOKEN', token);
      // setToken(token);

      // const { roles } = await dispatch('getInfo');

      const roles = [role.name];
      const permissions = role.permissions.map(permission => permission.name);
      commit('SET_ROLES', roles);
      commit('SET_PERMISSIONS', permissions);
      resetRouter();

      // generate accessible routes map based on roles
      const accessRoutes = await store.dispatch('permission/generateRoutes', { roles, permissions });

      // dynamically add accessible routes
      router.addRoutes(accessRoutes);

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
