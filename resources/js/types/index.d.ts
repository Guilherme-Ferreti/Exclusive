export interface Auth {
  isGuest: boolean;
  isAuthenticated: boolean;
  user: User;
}

export type AppPageProps<T extends Record<string, unknown> = Record<string, unknown>> = T & {
  name: string;
  quote: { message: string; author: string };
  auth: Auth;
};

export interface User {
  id: number;
  name: string;
  email: string;
}
