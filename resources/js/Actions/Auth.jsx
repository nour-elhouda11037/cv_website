import axios from 'axios';
export const registerUser = async (data) => {
  return await axios.post('/register', data);};
export const loginUser = async (data) => {
  return await axios.post('/login', data);};