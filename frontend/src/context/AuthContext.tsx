import React, { useEffect, useState, type ReactNode } from "react";
import {
  getMe,
  login as loginApi,
  logout as logoutApi,
  register as registerApi,
} from "../api/auth";
import type { User, LoginCredentials, RegisterData } from "../types";
import { AuthContext } from "./useAuth";

export function AuthProvider({ children }: { children: ReactNode }) {
  const [user, setUser] = useState<User | null>(null);
  const [loading, setLoading] = useState<boolean>(true);

  useEffect(() => {
    const token = localStorage.getItem("token");
    if (!token) {
      setLoading(false);
      return;
    }
    getMe()
      .then((res) => setUser(res.data.data))
      .catch(() => {
        localStorage.removeItem("token");
        setUser(null);
      })
      .finally(() => setLoading(false));
  }, []);

  const login = async (credentials: LoginCredentials): Promise<User> => {
    const res = await loginApi(credentials);
    localStorage.setItem("token", res.data.token);
    setUser(res.data.user.data);
    return res.data.user.data;
  };

  const register = async (data: RegisterData): Promise<User> => {
    const res = await registerApi(data);
    localStorage.setItem("token", res.data.token);
    setUser(res.data.user.data);
    return res.data.user.data;
  };

  const logout = async (): Promise<void> => {
    try {
      await logoutApi();
    } finally {
      localStorage.removeItem("token");
      setUser(null);
    }
  };

  return (
    <AuthContext.Provider value={{ user, loading, login, register, logout }}>
      {children}
    </AuthContext.Provider>
  );
}
// 1. Create Context (empty box)
//    ↓
// 2. Create Hook useAuth() (tool to grab from box)
//    ↓
// 3. Create Provider (fills box + broadcasts data)
//    ↓
// 4. Wrap App with Provider in main.tsx
//    ↓
// 5. Components use Hook to get data
