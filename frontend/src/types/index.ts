export type Role = "admin" | "org" | "seeker";

export interface User {
  id: number;
  name: string;
  email: string;
  role: Role;
  profile?: OrganizationProfile | SeekerProfile;
}

export interface OrganizationProfile {
  id: number;
  company_name: string;
  description: string | null;
  website: string | null;
  industry: string;
  phone: string | null;
  email: string | null;
  country: string | null;
  city: string | null;
  address: string | null;
  plan: "free" | "pro";
}

export interface SeekerProfile {
  id: number;
  first_name: string;
  last_name: string;
  headline: string | null;
  bio: string | null;
  phone: string | null;
  country: string | null;
  city: string | null;
  open_to_remote: boolean;
  available: boolean;
}
export interface JobListing {
  id: number;
  title: string;
  description: string;
  location: string | null;
  type: "full-time" | "part-time" | "contract" | "remote" | "internship";
  salary_range: string | null;
  status: "pending" | "approved" | "rejected" | "closed";
  deadline: string | null;
  created_at: string;
  organization?: OrganizationProfile;
}
export interface JobApplication {
  id: number;
  status: "applied" | "reviewed" | "shortlisted" | "rejected";
  message: string | null;
  user?: User;
  job?: JobListing;
}

export interface AuthResponse {
  user: { data: User };
  token: string;
}

export interface LoginCredentials {
  email: string;
  password: string;
}

export interface RegisterData {
  name: string;
  email: string;
  password: string;
  password_confirmation: string;
  role: "org" | "seeker";
}
