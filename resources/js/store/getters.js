const getters = {
  sidebar: state => state.app.sidebar,
  language: state => state.app.language,
  size: state => state.app.size,
  device: state => state.app.device,
  visitedViews: state => state.tagsView.visitedViews,
  cachedViews: state => state.tagsView.cachedViews,
  token: state => state.user.token,
  avatar: state => state.user.avatar,
  email: state => state.user.email,
  username: state => state.user.username,
  name: state => state.user.name,
  roleId: state => state.user.roleId,
  roleName: state => state.user.roleName,
};
export default getters;
