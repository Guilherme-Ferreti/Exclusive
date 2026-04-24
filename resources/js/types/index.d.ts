export type AppPageProps<T extends Record<string, unknown> = Record<string, unknown>> = T & {
  name: string;
  auth: Auth;
};

export interface Auth {
  isGuest: boolean;
  isAuthenticated: boolean;
  user: User;
  wishlist: string[];
  cartItems: {
    productId: string;
    quantity: number;
  }[];
}

export interface User {
  id: number;
  name: string;
  email: string;
}

export interface PaginatedResults<T> {
  data: T[];
  total: number;
  perPage: number;
  currentPage: number;
  path: string;
}
