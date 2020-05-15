// import Vue from 'vue'
// import Vuex from 'vuex'
// import axios from 'axios';
// import {RESOURCE_USER} from '../api';
// Vue.use(Vuex);
// export const store = new Vuex.Store({
//     state:{
//         users:[],
//         user:{},
//         category:[],
//     },
//     getters:{
//         users(state){
//             return state.users;
//         },
//         category(state){
//             return state.category;
//         }
//     },
//     mutations:{
//         FETCH_USERS(state, users){
//             state.users = users;
//         },
//         DELETE_USERS(state, payload){
//             Vue.delete(state.users, payload.users.user_id);
//         },
//         FETCH_CATEGORY(state, category){
//             state.category = category;
//         }
//     },
//     actions:{
//         fetchUser({commit}){
//             axios.get(`${RESOURCE_USER}/users`)
//                 .then(res => res.data)
//                 .then(users => {
//                     commit('FETCH_USERS', users)
//                 });
//         },
//         deleteUser({commit}, id){
//         // .then(res => res.data.success)
//             axios.delete(`${RESOURCE_USER}/users/${id}`)
//                 .then(res => console.log(res.data.result))
//                 .then(users => {
//                     commit('DELETE_USERS', users)
//                 });
//         },
//         logoutAdmin({commit}){
//             axios.get(`${RESOURCE_USER}/users/logout`)
//                 .then(res => console.log(res.data.result))
//                 .then(users => {
//                     commit('LOGOUT_USER', users)
//                 })
//         },
//     //    category
//         fetchCategory({commit}){
//             axios.get(`${RESOURCE_USER}/category`)
//                 .then(res =>res.data)
//                 .then(category => {
//                     commit('FETCH_CATEGORY', category)
//                 });
//         },
//         editUser({}, user) {
//             axios.put(`${RESOURCE_USER}/${user.id}`, {
//                 name: user.name,
//                 email: user.email,
//                 password: user.password,
//             })
//                 .then(() => this.dispatch('fetch'));
//         },
//     }
// });
// export default store
