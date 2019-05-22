import request from '@/utils/request';
const API_URL = '/auth/';

export function login(data) {
  return request({
    url: API_URL + 'login',
    method: 'post',
    data: data,
  });
}

export function getInfo(token) {
  return request({
    url: API_URL + 'info',
    method: 'get',
  });
}

export function logout() {
  return request({
    url: API_URL + 'logout',
    method: 'post',
  });
}
