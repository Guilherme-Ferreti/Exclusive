export type AppPageProps<T extends Record<string, unknown> = Record<string, unknown>> = T & {
  name: string;
  auth: Auth;
};

export interface Auth {
  isGuest: boolean;
  isAuthenticated: boolean;
  user: User;
  wishlist: string[];
  cartItemsCount: number;
}

export interface User {
  id: number;
  name: string;
  email: string;
}
