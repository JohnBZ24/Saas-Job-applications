import api from "./axios";

import type {
  AuthResponse,
  LoginCredentials,
  RegisterData,
  User,
} from "../types";

export const register = (data: RegisterData) =>
  api.post<AuthResponse>("/register", data);

export const login = (data: LoginCredentials) =>
  api.post<AuthResponse>("/login", data);

export const logout = () => api.post("/logout");

export const getMe = () => api.get<{ data: User }>("/me");
